@extends('layouts.app')

@section('content')
<section class="form animated flipInX">
<h2>LOGIN</h2>
   
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                           

                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                            </div>
                        </div>

                        <div class="form-group row">
                          
                            
                            <label class="col-md-12 col-form-label text-md-right" style="margin-top:-10px;">
              <a href="{{ route('password.request') }}">    Forgot password?</a>
</label>

                            <div class="col-md-12">
                                <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <button id="submit">LOGIN</button>
  <div class="container-wrapper">
  </div>                       
</form>
</section>
@endsection
