<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function wallets()
    {
        return $this->hasMany(Wallet::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class)->latest();
    }

    public function getFactorAttribute() {
        if($this->decimal_points == 2){
            return 100;
        }else{
            return 1000;
        }
    }
}
