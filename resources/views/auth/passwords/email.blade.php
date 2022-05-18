@extends('layouts.app')

@section('content')
@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                      @endif

                      
<section class="form animated flipInX">

<h2>GET A PASSWORD RESET LINK</h2>
               
                
                    <form method="POST" action="{{ route('password.email') }}">
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

                        <button id="submit">SEND RESET LINK</button>
                        <div class="container-wrapper">
                        <p class="text-center"> <h2> <a href="{{route('login')}}">LOGIN </a></h2></p>
                        </div>

                     
                    </form>
</section>

@endsection
