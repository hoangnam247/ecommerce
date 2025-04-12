@extends('admin.layout.main')

@section('content')
<div class="category">
<div class="page_header">
        <p class="title">SIZE</p>
    </div>
 @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
    <div class="between">
        <div class="button_form center">
            <a href="{{route('addSize')}}">
                <button type="button">
                    CREATE
                </button>
            </a>
        </div>
        <div class="between">

<form class="d-flex" role="search">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keywords" value="{{request()->keywords}}">
    <button class="btn btn-outline-success" type="submit"><i class='bx bx-search'></i></button>
</form>
</div>
    </div>
    <div class="account_list">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">ID</th>
                    <th scope="col">VOLUME</th>
                    <th scope="col">EDIT</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($sizeList as $key => $item)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$item->size_id}}</td>               
                    <td style="text-align: left;">{{$item->volume}}</td>
                    <td> <a href="{{route('editSize',['id'=>$item->size_id])}}"><i class='bx bx-comment-detail'></i></td>
                </tr>
                 @endforeach 
               
            </tbody>
        </table>
    </div>
    <div style = "margin-left:45% ">
{{ $sizeList->links('pagination::bootstrap-4') }}
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

