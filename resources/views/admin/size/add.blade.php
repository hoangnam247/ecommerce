@extends('admin.layout.main')

@section('content')
<style>

    .size {
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

.size:hover {
    background-color: #45a049; /* Darker shade of green on hover */
}
</style>
<div class="create_product">
    <h2>CREATE SIZE</h2>
    <div class="input_form center" >
    <form action="#" method="POST" enctype="multipart/form-data">
    <input type="text" name="volume" placeholder="Tên size" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
    @error('volume')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <input class = "size" type="submit" name="submit" value="Thêm Category">
    @csrf
</form>
</div>
@endsection