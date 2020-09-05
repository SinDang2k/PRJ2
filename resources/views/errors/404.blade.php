@extends('layouts.master')
@section('master')
<link rel="stylesheet" href="{{ asset('public/css/404.css') }}">
<div id="notfound">
	<div class="notfound">
		<div class="notfound-404">
			<h1>4<span>0</span>4</h1>
		</div>
		<p>The page you are looking for might have been removed had its name changed or is temporarily unavailable.</p>
		<a href="{{ route('dashboard') }}">home page</a>
	</div>
</div>
@endsection
