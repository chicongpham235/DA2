<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nhomsanpham;

class Hero extends Component
{
    public $home;

    public function render()
    {
        $nhomsanpham=Nhomsanpham::orderby('uutien','desc')->orderby('ten','asc')->get();
        return view('livewire.hero',['nhomsanpham'=>$nhomsanpham]);
    }
}
