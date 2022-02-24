@extends('layouts.admin')

@section('title','Sản phẩm')

@section('content')
    <div class="row my-2">
        <div class="col-md-8">
            <form class="form-inline">
                <div class="form-group">
                    <input type="text" name="key" value="{{request()->key}}" class="form-control" placeholder="Từ khóa" aria-describedby="helpId">
                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-right">
            <a class="btn btn-primary" href="{{route('admin.sanpham.create')}}" role="button">Thêm mới</a>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Ảnh</th>
                <th>Size</th>
                <th>Màu</th>
                <th>Giá</th>
                <th>Giá bán</th>
                <th>Trạng thái</th>
                <th>Mức ưu tiên</th>
                <th class='text-right'>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @for($i=0; $i < count($data); $i++)
            <tr>
                <td scope="row">{{$data[$i]->id}}</td>
                <td>{{$data[$i]->ten}}</td>
                <td><img src="{{url('uploads')}}/{{$data[$i]->anh}}" alt="" width="75px" height="auto"></td>
                <td>
                    @foreach ($sizes[$i] as $s)
                        {{App\Models\Size::where('id',$s->size_id)->select('id','size')->first()->size}}
                    @unless ($loop->last)
                        ,
                    @endunless
                    @endforeach
                </td>
                <td>
                    @foreach ($colors[$i] as $c)
                        {{App\Models\Color::where('id',$c->color_id)->select('id','color')->first()->color}}
                    @unless ($loop->last)
                        ,
                    @endunless
                    @endforeach
                </td>
                <td>{{number_format($data[$i]->gia,0)}}</td>
                @if ($data[$i]->giaban==NULL)
                    <td></td>
                @else
                    <td>{{number_format($data[$i]->giaban,0)}}</td>
                @endif
                <td>
                    @if ($data[$i]->trangthai==1)
                        <span class="badge badge-primary">Hoạt động</span>
                    @else
                        <span class="badge badge-danger">Không hoạt động</span>
                    @endif
                </td>
                <td>{{$data[$i]->uutien}}</td>
                <td class="text-right">
                    <a name="" id="" class="btn btn-sm btn-primary" href="{{route('admin.sanpham.edit', $data[$i]->id)}}" role="button"><i class="fa fa-edit"></i></a>
                    <a name="" id="" class="btn btn-sm btn-danger btndelete" href="{{route('admin.sanpham.destroy',$data[$i]->id)}}" role="button"><i class="fa fa-trash"></i> </a>
                </td>
            </tr>
            @endfor
        </tbody>
    </table>

    {{$data->appends(Request::all())->links()}}

    <form id='formdelete' action="" method="post">
        @csrf @method('DELETE')
    </form>
@endsection

@section('js')
<script>
    $(".btndelete").click(function(ev){
        ev.preventDefault();
        let _href=$(this).attr('href');
        $("form#formdelete").attr('action',_href);
        if (confirm('Bạn muốn xóa bản ghi này không?'))
        {
            $("form#formdelete").submit();
        }
    });

</script>
@endsection
