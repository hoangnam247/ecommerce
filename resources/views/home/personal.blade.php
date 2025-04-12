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

        @if(session()->has('msg_pass'))
        <div class="alert alert-success">
        {{ session()->get('msg_pass') }}
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
        <div class="update_account center">
<div class="form">
<form method="POST" action="{{ route('updatePersonal', $detailCustomer->customer_id) }}">
        @csrf
    <div class="input">
        <label>NAME</label>
        <input type="text" name="name" value="{{ $detailCustomer->customer_name }}"  class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        @error('name')
         <span style="color:red">{{$message}}</span>
         @enderror
    </div>
    <div class="input">
        <label>PHONE</label>
        <input type="text" name="phone" value="{{ $detailCustomer->phone }}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        @error('phone')
         <span style="color:red">{{$message}}</span>
         @enderror
    </div>
    <div class="input">
        <label>EMAIL</label>
        <input type="email" name="email" value="{{ $detailCustomer->email }}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" readonly>
    </div>
    <div class="input">
        <label>ADDRESS</label>
        <input type="text" name="address" value="{{ $detailCustomer->address }}" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm">
        @error('address')
         <span style="color:red">{{$message}}</span>
         @enderror
    </div>
    <div class="button_form center">
        <a >
            <button type="submit">
                UPDATE
            </button>
        </a>
    </div>
</form>
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