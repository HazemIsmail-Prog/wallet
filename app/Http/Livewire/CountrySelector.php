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
        // (new HandleCountrySelection())->selectFirstCountryIfUserLastSelectedCountryIsNull();
        $this->countries = auth()->user()->countries;
        $this->country_id = session('current_country') ? session('current_country')->id : auth()->user()->countries->first()->id;
        $this->country_name =
        session('current_country') ? session('current_country')->name : auth()->user()->countries->first()->name;
    }

    public function updatedCountryId()
    {
        $user = User::find(auth()->id());
        $user->last_selected_country_id = $this->country_id;
        $user->save();
        $this->country_name = Country::find($user->last_selected_country_id)->name;
        return redirect()->route('wallets.index');
    }


    public function render()
    {
        return view('livewire.country-selector');
    }
}
