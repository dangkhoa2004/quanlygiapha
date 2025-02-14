@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="event-container">
        <div id="calendar" class="calendar"></div>
    </div>
    <div id="range-actions">
        <button id="btnAddEvent">Thêm Sự Kiện</button>
        <button id="btnCancelSelection">Hủy Chọn</button>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Các biến dùng chung
        const calendarEl = document.getElementById("calendar");
        let selectedRange = null;
        let selectedSingleDate = null;
        let longPressTimeout;
        let startX, startY;

        // Khởi tạo FullCalendar
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,listYear"
            },
            buttonText: {
                prev: "Trang trước",
                next: "Trang sau",
                today: "Hiện tại",
                month: "Lịch tháng",
                list: "Danh sách sự kiện"
            },
            selectable: true,
            locale: "vi",
            titleFormat: {
                month: "long"
            },
            dateClick: () => {},
            select: info => {
                selectedRange = {
                    start: info.startStr,
                    end: info.endStr
                };
                selectedSingleDate = null;
                document.getElementById("range-actions").style.display = "block";
            },
            eventClick: info => {
                const eventObj = info.event;
                let htmlContent = `<p><strong>Tên sự kiện:</strong> ${eventObj.title}</p>`;
                htmlContent += `<p><strong>Bắt đầu:</strong> ${eventObj.start ? eventObj.start.toLocaleDateString() : ""}</p>`;
                if (eventObj.end) {
                    htmlContent += `<p><strong>Kết thúc:</strong> ${eventObj.end.toLocaleDateString()}</p>`;
                }
                Swal.fire({
                    title: "Chi tiết sự kiện",
                    html: htmlContent,
                    icon: "info"
                });
            }
        });
        fetch("{{ route('getEventData') }}")
            .then(response => response.json())
            .then(events => {
                // Duyệt qua từng sự kiện và thêm ID nếu chưa có
                events.forEach(event => {
                    if (!event.id) {
                        event.id = generateUniqueId(); // Tạo ID duy nhất cho sự kiện
                    }
                });

                // Xóa tất cả sự kiện cũ trước khi thêm sự kiện mới
                calendar.removeAllEvents();

                // Thêm sự kiện mới vào calendar
                calendar.addEventSource(events);
                console.log("Sự kiện mới đã được thêm vào.");

                // Render lại calendar
                calendar.render();
            })
            .catch(error => console.error("Lỗi tải sự kiện:", error));

        // Hàm xóa trạng thái chọn và ẩn khung thao tác
        const clearSelection = () => {
            selectedRange = null;
            selectedSingleDate = null;
            document.getElementById("range-actions").style.display = "none";
            document.querySelectorAll(".fc-daygrid-day.long-pressed").forEach(cell => {
                cell.classList.remove("long-pressed");
            });
            calendar.unselect();
        };

        // Xử lý long press: bắt đầu khi nhấn chuột vào ô ngày
        const onCellMouseDown = e => {
            const cell = e.currentTarget;
            startX = e.pageX;
            startY = e.pageY;
            longPressTimeout = setTimeout(() => {
                const dateStr = cell.getAttribute("data-date");
                enterDateSelectionMode(dateStr, cell);
            }, 3000);
            cell.addEventListener("mousemove", onCellMouseMove);
        };

        const onCellMouseMove = e => {
            if (Math.abs(e.pageX - startX) > 10 || Math.abs(e.pageY - startY) > 10) {
                clearTimeout(longPressTimeout);
                e.currentTarget.removeEventListener("mousemove", onCellMouseMove);
            }
        };

        const onCellMouseUp = e => {
            clearTimeout(longPressTimeout);
            e.currentTarget.removeEventListener("mousemove", onCellMouseMove);
        };

        const onCellMouseLeave = e => {
            clearTimeout(longPressTimeout);
            e.currentTarget.removeEventListener("mousemove", onCellMouseMove);
        };

        // Kích hoạt chế độ chọn đơn khi nhấn giữ đủ 3 giây
        const enterDateSelectionMode = (dateStr, cell) => {
            selectedSingleDate = dateStr;
            selectedRange = null;
            if (cell) cell.classList.add("long-pressed");
            document.getElementById("range-actions").style.display = "block";
        };

        // Sau mỗi lần FullCalendar render lại, gán sự kiện cho các ô ngày
        calendar.on("datesSet", () => {
            document.querySelectorAll(".fc-daygrid-day").forEach(cell => {
                cell.addEventListener("mousedown", onCellMouseDown);
                cell.addEventListener("mouseup", onCellMouseUp);
                cell.addEventListener("mouseleave", onCellMouseLeave);
            });
        });

        // Xử lý nút "Thêm Sự Kiện"
        document.getElementById("btnAddEvent").addEventListener("click", () => {
            if (selectedRange) {
                Swal.fire({
                    title: "Nhập tên sự kiện",
                    input: "text",
                    showCancelButton: true,
                    confirmButtonText: "Thêm sự kiện",
                    cancelButtonText: "Hủy"
                }).then(result => {
                    if (result.isConfirmed && result.value) {
                        calendar.addEvent({
                            title: result.value,
                            start: selectedRange.start,
                            end: selectedRange.end,
                            allDay: true
                        });
                        clearSelection();
                    }
                });
            } else if (selectedSingleDate) {
                Swal.fire({
                    title: "Nhập tên sự kiện",
                    input: "text",
                    showCancelButton: true,
                    confirmButtonText: "Thêm sự kiện",
                    cancelButtonText: "Hủy"
                }).then(result => {
                    if (result.isConfirmed && result.value) {
                        calendar.addEvent({
                            title: result.value,
                            start: selectedSingleDate,
                            allDay: true
                        });
                        clearSelection();
                    }
                });
            }
        });

        document.getElementById("btnCancelSelection").addEventListener("click", clearSelection);

        document.addEventListener("click", e => {
            if (!calendarEl.contains(e.target) && !document.getElementById("range-actions").contains(e.target)) {
                clearSelection();
            }
        });
    });
