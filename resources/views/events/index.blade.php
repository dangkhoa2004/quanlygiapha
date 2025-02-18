@extends('layouts.app')

@section('content')
<div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="flex justify-between items-center bg-white text-white p-4 rounded-lg shadow">
        <div class="flex space-x-3">
            <a id="btnPrev" href="#">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-arrow-left mr-2"></i> Trước
                </x-primary-button>
            </a>
            <a id="btnNext" href="#">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-arrow-right mr-2"></i> Sau
                </x-primary-button>
            </a>
            <a id="btnToday" href="#">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-calendar-day mr-2"></i> Hôm nay
                </x-primary-button>
            </a>
        </div>
        <h2 id="calendarTitle" class="text-black text-2xl font-bold">Tháng 2, 2025</h2>
        <div class="flex space-x-3">
            <a id="btnMonthView" href="#" style="display: none;">
                <x-primary-button class="px-6 py-3 text-lg">
                    <i class="fas fa-calendar mr-2"></i> Lịch tháng
                </x-primary-button>
            </a>
            <a id="btnListView" href="#">
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
        <a id="btnAddEvent" href="#">
            <x-primary-button class="px-6 py-3 text-lg"> Thêm</x-primary-button>
        </a>
        <a id="btnCancelSelection" href="#">
            <x-primary-button class="px-6 py-3 text-lg"> Huỷ</x-primary-button>
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
        let selectedRange = null;
        let selectedSingleDate = null;
        const calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            locale: "vi",
            selectable: true,
            titleFormat: {
                month: "long"
            },
            headerToolbar: false,
            datesSet: info => {
                titleEl.innerText = info.view.title;
                checkNavigationButtons();
            },
            select: info => {
                selectedRange = {
                    start: info.startStr,
                    end: info.endStr
                };
                document.getElementById("range-actions").style.display = "block";
            },
            eventClick: info => {
                const eventObj = info.event;
                let htmlContent = `
            <div class="p-4 bg-gray-100 rounded-lg text-gray-700">
                <p class="text-lg font-semibold mb-2"><strong>${eventObj.title}</strong></p>
                <p class="mb-1"><strong>Bắt đầu:</strong> ${eventObj.start ? eventObj.start.toLocaleDateString() : "Không xác định"}</p>
                ${eventObj.end ? `<p><strong>Kết thúc:</strong> ${eventObj.end.toLocaleDateString()}</p>` : ""}
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <x-primary-button id="deleteEvent">Xoá</x-primary-button>            
                <x-secondary-button id="closeSwal">Đóng</x-primary-button>
            </div>`;

                Swal.fire({
                    title: `<span class="uppercase text-gray-800 font-bold">Chi tiết sự kiện</span>`,
                    html: htmlContent,
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
        });
        calendar.render();
        fetch("{{ route('getEventData') }}")
            .then(response => response.json())
            .then(events => {
                calendar.removeAllEvents();
                calendar.addEventSource(events);
            })
            .catch(error => console.error("Lỗi tải sự kiện:", error));

        function checkNavigationButtons() {
            const currentDate = new Date();
            const currentView = calendar.view;
            const startDate = currentView.currentStart;
            const endDate = currentView.currentEnd;
            btnPrev.style.display = "block";
            btnNext.style.display = "block";
            if (currentDate >= startDate && currentDate <= endDate) {
                btnToday.style.display = "none";
            } else {
                btnToday.style.display = "block";
            }
        }

        btnPrev.addEventListener("click", () => {
            calendar.prev();
            titleEl.innerText = calendar.view.title;
            checkNavigationButtons();
        });

        btnToday.addEventListener("click", () => {
            calendar.today();
            titleEl.innerText = calendar.view.title;
            checkNavigationButtons();
        });

        btnNext.addEventListener("click", () => {
            calendar.next();
            titleEl.innerText = calendar.view.title;
            checkNavigationButtons();
        });
        document.getElementById("btnMonthView").addEventListener("click", () => {
            calendar.changeView("dayGridMonth");
            titleEl.innerText = calendar.view.title;
            document.getElementById("btnMonthView").style.display = "none";
            document.getElementById("btnListView").style.display = "block";
        });

        document.getElementById("btnListView").addEventListener("click", () => {
            calendar.changeView("listYear");
            titleEl.innerText = calendar.view.title;
            document.getElementById("btnListView").style.display = "none";
            document.getElementById("btnNext").style.display = "none";
            document.getElementById("btnToday").style.display = "none";
            document.getElementById("btnPrev").style.display = "none";
            document.getElementById("btnMonthView").style.display = "block";
        });
        if (calendar.view.type === "dayGridMonth") {
            document.getElementById("btnMonthView").style.display = "none";
            document.getElementById("btnListView").style.display = "block";
        } else {
            document.getElementById("btnListView").style.display = "none";
            document.getElementById("btnMonthView").style.display = "block";
        }
        document.getElementById("btnAddEvent").addEventListener("click", () => {
            if (selectedRange) {
                Swal.fire({
                    title: "Nhập tên sự kiện",
                    input: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    customClass: {
                        popup: "rounded-lg shadow-lg p-6",
                        title: "text-lg font-semibold text-gray-800"
                    },
                    html: `
                <div class="flex flex-col gap-4">
                    <x-text-input id="swal-input" class="swal2-input border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 w-auto p-2 text-gray-700" type="text" placeholder="Nhập tên sự kiện..." />
                    
                    <div class="flex justify-end gap-2">
                        <x-primary-button id="customCancel">Hủy</x-primary-button>
                        <x-primary-button id="customConfirm">Thêm sự kiện</x-primary-button>
                    </div>
                </div>`,
                    didOpen: () => {
                        document.getElementById("customConfirm").addEventListener("click", () => {
                            let eventTitle = document.getElementById("swal-input").value;
                            if (eventTitle.trim()) {
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

                        document.getElementById("customCancel").addEventListener("click", () => {
                            Swal.close();
                        });
                    }
                });
            }
        });

        document.getElementById("btnCancelSelection").addEventListener("click", () => {
            selectedRange = null;
            document.getElementById("range-actions").style.display = "none";
        });
        checkNavigationButtons();
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