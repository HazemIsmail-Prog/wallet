<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactSelector extends Component
{
    public $showModal = false;
    public $contacts = [];
    public $search = '';

    protected $listeners = [
        'showingModal' => 'showingModal',
        'ContactsDataChanged' => 'getData',
    ];

    public function showingModal()
    {
        $this->reset();
        $this->getData();
        $this->showModal = true;
    }

    public function updatedSearch()
    {
        $this->getData();
    }

    public function getData()
    {
        $this->contacts = Contact::query()
            ->where('country_id', session('current_country')->id)
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })
            ->with('incomingTransactions')
            ->with('outgoingTransactions')
            ->get();
    }

    public function selected($selected)
    {
        $this->emitTo('transaction-form', 'set_target', $selected, 'App\Models\Contact');
        $this->reset();
    }

    public function delete(Contact $contact)
    {
        if ($contact->outgoingTransactions->count() == 0 && $contact->incomingTransactions->count() == 0) {
            $contact->delete();
            $this->emit('ContactsDataChanged');
        } else {
            session()->flash('message', 'Cannot delete this contact (Transactions found)');
            session()->flash('error-classes', 'text-red-600 dark:text-red-400');
        }
    }
}
