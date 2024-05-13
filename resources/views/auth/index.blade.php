@extends('layouts.auth')
@section('content')
<section>
    <div class="container row">
        <div class="col m6 offset-m3 l6 offset-l3 xl4 offset-xl4 s10 offset-s1 card card-login z-depth-4">
            <div class="lighten-2 black-text">
                <h5 class="center flow-text">Login</h5>
            </div>
            <div class="card-content">
                <form action="{{ route('auth.authenticate') }}" method="POST">
                    <div class="input-field">
                       
                        <input type="email" name="email" id="email" class="validate" value="{{ old('email') ? : '' }}">
                        <label for="email">Email</label>
                        <span class="{{$errors->has('email') ? 'helper-text red-text' : '' }}">{{$errors->has('email') ? $errors->first('email') : '' }}</span>
                    </div>
                    <div class="input-field">
                        <input type="password" name="password" id="password">
                        <label for="password">Password</label>
                        <span class="{{$errors->has('password') ? 'helper-text red-text' : '' }}">{{$errors->has('password') ? $errors->first('password') : '' }}</span>
                    </div>
                    @csrf()
                    <p>
                        <label for="remember">
                            <input type="checkbox" id="remember" name="remember" />
                            <span>Remember Me</span>
                        </label>
                    </p>
                    
                    
                    <div class="card-action">
                        <button class="btn col s12 m12 l12 xl12 waves-effect " type="submit" name="submit">Login</button>
                    </div>
                    
                    <div class="ratt"><a href="{{route('password.request')}}">Forgot Password</a></div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection