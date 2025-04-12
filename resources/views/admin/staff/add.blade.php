@extends('admin.layout.main')

@section('content')
<style>

    .nhanvien {
    background-color: #4CAF50; /* Green background */
    color: white; /* White text color */
    padding: 12px 24px; /* Padding around the text */
    border: none; /* No border */
    border-radius: 4px; /* Rounded corners */
    cursor: pointer; /* Pointer cursor on hover */
    transition: background-color 0.3s; /* Smooth transition for hover effect */
    font-size: 16px; /* Larger font size */
    margin-top : 10%;
}

.nhanvien:hover {
    background-color: #45a049; /* Darker shade of green on hover */
}
</style>
<div class="create_product">
    <h2>CREATE STAFF</h2>
    <div class="input_form center" >
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Tên nhân viên" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('name') }}">
    @error('name')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <input type="text" name="phone" placeholder="Số điện thoại" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('phone') }}" >
    @error('phone')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <input type="text" name="address" placeholder="Địa chỉ" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('address') }}" >
    @error('address')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <select name="gender" class="form-control">
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select>
    @error('gender')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror

    <input type="email" name="email" placeholder="Email" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('email') }}" >
    @error('email')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <input type="password" name="password" placeholder="Mật khẩu" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" >
    @error('password')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
    @error('password_confirmation')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <select name="level" class="form-control" >
            <option value="2">Nhân Viên</option>
            <option value="1">Admin</option>
    </select>
    @error('level')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <input class="nhanvien" type="submit" name="submit" value="Thêm nhân viên">
    @csrf
</form>
</div>
@endsection