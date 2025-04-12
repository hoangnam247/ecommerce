@extends('admin.layout.main')

@section('content')
<div class="invoice">
    <div class="page_header between">
        <p class="title">INVOICE</p>
        @if (session('msg'))
    <div class="alert alert-success">
        {{ session('msg') }}
    </div>
@endif
        <form class="d-flex" role="search">
            
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keywords" value="{{request()->keywords}}">
            
            <button class="btn btn-outline-success" type="submit"><i class='bx bx-search'></i></button>
            <div  >
                    <select name = "status"  style = "height: 100%;padding: 1% 5%;border-radius: 10px;"  >
                        <option value="0">Tất cả trạng thái</option> 
                        <option value="waiting" {{request()->status=='waiting'?'selected':false}}>Đang chờ</option>
                        <option value="active" {{request()->status=='active'?'selected':false}}>Đang giao</option>
                        <option value="inactive" {{request()->status=='inactive'?'selected':false}}>Từ chối</option>
                        <option value="confirm" {{request()->status=='confirm'?'selected':false}}>Hoàn Thành</option>
                        <option value="cancel" {{request()->status=='cancel'?'selected':false}}>CanCel</option>
                    </select>
                </div>
        </form>
    </div>
    <div class="product_list">
    <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">ID</th>
                            <th scope="col">STAFF</th>
                            <th scope="col">CUSTOMER</th>
                            <th scope="col">STATE</th>
                            <th scope="col">CREATED_AT</th>
                            <th scope="col">UPDATED_AT</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">ADDRESS</th>
                            <th scope="col">PHONE</th>
                            <th scope="col">TOTAL</th>
                            <th scope="col">SHIP</th>
                            <th scope="col">TOTAL_BILL</th>
                            <th scope="col">DETAIL</th>
                            <th scope="col">APPROVE</th>
                            <th scope="col">CONFIRM</th>
                            <th scope="col">CANCEL</th>
                        </tr>
                    </thead>
                    <tbody>
            @foreach ($invoiceList as $key => $item)
                    <tr>            
                    <td>{{$key+1}}</td>
                    <th>{{$item->invoice_id}}</th>  
                    <th>{{$item->staff_name}} </th>
                    <th>{{$item->customer_name}} </th> 
                    <td>
                        @switch($item->invoice_status)
                            @case(0)
                                Đang chờ
                                @break
                            @case(1)
                                Đang giao
                                @break
                            @case(2)
                                Từ chối
                                @break
                            @case(3)
                                Hoàn Thành
                                @break
                            @case(4)
                                Bị Hủy
                                @break
                            @default
                                Không xác định
                        @endswitch
                    </td>
                    <td>{{$item->created_at}}</td>  
                    <td>{{$item->updated_at}}</td>
                    <td>{{$item->email}}</td>  
                    <td>{{$item->address}}</td>  
                    <td>{{$item->phone}}</td>  
                    <td>{{number_format($item->total)}}.đ</td> 
                    <td>{{number_format($item->ship)}}.đ</td> 
                    <td>{{number_format($item->total_bill)}}.đ</td> 
                    <td class="detail">
                    <a href="{{route('detailinvoice',['id'=>$item->invoice_id])}}"><i class='bx bx-comment-detail'></i></a>
                    </td>
                    <td class="detail">
                    @if( $item->invoice_status == 2 || $item->invoice_status == 3 || $item->invoice_status == 4   )
                    
                        <i class="uil uil-lock"></i>
                
                    @else
                        <a href="{{route('activeinvoice',['id'=>$item->invoice_id])}}">a</a>
                        <a href="{{route('inactiveinvoice',['id'=>$item->invoice_id])}}">b</a>
                    @endif
                    </td>
                    <td class="detail">
                    @if( $item->invoice_status == 2 || $item->invoice_status == 3 || $item->invoice_status == 4   )
                    
                    <i class="uil uil-lock"></i>
            
                    @else
                    <a href="{{route('confirminvoice',['id'=>$item->invoice_id])}}">c</a>
                    @endif
                   
                    </td>
                    <td class="detail">
                    @if( $item->invoice_status == 2 || $item->invoice_status == 3 || $item->invoice_status == 4    )
                    
                    <i class="uil uil-lock"></i>
            
                    @else
                    <a href="{{route('cancelinvoice',['id'=>$item->invoice_id])}}">d</a>
                    @endif
                    </td>
                @endforeach
        </tbody> 
                </table>
    </div>
    <div style = "margin-left:45% ">
{{ $invoiceList->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection