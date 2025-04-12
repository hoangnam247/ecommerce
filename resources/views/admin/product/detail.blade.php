
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
@if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
<div class="product_list">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">SIZE</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">STATE</th>
                    <th scope="col">EDIT</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            @foreach ($productList as $key => $item)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$item->productsize_id}}</td>
                    <td style="text-align: left;">{{$item->product_name}}</td>
                    <td style="text-align: left;">{{$item->volume}}</td>
                    <td style="text-align: left;">{{$item->quantity}}</td>
                    <td style="text-align: left;">{{$item->price}}</td>
                    <td>
                        @if($item->productsize_status == 1)
                            Hoạt động
                        @else
                            Không hoạt động
                        @endif
                    </td>
                    <td>
                    <a href="{{route('editstatusproduct',['id'=>$item->productsize_id ]  )}}"><i class='bx bx-check' ></i></a>
                    </td>
                </tr>
                 @endforeach 
            </tbody>
           
        </table>
        <h2>ADD PRODUCTSIZE</h2>
    <div class="input_form center" >
        <form action="" method="POST" enctype="multipart/form-data">
           
    

            <select name="size_id" class="form-control" >
            @foreach ($sizeList as $size)
            <option value="{{ $size->size_id }}">
                {{ $size->volume }}
                </option> 
            @endforeach
            </select> 
            @error('size_id')
            <span style="color:red">{{ $message }}</span><br>
            @enderror

            <input type="text" name="quantity" id="quantity"  placeholder="Số lượng" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            @error('quantity')
                <span style="color:red">{{ $message }}</span><br>
            @enderror

            <input type="text" name="price" id="price"  placeholder="Giá" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
            @error('price')
                <span style="color:red">{{ $message }}</span><br>
            @enderror

            <select name="status"  class="form-control"  >
            <option value="1" >Hiển thị</option>
            <option value="0" >Ẩn</option>
            </select>

        
            <input class = "product" type="submit" name="submit" value="Cập nhật sản phẩm">
            @csrf
        </form>
    </div>

@endsection