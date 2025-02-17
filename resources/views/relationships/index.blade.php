@extends('layouts.app')

@section('content')
<style>
    /* -------------------- CSS “cũ” -------------------- */
    #panzoom-container {
        width: 100%;
        height: 100vh;
        overflow: hidden;
        position: relative;
    }

    .tree {
        cursor: grab;
        transform-origin: 0 0;
    }

    .tree ul {
        padding-top: 35px;
        position: relative;
        white-space: nowrap;
    }

    .tree li {
        display: inline-block;
        text-align: center;
        list-style-type: none;
        position: relative;
        padding: 35px 10px 0 10px;
        vertical-align: top;
    }

    .tree li::after {
        right: auto;
        left: 50%;
        border-left: 2px solid #aaa;
    }

    .tree li:only-child::after,
    .tree li:only-child::before {
        display: none;
    }

    .tree li:only-child {
        padding-top: 0;
    }

    .tree li:first-child::before,
    .tree li:last-child::after {
        border: 0 none;
    }

    .tree li:last-child::before {
        border-right: 2px solid #aaa;
        border-radius: 0 5px 0 0;
    }

    .tree li:first-child::after {
        border-radius: 5px 0 0 0;
    }

    .tree li a {
        align-items: center;
        border: 2px solid #7d5803;
        padding: 10px 15px;
        text-decoration: none;
        color: black;
        font-size: 14px;
        font-weight: bold;
        display: inline-block;
        border-radius: 8px;
        background: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 2;
    }

    .tree li .avt {
        width: 50px;
        height: 50px;
        border-radius: 8px;
    }

    .tree li a:hover + ul li::after,
    .tree li a:hover + ul li::before,
    .tree li a:hover + ul::before,
    .tree li a:hover + ul ul::before {
        border-color: black;
    }

    .tree li a .detail {
        color: white;
        position: absolute;
        top: 115%;
        left: -10%;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 1s ease, transform 1s ease;
        white-space: nowrap;
        z-index: 10;
        background: rgba(0, 0, 0, 0.7);
        padding: 2px 4px;
        border-radius: 4px;
    }

    .tree li a:hover .detail {
        color: white;
        opacity: 1;
        transform: translateY(0);
    }

    /* -------------------- CSS cho SVG (đường nối cong) -------------------- */
    #links-layer {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        /* Để không cản event của các phần tử HTML bên dưới */
    }

    .link {
        fill: none;
        stroke: #aaa;
        stroke-width: 2px;
    /
    }
</style>

<body style="overflow-y: hidden;">
<div id="panzoom-container">
    <div id="tree-wrapper" style="position: absolute; top:0; left:0;">
        <svg id="links-layer"></svg>
        <div class="tree" id="relationship-tree"></div>
    </div>
</div>
<script>
    d3.json("{{ route('getRelationshipData') }}").then(function (members) {
        const treeContainer = d3.select("#relationship-tree");

        // Hàm đệ quy dựng cây dạng ul/li; thêm data-id và data-parent để xác định quan hệ giữa các nút
        function renderTree(parentId, selection) {
            const children = members.filter(member => member.ChaID === parentId);
            if (!children.length) return;
            const ul = selection.append("ul");
            children.forEach(child => {
                const li = ul.append("li")
                    .attr("data-id", child.ID)
                    .attr("data-parent", parentId || "");
                const a = li.append("a");
                a.html(`<img class="avt" src="${child.AVT}">
                  <p>${child.HoTen}</p>
                  <span class="detail">Quan hệ: ${child.QuanHe}<br>Ngày sinh: ${child.NgaySinh}</span>`);
                // Đệ quy với các con của node hiện tại
                renderTree(child.ID, li);
            });
        }

        // Xử lý các phần tử gốc (ChaID == null hoặc undefined)
        const roots = members.filter(member => !member.ChaID);
        const ulRoot = treeContainer.append("ul");
        roots.forEach(root => {
            const li = ulRoot.append("li")
                .attr("data-id", root.ID);
            const a = li.append("a");
            a.html(`<img class="avt" src="${root.AVT}">
                <p>${root.HoTen}</p>
                <span class="detail">Quan hệ: ${root.QuanHe}<br>Ngày sinh: ${root.NgaySinh}</span>`);
            renderTree(root.ID, li);
        });

        // Sau khi cây được dựng, vẽ đường nối cong giữa các nút
        function updateLinks() {
            const svg = d3.select("#links-layer");
            svg.selectAll("*").remove(); // Xóa các đường nối cũ

            // Duyệt qua tất cả các nút <li> có thuộc tính data-parent (nút con)
            d3.selectAll("li").each(function () {
                const li = d3.select(this);
                const parentId = li.attr("data-parent");
                if (parentId) { // Nếu có nút cha
                    // Tìm nút cha có data-id = parentId
                    const parentLi = d3.select(`[data-id='${parentId}']`);
                    if (!parentLi.empty()) {
                        // Lấy phần tử <a> của nút con và nút cha để tính vị trí nối
                        const childA = li.select("a").node();
                        const parentA = parentLi.select("a").node();
                        if (childA && parentA) {
                            // Tính vị trí tương đối so với wrapper
                            const wrapperRect = document.getElementById("tree-wrapper").getBoundingClientRect();
                            const childRect = childA.getBoundingClientRect();
                            const parentRect = parentA.getBoundingClientRect();

                            // Tính vị trí bottom-center của nút cha và top-center của nút con
                            const x1 = parentRect.left + parentRect.width / 2 - wrapperRect.left;
                            const y1 = parentRect.top + parentRect.height - wrapperRect.top;
                            const x2 = childRect.left + childRect.width / 2 - wrapperRect.left;
                            const y2 = childRect.top - wrapperRect.top;

                            // Sử dụng khoảng cách dọc giữa nút cha và con để tính offset cho các điểm điều khiển
                            const deltaY = (y2 - y1) * 0.5;
                            const path = `M${x1},${y1} C${x1},${y1 + deltaY} ${x2},${y2 - deltaY} ${x2},${y2}`;

                            svg.append("path")
                                .attr("class", "link")
                                .attr("d", path)
                                .attr("fill", "none")
                                .attr("stroke", "#ccc")
                                .attr("stroke-width", 2)
                                .attr("stroke-linecap", "round");
                        }
                    }
                }
            });
        }

        // Cho phép một chút thời gian để trình duyệt hoàn tất layout
        setTimeout(updateLinks, 1);

        // Thiết lập pan và zoom bằng D3 cho wrapper chứa cả SVG & HTML
        const panzoomContainer = d3.select("#panzoom-container");
        const treeWrapper = d3.select("#tree-wrapper");
        const zoom = d3.zoom()
            .scaleExtent([0.7, 3])
            .on("zoom", (event) => {
                treeWrapper.style("transform", `translate(${event.transform.x}px, ${event.transform.y}px) scale(${event.transform.k})`);
            });
        panzoomContainer.call(zoom);

        // (Tùy chọn) Cập nhật lại các đường nối khi cửa sổ thay đổi kích thước
        window.addEventListener("resize", function () {
            setTimeout(function () {
                // Gọi lại hàm updateLinks() sau khi resize (nếu cần)
                if (typeof updateLinks === "function") updateLinks();
            }, 500);
        });
    });
</script>
</body>

</html>
@endsection
