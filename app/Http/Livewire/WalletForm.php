<?php

namespace App\Http\Livewire;

use App\Models\Wallet;
use Livewire\Component;

class WalletForm extends Component
{
    public $modalTitle = 'New Wallet';
    public $showModal = false;
    public $wallet;
    public $colors = [
        '#9CA3AF',
        '#6B7280',
        '#4B5563',
        '#374151',
        '#1F2937',
        '#111827',
        '#F98080',
        '#F05252',
        '#E02424',
        '#C81E1E',
        '#9B1C1C',
        '#771D1D',
        '#E3A008',
        '#C27803',
        '#9F580A',
        '#8E4B10',
        '#723B13',
        '#633112',
        '#31C48D',
        '#0E9F6E',
        '#057A55',
        '#046C4E',
        '#03543F',
        '#014737',
        '#76A9FA',
        '#3F83F8',
        '#1C64F2',
        '#1A56DB',
        '#1E429F',
        '#233876',
        '#8DA2FB',
        '#6875F5',
        '#5850EC',
        '#5145CD',
        '#42389D',
        '#362F78',
        '#AC94FA',
        '#9061F9',
        '#7E3AF2',
        '#6C2BD9',
        '#5521B5',
        '#4A1D96',
        '#F17EB8',
        '#E74694',
        '#D61F69',
        '#BF125D',
        '#99154B',
        '#751A3D',
    ];

    protected $listeners = [
        'showingModal' => 'showingModal',
    ];

    public function showingModal($wallet)
    {
        $this->reset();
        $this->wallet = [
            'id' => $wallet['id'] ?? null,
            'name' => $wallet['name'] ?? '',
            'country_id' => session('current_country')->id,
            'init_amount' => $wallet['init_amount'] ?? 0,
            'is_visible' => $wallet['is_visible'] ?? 1,
            'color' => $wallet['color'] ?? '#9CA3AF',
        ];
        $this->showModal = true;
    }

    public function save()
    {
        Wallet::updateOrCreate(
            [
                'id'            => $this->wallet['id']
            ],
            [
                'name'          => $this->wallet['name'],
                'country_id'    => $this->wallet['country_id'],
                'init_amount'   => $this->wallet['init_amount'],
                'is_visible'    => $this->wallet['is_visible'],
                'color'         => $this->wallet['color'],

            ]
        );

        $this->emit('WalletsDataChanged');
        $this->showModal = false;
    }
}
