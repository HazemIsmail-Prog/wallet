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
            ->where('country_id', session('current_country')->id)
            ->where('type', 'expense')
            ->where('category_id', null)
            ->when($this->selected_row, function ($q) {
                $q->whereHas('incomingTransactions', function ($q) {
                    $q->whereMonth('date', $this->selected_month);
                    $q->whereYear('date', $this->selected_year);
                });
                $q->orWhereHas('sub_categories.incomingTransactions', function ($q) {
                    $q->whereMonth('date', $this->selected_month);
                    $q->whereYear('date', $this->selected_year);
                });
            })
            ->with('incomingTransactions')
            ->with('outgoingTransactions')
            ->with('sub_categories.incomingTransactions')
            ->with('sub_categories.outgoingTransactions')
            ->get();

        return view('livewire.expenses-report', [
            'categories' => $categories
        ]);
    }
}
