<div
    class=" text-sm rounded-lg overflow-clip shadow dark:shadow-none bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-400">
    <div class="p-4 flex items-center justify-between dark:border-red-400 border-red-600 border-b">
        <div class=" text-red-600 dark:text-red-400 uppercase font-extrabold  ">expenses
        </div>
        <select wire:ignore wire:model="selected_row" class=" text-center border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
            <option value="">All</option>
            @foreach ($months as $month)
                <option value="{{ $month->month }}">{{ $month->month }}</option>
            @endforeach
        </select>
    </div>
    @foreach ($categories->sortByDesc('total') as $category)
        <div x-data="{ expanded: false }">
            @if ($category->total + $category->sub_categories->sum('total') > 0)
                <div @click="expanded=!expanded"
                    class=" font-bold cursor-pointer flex items-center justify-between p-4 bg-white dark:bg-gray-800">
                    <div>{{ $category->name }}</div>
                    <div>
                        {{ number_format($category->total, session('current_country')->decimal_points) }}
                    </div>
                </div>
                @foreach ($category->sub_categories->sortByDesc('total') as $sub_category)
                    @if ($sub_category->total > 0)
                        <div x-show="expanded"
                            class=" flex items-center justify-between p-4 bg-gray-100 dark:bg-gray-900">
                            <div>{{ $sub_category->name }}</div>
                            <div>{{ number_format($sub_category->total, session('current_country')->decimal_points) }}
                            </div>
                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    @endforeach
</div>
