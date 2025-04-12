@extends('home.layout.main')

@section('content')
<style>
    .button_form {
    display: flex;
    justify-content: center; /* Center button horizontally */
    align-items: center; /* Center button vertically */
    padding: 20px; /* Space around the button */
}

.submit {
    background-color: black; /* White background */
    color: white;
    font-size: 16px; /* Larger font size */
    padding: 10px 20px; /* Vertical and horizontal padding */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s, transform 0.3s; /* Smooth transition for background and transform */
    outline: none; /* Removes the outline */
}

.submit:hover, .submit:focus {
    background-color: #0056b3; /* Darker blue on hover/focus */
    transform: scale(1.05); /* Slightly enlarge on hover/focus */
    cursor: pointer;
}

.submit:active {
    transform: scale(0.95); /* Slightly shrink when clicked */
}
</style>
<div class="personal center">
    <div class="personal_header center">
        <p class="title">PERSONAL ACCOUNT</p>
        @if (Auth::check())
                    <p class="name">{{Auth::user()->users_name}}</p>
        @endif
        @if(session()->has('msg_pass'))
        <div class="alert alert-success">
        {{ session()->get('msg_pass') }}
    </div>
    @endif
    </div>
    <div class='line '></div>
    <div class="personal_main">
    <div class="personal_side">          
            <p><a href="{{route('personal')}}">Information</a></p>
            <p><a href="{{route('changepass')}}">Change Password</a></p>
            <p><a href="{{route('logout')}}">Logout</a></p>
        </div>
        <div class="personal_content">
        <div class="password center">
    <div class="form">

        <div class="input">
        <form action = ""  method="POST">
            <label>OLD PASSWORD</label>
            <input  type="password" placeholder="******" class="form-control"  aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="oldpassword" >
            @if(session('msg'))
                <span style="color:black " >{{session('msg')}}</span>
            @endif
        </div>
        <div class="input">
            <label>NEW PASSWORD</label>
            <input  type="password" placeholder="******" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="password">
            @error('password')
                <span style="color:red">{{$message}}</span>
            @enderror
        </div>
        <div class="button_form center">
            <button type="submit" name="submit" class="submit btn btn-primary btn-lg btn-block">Cập Nhật</button>
        </div>
        @csrf
            </form>
    </div>
</div>
        </div>
    </div>
</div>
@endsection