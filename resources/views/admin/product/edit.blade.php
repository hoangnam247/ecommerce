
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
    <h2>EDIT PRODUCT</h2>
    <div class="input_form center" >
        <form action="#" method="POST" enctype="multipart/form-data">
           
        <select name="category_id"  class="form-control"  >
                @foreach ($categoryList as $category)
                <option value="{{ $category->category_id }}" {{ $category->category_id == $productDetail->category_id ? 'selected' : '' }}>
                 {{ $category->category_name }}
        </option>
                @endforeach
            </select>
            @error('category_id')
                <span style="color:red">{{ $message }}</span><br>
            @enderror

            <input type="text" name="product_name" id="product_name" value="{{ $productDetail->product_name }}" placeholder="Tên sản phẩm" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            @error('product_name')
                <span style="color:red">{{ $message }}</span><br>
            @enderror

            <input type="file" id="productImages" name="file_upload" multiple>
            <br>
            <!-- Hiển thị ảnh đã chọn trước đó -->
            <img src="{{ asset('public/uploads/' . $productDetail->image) }}" alt="Image" style="width: 25%">
            <br>
            <div id="previewImages"></div>

    

            <textarea name="description" id="description" class="form-control" placeholder="Thông tin sản phẩm..." style="height: 100px">{{ $productDetail->description }}</textarea>
            @error('description')
                <span style="color:red">{{ $message }}</span><br>
            @enderror

            <select name="status"  class="form-control"  >
            <option value="1" {{ $productDetail->status == 1 ? 'selected' : '' }}>Hiển thị</option>
            <option value="0" {{ $productDetail->status == 0 ? 'selected' : '' }}>Ẩn</option>
            </select>
            <!-- Input để chọn nhiều ảnh -->
          
            <!-- Hiển thị các ảnh đã chọn -->
            <div id="previewImages"></div>
            <input class = "product" type="submit" name="submit" value="Cập nhật sản phẩm">
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