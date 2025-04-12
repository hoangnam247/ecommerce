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
<div class="edit_product">
    <h2>EDIT STAFF</h2>
    <div class="input_form center" >
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Tên nhân viên" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('name', $staffDetail->staff_name) }}">
    @error('name')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    
    <input type="text" name="phone" placeholder="Số điện thoại" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('phone', $staffDetail->phone) }}" >
    @error('phone')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    
    <input type="text" name="address" placeholder="Địa chỉ" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('address', $staffDetail->address) }}" >
    @error('address')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    
    <select name="gender" class="form-control">
    <option value="Nam" {{ old('gender', $staffDetail->gender) == 'Nam' ? 'selected' : '' }}>Nam</option>
    <option value="Nữ" {{ old('gender', $staffDetail->gender) == 'Nữ' ? 'selected' : '' }}>Nữ</option>
</select>
@error('gender')
    <span style="color:red">{{$message}}</span>
    <br>
@enderror
    <select name="status" class="form-control">
            <option value="1" {{ $staffDetail->status == 1 ? 'selected' : '' }}>Kích Hoạt</option>
            <option value="0" {{ $staffDetail->status == 0 ? 'selected' : '' }}>Không kích hoạt</option>
    </select>
    @error('status')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <select name="level" class="form-control" >
            <option value="1" {{ $staffDetail->level == 1 ? 'selected' : '' }}>Admin</option>
            <option value="2" {{ $staffDetail->level == 2 ? 'selected' : '' }}>Nhân Viên</option>
    </select>
    @error('level')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <input type="email" name="email" placeholder="Email" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value="{{ old('email', $staffDetail->email) }}" >
    @error('email')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror

    <input class="nhanvien"  type="submit" name="submit" value="Sửa nhân viên">
    @csrf
</form>

</div>
@endsection