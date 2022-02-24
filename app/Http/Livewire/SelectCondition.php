<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nhomsanpham;
use App\Models\Sanpham;
use App\Models\Size;
use Illuminate\Support\Facades\DB;
use Cart;

class SelectCondition extends Component
{
    public $selectionCatid=null;
    public $selectionSizeid=null;
    public $pMin;
    public $pMax;
    public $minPrice;
    public $maxPrice;

    public function mount(){

        $this->pMin=intval(Sanpham::min('gia'));
        $this->pMax=intval(Sanpham::max('gia'));
        $this->minPrice=$this->pMin;
        $this->maxPrice=$this->pMax;
        $this->emit('updateSelection', $this->selectionCatid, $this->minPrice, $this->maxPrice, $this->selectionSizeid);
    }

    public function updatePrice($minPrice, $maxPrice){
        $this->minPrice = $minPrice;
        $this->maxPrice = $maxPrice;

        $this->emit('updateSelection', $this->selectionCatid, $this->minPrice, $this->maxPrice, $this->selectionSizeid);
    }

    public function selectCategory($catid){
        if ($this->selectionCatid==$catid){
            $this->selectionCatid=null;
        }else {
            $this->selectionCatid=$catid;
        }

        $this->emit('updateSelection', $this->selectionCatid, $this->minPrice, $this->maxPrice, $this->selectionSizeid);
    }

    public function selectSize($sizeid){
        if ($this->selectionSizeid==$sizeid){
            $this->selectionSizeid=null;
        }else {
            $this->selectionSizeid=$sizeid;
        }

        $this->emit('updateSelection',$this->selectionCatid,$this->minPrice,$this->maxPrice,$this->selectionSizeid);
    }

    public function render()
    {
        $categories = Nhomsanpham::orderby('uutien','desc')->orderby('ten','asc')->get();
        $sizes = Size::orderby('id','desc')->get();

        return view('livewire.select-condition', compact('categories','sizes'));
    }
}
