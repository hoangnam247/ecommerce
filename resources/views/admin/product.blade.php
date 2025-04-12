@extends('admin.layout.main')

@section('content')
<div class="product">
    <div class="page_header">
        <p class="title">PRODUCT</p>
    </div>
    @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
    <div class="between">
        <div class="button_form center">
            <a href="{{route('getaddProduct')}}">
                <button type="button">
                    CREATE
                </button>
            </a>
        </div>
        <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keywords" value="{{request()->keywords}}">
            <button class="btn btn-outline-success" type="submit"><i class='bx bx-search'></i></button>
            <div>
                    <select name = "status" style = "height: 100%;padding: 1% 5%;border-radius: 10px;">
                        <option value="0">Tất cả trạng thái</option>
                        <option value="active" {{request()->status=='active'?'selected':false}}>Hoạt động</option>
                        <option value="inactive" {{request()->status=='inactive'?'selected':false}}>Không hoạt động</option>
                    </select>
            </div>
        </form>
    </div>
    <div class="product_list">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">ID</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">NAME</th>
                    <th scope="col">Created_At</th>
                    <th scope="col">Updated_At</th>
                    <th scope="col">Description</th>
                    <th scope="col">STATE</th>
                    <th scope="col">DETAIL</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">DELETE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($productList as $key => $item)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$item->product_id}}</td>
                    <td>{{$item->category_name}}</td>
                    <td  style="width: 10%;">
                        <img src="../public/uploads/{{$item->image}}" style="width: 50%" alt="airpods2" />
                    </td>
                    <td style="text-align: left;">{{$item->product_name}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
                    <td>{{$item->description}}</td>
                    <td>
                        @if($item->product_status == 1)
                            Hoạt động
                        @else
                            Không hoạt động
                        @endif
                    </td>
                    <td> <a href="{{route('detailProduct',['id'=>$item->product_id])}}"><i class='bx bx-comment-detail'></i></td>
                    <td> <a href="{{route('editProduct',['id'=>$item->product_id])}}"><i class='bx bx-comment-detail'></i></td>
                    <td> <a href="{{route('deleteProduct',['id'=>$item->product_id])}}"><i class='bx bx-comment-detail'></i></td>
                </tr>
                 @endforeach 
            </tbody>
           
        </table>
    </div>
    <div style = "margin-left:45% ">
{{ $productList->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection