@extends('home.layout.main')

@section('content')
<div class="personal center">
    <div class="personal_header center">
        <p class="title">PERSONAL ACCOUNT</p>
        @if (Auth::check())
                    <p class="name">{{Auth::user()->users_name}}</p>
        @endif
        @if(session()->has('msg'))
        <div class="alert alert-success">
        {{ session()->get('msg') }}
    </div>
@endif
    </div>
    <div class='line '></div>
    <div class="personal_main">
    <div class="personal_side">          
            <p><a href="{{route('personal')}}">Information</a></p>
            <p><a href="{{route('changepass')}}">Change Password</a></p>
            <p><a href="{{route('logout')}}">Logout</a></p>
        </div>
        <div class="personal_content">
        <div class="order">
    <table class="table table-striped">
        <thead>
        <tr>
                    <td scope="col">Tên Sản Phẩm</td>
                    <td scope="col">Volume</td>
                    <td scope="col">Đơn giá</td>
                    <td scope="col">Số lượng</td>
                    <td scope="col">Thành Tiền</td>
        </tr>
        </thead>
        <tbody>
        @foreach($detailList as $key => $item)
            <tr>
                <td><a href="{{route('detail-product',['id' => $item->product_id])}}" >{{$item->product_name}}</a></td>
                <td>{{$item->volume}}</td>
                <td>{{number_format($item->price)}}.đ</td>  
                <td>{{$item->quantity}}</td>
                <td>{{number_format($item->total)}}.đ</td>  
            </tr>
            @endforeach
            </tbody>
    </table>
</div>
        </div>
    </div>
</div>
@endsection