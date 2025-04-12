@extends('home.layout.main')

@section('content')
<style>
.image {
    width: 100%;
    border-radius: 10px;
    max-width: 100%; /* Đảm bảo rằng ảnh không vượt quá 100% chiều rộng của cột */
}
.black-button {
    background-color: black; /* Sets the background color to black */
    color: white;            /* Sets the text color to white */
    border: none;            /* Removes the border */
    padding: 10px 20px;      /* Adds padding around the text */
    font-size: 16px;         /* Sets the font size */
    cursor: pointer;         /* Changes the cursor to a pointer when hovering over the button */
    transition: background 0.3s, color 0.3s; /* Smooth transition for hover effects */
}

.black-button:hover {
    background-color: #333; /* Dark gray background on hover for visual feedback */
    color: #ddd;            /* Slightly lighter text color on hover */
}
</style>
<div class="payment">
    <div class="payment_header center">
        <p>ORDER INFORMATION</p>
    </div>
@if(empty($cartList[0]))
        <div style = "margin-bottom : 10% ; margin-top : 10%">
        <br/>
                <br/>
            <h4 style = "margin-left:40%"; >Giỏ hàng của bạn đang trống</h4>
                <br/>
                <br/>
            <div class="make_pay">
                <a href="{{route('home')}}">Tiếp tục mua hàng</a>
            </div>
        </div>
                
@else
    <div class="payment_main">
        <div class="payment_product">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">IMAGE</th>
                        <th scope="col">NAME</th>
                        <th scope="col">PRICE</th>
                        <th scope="col">QUANTITY</th>
                        <th scope="col">AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
        @php
        $totalAmount = 0; // Khởi tạo biến tổng tiền
        @endphp
        @foreach ($cartList as $key => $item)
        <tr>
            <td class="image" style="max-width: 15%;">
            <img src="./public/uploads/{{$item->image}}" class="image" alt="Hình ảnh">
            </td>
            <td style="text-align: center;">{{ $item->product_name }}</td>
            <td>{{number_format($item->price)}}.đ</td>
            <td>{{ $item->quantity }}</td>
            <td style="text-align: end;">{{number_format($item->total_price)}}.đ</td>
        </tr>
        @php
        $totalAmount += $item->total_price; // Cộng vào tổng tiền của giỏ hàng
        @endphp
        @endforeach

        <!-- Tính tổng tiền của giỏ hàng -->
        <tr>
            <td colspan="4" style="text-align:left;">Temporary</td>
            <td style="text-align: end; color: #0000ff"> {{number_format($totalAmount)}}.đ</td>
        </tr>

        <!-- Chi phí ship -->
        <tr>
            <td colspan="4" style="text-align:left;">Ship</td>
            <td style="text-align: end;">40.000.đ</td>
        </tr>

        <!-- Tính tổng đơn hàng -->
        @php
        $grandTotal = $totalAmount + 40000; // Tính tổng đơn hàng bằng cách cộng tổng tiền và chi phí ship
        @endphp
        <tr>
            <td colspan="4" style="font-weight: 600; text-align:left;">TOTAL</td>
            <td style="text-align: end; font-weight: 600; color: #ff0000;"> {{number_format($grandTotal)}}.đ</td>
        </tr>
    </tbody>
            </table>
        </div>
        <form action = "{{route('postPayment')}}" method="POST">
        <div class="payment_infor center">

            <p class="">Information</p>
            <input type="text" placeholder="Nguyen Van A" name = 'customer_name' class="form-control " aria-label="Large" aria-describedby="inputGroup-sizing-sm" value = "{{old('customer_name')}}" >
            @error('customer_name')
                            <span style="color:red">{{$message}}</span>
            @enderror

            <input type="text"  placeholder="0812345678"name = 'phone'   class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value = "{{old('phone')}}" >
            @error('phone')
                            <span style="color:red">{{$message}}</span>
                        @enderror
            <input type="text" placeholder="nguyenvana@gmail.com"   name = 'email' class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value = "{{old('email')}}" >
            @error('email')
                            <span style="color:red">{{$message}}</span>
            @enderror
            <input type="text"  name = 'address'  placeholder="273 An Duong Vuong P3 Q5" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" value = "{{old('address')}}">
            @error('address')
                            <span style="color:red">{{$message}}</span>
            @enderror
            <textarea class="form-control"  name = 'note' aria-label="With textarea" placeholder="Note..."></textarea>
                <button type="submit"  class="black-button" >
                    COMPLETE
                </button>
                @csrf
    </form>
        </div>

    </div>
    @endif
</div>
@endsection