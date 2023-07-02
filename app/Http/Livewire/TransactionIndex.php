<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Transaction;
use App\Models\Wallet;
use Livewire\Component;

class TransactionIndex extends Component
{
    protected $listeners = [
        'TransactionsDataChanged' => 'mount',
    ];

    public $days = [];
    public $filter;

    public function mount()
    {
        $this->filter = [
            'expense_list' => Category::where('country_id', session('current_country')->id)->where('type', 'expense')->orderBy('name')->get()->toArray(),
            'selected_expense' => '',
            'income_list' => Category::where('country_id', session('current_country')->id)->where('type', 'income')->orderBy('name')->get()->toArray(),
            'selected_income' => '',
            'wallet_list' => Wallet::where('country_id', session('current_country')->id)->orderBy('name')->get()->toArray(),
            'selected_wallet' => '',
            'contact_list' => Contact::where('country_id', session('current_country')->id)->orderBy('name')->get()->toArray(),
            'selected_contact' => '',
        ];

        $this->getData();
    }

    public function getData()
    {
        $this->days = Transaction::query()
            ->where('country_id', session('current_country')->id)
            ->when($this->filter['selected_expense'] , function($q){
                $q->where('target_type','App\Models\Category');
                $q->where('target_id',$this->filter['selected_expense']);
            })
            ->when($this->filter['selected_income'] , function($q){
                $q->where('source_type','App\Models\Category');
                $q->where('source_id',$this->filter['selected_income']);
            })
            ->when($this->filter['selected_wallet'] , function($q){
                $q->where(function($q){
                    $q->where('source_type','App\Models\Wallet');
                    $q->where('source_id',$this->filter['selected_wallet']);
                    $q->orWhere(function($q){
                        $q->where('target_type','App\Models\Wallet');
                        $q->where('target_id',$this->filter['selected_wallet']);
                    });
                });
            })
            ->when($this->filter['selected_contact'] , function($q){
                $q->where('source_type','App\Models\Contact');
                $q->where('source_id',$this->filter['selected_contact']);
                $q->orWhere(function($q){
                    $q->where('target_type','App\Models\Contact');
                    $q->where('target_id',$this->filter['selected_contact']);
                });
            })
            ->with('target')
            ->with('source')
            ->with(['target' => function ($query) {
	            $query->morphWith([
		            Category::class => ['parent_category'],
                ]);
            }])
            ->with(['source' => function ($query) {
	            $query->morphWith([
		            Category::class => ['parent_category'],
                ]);
            }])
            ->get() ?? [];
    }

    public function updatedFilter()
    {
        $this->getData();
    }


    public function delete(Transaction $transaction)
    {
        $transaction->delete();
        $this->emit('TransactionsDataChanged');
    }

    public function render()
    {
        return view('livewire.transaction-index');
    }
}
