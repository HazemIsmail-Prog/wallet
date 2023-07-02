<div
    class=" text-sm rounded-lg overflow-clip shadow dark:shadow-none bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-400">
    <div class="p-4 flex items-center justify-between dark:border-green-400 border-green-600 border-b">
        <div class=" text-green-600 dark:text-green-400 uppercase font-extrabold  ">Income
        </div>
        <select wire:ignore wire:model="selected_row"
            class=" text-center border border-transparent text-sm font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-50 dark:focus:bg-gray-700 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
            <option value="">All</option>
            @foreach ($months as $month)
                <option value="{{ $month->month }}">{{ $month->month }}</option>
            @endforeach
        </select>
    </div>
    @foreach ($categories->where('amount', '>', 0)->sortByDesc('amount') as $category)
        <div x-data="{ expanded: false }">
            <div @click="expanded=!expanded"
                class=" font-bold cursor-pointer flex items-center justify-between p-4 bg-white dark:bg-gray-800">
                <div>{{ $category['name'] }}</div>
                <div>
                    {{ number_format($category['amount'] / session('current_country')->factor, session('current_country')->decimal_points) }}
                </div>
            </div>
            @foreach (collect(@$category['sub_categories'])->where('amount', '>', 0)->sortByDesc('amount') as $sub_category)
                <div x-show="expanded" class=" flex items-center justify-between p-4 bg-gray-100 dark:bg-gray-900">
                    <div>{{ $sub_category['name'] }}</div>
                    <div>
                        {{ number_format($sub_category['amount'] / session('current_country')->factor, session('current_country')->decimal_points) }}
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
