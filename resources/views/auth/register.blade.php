@extends('layouts.app')
@section('content')
<style>

strong{
    font-size: small;
    color: red;
    margin-top:-10px;
}
</style>
<section class="form animated flipInX" >
    <h2>CREATE AN ACCOUNT</h2>
    <form method="POST" action="{{ route('register') }}" autocomplete="off">
        @csrf
        <input type="hidden" name="role"  value="isWorker"/>
      <input placeholder="First Name" type="text"  value="{{ old('name') }}" autocomplete="off" name="name" id="name"/>
      @error('name')
                                   
                                        <strong>{{ $message }}</strong>
                                
                                @enderror

                                <input placeholder="Surname" type="text"  value="{{ old('surname') }}" autocomplete="off" name="surname" id="surname"/>
      @error('surname')
                                   
                                        <strong>{{ $message }}</strong>
                                
                                @enderror
      <input placeholder="Email" type="email"  value="{{ old('email') }}"  autocomplete="off" name="email" id="email"/>
      
      @error('email')
     
          <strong>{{ $message }}</strong>
     
  @enderror
  
   
     
    
     
 
      <input placeholder="Password" autocomplete="off" name="password" type="password" id="password"/>
      @error('password')
     
          <strong>{{ $message }}</strong>
     
  @enderror
      <input placeholder="Confirm Password" autocomplete="off" name="password_confirmation" type="password" id="confirm_password"/>
  <button id="submit">SIGN UP </button>
  <div class="container-wrapper">
  <p class="text-center"> <h2> <a href="{{route('login')}}">LOGIN </a></h2></p>
  </div>

  </form>
  </section>
@endsection

