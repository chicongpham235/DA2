@extends('layouts.admin')

@section('title','Thêm mới màu sắc')

@section('content')
    <form action="{{route('admin.color.store')}}" method='post'>
        @csrf
        <div class="row">
            <div class="form-group col-lg-5">
                <label for="color">Tên màu</label>
                <input type="text" value="{{old('color')}}" class="form-control" name="color" id="color" aria-describedby="helpId" placeholder="Tên màu">
                @error('color')
                <small class="text-danger">{{$message}}</small>
                @enderror
              </div>
              <div class="form-group col-lg-7">
                  <label for="code">Mã màu</label>
                  <input type="text" value="{{old('code')}}" class="form-control" name="code" id="code" aria-describedby="helpId" placeholder="Mã màu">
                  @error('code')
                  <small class="text-danger">{{$message}}</small>
                  @enderror
                </div>
        </div>
        <button type="submit" class="btn btn-primary">Thêm mới</button>
    </form>
@endsection
