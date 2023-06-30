<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategorySelector extends Component
{
    public $search = '';
    public $type = '';
    public $showModal = false;
    public $categories = [];

    protected $listeners = [
        'showingModal' => 'showingModal',
        'CategoriesDataChanged' => 'getData',
    ];

    public function showingModal($type)
    {
        $this->reset();
        $this->type = $type;
        $this->getData();
        $this->showModal = true;
    }

    public function getData()
    {
        $this->categories = Category::query()
            ->where('country_id', session('current_country')->id)
            ->where('type', $this->type)
            ->whereNull('category_id')
            ->with('sub_categories')
            ->get();
    }

    public function updatedSearch()
    {
        if ($this->search) {
            $this->categories = Category::query()
                ->where('country_id', session('current_country')->id)
                ->where('type', $this->type)
                ->where('name', 'like', '%' . $this->search . '%')
                ->get();
        } else {
            $this->getData();
        }
    }

    public function selected($selected)
    {
        $this->emitTo('transaction-form', 'set_target', $selected, 'App\Models\Category');
        $this->reset();
    }

    public function delete(Category $category)
    {
        if ($category->outgoingTransactions->count() == 0 && $category->incomingTransactions->count() == 0) {
            $category->delete();
            $this->emit('CategoriesDataChanged');
        } else {
            session()->flash('message', 'Cannot delete this category (Transactions found)');
            session()->flash('error-classes', 'text-red-600 dark:text-red-400');
        }
    }
}
