@extends('layouts.app')

@section('styles')
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> --}}
<link href="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')
<div class="container mt-5 mb-5">
	<div class="content">
		<h1 class="display-2">Request a Digital Vacation Guide</h1>

		<div class="fr-view">
			<p>
				{{ $market->brand->name }} is a free publication and inspiring planning tool for your next trip to {{ $market->name }}. The Vacation Guide features an overview of Surf City USA's beaches, dining options, local attractions and activities, including surfing (of course!), Huntington Beach hotels, popular events, shopping and a map of Huntington Beach.
			</p>

			<p>Sunny Day Guide is the best resource for planning what to do on your vacation to the Outer Banks. Our free guide download features interesting articles about the OBX, vivid local photography, easy-to-use maps, and free money-saving coupons. Discover fun things to do on the Outer Banks, must-see area attractions, the area’s best restaurants, where to shop for souvenirs, exciting nightlife, and fun events for the whole family!</p>
			<p>While you are visiting, be sure to pick up a free printed copy of our guide. You can find us in tourist information centers, hotels, restaurants, shopping centers and convenience stores, other area attractions, and in one of our many colorful outdoor racks throughout the area. Ask for Sunny Day Guide by name!</p>

			<p>If you are holding an event in {{ $market->name }} and would like multiple publications for your attendees, please <a href="#"><strong>contact us</strong></a> directly.</p>
		</div>

	</div>
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h3 class="text-primary">Fill out this form to get a digital copy of {{ $market->brand->name }} and start planning your dream vacation to {{ $market->name }} today!</h3>
			<p>* Indicates a required field</p>
			<form method="POST" action="{{ route('leads.store', $market->slug) }}">
				@csrf
				<fieldset>
					<legend>Your Information</legend>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="first_name">First Name*</label>
							<input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required >
						</div>
						<div class="form-group col-md-6">
							<label for="last_name">Last Name*</label>
							<input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="email">Email*</label>
							<input type="email" class="form-control" id="email" placeholder="Email" name="email" required >
						</div>
						<div class="form-group col-md-4">
							<label for="postal_code">Zip/Postal Code</label>
							<input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ old('postal_code') }}">
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Trip Information</legend>
					<div class="form-row">
						<div class="form-group col-6 col-md-3">
							<label for="visit_date">Visit Date</label>
							<div class="input-group date">
								<input type="text" class="form-control" id="visit_date" name="visit_date">
								<div class="input-group-append">
									<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
								</div>
							</div>
						</div>
						<div class="form-group col-6 col-md-3">
							<label for="visit_length">Visit Length</label>
							<select id="visit_length" class="form-control" name="visit_length">
								<option selected value="">Choose...</option>
								<option>1-3 days</option>
								<option>4-7 days</option>
								<option>8-14 days</option>
								<option>More than 14 days</option>
							</select>
						</div>
						<div class="form-group col-6 col-md-3">
							<label for="num_adults">Number of Adults</label>
							<select id="num_adults" class="form-control" name="num_adults">
								<option selected value="">Choose...</option>
								<option>1-4</option>
								<option>5-10</option>
								<option>11-14</option>
								<option>15+</option>
							</select>
						</div>
						<div class="form-group col-6 col-md-3">
							<label for="num_children">Number of Children</label>
							<select id="num_children" class="form-control" name="num_children">
								<option selected value="">Choose...</option>
								<option>None</option>
								<option>1-4</option>
								<option>5-10</option>
								<option>11-14</option>
								<option>15+</option>
							</select>
						</div>
					</div>
					<div>
						<h5>Interests</h5>
						<div class="form-row">
							<div class="form-group col-6">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="accommodations" id="interests1" name="interests[]">
									<label class="form-check-label" for="interests1">
										Accommodations
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="arts" id="interests2" name="interests[]">
									<label class="form-check-label" for="interests2">
										Arts & Culture
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="food" id="interests3" name="interests[]">
									<label class="form-check-label" for="interests3">
										Food & Drink
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="sightseeing" id="interests4" name="interests[]">
									<label class="form-check-label" for="interests4">
										Sightseeing / Tours
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="sports" id="interest5" name="interests[]">
									<label class="form-check-label" for="interests5">
										Sports / Outdoor
									</label>
								</div>
							</div>
							<div class="form-group col-6">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="shopping" id="interests6" name="interests[]">
									<label class="form-check-label" for="interests6">
										Shopping
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="family" id="interests7" name="interests[]">
									<label class="form-check-label" for="interests7">
										Family Activities
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="nightlife" id="interests8" name="interests[]">
									<label class="form-check-label" for="interests8">
										Nightlife / Entertainment
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="specials" id="interests9" name="interests[]">
									<label class="form-check-label" for="interests9">
										Specials & Offers
									</label>
								</div>
								<div class="form-check">
									<input class="form-check-input" type="checkbox" value="groups" id="interests10" name="interests[]">
									<label class="form-check-label" for="interests10">
										Group Travel
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="interests11">Other Interests</label>
							<input type="text" class="form-control" id="interests11" name="interests[other]">
						</div>
					</div>

				</fieldset>
				<fieldset>
					<legend>Special Offers & Services from our Partners</legend>
					<div class="form-group">

						<div class="custom-control custom-radio">
							<input type="radio" id="freemail_consent1" name="freemail_consent" class="custom-control-input" value="1" required>
							<label class="custom-control-label" for="freemail_consent1">Yes! I&rsquo;d like to hear about special offers and services from {{ $market->brand->name }}&rsquo;s partners.</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="freemail_consent2" name="freemail_consent" class="custom-control-input" value="0">
							<label class="custom-control-label" for="freemail_consent2">No, thank you. I&rsquo;d rather not find out about their special offers and services.</label>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>{{ $market->brand->name }} Newsletter</legend>
					<div class="form-group">

						<p>We&rsquo;d love to send you exclusive deals and the latest info about {{ $market->name }}. We&rsquo;ll always treat your personal information with care and won't add you to any lists you didn&rsquo;t request. You can, of course, unsubscribe at any time.</p>
						<div class="custom-control custom-radio">
							<input type="radio" id="sdg_consent1" name="sdg_consent" class="custom-control-input" value="1" required>
							<label class="custom-control-label" for="sdg_consent1">Yes! Please subscribe me to {{ $market->brand->name }}&rsquo;s newsletter.</label>
						</div>
						<div class="custom-control custom-radio">
							<input type="radio" id="sdg_consent2" name="sdg_consent" class="custom-control-input" value="0">
							<label class="custom-control-label" for="sdg_consent2">No, thank you. I&rsquo;d rather not subscribe right now.</label>
						</div>
					</div>
				</fieldset>
				<div class="form-group my-4">
					<div class="alert alert-editorial" role="alert">
						Your information will be only used to provide you with the information that you have requested. By using this website and submitting this form, you agree to our <a href="#" class="alert-link">Privacy and Cookie Policy</a>.
						<div class="form-check pt-3">
							<input type="hidden" name="cookie_consent" value="0" />
							<input class="form-check-input" type="checkbox" name="cookie_consent" value="1" required>
							<label class="form-check-label" for="cookie_consent">
								I agree to these terms and conditions.*
							</label>
						</div>
					</div>
				</div>
				<button type="submit" class="btn btn-editorial btn-lg btn-block text-uppercase">Get Your Guide!</button>
			</form>

			@include ('partials._messages')

		</div>
	</div>
</div>


@endsection

@section('scripts')
<script src="{{ asset('vendor/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
	$('#visit_date').datepicker({
		autoclose: true,
		todayBtn: "linked",
		orientation: "auto"
	});  
</script> 
@endsection