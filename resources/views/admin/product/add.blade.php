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
<div class="create_product">
    <h2>CREATE PRODUCT</h2>
    <div class="input_form center" >
    <form action="#" method="POST" enctype="multipart/form-data">
    <select name="category_id" class="form-control" >
        @foreach ($categoryList as $key => $item)
            <option value="{{$item->category_id}}">{{$item->category_name}}</option>       
        @endforeach
    </select>
    @error('category_id')
        <span style="color:red">{{$message}}</span>
    @enderror

    <input type="text" name="product_name" id="product_name" placeholder="Tên sản phẩm" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
    @error('product_name')
        <span style="color:red">{{$message}}</span>
        <br>
    @enderror
    <input type="file" id="productImages" name="file_upload" multiple>
    <br>
    @error('productImages')
        <span style="color:red">{{$message}}</span>
    @enderror
    <input type="text" name="price" id="price" placeholder="Giá" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
    @error('price')
        <span style="color:red">{{$message}}</span>
    @enderror

    <input type="text" name="quantity" id="quantity" placeholder="Số lượng" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
    @error('quantity')
        <span style="color:red">{{$message}}</span>
    @enderror
    <textarea name="description" id="description" class="form-control" placeholder="Thông tin sản phẩm..." style="height: 100px"></textarea>
    @error('description')
        <span style="color:red">{{$message}}</span>
    @enderror
    <!-- Input để chọn nhiều ảnh -->
  
    <!-- Hiển thị các ảnh đã chọn -->
    <div id="previewImages"></div>

    <input  class = "product" type="submit" name="submit" value="Thêm sản phẩm">
    @csrf
</form>
<script>
 
    // Function để hiển thị các ảnh đã chọn
    document.getElementById('productImages').addEventListener('change', function() {
        var previewContainer = document.getElementById('previewImages');
        var files = this.files;
        while (previewContainer.firstChild) {
            previewContainer.removeChild(previewContainer.firstChild);
        }

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();

            reader.onload = function(e) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                previewContainer.appendChild(img);
            }

            reader.readAsDataURL(file);
        }
    });

   

</script>
</div>
@endsection