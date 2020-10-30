<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductCart extends Component
{
    public $field;
    public $price;
    public $data = [];
    public function mount()
    {
        foreach ($this->field as $key => $value) {
            $this->data[$value['text']] = '';
        }
    }

    public function render()
    {
        return view('livewire.product-cart', ['price' => $this->price, 'field' => $this->field]);
    }
    public function save()
    {
        foreach ($this->field as $key => $value) {
            if (empty($this->data[$value['text']])) {
                $this->addError('data.' . $value['text'], 'not be empty');
            }
        }
    }
}
