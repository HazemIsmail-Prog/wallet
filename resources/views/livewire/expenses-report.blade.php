<div
    class=" text-sm rounded-lg overflow-clip shadow dark:shadow-none bg-white dark:bg-gray-800 text-gray-800 dark:text-gray-400">
    <div class="p-4 text-red-600 dark:text-red-400 uppercase font-extrabold border-b dark:border-red-400 border-red-600">expenses
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
