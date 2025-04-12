@extends('admin.layout.main')

@section('content')
<div class="product">
    <div class="page_header">
        <p class="title">PRODUCT</p>
    </div>
    <div class="between">
        <div class="button_form center">
            <a href="index.php?menu=create_product">
                <button type="button">
                    CREATE
                </button>
            </a>
        </div>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit"><i class='bx bx-search'></i></button>
        </form>
    </div>
    <div class="product_list">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">CATEGORY</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">NAME</th>
                    <th scope="col">QUANTITY</th>
                    <th scope="col">PRICE</th>
                    <th scope="col">DISCOUNT</th>
                    <th scope="col">STATE</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>1</td>
                    <td  style="width: 10%;">
                        <img src='./../images/airpods-2.png' style="width: 50%" alt="airpods2" />
                    </td>
                    <td style="text-align: left;">AirPods 2</td>
                    <td>28</td>
                    <td>8.790.000</td>
                    <td>0</td>
                    <td>1</td>
                    <td><i class='bx bx-comment-detail'></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection