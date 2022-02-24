<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Sanpham;
use App\Models\Nhomsanpham;
use Illuminate\Support\Facades\DB;
use Cart;
use Livewire\WithPagination;

class ProductShopping extends Component
{


    use WithPagination;

    protected $listeners = ['updateSelection'];

    protected $paginationTheme = 'bootstrap';

    public $sorts = [
        0 => 'Mặc định',
        1 => 'Giá tăng dần',
        2 => 'Giá giảm dần',
    ];


    public $sortid=0;

    public $viewType='grid';

    public $selectionCatid=null;
    public $selectionSizeid=null;
    public $minPrice;
    public $maxPrice;
    public $search;

    public function mount(){
        $this->minPrice=Sanpham::min('gia');
        $this->maxPrice=Sanpham::max('gia');
        $this->fill(request()->only('search'));


    }

    public function updateSelection($catid, $minPrice, $maxPrice, $sizeid){
        $this->selectionCatid=$catid;
        $this->selectionSizeid=$sizeid;
        $this->minPrice=$minPrice;
        $this->maxPrice=$maxPrice;
        $this->resetPage();
    }

    public function updatedSortid(){
        $this->resetPage();
    }

    public function paginationView()
    {
        return 'livewire.custom-pagination-links-view';
    }

    public function viewFormat($viewType){
        $this->viewType=$viewType;
    }

    // public function store($product_id, $product_name, $product_price)
    // {
    //     Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\SanPham');
    //     session()->flash('success','Thêm mới một mục vào rỏ hàng');
    //     return redirect()->route('cart');
    // }

