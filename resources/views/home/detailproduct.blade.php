@extends('home.layout.main')

@section('content')
<style>
    .size-btn.selected {
    background-color: black;
    color: white; 
}
#price-container {
    font-size: 16px; /* Thay đổi kích cỡ chữ tùy theo nhu cầu */
    color: black; /* Màu chữ mặc định */
}
</style>
<div class="detail">
    <div class="detail_image center">
    <img src="../public/uploads/{{$product->image}}"  />
    </div>
    <div class="detail_product">
    <form action="#" method="POST">
    <h1>{{ $product->product_name }}</h1>

    <div id="price-container">
    <span id="product-price">{{ number_format($product->price) }}đ</span>

    <!-- Giá của sản phẩm sẽ được cập nhật ở đây -->
    </div>
    <div style ="margin:2% 0 " >
    @foreach ($size as $key => $item)

        <button  class="size-btn {{ $key === 0 ? 'selected' : '' }}" data-size="{{ $item->size_id }}" data-productsize="{{ $product->productsize_id }}" data-product="{{ $product->product_id }}">{{ $item->volume }}</button>

    @endforeach
    </div>
    <input type="hidden" name="productsize_id" id="productsize_id"> <!-- Trường ẩn để lưu trữ productsize_id -->

    <div style ="display:flex ; gap: 2%">

    <div style="display: flex; align-items: center;">
        <button type="button" onclick="decreaseValue()">-</button>
        <input type="number" id="quantity" name="quantity" style="width: 50px; text-align: center;" min="1" value="1">
        <button type="button" onclick="increaseValue()">+</button>
    </div>
    </div>
    
        <div class="promotion">
            <p>Promotion</p>
            <ul>
                <li>Thu cũ Đổi mới: Giảm đến 2 triệu</li>
                <li>Hoàn tiền nếu ở đâu rẻ hơn</li>
                <li>Nhập mã SALET12 giảm ngay 1% tối đa 100.000đ khi thanh toán qua MOMO</li>
                <li>Nhập mã VNPAYTGDD giảm từ 50,000đ đến 200,</li>
            </ul>
        </div>
        <div class="add_buy">
            @if (Auth::check())
            <a class="center">
                <button type="submit" name="submit"  id="add-to-cart-btn" >
                    ADD TO CART
                </button>
            </a>
            @endif

        </div>
         @csrf
    </form>
    </div>
</div>

<script>
     // Lắng nghe sự kiện click trên các nút dung tích
     document.querySelectorAll('.size-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Loại bỏ lớp 'selected' từ tất cả các nút dung tích
            document.querySelectorAll('.size-btn').forEach(btn => {
                btn.classList.remove('selected');
            });

            // Thêm lớp 'selected' cho nút được nhấp
            this.classList.add('selected');
        });
    });
    // Lắng nghe sự kiện click trên các nút dung tích
    function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

// Sử dụng hàm number_format để định dạng giá sản phẩm
document.querySelectorAll('.size-btn').forEach(button => {
    button.addEventListener('click', function() {
        event.preventDefault();
        
        var productId = this.getAttribute('data-product');
        var sizeId = this.getAttribute('data-size');
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        console.log(productId,sizeId)

        // Gửi yêu cầu AJAX để lấy giá từ máy chủ
        fetch('/shop/detail-product/' + productId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                productId: productId,
                sizeId: sizeId
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.price) {
                var formattedPrice = new Intl.NumberFormat('vi-VN').format(data.price);
                document.getElementById('price-container').innerHTML = `<span id="product-price">${formattedPrice}đ</span>`;
            }
            if (data.productsize_id) {
                document.getElementById('productsize_id').value = data.productsize_id;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
//
document.querySelectorAll('.size-btn').forEach(button => {
    button.addEventListener('click', function() {
        event.preventDefault();
        
        var productId = this.getAttribute('data-product');
        var sizeId = this.getAttribute('data-size');
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // Gửi yêu cầu AJAX để lấy giá từ máy chủ
        fetch('/shop/detail-product/' + productId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                productId: productId,
                sizeId: sizeId
            })
        })
        .then(response => response.json())
        .then(data => {
            var formattedPrice = '{{ number_format($product->price) }}đ'; // Định dạng giá sản phẩm
            document.getElementById('productsize_id').value = data.productsize_id;
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
//dung tich mac dinh
document.addEventListener("DOMContentLoaded", function() {
    var defaultSizeBtn = document.querySelector('.size-btn.selected');
    if (!defaultSizeBtn) {
        defaultSizeBtn = document.querySelector('.size-btn');
        defaultSizeBtn.classList.add('selected');
    }
    var defaultProductSizeId = defaultSizeBtn.getAttribute('data-productsize');
    var defaultPrice = '{{number_format($product->price)}}đ';
    
    document.getElementById('productsize_id').value = defaultProductSizeId;
    var priceContainer = document.getElementById('price-container');
    priceContainer.innerHTML = ' <span id="product-price">' + defaultPrice + '</span>';
    priceContainer.style.fontSize = '16px'; // Cập nhật kích cỡ chữ
    priceContainer.style.color = 'black'; // Cập nhật màu chữ
});
//cart 
document.getElementById('add-to-cart-btn').addEventListener('click', function(event) {
    event.preventDefault();

    var productSizeId = document.getElementById('productsize_id').value;
    var quantity = document.getElementById('quantity').value;
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    console.log(productSizeId,quantity);
    fetch('/shop/postCart', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({
            productSizeId: productSizeId,
            quantity: quantity
        })
    })
    .then(response => {
        // Xử lý phản hồi từ controller (nếu cần)
        window.location.href = '/shop/cart';
    })
    .catch(error => {
        console.error('Error:', error);
    });
});

function increaseValue() {
        var value = parseInt(document.getElementById('quantity').value, 10);
        value = isNaN(value) ? 1 : value;
        value++;
        document.getElementById('quantity').value = value;
    }

    function decreaseValue() {
        var value = parseInt(document.getElementById('quantity').value, 10);
        value = isNaN(value) ? 1 : value;
        value = value <= 1 ? 1 : value - 1;
        document.getElementById('quantity').value = value;
    }
</script>

@endsection
