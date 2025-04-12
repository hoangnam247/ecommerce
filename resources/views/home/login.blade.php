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
<div class="login center">
    <div class="form">
    <form style="background-color: #fff; border: 0;" action = ""  method="POST">
        <p class="">LOGIN</p>
        @if (session('msg_login'))
    <div class="alert alert-success">
        {{ session('msg_login') }}
    </div>
    @endif
        <input type="email" style="margin: 5% 0;" placeholder="nguyenvana@gmail.com" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="email" value = "{{old('email')}}" >
        @error('email')
        <span style="color:red">{{$message}}</span>
         @enderror
        <input type="password" style="margin-top: 5%;" placeholder="******" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="password">
        <span class="transfer end"><a href="{{ route('forgot') }}">Forgot password </a></span>
        @error('password')
         <span style="color:red">{{$message}}</span>
         @enderror
         @if(session('msg'))
        <span style="color:red">{{session('msg')}}</span>
        @endif
        <div class="button_form center">

                <button type="submit" name="submit" class="submit btn btn-primary btn-lg btn-block">LOGIN</button>
                
        </div>
        @csrf
            </form>
        <span class="transfer center">Haven't account? <a  href="{{ route('register') }}">Register</a></span>
    </div>
</div>
@endsection