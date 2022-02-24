<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use App\Models\Color;
use App\Models\ColorSanpham;
use Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Size;
use App\Models\SizeSanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductDetail extends Component
{
    public $qty=1;
    // public $size2="L";
    // public $color2=1;
    public $id;
    public function mount($param)
    {

        $this->id = $param;
        $product = Sanpham::where('id',$this->id)->first();
        $size = DB::table('size_sanpham')->join('size', 'size_sanpham.size_id', '=', 'size.id')->where('sanpham_id',$product->id);
        $color =DB::table('color_sanpham')->join('colors','color_sanpham.color_id', '=', 'colors.id')->where('sanpham_id',$product->id);

        // dd($color->first());
        // $this->size2="L";
        // $this->color2=1;
        $this->size2=$size->first()->size_id;
        $this->color2=$color->first()->color_id;
    }

    // public function updatedSize($value){
    //     dd($value);
    // }
    public function store($product_id, $product_p_id, $product_name, $product_size, $product_color ,$product_qty, $product_price)
    {

        Cart::add($product_id, $product_p_id, $product_name, $product_size, $product_color, $product_qty, $product_price)->associate('App\Models\SanPham');
        session()->flash('success','Thêm mới một mục vào rỏ hàng');
        return redirect()->route('cart');
    }

    public $order_item_id;
    public $user_id;

    public function render()
    {
        $product = Sanpham::where('id',$this->id)->first();

        $related_product = Sanpham::where('nhomsanphamid',$product->nhomsanphamid)->where('id','!=',$this->id)->get();

        $images = json_decode($product->danhsachanh, true);

        // $sizes=SizeSanpham::where('sanpham_id',$product->id)->select('sanpham_id','size_id')->get();

        // $colors=ColorSanpham::where('sanpham_id',$product->id)->select('sanpham_id','color_id')->get();

        // dd($sizes);

        $size = DB::table('size_sanpham')->join('size', 'size_sanpham.size_id', '=', 'size.id')->where('sanpham_id',$product->id)->get();
        $color =DB::table('color_sanpham')->join('colors','color_sanpham.color_id', '=', 'colors.id')->where('sanpham_id',$product->id)->get();

        // // dd($color->first()->color);

        // $this->size2=$size->first()->size;
        // $this->color2=$color->first()->color_id;
        return view('livewire.product-detail',[
            'product'=>$product,
            'related_product'=>$related_product,
            'images'=>$images,
            // 'sizes'=>$sizes,
            // 'colors'=>$colors,
            'size'=>$size,
            'color'=>$color,
            // 'size2'=>$sizes->size_id
        ])->layout('layouts.base1');
    }
}
