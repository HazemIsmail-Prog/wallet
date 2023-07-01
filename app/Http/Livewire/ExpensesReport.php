<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Transaction;
use Livewire\Component;

class ExpensesReport extends Component
{

    public $months;
    public $selected_row;
    public $selected_month;
    public $selected_year;

    public function mount()
    {
        $this->months =
            Transaction::selectRaw('DATE_FORMAT(date, "%Y-%m") as month')
            ->where('target_type', 'App\Models\Category')
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function updatedSelectedRow()
    {
        if ($this->selected_row) {
            $this->selected_month = explode('-', $this->selected_row)[1];
            $this->selected_year = explode('-', $this->selected_row)[0];
        }
    }

    public function render()
    {
        $categories = Category::query()
            ->select('id', 'name', 'category_id')
            ->where('country_id', session('current_country')->id)
            ->where('type', 'expense')
            ->withSum(['incomingTransactions' => function ($q) {
                $q->when($this->selected_row, function ($q) {
                    $q->whereMonth('date', $this->selected_month);
                    $q->whereYear('date', $this->selected_year);
                });
            }], 'amount')
            ->get();


        $sub_categories = $categories->whereNotNull('category_id');
        $parent_categories = $categories->whereNull('category_id');
        
        $final_list = [];
        foreach($parent_categories as $index => $parent_category)
        {
            $final_list[$index]['id'] = $parent_category->id;
            $final_list[$index]['name'] = $parent_category->name;
            $final_list[$index]['amount'] = $parent_category->incoming_transactions_sum_amount;
            foreach($sub_categories as $sub_index => $sub_category)
            {
                if($sub_category->category_id == $parent_category->id)
                {
                    $final_list[$index]['amount'] += $sub_category->incoming_transactions_sum_amount;
                    $final_list[$index]['sub_categories'][$sub_index] = [
                        'id' => $sub_category->id,
                        'name' => $sub_category->name,
                        'amount' => $sub_category->incoming_transactions_sum_amount,
                    ];
                }
            }
        }

        return view('livewire.expenses-report', [
            'categories' => collect($final_list)
        ]);
    }
}
