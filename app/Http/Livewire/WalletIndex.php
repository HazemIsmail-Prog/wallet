<?php

namespace App\Http\Livewire;

use App\Models\Wallet;
use Livewire\Component;

class WalletIndex extends Component
{

    protected $listeners = [
        'country_changed' => 'mount',
        'WalletsDataChanged' => 'mount',
    ];

    public $wallets = [];
    public bool $showEdit;

    public function mount()
    {
        $this->wallets = Wallet::query()
        ->where('country_id',session('current_country')->id)
        ->with('incomingTransactions')
        ->with('outgoingTransactions')
        ->with('country')
        ->get() ?? []
        ;
        // $this->wallets = session('current_country')->wallets ?? [];
        $this->showEdit = false;
    }

    public function delete(Wallet $wallet)
    {
        if ($wallet->outgoingTransactions->count() == 0 && $wallet->incomingTransactions->count() == 0) {
            $wallet->delete();
            $this->emit('WalletsDataChanged');
        } else {
            session()->flash('message', 'Cannot delete this wallet (Transactions found)');
            session()->flash('error-classes', 'text-red-600 dark:text-red-400');
        }
    }

    public function render()
    {
        return view('livewire.wallet-index');
    }
}
