@extends('home.layout.main')

@section('content')
<style>
.image {
    width: 100%;
    border-radius: 10px;
    max-width: 100%; /* Đảm bảo rằng ảnh không vượt quá 100% chiều rộng của cột */
}
</style>
<div class="cart">
    <div class="cart_header center">
        <p>CART</p>
    </div>

    @if(empty($cartList[0]))
                <br/>
                <br/>
            <h4 style = "margin-left:40%"; >Giỏ hàng của bạn đang trống</h4>
                <br/>
                <br/>
            <div class="make_pay">
                <a href="{{route('home')}}">Tiếp tục mua hàng</a>
            </div>
            <br/>
    @else
    <div class="cart_product">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">NAME</th>
                    <th scope="col">VOLUME</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">AMOUNT</th>
                    <th scope="col">DELETE</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($cartList as $key => $item)
               <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td class="image" style="max-width: 15%;">
    <img src="./public/uploads/{{$item->image}}" class="image" alt="Hình ảnh">
</td>                
                    <td class="name">{{$item->product_name}}</td>
                    <td class="name">{{$item->volume}}</td>
                    <td>
                    <button type="button" onclick="updateQuantity({{$item->productsize_id}}, -1)">-</button>
<input type="number" id="quantity{{$item->productsize_id}}" name="quantity[{{$item->productsize_id}}]" style="width: 50px; text-align: center;" min="1" value="{{$item->quantity}}">
<button type="button" onclick="updateQuantity({{$item->productsize_id}}, 1)">+</button>
                    </td>
                    <td>{{number_format($item->price)}}.đ</td>
                    <td  class="total-price">{{number_format($item->total_price)}}.đ </td>
                    <td class="delete">
                    <a class="uil uil-trash-alt" href="{{route('deletecart',['id' => $item->cart_id])}}" >
                    <i class='bx bx-trash'></i>                    </a>
                    </td>
                </tr>
            @endforeach 
                <tr>
                <td colspan="7" style="text-align: center;">
                    <div id="totalAmount" ></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="cart_button center">
        <a href="{{route('payment')}}">
            <button type="button" class="payment">
                COUNTINUE
            </button>
        </a>
        <a href="{{route('payment')}}">
            <button type="button" class="payment">
                PAYMENT
            </button>
        </a>
    </div>
    @endif
</div>
<script>
function increaseValue(productsizeId) {
    var quantityInput = document.getElementById('quantity' + productsizeId);
    var currentValue = parseInt(quantityInput.value);
    quantityInput.value = currentValue + 1;
}

function decreaseValue(productsizeId) {
    var quantityInput = document.getElementById('quantity' + productsizeId);
    var currentValue = parseInt(quantityInput.value);
    if (currentValue > 1) {
        quantityInput.value = currentValue - 1;
    }
} 

//capnhat
function updateQuantity(productsizeId, change) {
    var quantityInput = document.getElementById('quantity' + productsizeId);
    var currentValue = parseInt(quantityInput.value);
    var newValue = currentValue + change;
    if (newValue < 1) return; // Kiểm tra giá trị mới không nhỏ hơn 1
    
   
    // Gửi yêu cầu Ajax để cập nhật giỏ hàng
    var formData = new FormData();
    formData.append('productSizeId', productsizeId);
    formData.append('quantity', newValue);
    console.log('productSizeId:', formData.get('productSizeId'));  // Should log the value of productSizeId
console.log('quantity:', formData.get('quantity'));  
    fetch('/shop/updateCart', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Cập nhật giỏ hàng thành công
            quantityInput.value = newValue; // Cập nhật giá trị số lượng mới

            window.location.href = '/shop/cart';
        } else {
            console.error('Cập nhật giỏ hàng không thành công:', data.message);
        }
    })
    .catch(error => {
        console.error('Lỗi khi cập nhật giỏ hàng:', error);
    });
}
//
function calculateTotalAmount() {
    var totalAmount = 0;
    var totalPriceElements = document.querySelectorAll('.total-price'); // Lấy tất cả các phần tử trong cột thành tiền

    totalPriceElements.forEach(function(element) {
        var priceText = element.textContent.trim(); // Lấy văn bản từ phần tử
        var price = parseFloat(priceText.replace(/\./g, '').replace('đ', '').trim()); // Loại bỏ ký tự 'đ' và dấu phẩy, chuyển đổi sang số
        totalAmount += price; // Cộng giá trị vào tổng tiền
    });

    return totalAmount;
}

// Hàm để tính tổng giá trị của các sản phẩm trong giỏ hàng
function calculateTotalAmount() {
    var totalPriceElements = document.querySelectorAll('.total-price'); // Chọn tất cả các phần tử có class 'total-price'
    var totalAmount = 0;

    // Lặp qua từng phần tử và cộng thêm giá trị của nó vào tổng
    totalPriceElements.forEach(function(element) {
        var priceText = element.textContent.trim().replace('đ', '').replace('.', '').replace(',', '').replace(',', ''); // Loại bỏ kí tự 'đ', dấu phân tách hàng nghìn và dấu phân tách thập phân
        var price = parseFloat(priceText); // Chuyển đổi giá trị từ chuỗi sang số

        totalAmount += price;


    });

    return totalAmount;
} 
// Hàm để hiển thị tổng giá trị
function displayTotalAmount(totalAmount) {
    var totalAmountElement = document.getElementById('totalAmount');
    if (totalAmountElement) { // Check if the element exists
        totalAmountElement.textContent = 'Tổng tiền: ' + formatCurrency(totalAmount);
    } else {
        console.error('The element #totalAmount was not found.');
    }
}

// Hàm để định dạng số tiền thành chuỗi có dấu phân tách hàng nghìn
function formatCurrency(amount) {
    return amount.toLocaleString('vi-VN', { style: 'currency', currency: 'VND' }); // Định dạng số tiền theo chuẩn của ngôn ngữ địa phương
}

// Tính tổng giá trị và hiển thị khi trang được tải
window.onload = function() {
    var totalAmount = calculateTotalAmount();
    displayTotalAmount(totalAmount);
};
</script>
@endsection