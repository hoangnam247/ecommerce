
@extends('admin.layout.main')

@section('content')
<style>

    .category {
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

.category:hover {
    background-color: #45a049; /* Darker shade of green on hover */
}
</style>
<div class="edit_product">
    <h2>EDIT CATEGORY</h2>
    <div class="input_form center" >
        <form action="#" method="POST" enctype="multipart/form-data">

            <input type="text" name="category_name"  value="{{ $categoryDetail->category_name }}" placeholder="Tên category" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            @error('category_name')
                <span style="color:red">{{ $message }}</span><br>
            @enderror

            <select name="status" class="form-control" >
            <option value="1" {{ $categoryDetail->status == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ $categoryDetail->status == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
            <input class="category" type="submit" name="submit" value="Cập nhật category">
            @csrf
        </form>
</div>
@endsection