@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="flex justify-between items-center bg-white text-white p-4 rounded-lg shadow">
        <div class="flex space-x-3">
            <a id="btnPrev">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-arrow-left mr-2"></i> Trước
                </x-primary-button>
            </a>
            <a id="btnNext">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-arrow-right mr-2"></i> Sau
                </x-primary-button>
            </a>
            <a id="btnToday">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-calendar-day mr-2"></i> Hôm nay
                </x-primary-button>
            </a>
        </div>
        <h2 id="calendarTitle" class="text-black text-2xl font-bold">Tháng 2, 2025</h2>
        <div class="flex space-x-3">
            <a id="btnMonthView" style="display: none;">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-calendar mr-2"></i> Lịch tháng
                </x-primary-button>
            </a>
            <a id="btnListView">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-list mr-2"></i> Danh sách
                </x-primary-button>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div id="calendar" class="calendar"></div>
    </div>

    <div id="range-actions">
        <a id="btnAddEvent">
            <x-primary-button class="px-6 py-3 text-lg"> Thêm</x-primary-button>
        </a>
        <a id="btnCancelSelection">
            <x-secondary-button class="px-6 py-3 text-lg"> Huỷ</x-primary-button>
        </a>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const calendarEl = document.getElementById("calendar");
        const titleEl = document.getElementById("calendarTitle");
        const btnPrev = document.getElementById("btnPrev");
        const btnNext = document.getElementById("btnNext");
        const btnToday = document.getElementById("btnToday");
        const btnMonthView = document.getElementById("btnMonthView");
        const btnListView = document.getElementById("btnListView");
        const btnAddEvent = document.getElementById("btnAddEvent");
        const btnCancelSelection = document.getElementById("btnCancelSelection");
        const rangeActions = document.getElementById("range-actions");

        let selectedRange = null;

        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            locale: "vi",
            selectable: true,
            headerToolbar: false,
            titleFormat: {
                month: "long"
            },
            datesSet: () => updateTitleAndButtons(),
            select: info => {
                selectedRange = {
                    start: info.startStr,
                    end: info.endStr
                };
                rangeActions.style.display = "block";
            },
            eventClick: info => showEventDetails(info.event),
        });

        calendar.render();

        // Lấy dữ liệu sự kiện từ server
        fetch("{{ route('getEventData') }}")
            .then(response => response.json())
            .then(events => {
                calendar.removeAllEvents();
                calendar.addEventSource(events);
            })
            .catch(error => console.error("Lỗi tải sự kiện:", error));

        /** Cập nhật tiêu đề và kiểm tra hiển thị nút */
        function updateTitleAndButtons() {
            titleEl.innerText = calendar.view.title;
            const currentDate = new Date();
            const {
                currentStart,
                currentEnd
            } = calendar.view;
            btnPrev.style.display = "block";
            btnNext.style.display = "block";
            btnToday.style.display = (currentDate >= currentStart && currentDate <= currentEnd) ? "none" : "block";
        }

        /** Hiển thị chi tiết sự kiện */
        function showEventDetails(eventObj) {
            Swal.fire({
                title: `<span class="uppercase text-gray-800 font-bold">Chi tiết sự kiện</span>`,
                html: `
            <div class="p-4 bg-gray-100 rounded-lg text-gray-700">
                <p class="text-lg font-semibold mb-2"><strong>${eventObj.title}</strong></p>
                <p class="mb-1"><strong>Bắt đầu:</strong> ${eventObj.start ? eventObj.start.toLocaleDateString() : "Không xác định"}</p>
                ${eventObj.end ? `<p><strong>Kết thúc:</strong> ${eventObj.end.toLocaleDateString()}</p>` : ""}
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <x-secondary-button id="closeSwal">Đóng</x-secondary-button>
                <x-primary-button id="deleteEvent">Xoá</x-primary-button>            
            </div>`,
                showConfirmButton: false,
                didOpen: () => {
                    document.getElementById("closeSwal").addEventListener("click", () => Swal.close());
                    document.getElementById("deleteEvent").addEventListener("click", () => {
                        eventObj.remove();
                        Swal.close();
                    });
                }
            });
        }

        /** Chuyển đổi chế độ xem giữa tháng và danh sách */
        function toggleView(view) {
            calendar.changeView(view);
            updateTitleAndButtons();

            const isMonthView = (view === "dayGridMonth");
            btnMonthView.style.display = isMonthView ? "none" : "block";
            btnListView.style.display = isMonthView ? "block" : "none";
            btnPrev.style.display = isMonthView ? "block" : "none";
            btnNext.style.display = isMonthView ? "block" : "none";
            btnToday.style.display = isMonthView ? "block" : "none";
        }

        /** Thêm sự kiện mới */
        function addEvent() {
            if (selectedRange) {
                Swal.fire({
                    title: "Nhập tên sự kiện",
                    html: `
                <div class="flex flex-col gap-4">
                    <x-text-input id="swal-input" class="swal2-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-auto p-2 text-gray-700" type="text" placeholder="Nhập tên sự kiện..." />
                    <div class="flex justify-end gap-2">
                        <x-secondary-button id="customCancel">Hủy</x-primary-button>
                        <x-primary-button id="customConfirm">Thêm sự kiện</x-primary-button>
                    </div>
                </div>`,
                    showConfirmButton: false,
                    didOpen: () => {
                        document.getElementById("customConfirm").addEventListener("click", () => {
                            let eventTitle = document.getElementById("swal-input").value.trim();
                            if (eventTitle) {
                                calendar.addEvent({
                                    title: eventTitle,
                                    start: selectedRange.start,
                                    end: selectedRange.end,
                                    allDay: true
                                });
                                Swal.close();
                                clearSelection();
                            } else {
                                Swal.showValidationMessage("Vui lòng nhập tên sự kiện!");
                            }
                        });
                        document.getElementById("customCancel").addEventListener("click", () => Swal.close());
                    }
                });
            }
        }

        /** Xóa vùng chọn */
        function clearSelection() {
            selectedRange = null;
            rangeActions.style.display = "none";
        }

        // Gán sự kiện cho các nút điều hướng
        btnPrev.addEventListener("click", () => {
            calendar.prev();
            updateTitleAndButtons();
        });
        btnToday.addEventListener("click", () => {
            calendar.today();
            updateTitleAndButtons();
        });
        btnNext.addEventListener("click", () => {
            calendar.next();
            updateTitleAndButtons();
        });
        btnMonthView.addEventListener("click", () => toggleView("dayGridMonth"));
        btnListView.addEventListener("click", () => toggleView("listYear"));
        btnAddEvent.addEventListener("click", addEvent);
        btnCancelSelection.addEventListener("click", clearSelection);

        // Cập nhật tiêu đề và các nút ban đầu
        updateTitleAndButtons();
    });
</script>

<style>
    .fc-daygrid-event {
        cursor: pointer;
    }

    .fc-daygrid-day.long-pressed {
        background-color: #ffeb3b !important;
    }

    #range-actions {
        position: fixed;
        bottom: 20px;
        right: 0px;
        background: white;
        padding: 8px;
        border-radius: 8px 0 0 8px;
        display: none;
        z-index: 1000;
    }
</style>

@endsection