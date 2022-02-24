<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($key=request()->key){
            $data=Color::where('color','like','%'.$key.'%')->orderby('color','ASC')->paginate(5);
        }
        else{
            $data=Color::orderby('color','ASC')->paginate(5);
        }
        return view('admin.color.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.color.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'color'=>'required|unique:colors,color',
            'code'=>'required',
        ],
        [
            'color.required'=>'Cần nhập tên màu sắc',
            'color.unique'=>'Tên màu sắc phải là duy nhất',
            'code.required'=>'Cần nhập mã màu sắc',
        ]
        );

        if(Color::create($request->all())){
            return redirect()->route('admin.color.index')->with('success','Thêm mới thành công.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function show(Color $color)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function edit(Color $color)
    {
        return view('admin.color.edit',compact('color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        $request->validate([
            'color'=>'required|unique:colors,color,'.$color->id,
            'code'=>'required',
        ],
        [
            'color.required' => 'Cần nhập tên màu',
            'color.unique' => 'Tên màu phải duy nhất',
            'code.required' => "Cần nhập mã màu",

        ]
        );

        if ($color->update($request->all())){
            return redirect()->route('admin.color.index')->with('success','Cập nhật thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Color  $color
     * @return \Illuminate\Http\Response
     */
    public function destroy(Color $color)
    {
        if ($color->sanphams()->count()>0){
            return redirect()->route('admin.color.index')->with('error','Xóa bản ghi không thành công do có chứa sản phẩm.');
        }
        else {
            return redirect()->route('admin.color.index')->with('success','Xóa bản ghi thành công.');
        }
    }
}
