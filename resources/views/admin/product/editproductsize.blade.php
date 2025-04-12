
@extends('admin.layout.main')

@section('content')
<style>

    .product {
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

.product:hover {
    background-color: #45a049; /* Darker shade of green on hover */
}
</style>
<div class="edit_product">
    <h2>EDIT PRODUCTSIZE</h2>
    <div class="input_form center" >
    <form action="" method="POST" enctype="multipart/form-data">
           
            <select name="category_id"  class="form-control"  >
                <option >
                {{  $productDetail->volume  }}
            </option>

            </select>
            @error('category_id')
                <span style="color:red">{{ $message }}</span><br>
            @enderror

            <input type="text"  value="{{ $productDetail->product_name }}" placeholder="Tên sản phẩm" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" readonly >
            @error('product_name')
                <span style="color:red">{{ $message }}</span><br>
            @enderror

           <input type="text" name="quantity" id="quantity"  placeholder="Số lượng" value="{{ $productDetail->quantity }}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
           @error('quantity')
               <span style="color:red">{{ $message }}</span><br>
           @enderror

           <input type="text" name="price" id="price"  placeholder="Giá"  value="{{ $productDetail->price }}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
           @error('price')
               <span style="color:red">{{ $message }}</span><br>
           @enderror

           <select name="status"  class="form-control"  >
           <option value="1" {{ $productDetail->productsize_status == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ $productDetail->productsize_status == 0 ? 'selected' : '' }}>Ẩn</option>
           </select>

           <input class = "product" type="submit" name="submit" value="Cập nhật sản phẩm">
           @csrf
       </form>
</div>
@endsection