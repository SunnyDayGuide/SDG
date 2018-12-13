@if (session('message'))
	<div class="alert alert-success" role="alert">
		{{ session('message') }}
	</div>
@endif

@if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif