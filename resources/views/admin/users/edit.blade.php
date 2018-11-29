@extends('layouts.admin')

@section('pageHeader')
<h1 class="h2">Update User</h1>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-9">
			<form method="POST" action="{{ route('admin.users.update', $user->id) }}">
			@method('PATCH')
			{{ csrf_field() }}

				<div class="form-group">
					<label for="name">User Name:</label>
		            <input type="text" class="form-control" id="name" name="name"
		               value="{{ old('name', $user->name) }}" required>
				</div>

				<div class="form-group">
					<label for="email">Email:</label>
		            <input type="text" class="form-control" id="email" name="email"
		               value="{{ old('email', $user->email) }}" required>
				</div>

				<div class="row">
					<div class="col">
						<div class="form-group">
							<label for="department">Department(s):</label>
							@foreach($departments as $department)
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="departments[]" value="{{$department->id}}" {{ $user->departments->contains($department->id) ? 'checked' : '' }}> 
								<label class="form-check-label" for="{{ $department->id }}">
									{{ $department->name }}
								</label>
							</div>
							@endforeach
						</div>
					</div>

					<div class="col">
						<div class="form-group">
							<label for="department">Market(s):</label>
							@foreach($markets as $market)
							<div class="form-check">
								<input class="form-check-input" type="checkbox" name="markets[]" value="{{$market->id}}" {{ $user->markets->contains($market->id) ? 'checked' : '' }}> 
								<label class="form-check-label" for="{{ $market->id }}">
									{{ $market->name }}
								</label>
							</div>
							@endforeach
						</div>
					</div>
				</div>
				

				<div class="form-group">
					<button type="submit" class="btn btn-success btn-lg">Update User</button>
				</div>

			</form>

			@include ('partials._messages')

		</div>
	</div>
</div>
@endsection