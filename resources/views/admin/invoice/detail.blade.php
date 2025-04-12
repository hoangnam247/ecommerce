@extends('admin.layout.main')

@section('content')
<div class="invoice">
    <div class="page_header between">
        <p class="title">INVOICE</p>
    
    </div>
    <div class="product_list">
    <table class="table table-striped" >
        <thead>
            <tr>
            <th scope="col">PRODUCT_ID</th>
            <th scope="col">Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($invoiceDetail as $key => $item)
                <tr>
                <th><a href="{{route('detail-product',['id' => $item->productsize_id])}}">{{$item->productsize_id}}</a></th>
                    <th>{{number_format($item->price)}}.đ</th>
                    <th>{{$item->quantity}}</th>
                    <th>{{number_format($item->total_product)}}.đ </th>
                </tr>
        @endforeach
        <tr>
            <th scope="col"></th>
            <th scope="col">Tổng Tiền Sản phẩm</th>
            <th></th>
            <th scope="col">{{number_format($invoiceTotal->total)}}.đ</th>
        </tr>
        <tr>

            <th scope="col"></th>
            <th scope="col">Tiền Ship</th>
            <th></th>
            <th scope="col">40.000.đ</th>
        </tr>
        <tr>
            <td></td>
            <th colspan="2">TỔNG ĐƠN HÀNG</th>
            <th colspan="2">{{number_format($invoiceTotal->total_bill)}}.đ </th>
        </tr>    
        <tr>
            <td></td>
            <th><a href="{{route('invoice')}}">Quay Lại</a></th>
        </tr>   
        </tbody>
    </table>
    </div>

</div>
@endsection