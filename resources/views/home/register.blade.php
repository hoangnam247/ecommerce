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
<div class="register center">
    <div class="form">
    <form style="background-color: #fff; border: 0;" action = ""  method="POST">
        <p class="">REGISTER</p>
        <input type="text" placeholder="Nguyen Van A" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"name="fullname" value="{{old('fullname')}}">
            @error('fullname')
                <span style="color:red">{{$message}}</span>
            @enderror
        
        <input type="email" placeholder="nguyenvana@gmail.com" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" name="email" value = "{{old('email')}}" >
            @error('email')
                <span style="color:red">{{$message}}</span>
             @enderror
        
        <input  placeholder="******" class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm" type="password" placeholder="****" name="password" >
            @error('password')
                <span style="color:red">{{$message}}</span>
            @enderror
        
        <input   class="form-control" aria-label="Large" aria-describedby="inputGroup-sizing-sm"placeholder="Confirm password" name="password_confirmation" type="password" >
            @error('confirmpassword')
                <span style="color:red">{{$message}}</span>
            @enderror

        <div class="button_form center">

                <button type="submit" name="submit" class="submit btn btn-primary btn-lg btn-block">REGISTER</button>

           
        </div>
        <span class="transfer center">Have account? <a href="index.php?menu=login">Login</a></span>
        @csrf
            </form>
    </div>
</div>
@endsection