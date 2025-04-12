@extends('admin.layout.main')

@section('content')
<div class="category">
<div class="page_header">
<div class="page_header between">
        <p class="title">ACCOUNT</p>
        @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
        <form class="d-flex" role="search">
            
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keywords" value="{{request()->keywords}}">
            
            <button class="btn btn-outline-success" type="submit"><i class='bx bx-search'></i></button>
            <div  >
                    <select name = "status" style = "height: 100%;padding: 1% 5%;border-radius: 10px;">
                        <option value="0">Tất cả trạng thái</option>
                        <option value="active" {{request()->status=='active'?'selected':false}}>Hoạt động</option>
                        <option value="inactive" {{request()->status=='inactive'?'selected':false}}>Không hoạt động</option>
                    </select>
            </div>
        </form>
    </div>
    <div class="account_list">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">EMAIL</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">USERID</th>
                    <th scope="col">STATE</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">DELETE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($customerList as $key => $item)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$item->customer_id}}</td> 
                    <td>{{$item->customer_name}}</td>
                    <td>{{$item->email}}</td>   
                    <td>{{$item->phone}}</td>   
                    <td>{{$item->address}}</td>                
                    <td>{{$item->userId}}</td>  
                    <td>
                        @if($item->status == 1)
                            Hoạt động
                        @else
                            Không hoạt động
                        @endif
                    </td>
                    <td>
                    <a href="{{route('editstatusCustomer',['id'=>$item->customer_id , 'status' => '0']  )}}"><i class='bx bx-x' ></i></a>
                    <a href="{{route('editstatusCustomer',['id'=>$item->customer_id , 'status' => '1']  )}}"><i class='bx bx-check' ></i></a>
                    </td>
                    <td> <a href="#" onclick="confirmDelete('{{ route('deleteCustomer',['id'=>$item->customer_id]) }}')">
                    <i class='bx bx-trash' ></i>
                    </td>
                    
                </tr>
                 @endforeach 
               
            </tbody>
        </table>
    </div>
    <div style = "margin-left:45% ">
{{ $customerList->links('pagination::bootstrap-4') }}
    </div>
</div>
<script>
    function confirmDelete(deleteUrl) {
        if (confirm("Bạn có chắc chắn muốn xóa không?")) {
            window.location.href = deleteUrl;
        }
    }
</script>
@endsection