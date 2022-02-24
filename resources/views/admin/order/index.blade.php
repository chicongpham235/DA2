@extends('layouts.admin')

@section('title','Đơn đặt hàng')

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
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Mã sản phẩm</th>
                <th>Màu</th>
                <th>Size</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Zip code</th>
                <th>Số tiền thanh toán</th>
                <th>Thời gian</th>
                <th class='text-right'>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $d)
            <tr>
                <td scope="row">{{$d->order_id}}</td>
                <td>{{$d->firstname}}</td>
                <td>{{$d->product_id}}</td>
                <td>{{$d->color}}</td>
                <td>{{$d->size}}</td>
                <td>{{$d->phone}}</td>
                <td>{{$d->address}}</td>
                <td>{{$d->zipcode}}</td>
                <th>{{number_format($d->total)}}</th>
                <td>{{$d->created_at}}</td>
                <td class="text-right">
                    <a name="" id="" class="btn btn-sm btn-danger btndelete" href="{{route('admin.order.destroy',$d->order_id)}}" role="button"><i class="fa fa-trash"></i> </a>
                </td>
            </tr>
            @endforeach
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
