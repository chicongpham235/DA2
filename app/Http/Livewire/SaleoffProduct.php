<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use Cart;

class SaleoffProduct extends Component
{
    // public function store($product_id, $product_name ,$product_price)
    // {
    //     Cart::add($product_id, $product_name, 'L' ,1, $product_price);
    //     session()->flash('success','Thêm mới một mục vào rỏ hàng');
    //     return redirect()->route('cart');
    // }

    public function render()
    {
        $products=Sanpham::whereNotNull('giaban')->orderBy('giaban','ASC')->take(5)->get();

        return view('livewire.saleoff-product', compact('products'))->layout('layouts.base');
    }
}
