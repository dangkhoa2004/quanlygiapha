@props(['data' => [], 'editRoute' => null, 'deleteRoute' => null])
<table class="mt-4 w-full min-w-max table-auto text-center">
    <thead>
    <tr>
        @if(!empty($data))
        @foreach(array_keys($data[0]) as $column)
        <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50 text-center">
            <p class="antialiased font-sans text-lg font-bold text-blue-gray-900 flex items-center justify-center gap-2 leading-none">
                {{ ucfirst(str_replace('_', ' ', $column)) }}
            </p>
        </th>
        @endforeach
        <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50 text-center">
            <p class="antialiased font-sans text-lg font-bold text-blue-gray-900">
                Thao tác
            </p>
        </th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
    <tr>
        @foreach($row as $key => $cell)
        <td class="p-4 border-b border-blue-gray-50 text-center">
            @if(str_contains(strtolower($key), 'Ảnh') || str_contains(strtolower($key), 'photo'))
            @if($cell)
            <img src="{{$cell }}" width="50" class="rounded-md mx-auto">
            @else
            <span class="text-gray-500">Không có ảnh</span>
            @endif
            @else
            <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal text-center">
                {{ is_array($cell) ? json_encode($cell) : $cell }}
            </p>
            @endif
        </td>
        @endforeach

        <!-- Cột Actions -->
        <td class="p-4 border-b border-blue-gray-50 text-center">
            <div class="flex justify-center space-x-2">
                @if($editRoute)
                <!-- Nút Chỉnh sửa -->
                <a href="{{ route($editRoute, $row['STT']) }}" class="text-blue-500 hover:text-blue-700">
                    <button
                        class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs hover:bg-blue-500/10 active:bg-blue-500/30"
                        type="button">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                <i class="fas fa-edit text-blue-500"></i>
                            </span>
                    </button>
                </a>
                @endif

                @if($deleteRoute)
                <!-- Nút Xóa với SweetAlert -->
                <button type="button"
                        class="delete-btn relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs hover:bg-red-500/10 active:bg-red-500/30 text-red-500"
                        data-url="{{ route($deleteRoute, $row['STT']) }}">
                        <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                            <i class="fas fa-trash-alt text-red-500"></i>
                        </span>
                </button>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                let deleteUrl = this.getAttribute('data-url');

                Swal.fire({
                    title: "Bạn có chắc chắn?",
                    text: "Hành động này sẽ không thể hoàn tác!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Có, xóa ngay!",
                    cancelButtonText: "Hủy"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Tạo form ẩn để gửi request DELETE
                        let form = document.createElement('form');
                        form.method = 'POST';
                        form.action = deleteUrl;

                        // Thêm CSRF token và phương thức DELETE
                        let csrfToken = document.createElement('input');
                        csrfToken.type = 'hidden';
                        csrfToken.name = '_token';
                        csrfToken.value = "{{ csrf_token() }}";

                        let methodField = document.createElement('input');
                        methodField.type = 'hidden';
                        methodField.name = '_method';
                        methodField.value = 'DELETE';

                        form.appendChild(csrfToken);
                        form.appendChild(methodField);
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>
