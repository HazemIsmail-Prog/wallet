<?php

namespace App\Services;

use App\Models\Country;
use App\Models\User;

class HandleCountrySelection {
    public function selectFirstCountryIfUserLastSelectedCountryIsNull()
    {
        $user = User::find(auth()->id());
        if ($user->last_selected_country_id == null) {
            $country_id = $user->countries->first()->id;
            $user->last_selected_country_id = $country_id;
            $user->save();
            
        }
        session()->put('current_country', Country::find($user->last_selected_country_id));

    }
}
