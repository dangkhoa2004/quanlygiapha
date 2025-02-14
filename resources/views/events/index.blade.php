@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
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
                <x-primary-button class="px-6 py-3 text-lg"> Thêm </x-primary-button>
            </a>
            <a id="btnCancelSelection" href="#">
                <x-primary-button class="px-6 py-3 text-lg"> Huỷ </x-primary-button>
            </a>
        </div>
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
        calendar.render();
        fetch("{{ route('getEventData') }}")
            .then(response => response.json())
            .then(events => {
                calendar.removeAllEvents();
                calendar.addEventSource(events);
                console.log("Sự kiện mới đã được thêm vào.");
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
            }
        });

        document.getElementById("btnCancelSelection").addEventListener("click", () => {
            selectedRange = null;
            document.getElementById("range-actions").style.display = "none";
        });
        document.addEventListener("DOMContentLoaded", () => {
            // Lấy tất cả các thẻ <td>
            document.querySelectorAll("td").forEach(td => {
                if (td.textContent.trim().toLowerCase() === "all-day") {
                    td.textContent = "Cả ngày";
                }
            });
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