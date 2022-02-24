@extends('layouts.admin')

@section('title','Chỉnh sửa thông tin người dùng')

@section('content')
    <form action="{{route('admin.user.update', $user->id)}}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" name="name" id="name" aria-describedby="helpId" placeholder="Tên người dùng">
            @error('name')
                <div class="help-text text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId" placeholder="Email">
            @error('email')
                <div class="help-text text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="password">
            @error('password')
                <div class="help-text text-danger">{{$message}}</div>
            @enderror
        </div>

        <div class="form-group">
          <label for="level">Level</label>
          <select class="form-control" name="level" id="level">
            <option value="0">Sys admin</option>
            <option value="1">Người quản lý</option>
            <option value="2">User</option>
          </select>
        </div>

        <div class="form-group">
            <label for="status">Trạng thái</label>
            <select class="form-control" name="status" id="status">
                <option value="1">Hoạt động</option>
                <option value="0">Không hoạt động</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
@endsection
