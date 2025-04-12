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
            <p><a href="admin/index.php">ADMIN</a></p>
            <p><a href="index.php?menu=personal">Information</a></p>
            <p><a href="index.php?menu=personal&mana=password">Password</a></p>
            <p><a  href="{{route('order')}}">Order</a></p>
            <p><a href="index.php">Logout</a></p>
        </div>
        <div class="personal_content">
        <div class="update_account center">
    <div class="form">
        <div class="input">
            <label>NAME</label>
            <input type="text" placeholder="Nguyen Van A" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input">
            <label>PHONE</label>
            <input type="text" placeholder="0812345678" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input">
            <label>EMAIL</label>
            <input type="email" placeholder="nguyenvana@gmail.com" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="input">
            <label>ADDRESS</label>
            <input type="text" placeholder="273 An Duong Vuong P3 Q5" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        </div>
        <div class="button_form center">
            <a href="index.php?menu=personal">
                <button type="button">
                    UPDATE
                </button>
            </a>
        </div>
    </div>
</div>
        <div class="order">
    <table class="table table-striped">
        <thead>
        <tr>
                    <td scope="col">Mã Đơn Hàng</td>
                    <td scope="col">Ngày Đặt</td>
                    <td scope="col">Tình trạng đơn hàng</td>
                    <td scope="col">Thành Tiền</td>
        </tr>
        </thead>
        <tbody>
        @foreach($invoiceList as $key => $item)
    <tr>
            <td><a href="{{route('detailinvoice',['id' => $item->invoice_id])}}">HD{{$item->invoice_id}}</a></td>
            <td>{{$item->created_at}}</td> 
            <td>
        @if($item->status == 0) Đang chờ @endif
        @if($item->status == 1) Đã duyệt @endif
        @if($item->status == 2) Từ chối @endif
        @if($item->status == 3) Hoàn Thành @endif
        @if($item->status == 4) Bị Hủy @endif
            </td>
            <td>{{number_format($item->total_bill)}}.đ</td>
    </tr>
        @endforeach
            </tbody>
    </table>
</div>
        </div>
    </div>
</div>
@endsection