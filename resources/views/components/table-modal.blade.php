@props(['data' => [], 'editRoute' => null, 'deleteRoute' => null])
<table class="mt-4 w-full min-w-max table-auto text-left">
    <thead>
        <tr>
            @if(!empty($data))
            @foreach(array_keys($data[0]) as $column)
            <th class="cursor-pointer border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                <p class="antialiased font-sans text-lg font-bold text-blue-gray-900 flex items-center justify-between gap-2 leading-none">
                    {{ ucfirst(str_replace('_', ' ', $column)) }}
                </p>
            </th>
            @endforeach
            <th class="border-y border-blue-gray-100 bg-blue-gray-50/50 p-4 transition-colors hover:bg-blue-gray-50">
                <p class="antialiased font-sans text-blue-gray-900 leading-none text-lg font-bold">
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
            <td class="p-4 border-b border-blue-gray-50">
                @if(str_contains(strtolower($key), 'ảnh') || str_contains(strtolower($key), 'photo'))
                @if($cell)
                <img src="{{ asset('storage/'.$cell) }}" width="50" class="rounded-md">
                @else
                <span class="text-gray-500">Không có ảnh</span>
                @endif
                @else
                <p class="block antialiased font-sans text-sm leading-normal text-blue-gray-900 font-normal">
                    {{ is_array($cell) ? json_encode($cell) : $cell }}
                </p>
                @endif
            </td>
            @endforeach

            <!-- Cột Actions -->
            <td class="p-4 border-b border-blue-gray-50">
                <div class="flex space-x-2">
                    @if($editRoute)
                    <a href="{{ route($editRoute, $row['STT']) }}" class="text-blue-500 hover:text-blue-700">
                        <button class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs hover:bg-blue-500/10 active:bg-blue-500/30" type="button">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                <i class="fas fa-edit text-blue-500"></i>
                            </span>
                        </button>
                    </a>
                    @endif

                    @if($deleteRoute)
                    <form action="{{ route($deleteRoute, $row['STT']) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="relative align-middle select-none font-sans font-medium text-center uppercase transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-10 max-w-[40px] h-10 max-h-[40px] rounded-lg text-xs hover:bg-red-500/10 active:bg-red-500/30 text-red-500">
                            <span class="absolute top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2">
                                <i class="fas fa-trash-alt text-red-500"></i>
                            </span>
                        </button>
                    </form>
                    @endif
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>