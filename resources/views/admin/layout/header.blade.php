<div class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home')}}"  style="font-weight: 600; letter-spacing: 0.125em;">STORE</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a href="{{route('staff')}}"  class="nav-link active" aria-current="page" href="index.php?menu=account">STAFF</a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{route('account')}}"  class="nav-link active" aria-current="page" href="index.php?menu=account">ACCOUNT</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('category')}}"  class="nav-link active" aria-current="page" href="index.php?menu=category">CATEGORY</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('size')}}"  class="nav-link active" aria-current="page" href="index.php?menu=invoice">SIZE</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('product')}}"  class="nav-link active" aria-current="page" href="index.php?menu=product">PRODUCT</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('customer')}}"  class="nav-link active" aria-current="page" href="index.php?menu=invoice">CUSTOMER</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('invoice')}}"  class="nav-link active" aria-current="page" href="index.php?menu=invoice">INVOICE</a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('logout')}}">LOGOUT</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>