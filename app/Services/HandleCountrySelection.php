<?php

namespace App\Services;

use App\Models\Country;
use App\Models\User;

class HandleCountrySelection {
    public function selectFirstCountryIfUserLastSelectedCountryIsNull()
    {
        if (auth()->user()->last_selected_country_id == null) {
            $country_id = auth()->user()->countries->first()->id;
            $user = User::find(auth()->id());
            $user->last_selected_country_id = $country_id;
            $user->save();
            
        }
        session()->put('current_country', Country::find(auth()->user()->last_selected_country_id));
    }
}
