@extends('layouts.admin')

@section('title','Cập nhật màu sắc')

@section('content')
    <form action="{{route('admin.color.update',$color->id)}}" method='post'>
        @csrf @method('PUT')
        <div class="row">
            <div class="form-group col-lg-5">
                <label for="color">Tên màu</label>
                <input type="text" value="{{$color->color}}" class="form-control" name="color" id="color" aria-describedby="helpId" placeholder="Tên màu sắc">
                @error('color')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group col-lg-7">
                  <label for="code">Mã màu</label>
                  <input type="text" value="{{$color->code}}" class="form-control" name="code" id="code" aria-describedby="helpId" placeholder="Mã màu sắc">
                  @error('code')
                  <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
