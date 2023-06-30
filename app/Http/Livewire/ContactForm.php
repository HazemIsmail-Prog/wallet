<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactForm extends Component
{
    public $modalTitle = 'New Contact';
    public $showModal = false;
    public $contact;


    protected $listeners = [
        'showingModal' => 'showingModal',
    ];

    public function showingModal($contact)
    {
        $this->contact = [
            'id' => $contact['id'] ?? null,
            'name' => $contact['name'] ?? '',
            'country_id' => auth()->user()->last_selected_country_id,
        ];
        if ($contact) {
            $this->modalTitle = 'Edit Contact';
        }
        $this->showModal = true;
    }

    public function save()
    {
        Contact::updateOrCreate(
            [
                'id'            => $this->contact['id']
            ],
            [
                'name'          => $this->contact['name'],
                'country_id'    => $this->contact['country_id'],
            ]
        );

        $this->emit('ContactsDataChanged');
        $this->showModal = false;
    }
}
