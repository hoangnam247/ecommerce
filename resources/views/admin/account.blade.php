@extends('admin.layout.main')

@section('content')
<div class="account">
<div class="page_header between">
        <p class="title">ACCOUNT</p>
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
                    <th scope="col">CREATE_AT</th>
                    <th scope="col">UPDATE_AT</th>
                    <th scope="col">LEVEL</th>
                    <th scope="col">STATE</th>
                    <th scope="col">UPDATE STATUS</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($accountList as $key => $item)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$item->id}}</td>
                    <td>{{$item->users_name}}</td>
                    <td style="text-align: left;">{{$item->email}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->updated_at}}</td>
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
                    <td>
                        @if($item->status == 1)
                            Hoạt động
                        @else
                            Không hoạt động
                        @endif
                    </td>
                    <td class="delete">
                    @if($item->level == 1)
                    <i class="uil uil-lock"></i>
                    @else
                    <a href="{{route('editstatus',['id'=>$item->id , 'status' => '0']  )}}"><i class='bx bx-x' ></i></a>
                    <a href="{{route('editstatus',['id'=>$item->id , 'status' => '1']  )}}"><i class='bx bx-check' ></i></a>
                    
                    @endif
                </td>
                </tr>
                 @endforeach 
            </tbody>
        </table>
    </div>
</div>
@endsection