    public function render()
    {
        if (!is_null($this->selectionCatid) && is_null($this->search) && is_null($this->selectionSizeid)){
            if ($this->sortid == 1){
                $products=Sanpham::where('nhomsanphamid',$this->selectionCatid)
                    ->where('gia','>=', $this->minPrice)
                    ->where('gia','<=', $this->maxPrice)
                    ->orderBy('gia', 'asc')->paginate(6);
            } elseif ($this->sortid ==2){
                $products=Sanpham::where('nhomsanphamid',$this->selectionCatid)
                ->where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->orderBy('gia', 'desc')->paginate(6);
            } else {
                $products=Sanpham::where('nhomsanphamid',$this->selectionCatid)
                ->where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->paginate(6);
            }
        }

        elseif(is_null($this->selectionCatid) && is_null($this->search) && is_null($this->selectionSizeid)){
            if ($this->sortid == 1){
                $products=Sanpham::where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->orderBy('gia', 'asc')->paginate(6);
            } elseif ($this->sortid ==2){
                $products=Sanpham::where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->orderBy('gia', 'desc')->paginate(6);
            } else {
                $products=Sanpham::where('gia','>=', $this->minPrice)
                ->where('gia','<=', $this->maxPrice)
                ->paginate(6);
            }
        }

        elseif (!is_null($this->selectionCatid) && !is_null($this->search) && is_null($this->selectionSizeid)) {
            if ($this->sortid == 1){
                $products=DB::table('nhomsanpham')->join('sanpham','nhomsanpham.id','=','sanpham.nhomsanphamid')
                    // ->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->where(function ($q){
                        $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                        ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                    })
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
                    // dd($this->minPrice);
            } elseif ($this->sortid ==2){
                $products=DB::table('nhomsanpham')->join('sanpham','nhomsanpham.id','=','sanpham.nhomsanphamid')
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    // ->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->where(function ($q){
                        $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                        ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                    })
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } else {
                $products=DB::table('nhomsanpham')->join('sanpham','nhomsanpham.id','=','sanpham.nhomsanphamid')
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    // ->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->where(function ($q){
                        $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                        ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                    })
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
            }
        }

        elseif (is_null($this->selectionCatid) && !is_null($this->search) && is_null($this->selectionSizeid)){
            if ($this->sortid == 1){
                $products=DB::table('nhomsanpham')->join('sanpham','nhomsanpham.id','=','sanpham.nhomsanphamid')
                ->where(function ($q){
                    $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                })
                ->where('sanpham.gia','>=', $this->minPrice)
                ->where('sanpham.gia','<=', $this->maxPrice)
                ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } elseif ($this->sortid ==2){
                $products=DB::table('nhomsanpham')->join('sanpham','nhomsanpham.id','=','sanpham.nhomsanphamid')
                ->where(function ($q){
                    $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                })
                ->where('sanpham.gia','>=', $this->minPrice)
                ->where('sanpham.gia','<=', $this->maxPrice)
                ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } else {
                $products=DB::table('nhomsanpham')->join('sanpham','nhomsanpham.id','=','sanpham.nhomsanphamid')
                ->where(function ($q){
                    $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                })
                ->where('sanpham.gia','>=', $this->minPrice)
                ->where('sanpham.gia','<=', $this->maxPrice)
                ->orderBy('sanpham.gia', 'asc')->paginate(6);
            }
        }

        elseif (!is_null($this->selectionCatid) && is_null($this->search) && !is_null($this->selectionSizeid)){
            if ($this->sortid == 1){
                $products=DB::table('sanpham')->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    ->where('size_sanpham.size_id',$this->selectionSizeid)
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } elseif ($this->sortid ==2){
                $products=DB::table('sanpham')->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    ->where('sanpham.size_sanpham.size_id',$this->selectionSizeid)
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } else {
                $products=DB::table('sanpham')->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    ->where('size_sanpham.size_id',$this->selectionSizeid)
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
            }
        }

        elseif (is_null($this->selectionCatid) && is_null($this->search) && !is_null($this->selectionSizeid)){
            if ($this->sortid == 1){
                $products=DB::table('sanpham')->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                ->where('size_sanpham.size_id',$this->selectionSizeid)
                ->where('sanpham.gia','>=', $this->minPrice)
                ->where('sanpham.gia','<=', $this->maxPrice)
                ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } elseif ($this->sortid ==2){
                $products=DB::table('sanpham')->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                ->where('size_sanpham.size_id',$this->selectionSizeid)
                ->where('sanpham.gia','>=', $this->minPrice)
                ->where('sanpham.gia','<=', $this->maxPrice)
                ->orderBy('sanpham.gia', 'desc')->paginate(6);
            } else {
                $products=DB::table('sanpham')->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                ->where('size_sanpham.size_id',$this->selectionSizeid)
                ->where('sanpham.gia','>=', $this->minPrice)
                ->where('sanpham.gia','<=', $this->maxPrice)
                ->paginate(6);
            }
        }

        elseif (!is_null($this->selectionCatid) && !is_null($this->search) && !is_null($this->selectionSizeid)){
            if ($this->sortid == 1){
                $products=DB::table('sanpham')->join('nhomsanpham','sanpham.nhomsanphamid','=','nhomsanpham.id')
                    ->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                    // ->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->where(function ($q){
                        $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                        ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                    })
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    ->where('size_sanpham.size_id',$this->selectionSizeid)
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)->select('sanpham.*','nhomsanpham.id as nspid')
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
                    // dd($this->minPrice);
            } elseif ($this->sortid ==2){
                $products=DB::table('sanpham')->join('nhomsanpham','sanpham.nhomsanphamid','=','nhomsanpham.id')
                    ->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    ->where('size_sanpham.size_id',$this->selectionSizeid)
                    // ->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->where(function ($q){
                        $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                        ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                    })
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)->select('sanpham.*','nhomsanpham.id as nspid')
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } else {
                $products=DB::table('sanpham')->join('nhomsanpham','sanpham.nhomsanphamid','=','nhomsanpham.id')
                    ->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                    ->where('sanpham.nhomsanphamid',$this->selectionCatid)
                    ->where('size_sanpham.size_id',$this->selectionSizeid)
                    // ->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->where(function ($q){
                        $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                        ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                    })
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)->select('sanpham.*','nhomsanpham.id as nspid')
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
            }
        }

        else {
            if ($this->sortid == 1){
                $products=DB::table('sanpham')->join('nhomsanpham','sanpham.nhomsanphamid','=','nhomsanpham.id')
                    ->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                ->where(function ($q){
                    $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                })
                ->where('size_sanpham.size_id',$this->selectionSizeid)
                ->where('sanpham.gia','>=', $this->minPrice)
                ->where('sanpham.gia','<=', $this->maxPrice)
                ->select('sanpham.*','nhomsanpham.id as nspid')
                ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } elseif ($this->sortid ==2){
                $products=DB::table('sanpham')->join('nhomsanpham','sanpham.nhomsanphamid','=','nhomsanpham.id')
                    ->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                ->where(function ($q){
                    $q->where('nhomsanpham.ten','like','%'.$this->search.'%')
                    ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                })
                ->where('size_sanpham.size_id',$this->selectionSizeid)
                ->where('sanpham.gia','>=', $this->minPrice)
                ->where('sanpham.gia','<=', $this->maxPrice)->select('sanpham.*','nhomsanpham.id as nspid')
                ->orderBy('sanpham.gia', 'asc')->paginate(6);
            } else {
                $products=DB::table('sanpham')->join('nhomsanpham','sanpham.nhomsanphamid','=','nhomsanpham.id')
                    ->join('size_sanpham','sanpham.id','=','size_sanpham.sanpham_id')
                    ->where(function ($q){
                        $q  ->where('nhomsanpham.ten','like','%'.$this->search.'%')
                            ->orWhere('sanpham.ten','like','%'.$this->search.'%');
                })
                ->where('size_sanpham.size_id',$this->selectionSizeid)
                    ->where('sanpham.gia','>=', $this->minPrice)
                    ->where('sanpham.gia','<=', $this->maxPrice)->select('sanpham.*','nhomsanpham.id as nspid')
                    ->orderBy('sanpham.gia', 'asc')->paginate(6);
            }
        }

        return view('livewire.product-shopping', ['products'=>$products])->layout('site.shop');
    }
}
