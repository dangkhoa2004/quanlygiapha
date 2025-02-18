@extends('layouts.app')

@section('content')
<style>
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

    .tree li a:hover+ul li::after,
    .tree li a:hover+ul li::before,
    .tree li a:hover+ul::before,
    .tree li a:hover+ul ul::before {
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

    #links-layer {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
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
        d3.json("{{ route('getRelationshipData') }}").then(members => {
            const treeContainer = d3.select("#relationship-tree");

            const renderTree = (parentId, selection) => {
                const children = members.filter(m => m.ChaID === parentId);
                if (!children.length) return;
                const ul = selection.append("ul");
                children.forEach(child => {
                    const li = ul.append("li").attr("data-id", child.ID).attr("data-parent", parentId || "");
                    li.append("a").html(`<img class="avt" src="${child.AVT}"><p>${child.HoTen}</p><span class="detail">Quan hệ: ${child.QuanHe}<br>Ngày sinh: ${child.NgaySinh}</span>`);
                    renderTree(child.ID, li);
                });
            };

            const ulRoot = treeContainer.append("ul");
            members.filter(m => !m.ChaID).forEach(root => {
                const li = ulRoot.append("li").attr("data-id", root.ID);
                li.append("a").html(`<img class="avt" src="${root.AVT}"><p>${root.HoTen}</p><span class="detail">Quan hệ: ${root.QuanHe}<br>Ngày sinh: ${root.NgaySinh}</span>`);
                renderTree(root.ID, li);
            });

            const updateLinks = () => {
                const svg = d3.select("#links-layer").html("");
                d3.selectAll("li[data-parent]").each(function() {
                    const li = d3.select(this),
                        parentLi = d3.select(`[data-id='${li.attr("data-parent")}'`);
                    if (parentLi.empty()) return;
                    const childA = li.select("a").node(),
                        parentA = parentLi.select("a").node();
                    if (!childA || !parentA) return;

                    const wrapperRect = document.getElementById("tree-wrapper").getBoundingClientRect();
                    const [x1, y1] = [parentA.getBoundingClientRect().left + parentA.offsetWidth / 2 - wrapperRect.left, parentA.getBoundingClientRect().bottom - wrapperRect.top];
                    const [x2, y2] = [childA.getBoundingClientRect().left + childA.offsetWidth / 2 - wrapperRect.left, childA.getBoundingClientRect().top - wrapperRect.top];
                    const deltaY = (y2 - y1) * 0.5;
                    svg.append("path").attr("class", "link").attr("d", `M${x1},${y1} C${x1},${y1 + deltaY} ${x2},${y2 - deltaY} ${x2},${y2}`)
                        .attr("fill", "none").attr("stroke", "#ccc").attr("stroke-width", 2).attr("stroke-linecap", "round");
                });
            };

            setTimeout(updateLinks, 1);

            d3.select("#panzoom-container").call(d3.zoom().scaleExtent([0.7, 3]).on("zoom", e => {
                d3.select("#tree-wrapper").style("transform", `translate(${e.transform.x}px, ${e.transform.y}px) scale(${e.transform.k})`);
            }));

            window.addEventListener("resize", () => setTimeout(updateLinks, 500));
        });
    </script>
</body>
@endsection