</script>
<style>
    .fc-theme-standard td {
        border: 1px solid black !important;
    }

    .fc-col-header th {
        font-size: 18px;
        border: none;
        padding: 20px 30px;
        color: white;
        background: linear-gradient(135deg, #7d5803, #d39e00);
    }

    .fc .fc-daygrid-day.fc-day-today {
        border: 1.7px solid #7d5803;
    }

    .fc-header-toolbar {
        padding-left: 5px;
        padding-right: 5px;
    }

    .fc-button-group {
        display: flex;
        gap: 5px;
    }

    .fc-daygrid-day-number {
        font-size: 18px;
        color: black;
    }

    .fc-toolbar-title {
        border-radius: 4px;
        padding: 8px 12px !important;
        font-size: 22px !important;
        color: white;
        background-color: #b5861b;
    }

    .fc-button {
        color: white !important;
        padding: 8px 12px !important;
        border: 1px solid #ccc !important;
        border-radius: 4px !important;
        font-size: 17px !important;
        background-color: #b5861b !important;
    }

    .fc-button:hover {
        background-color: #d39e00 !important;
    }

    .fc-daygrid-event {
        color: white !important;
        padding: 8px 12px !important;
        border-radius: 5px !important;
        font-size: 17px !important;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .fc-daygrid-day.long-pressed {
        background-color: #ffeb3b !important;
    }

    #range-actions {
        position: fixed;
        bottom: 20px;
        right: 0px;
        background: linear-gradient(135deg, #7d5803, #d39e00);
        padding: 8px;
        border-radius: 8px 0 0 8px;
        display: none;
        z-index: 1000;
    }

    #range-actions button {
        margin: 5px;
        padding: 8px 12px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    #btnAddEvent {
        background-color: white;
        color: black;
    }

    #btnCancelSelection {
        background-color: red;
        color: white;
    }
</style>

</html>
@endsection