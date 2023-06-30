<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use App\Models\Wallet;
use Livewire\Component;

class TransactionForm extends Component
{

    protected $listeners = [
        'set_target' => 'set_target',
    ];

    public $transaction;
    public $selected_wallet;
    public $target_list = [];
    public $target_id;
    public $target_name;
    public $target_type;
    public $amount;
    public $notes;
    public $date;
    public $time;
    public $transaction_type;
    public $transaction_types = [
        'expense' => 'Expense',
        'transfer' => 'Transfer',
        'income' => 'Income',
        'loan_to' => 'Loan To',
        'loan_from' => 'Loan From',
    ];
    public function mount(Wallet $wallet, Transaction $transaction)
    {
        if (!$transaction->id) {
            $this->selected_wallet = $wallet;
            $this->transaction_type = 'expense';
            $this->date = date('Y-m-d');
            $this->time = now()->format('H:i');
        } else {
            //edit
            $this->transaction = $transaction;
            $this->transaction_type = $this->transaction->type;
            $this->date = $this->transaction->date->format('Y-m-d');
            $this->time = $this->transaction->time->format('H:i');
            $this->amount = $this->transaction->amount;
            $this->notes = $this->transaction->notes;

            switch ($this->transaction_type) {
                case 'expense':
                case 'transfer':
                case 'loan_to':
                    $this->selected_wallet = $this->transaction->source;
                    $this->set_target($this->transaction->target, $this->transaction->target_type);
                    break;
                case 'income':
                case 'loan_from':
                    $this->selected_wallet = $this->transaction->target;
                    $this->set_target($this->transaction->source, $this->transaction->source_type);
                    break;
            }
        }
    }

    public function rules()
    {
        return [
            'target_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'time' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Enter your amount'
        ];
    }

    public function showModal()
    {
        if ($this->transaction_type == 'transfer') {
            $this->emitTo('wallet-selector', 'showingModal', $this->selected_wallet->id);
        }
        if ($this->transaction_type == 'expense' || $this->transaction_type == 'income') {
            $this->emitTo('category-selector', 'showingModal', $this->transaction_type);
        }
        if ($this->transaction_type == 'loan_to' || $this->transaction_type == 'loan_from') {
            $this->emitTo('contact-selector', 'showingModal');
        }
    }

    public function set_transaction_type($type)
    {
        $this->transaction_type = $type;
        $this->set_target(null, null);
    }

    public function set_target($target, $target_type)
    {
        $this->target_id = $target['id'] ?? null;
        $this->target_name = $target['name'] ?? null;
        $this->target_type = $target_type ?? null;
    }
    public function save()
    {
        $this->validate();
        switch ($this->transaction_type) {
            case 'expense':
            case 'transfer':
            case 'loan_to':
                $source_id = $this->selected_wallet->id;
                $source_type = 'App\Models\Wallet';
                $target_id = $this->target_id;
                $target_type = $this->target_type;
                break;
            case 'income':
            case 'loan_from':
                $source_id = $this->target_id;
                $source_type = $this->target_type;
                $target_id = $this->selected_wallet->id;
                $target_type = 'App\Models\Wallet';
                break;
        }

        $data = [
            'country_id' => auth()->user()->last_selected_country_id,
            'source_id' => $source_id,
            'source_type' => $source_type,
            'target_id' => $target_id,
            'target_type' => $target_type,
            'type' => $this->transaction_type,
            'amount' => $this->amount,
            'notes' => $this->notes,
            'date' => $this->date,
            'time' => $this->time,
        ];
        Transaction::updateOrCreate(['id' => $this->transaction->id ?? null],$data);

        return redirect()->route('transactions.index');
    }
    public function render()
    {
        return view('livewire.transaction-form');
    }
}
