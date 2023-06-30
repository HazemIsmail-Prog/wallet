<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationship with transactions as the source entity
    public function outgoingTransactions()
    {
        return $this->morphMany(Transaction::class, 'source');
    }

    // Relationship with transactions as the target entity
    public function incomingTransactions()
    {
        return $this->morphMany(Transaction::class, 'target');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getFormatedAvailableAmountAttribute() {
        return number_format($this->available_amount, session('current_country')->decimal_points);
    }
    public function getAvailableAmountAttribute() {
        return $this->init_amount + $this->incomingTransactions->sum('amount') - $this->outgoingTransactions->sum('amount');
    }

    protected function initAmount(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value / session('current_country')->factor,
            set: fn ($value) => $value * session('current_country')->factor,
        );
    }

}
