@extends('admin.layout.main')

@section('content')
<div class="category">
<div class="page_header">
        <p class="title">STAFF</p>
    </div>
    @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
    <div class="between">
        <div class="button_form center">
            <a href="{{route('addStaff')}}">
                <button type="button">
                    CREATE
                </button>
            </a>
        </div>
        
        <div class="between">

<form class="d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keywords" value="{{request()->keywords}}">
    <button class="btn btn-outline-success" type="submit"><i class='bx bx-search'></i></button>
    <div style = "margin-right: 5%;"  >
                    <select name = "status" style = "height: 100%;padding: 1% 5%;border-radius: 10px;" >
                        <option value="0">Tất cả trạng thái</option>
                        <option value="active" {{request()->status=='active'?'selected':false}}>Hoạt động</option>
                        <option value="inactive" {{request()->status=='inactive'?'selected':false}}>Không hoạt động</option>
                    </select>
                </div>
</form>
</div>
    </div>
    <div class="account_list">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">GENDER</th>
                    <th scope="col">ADDRESS</th>
                    <th scope="col">PHONE</th>
                    <th scope="col">LEVEL</th>
                    <th scope="col">USERID</th>
                    <th scope="col">STATE</th>
                    <th scope="col">EDIT</th>
                    <th scope="col">DELETE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($staffList as $key => $item)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$item->staff_id}}</td> 
                    <td>{{$item->staff_name}}</td>
                    <td>{{$item->gender}}</td>   
                    <td>{{$item->address}}</td>   
                    <td>{{$item->phone}}</td>   
                    <td>
                     @switch($item->level)
                    @case(1)
                    Admin
                        @break
                    @case(2)
                    Nhân viên
                        @break
                    @case(3)
                    Khách hàng
                        @break
                    @default
                        Unknown
                    @endswitch
                    </td>              
                    <td>{{$item->userId}}</td>  
                    <td>
                        @if($item->status == 1)
                            Hoạt động
                        @else
                            Không hoạt động
                        @endif
                    </td>
                    <td> <a href="{{route('editStaff',['id'=>$item->staff_id])}}"><i class='bx bx-comment-detail'></i></td>
                    <td> 
                        <a href="#" onclick="confirmDelete('{{ route('deleteStaff',['id'=>$item->staff_id]) }}')">
                            <i class='bx bx-trash'></i>
                        </a>
                    </td>               
                 </tr>
                 @endforeach 
               
            </tbody>
        </table>
    </div>
    <div style = "margin-left:45% ">
{{ $staffList->links('pagination::bootstrap-4') }}
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