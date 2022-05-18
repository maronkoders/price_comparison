@extends('layouts.master')
@section('login')
	  <div id="login-page">
	  	<div class="container">
	  	
		  <form class="form-login" action="{{route('postSignup')}}" method="POST">
			{{ csrf_field() }}
                <h2 class="form-login-heading">sign up now</h2>
                @include('includes.messages')
		        <div class="login-wrap">
                    <input type="text" class="form-control" name="name" placeholder="Name" autofocus>
                    <br>
                    <input type="text" class="form-control" name="surname" placeholder="Surname" autofocus>
                    <br>
                    <input type="text" class="form-control" name="phonenumber" placeholder="Phonenumber" autofocus>
		            <br>
                    <input type="email" class="form-control" name="email" placeholder="Email" autofocus>
                    <br>
                    <input type="text" class="form-control" name="idnumber" placeholder="ID Number" autofocus>
                    <br>
                    <input type="text" class="form-control" name="address" placeholder="Physical Address" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" placeholder="Password">
                   <br>
                   <input type="password" class="form-control" name="cpassword" placeholder="Confirm Password">
		           <br>
		            <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> SIGN UP</button>
		            <hr>
		            <div class="registration">
		                Already have an account?<br/>
					<a class="" href="{{route('login')}}">
		                    Login
		                </a>
		            </div>
		
		        </div>
		      </form>	  	
	  	
	  	</div>
	  </div>
	  @endsection