
<!DOCTYPE html>
<html lang="vi">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- ICONSCOUNT -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
        <!-- BOX ICONS CSS -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

        <link rel="stylesheet" href="./site.css">

        <!-- BOOTSTRAP CSS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>PET STORE</title>
    </head>
    <body class="bg-light">
        
    </body>
</html><!DOCTYPE html>
<html>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- ICONSCOUNT -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

        <link rel="stylesheet" href="./site_sign.css">

        <!-- BOOTSTRAP CSS-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>PASSWORD MESSAGE</title>
        <style>
            /* -- GOOGLE FONTS -- */
            @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,900;1,300;1,700;1,900&display=swap');
            *{
                font-family: 'Roboto', sans-serif;
            }
            /* -- SIGN IN -- */
            .form_notify {
                display: flex;
                justify-content: center;
                align-content: center;
                margin-top: 5%;
            }
            .form_notify  form{ 
                background-color: #fff;
                width: 36%;
                border-radius: 18px;
                padding: 3% 8%;
                margin-left: 22%;
            }
            .form_notify  form table, th, td{
                width: 500px;
                width: 100%;
            }
            .form_notify form table td h1 {
                padding-top: 5%;
            }
            .form_notify form table td h2{
                padding: 0 0 6% 4%;
                font-size: 40px;
                font-weight: 700;
            }
            .form_notify  form table th {
                width: 20%;
            }
            .form_notify  form table th,
            .form_notify  form table td {
                padding: 2% 0;
            }
            .form_notify  form table td {
                width: 100%;
            }
            .form_notify  form table td input {
                width: 100%;
            }
            .form_notify  form table th i {
                font-size: 30px;
                text-align: center;
            }
            .form_notify  form table .ctorder {
                background:#91d2bd;
                width: 100%;
                border-radius: 10px;
                text-align: center;
            }
            .form_notify  form table .ctorder a {
                text-decoration: none;
                color: #000;
                font-weight: 500;
            }

            @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,900;1,300;1,700;1,900&display=swap');
            *{
                font-family: 'Roboto', sans-serif;
            }
            /* -- SIGN IN -- */
            .form_notify {
                display: flex;
                justify-content: center;
                align-content: center;
                margin-top: 10%;
            }
            .form_notify  form{
                background-color: #fff;
                width: 50%;
                border-radius: 18px;
                padding: 1% 4%;
            }
            .form_notify  form table, th, td{
                width: 500px;
                width: 100%;
            }
            .form_notify  form table th,
            .form_notify  form table td {
                padding: 2% 0;
            }
            .form_notify  form table td {
                width: 50%;
            }
            .form_notify  form table tr {
                margin:0;
                padding:0;
            }
            
        </style>
    </head>
    <body style="background-color: #91d2bd;">
        <div class="form_notify">
            <form style="background-color: #fff; border: 0;">
                <table>
                    <tr>
                        <th colspan="3">
                            <h4>Cảm ơn bạn đã đặt hàng!</h4>
                          
                        </th>
                    </tr>
                    <tr>
                        <td colspan="3">
                            Xin chào {{$data['customer_name']}} Chúng tôi đã nhận được đơn đặt hàng từ bạn và đã sẵn sàng vận chuyển. Chúng tôi sẽ thông báo cho bạn khi đơn hàng được gửi đi.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="ctorder">
                            <a href="{{route('home')}}">Đến với của hàng chúng tôi </a>
                        </td>
                    </tr>
                    <tr class="new">
                        <th colspan="3">
                            <h4>Thông tin đơn hàng</h5>
                        </th>
                    </tr>
                    <tr>
                        <td style="width: 20%;">
                           Ảnh sản phẩm 
                        </td>
                        <td >Tên sản phẩm </td>
                        <td>
                           Volume
                        </td>
                        <td>
                           Đơn giá 
                        </td>
                        <td>
                            Số lượng
                        </td>
                        <td>
                            Thành tiền
                        </td>
                    </tr>
                    @foreach($new_data as $key => $item)
                    <tr>
                        <td style="width: 30%;">
                            <img src="public/uploads/{{$item['image']}}" style="width: 20%; border-radius: 5px;">

                        </td>
                        <td style="padding-left: 2%">{{$item['product_name']}}</td>
                        <td style="padding-left: 2%" >
                            {{$item['volume']}}
                        </td>
                        <td>
                            {{number_format($item['price'])}}.đ
                        </td>
                        <td>
                            {{$item['quantity']}} 
                        </td>
                        <td>
                          {{number_format($item['total'])}}.đ
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <hr>
                        </td>
                    </tr>
                    @endforeach

                    <tr>
                        <td colspan="3" style="padding-left:16%">
                            <table>
                                <tr>
                                    <td>
                                        <small>Tổng giá trị sản phẩm</small>
                                    </td>
                                    <td colspan="2">{{number_format($data['total'])}}.đ </td>
                                </tr>
                                <tr>
                                    <td>
                                        <small>Khuyến mãi</small>
                                    </td>
                                    <td colspan="2">0đ</td>
                                </tr>
                                <tr>
                                    <td>
                                        <small>Phí vận chuyển</small>
                                    </td>
                                    <td colspan="2">{{number_format($data['ship'])}}.đ  </td>
                                </tr>
                                <tr>
                                    <td colspan="3"><hr></td>
                                </tr>
                                <tr>
                                    <td>
                                        <small>Tổng cộng</small>
                                    </td>
                                    <td>{{number_format($data['total_bill'])}}</td>
                                    <td>VND</td>
                                </td>
                            </table>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="form_notify">
            <form style="background-color: #fff; border: 0;">
                <table>
                    <tr>
                        <th colspan="2">
                            <h4>Thông tin khách hàng</h4>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <h5>Địa chỉ giao hàng</h5>
                        </td>
                        <td>
                            <h5>Địa chỉ thanh toán</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small>{{$data['customer_name']}}</small>
                        </td>
                        <td>
                            <small>{{$data['customer_name']}}</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small>{{$data['address']}}</small>
                        </td>
                        <td>
                            <small>{{$data['address']}}</small>
                        </td>
                    </tr> 
                    <tr>
                        <td>
                            <h5>Phương thức vận chuyển</h5>
                        </td>
                        <td>
                            <h5>Phương thức thanh toán</h5>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <small>30,000đ</small>
                        </td>
                        <td>
                            <small>Thanh toán khi giao hàng (COD)</small>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>
