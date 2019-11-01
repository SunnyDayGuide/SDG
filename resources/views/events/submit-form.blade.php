@extends('layouts.app')

@section('styles')
<link href="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('jumbotron')
@include('partials._jumbo-slider')
@endsection

@section('content')

<div class="container my-3 my-md-5">

	<div class="content">
		<div class="page-title d-md-flex justify-content-between">
			<h1 class="display-4">Submit Your Event</h1>
		</div>

		<div class="fr-view page-body">
			<p>We maintain this Calendar of Events as a service to our users. All submitted events should be of interest to visitors, take place in or around {{ $market->name }} and be open to the public. {{ $market->brand->name }} reserves the right to edit and post events at its discretion. Prior to completing this form, please search the Calendar of Events to see if your event is already listed.</p>

			<p>If you would like to make changes to an event that is already listed on the calendar, please email the changes to <a href="mailto:sdmedia@sunnydayguide.com">sdmedia@sunnydayguide.com</a>. Make sure to include the name and date of your event in the email.</p>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-8 offset-sm-2 p-2">
			<p>* Indicates a required field</p>
			
			<form method="POST" action="{{ route('events.store', $market->slug) }}">
				@csrf

				<fieldset>
					<legend>Event Information</legend>
					<div class="form-group">
						<label for="title">Event Title*</label>
						<input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
						<div class="font-weight-bold text-danger">{{ $errors->first('title') }}</div>
					</div>
					<div class="form-row">
						<div class="form-group col-6 col-md-3">
							<label for="start_date">Start Date*</label>
							<div class="input-group date">
								<input type="text" class="form-control event_date" name="start_date" value="{{ old('start_date') }}">
								<div class="input-group-append">
									<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
								</div>
							</div>
						</div>
						<div class="form-group col-6 col-md-3">
							<label for="end_date">End Date</label>
							<div class="input-group date">
								<input type="text" class="form-control event_date" name="end_date" value="{{ old('end_date') }}">
								<div class="input-group-append">
									<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
								</div>
							</div>
						</div>
						<div class="form-group col-6 col-md-3">
							<label for="start_time">Start Time</label>
							<input type="text" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') }}">
						</div>
						<div class="form-group col-6 col-md-3">
							<label for="end_time">End Time</label>
							<input type="text" class="form-control" name="end_time" id="end_time" value="{{ old('end_time') }}">
						</div>
						<div class="font-weight-bold text-danger">{{ $errors->first('start_date') }}</div>
					</div>
					<div class="form-group">
						<label for="description">Brief Description of your Event*</label>
						<textarea class="form-control" id="description" name="description" rows="5" required value="{{ old('description') }}"></textarea>
					</div>
					<div class="form-group">
						<label for="location">Event Location*</label>
						<input type="text" class="form-control" id="location" name="location" required value="{{ old('location') }}">
					</div>
					<div class="form-group">
						<label for="phone">Phone Number</label>
						<input type="text" class="form-control" id="phone" name="phone" aria-describedby="phoneHelpBlock" value="{{ old('phone') }}">
						<small id="phoneHelpBlock" class="form-text text-muted">
							000-000-0000 -- Phone number where visitors can find out more information about your event. This will appear online.
						</small>
					</div>
					<div class="form-group">
						<label for="website_url">Website URL</label>
						<input type="url" class="form-control" id="website_url" name="website_url" value="{{ old('website_url') }}">
					</div>
					<div class="form-group">
						<label for="ticket_url">Ticket URL</label>
						<input type="url" class="form-control" id="ticket_url" name="ticket_url" value="{{ old('ticket_url') }}">
					</div>
					<div class="form-group">
						<label for="facebook_url">Facebook Page URL</label>
						<input type="url" class="form-control" id="facebook_url" name="facebook_url" value="{{ old('facebook_url') }}">
					</div>
				</fieldset>

				<fieldset>
					<legend>Contact Information</legend>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="name">Your Name*</label>
							<input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required >
						</div>
						<div class="form-group col-md-6">
							<label for="email">Email*</label>
							<input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required >
						</div>
					</div>
					<div class="form-group">
						<label for="company">Company/Organization</label>
						<input type="text" class="form-control" id="last_name" name="company" value="{{ old('company') }}">
					</div>
				</fieldset>

				<div class="form-group my-4">
					<div class="alert alert-editorial" role="alert">
						Your personal information will be only used to contact you about your event listing. By using this website and submitting this form, you agree to our <a href="#" class="alert-link">Privacy and Cookie Policy</a>.
						<div class="form-check pt-3">
							<input type="hidden" name="cookie_consent" value="0" />
							<input class="form-check-input" type="checkbox" name="cookie_consent" value="1" required>
							<label class="form-check-label" for="cookie_consent">
								I agree to these terms and conditions.*
							</label>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-editorial btn-lg btn-block text-uppercase">Submit</button>
			</form>
			
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$('.event_date').datepicker({
		autoclose: true,
		todayBtn: "linked",
		orientation: "auto"
	});  
</script> 
@endsection