<div class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand"  href="{{route('home')}}"  style="font-weight: 600; letter-spacing: 0.125em;">STORE</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('home')}}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('collections')}}">NƯỚC HOA</a>
                    </li>

                    @if (Auth::check())
                        @if (Auth::user()->level == 3)
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('personal')}}">PERSONAL</a>
                    </li>  
                        @elseif (Auth::user()->level != 3)
                            <a class="nav-link active" aria-current="page" href="{{ route('invoice') }}">PERSONAL</a>
                        @endif
                    @endif
 
                </ul>
                <form class="d-flex" role="search">
                    
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="keywords" value="{{request()->keywords}}" >
                    <button class="btn btn-outline-success" type="submit"><i class='bx bx-search'></i></button>
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('cart')}}">
                            <i class='bx bx-cart'></i>(0)
                        </a>
                    </li>
                    <li class="nav-item">
                    @if (!(Auth::check()))
                        <a class="nav-link active" aria-current="page" href="{{route('login')}}">LOGIN</a>
                    @endif
                    @if (Auth::check())
                        @if (Auth::user()->level == 3)
                            <a class="nav-link active" aria-current="page" href="{{ route('personal') }}">{{ Auth::user()->users_name }}</a>
                        @elseif (Auth::user()->level != 3)
                            <a class="nav-link active" aria-current="page" href="{{ route('invoice') }}">{{ Auth::user()->users_name }}</a>
                        @endif
                    @endif
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>