@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Welcome to the Dashboard, {{ Auth::user()->name }}</h1>
@endsection

@section('content')
<div>
    You are logged in! Let's edit some stuff!
</div>

@endsection
