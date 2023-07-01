<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Transaction;
use Livewire\Component;

class ExpensesReport extends Component
{

    public $categories;
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

        $this->selected_month = explode('-', $this->months->last()->month)[1];
        $this->selected_year = explode('-', $this->months->last()->month)[0];
        $this->selected_row =   $this->selected_year . '-' . $this->selected_month;

        $this->getData();
    }

    public function getData()
    {
        $this->categories = Category::query()
            ->where('country_id', session('current_country')->id)
            ->where('type', 'expense')
            ->where('category_id', null)
            ->whereHas('incomingTransactions', function ($q) {
                $q->whereMonth('date', $this->selected_month);
                $q->whereYear('date', $this->selected_year);
            })
            ->orWhereHas('sub_categories.incomingTransactions', function ($q) {
                $q->whereMonth('date', $this->selected_month);
                $q->whereYear('date', $this->selected_year);
            })
            ->with('incomingTransactions')
            ->with('outgoingTransactions')
            ->with('sub_categories.incomingTransactions')
            ->with('sub_categories.outgoingTransactions')
            ->get();
    }

    public function updatedSelectedRow()
    {
        $this->selected_month = explode('-', $this->selected_row)[1];
        $this->selected_year = explode('-', $this->selected_row)[0];
        $this->getData();
    }

    public function render()
    {
        return view('livewire.expenses-report');
    }
}
