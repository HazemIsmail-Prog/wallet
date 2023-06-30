<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\User;
use App\Services\HandleCountrySelection;
use Livewire\Component;

class CountrySelector extends Component
{
    public $countries = [];
    public $country_id = '';
    public $country_name = '';
    public $user;

    public function mount()
    {
        (new HandleCountrySelection())->selectFirstCountryIfUserLastSelectedCountryIsNull();
        $this->user = User::find(auth()->id());
        $this->countries = $this->user->countries;
        $this->country_id = $this->user->last_selected_country_id;
        $this->country_name = Country::find($this->user->last_selected_country_id)->name;
    }

    public function updatedCountryId()
    {
        $this->user->last_selected_country_id = $this->country_id;
        $this->user->save();
        $this->country_name = Country::find($this->user->last_selected_country_id)->name;
        $this->emit('country_changed');

        return redirect()->route('wallets.index');
    }


    public function render()
    {
        return view('livewire.country-selector');
    }
}
