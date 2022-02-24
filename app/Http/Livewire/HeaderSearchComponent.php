<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nhomsanpham;

class HeaderSearchComponent extends Component
{
    public $search;

    public function mount()
    {
        $this->fill(request()->only('search'));

    }

    public function productSearch(){

    }

    public function render()
    {
        $nhomsanpham=Nhomsanpham::orderby('uutien','desc')->orderby('ten','asc')->get();
        return view('livewire.header-search-component', compact('nhomsanpham'));
    }
}
