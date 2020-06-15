@extends('layouts.app')

@section('content')
	
	<p>Hallo, {{ Auth::user()->name }}</p>

	<a href="route('logout')">Logout</a>

@endsection