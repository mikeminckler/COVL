@extends('app')

@section('content')

<div class="flex-1 flex flex-col items-center justify-center">

    <div class="">
        <div class="my-2 flex justify-center"><img src="/images/covl_logo.png" class="h-[75px]" /></div>
        <h2>Login</h2>

        <form method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}

            <div class="input-block">
                <div class="label">Email</div>
                <div class="input">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" :autofocus="'autofocus'">
                </div>
            </div>

            <div class="input-block">
                <div class="label">Password</div>
                <div class="input">
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            
            <div class="input-block">
                <div class="input text-sm text-slate-500">
                    <div class="checkbox">
                        <input id="remember" type="checkbox" name="remember"> <label for="remember">Remember Me</label>
                    </div>
                </div>
            </div>

            <div class="input-block">
                <div class="input">
                    <button type="submit" class="w-full">Login</button>
                </div>
            </div>

        </form>

        <div class="text-sm mt-4">
            <a class="" href="{{ url('/password/email') }}">Forgot Your Password?</a>
        </div>

    </div>

</div>

@endsection
