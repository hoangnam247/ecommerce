@extends('home.layout.main')

@section('content')
<div class="all">
<div class="slideshow">
    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./public/images/slideshow_1.png" class="d-block w-100" alt="slide1">
            </div>
            <div class="carousel-item">
                <img src="./public/images/slideshow_3.png" class="d-block w-100" alt="slide2">
            </div>
            <div class="carousel-item">
                <img src="./public/images/slideshow_4.png" class="d-block w-100" alt="slide3">
            </div>
            <div class="carousel-item">
                <img src="./public/images/slideshow_5.png" class="d-block w-100" alt="slide4">
            </div>
          
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
    <div class="main_content">
        <div class="card">
            <a href="index.php?menu=detail" class="center">
                <img class="card-img-top image" src="./public/images/prada.png" alt="airpod">
                <div class="card-body">
                    <h4>AirPods 2</h4>
                    <p>8.690.000 đ</p>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="index.php?menu=detail" class="center">
                <img class="card-img-top image" src="./public/images/gio.png" alt="airpod">
                <div class="card-body">
                    <h4>AirPods 2</h4>
                    <p>8.690.000 đ</p>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="index.php?menu=detail" class="center">
                <img class="card-img-top image" src="./public/images/valentino.png" alt="airpod">
                <div class="card-body">
                    <h4>AirPods 2</h4>
                    <p>8.690.000 đ</p>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="index.php?menu=detail" class="center">
                <img class="card-img-top image" src="./public/images/prada.png" alt="airpod">
                <div class="card-body">
                    <h4>AirPods 2</h4>
                    <p>8.690.000 đ</p>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="index.php?menu=detail" class="center">
                <img class="card-img-top image" src="./public/images/amouage.png" alt="airpod">
                <div class="card-body">
                    <h4>AirPods 2</h4>
                    <p>8.690.000 đ</p>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="index.php?menu=detail" class="center">
                <img class="card-img-top image" src="./public/images/valentino.png" alt="airpod">
                <div class="card-body">
                    <h4>AirPods 2</h4>
                    <p>8.690.000 đ</p>
                </div>
            </a>
        </div>
        <div class="card">
            <a href="index.php?menu=detail" class="center">
                <img class="card-img-top image" src="./public/images/gio.png" alt="airpod">
                <div class="card-body">
                    <h4>AirPods 2</h4>
                    <p>8.690.000 đ</p>
                </div>
            </a>
        </div>
    </div>
    <!-- <div class="pagination center">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous"  style="color: #000">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item"><a class="page-link" href="#"  style="color: #000">1</a></li>
                <li class="page-item"><a class="page-link" href="#"  style="color: #000">2</a></li>
                <li class="page-item"><a class="page-link" href="#"  style="color: #000">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next"  style="color: #000">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div> -->
</div>
@endsection