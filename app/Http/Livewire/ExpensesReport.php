<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Transaction;
use Livewire\Component;

class ExpensesReport extends Component
{

    public $categories;
    public $months;



    public function mount()
    {
        $this->months =
        Transaction::selectRaw('DATE_FORMAT(date, "%m-%Y") as month')
        ->groupBy('month')
        ->get();

        $this->categories = Category::query()
        ->where('country_id',session('current_country')->id)
        ->where('type','expense')
        ->where('category_id',null)
        ->with('incomingTransactions')
        ->with('outgoingTransactions')
        ->with('sub_categories.incomingTransactions')
        ->with('sub_categories.outgoingTransactions')
        ->get()
        ;
    }

    public function render()
    {
        return view('livewire.expenses-report');
    }
}
