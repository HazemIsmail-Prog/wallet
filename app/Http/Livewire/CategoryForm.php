<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryForm extends Component
{
    public $modalTitle = 'New Category';
    public $showModal = false;
    public $category;


    protected $listeners = [
        'showingModal' => 'showingModal',
    ];

    public function showingModal($category, $type, $parent_category_id)
    {
        $this->category = [
            'id' => $category['id'] ?? null,
            'name' => $category['name'] ?? '',
            'type' => $type,
            'category_id' => $parent_category_id,
            'country_id' => session('current_country')->id,
        ];
        if ($category) {
            $this->modalTitle = 'Edit Category';
        }
        $this->showModal = true;
    }

    public function save()
    {
        Category::updateOrCreate(
            [
                'id'            => $this->category['id']
            ],
            [
                'name'          => $this->category['name'],
                'type'          => $this->category['type'],
                'category_id'   => $this->category['category_id'],
                'country_id'    => $this->category['country_id'],

            ]
        );

        $this->emit('CategoriesDataChanged');
        $this->showModal = false;
    }
}
