<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Livewire\Component;

class TransactionIndex extends Component
{
    protected $listeners = [
        'country_changed' => 'mount',
        'TransactionsDataChanged' => 'mount',
    ];

    public $days = [];

    public function mount()
    {
        $this->days = Transaction::query()
        ->where('country_id',session('current_country')->id)
        ->with('target')
        ->with('source')
        ->get() ?? [];
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
