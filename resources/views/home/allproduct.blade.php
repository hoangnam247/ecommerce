@extends('home.layout.main')

@section('content')
<div class="rental_header center">
@if(isset($categoryList) && $categoryList->unique('category_name')->count() > 1)
    <p style="font-size: 40px; letter-spacing:0.05em;">ALL</p>
@elseif(isset($categoryList) && $categoryList->count() == 1)
    <p style="font-size: 40px; letter-spacing:0.05em;">{{ $categoryList->first()->category_name }}</p>
@else
    <p style="font-size: 40px; letter-spacing:0.05em;">No Categories</p>
@endif
    </div>
<div class="content">
<div class="sidebar" style =" width: 23%;padding: 3%;">

        @foreach ($categoryList as $key => $item)
        <div class="item">
        <a  href="{{ route('collectionsbycategory', ['id' => $item->category_id]) }}">
        <h1>{{$item->category_name}}</h1>
            <div class="separator"></div>
        </a>
        </div>     
        @endforeach

    </div>
    <div class="rental">
        
        <div class="main_content" style ="padding: 2%; display: grid; grid-template-columns: repeat(3, minmax(0, 1fr));">
        @foreach ($productList as $key => $item)
                <div class="card center">
              
                <a href="{{ route('getdetail-product', ['id' => $item->product_id]) }}" class="center">
                <img src="../public/uploads/{{$item->image}}" style="width: 70%" alt="nuoc hoa" />
                    <div class="card-body">
                        <h4>{{$item->product_name}}</h4>
                        <p>{{number_format($item->price)}}.đ</p>
                    </div>
                </a>
                </div>
             @endforeach 
            </div>
        <div style = "margin-left:45% ">
{{ $productList->links('pagination::bootstrap-4') }}
    </div>
</div>
    </div>
<style>
a {
    color: #000;
    text-decoration: none;
}

    .main .card {
    border: 0;
    padding: 3% 2%;
    width: 100%;
    }
    .main_content {
    gap: 4%;
    }
    .content {
        display: flex;
    }

    .content .sidebar {
        width: 30%;
        padding: 3%;
    }

    .content .sidebar ul li {
        font-size: 18px;
        list-style: none;
    }
    .content .sidebar {
        width: 25%;
        padding: 3% 0;
    }
    .rental {
    width: 70%;
    }

    
.item {
  font-family: Arial, sans-serif; /* Replace with the actual font-family, if known */
  color: #000000; /* Replace with the actual color code, if known */
  margin-bottom: 10px; /* Adjust as needed for spacing */
}

.item h1 {
  font-size: 16px; /* Replace with the actual font size, if known */
  margin-bottom: 4px; /* Spacing between the heading and the separator */
}

/* For the Vietnamese translation in parentheses */
.item .translation {
  font-size: 14px; /* Smaller than the main heading, adjust as needed */
  color: #666666; /* Typically a lighter shade than the main heading */
}

/* For the dotted line separator */
.item .separator {
    opacity: 0.4;
  border-bottom: 1px dotted #000000; /* Dotted line */
  padding-bottom: 5px; /* Spacing between the text and the line */
}

</style>
@endsection