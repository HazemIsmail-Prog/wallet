<?php

namespace App\Http\Livewire;

use App\Models\Wallet;
use Livewire\Component;

class WalletSelector extends Component
{
    public $modalTitle = 'Select';
    public $showModal = false;
    public $wallets = [];
    public $search = '';
    public $selected_wallet_id = '';

    protected $listeners = [
        'showingModal' => 'showingModal',
    ];

    public function showingModal($selected_wallet_id)
    {
        $this->reset();
        $this->selected_wallet_id = $selected_wallet_id;
        $this->getData();
        $this->showModal = true;
    }

    public function updatedSearch(){
        $this->getData();
    }

    public function getData()
    {
        $this->wallets = Wallet::query()
            ->where('country_id', session('current_country')->id)
            ->where('id', '!=', $this->selected_wallet_id)
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->with('incomingTransactions')
            ->with('outgoingTransactions')
            ->get();
    }

    public function selected($selected)
    {
        $this->emitTo('transaction-form', 'set_target',$selected,'App\Models\Wallet');
        $this->reset();
    }

}
