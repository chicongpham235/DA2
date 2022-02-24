<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use Cart;

class ShoppingCart extends Component
{
    public function delete($rowId)
    {

        Cart::remove($rowId);

    }

    public function quantitychange($rowId, $value)
    {
        Cart::update($rowId, (int)$value);
    }

    public function quantityreduce($rowId)
    {
        Cart::update($rowId, Cart::get($rowId)->qty-1);
    }

    public function quantityincrease($rowId)
    {
        Cart::update($rowId, Cart::get($rowId)->qty+1);

    }

    public function render()
    {
        $this->emitTo('cart-counter', 'postCartProcessed');

        $items=Cart::content();

        return view('livewire.shopping-cart', compact('items'));
    }
}
