<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\ColorSanpham;
use App\Models\Nhomsanpham;
use App\Models\Sanpham;
use App\Models\Size;
use App\Models\SizeSanpham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key = request()->key) {
            $data = Sanpham::where('ten', 'like', '%' . $key . '%')->orderby('uutien', 'DESC')->orderby('id', 'ASC')->paginate(5);
        } else {
            $data = Sanpham::orderby('uutien', 'DESC')->orderby('id', 'ASC')->paginate(5);
        }

        $sizes = [];
        $colors = [];

        for ($i = 0; $i < count($data); $i++) {
            $sizes[] = SizeSanpham::where('sanpham_id', $data[$i]->id)->select('sanpham_id', 'size_id')->get();
            $colors[] = ColorSanpham::where('sanpham_id', $data[$i]->id)->select('sanpham_id', 'color_id')->get();
        }
        // for($i=0; $i < count($data); $i++){
        //     foreach($sizes[$i] as $s){
        //         $size1[]=Size::where('id',$s->size_id)->select('id','size')->get();
        //     }
        // }
        return view('admin.sanpham.index', compact('data', 'sizes', 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $nhomsanphams = Nhomsanpham::orderby('ten')->where('trangthai', 1)->select('id', 'ten')->get();

        $sizes = Size::orderby('id')->select('id', 'size')->get();

        $colors = Color::orderby('id')->select('id', 'color')->get();

        return view('admin.sanpham.create', compact('nhomsanphams', 'sizes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $keys = $request->ten;
        $request->validate([
            'ten' => 'required|unique:sanpham',
            'gia' => 'required',
            'uutien' => 'required',
            'size1' => 'required',
            'color1' => 'required',
        ],
            [
                'ten.required' => 'Cần nhập tên nhóm sản phẩm',
                'ten.unique' => 'Tên nhóm sản phẩm cần duy nhất',
                'gia.required' => 'Cần nhập giá sản phẩm',
                'uutien.required' => "Cần nhập mức độ ưu tiên",
                'color1.required' => 'Cần chọn màu sắc',
                'size1.required' => 'Cần chọn size',

            ]
        );
        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $ext = $file->extension();

            $file_name = time() . '-sp.' . $ext;

            $file->move(public_path('uploads'), $file_name);
            $request->merge(['anh' => $file_name]);
        }
        $color = $request->color1;
        $size = $request->size1;
        Sanpham::create($request->all());
        $sanpham = Sanpham::where('ten', $keys)->first();
        $sanpham->sizes()->attach($size);
        $sanpham->colors()->attach($color);
        return redirect()->route('admin.sanpham.index')->with('success', 'Thêm mới sản phẩm thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function show(Sanpham $sanpham)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function edit(Sanpham $sanpham)
    {
        $nhomsanphams = Nhomsanpham::orderby('ten')->where('trangthai', 1)->select('id', 'ten')->get();

        $sizesp = SizeSanpham::where('sanpham_id', $sanpham->id)->select('sanpham_id', 'size_id')->get();

        $sizes = Size::orderby('id')->select('id', 'size')->get();

        $colorsp = ColorSanpham::where('sanpham_id', $sanpham->id)->select('sanpham_id', 'color_id')->get();

        $colors = Color::orderby('id')->select('id', 'color')->get();

        return view('admin.sanpham.edit', compact('sanpham', 'nhomsanphams', 'sizesp', 'sizes', 'colorsp', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sanpham $sanpham)
    {
        $request->validate([
            'ten' => 'required|unique:nhomsanpham,ten,' . $sanpham->id,
            'gia' => 'required',
            'uutien' => 'required',
            'size1' => 'required',
            'color1' => 'required',
        ],
            [
                'ten.required' => 'Cần nhập tên nhóm sản phẩm',
                'ten.unique' => 'Tên nhóm sản phẩm cần duy nhất',
                'gia.required' => 'Cần nhập giá sản phẩm',
                'uutien.required' => "Cần nhập mức độ ưu tiên",
                'size1.required' => "Cần chọn size",
                'color1.required' => "Cần chọn màu sắc",

            ]
        );

        $deleteimage = false;
        $oldimage = public_path('uploads/' . $sanpham->anh);

        if ($request->has('size1')) {
            $size = $request->size1;
            $sanpham->sizes()->detach();
            $sanpham->sizes()->attach($size);
        }

        if ($request->has('color1')) {
            $color = $request->color1;
            $sanpham->colors()->detach();
            $sanpham->colors()->attach($color);
        }

        if ($request->has('file_upload')) {
            $file = $request->file_upload;
            $ext = $file->extension();

            $file_name = time() . '-sp.' . $ext;

            $file->move(public_path('uploads'), $file_name);
            $request->merge(['anh' => $file_name]);
            $deleteimage = true;
        } else {
            $request->merge(['anh' => $sanpham->anh]);
        }
        if ($sanpham->update($request->only('ten', 'mota', 'danhsachanh', 'nhomsanphamid', 'gia', 'giaban', 'anh', 'trangthai', 'uutien'))) {
            if ($deleteimage) {
                File::delete($oldimage);
            }
            return redirect()->route('admin.sanpham.index')->with('success', 'Cập nhật sản phẩm thành công.');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sanpham  $sanpham
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sanpham $sanpham)
    {
        $sizesp = SizeSanpham::where('sanpham_id', $sanpham->id);
        $sizesp->delete();
        $colorsp = ColorSanpham::where('sanpham_id', $sanpham->id);
        $colorsp->delete();
        $sanpham->delete();
        return redirect()->route('admin.sanpham.index')->with('success', 'Xóa bản ghi thành công.');
    }
}
