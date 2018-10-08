@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div>
            <h1>Welcome to the Dashboard, {{ Auth::user()->name }}</h1>
            <div>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in! Let's edit some stuff!
                </div>
        </div>
    </div>
</div>
@endsection
