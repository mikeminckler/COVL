@extends('layout')

@section('content')


<div class="section form login">

	<h1>Login</h1>

    <form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

	<div class="input-block">
		<div class="label">Email</div>
		<div class="input">
			<input type="email" class="form-control" name="email" value="{{ old('email') }}">
		</div>
	</div>

	<div class="input-block">
		<div class="label">Password</div>
		<div class="input">
			<input type="password" class="form-control" name="password">
		</div>
	</div>
	
	<div class="input-block">
		<div class="label">&nbsp;</div>
		<div class="input">
			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember"> Remember Me
				</label>
			</div>
		</div>
	</div>

	<div class="input-block">
		<div class="label">&nbsp;</div>
		<div class="input">
			<button type="submit" class="button">Login</button>
		</div>
	</div>

    </form>

	<div class="row">
		<a class="" href="{{ url('/password/email') }}">Forgot Your Password?</a>
	</div>

</div>

@endsection
