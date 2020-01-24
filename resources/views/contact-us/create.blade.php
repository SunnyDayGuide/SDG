<div class="container mt-5 mb-5">
	<div class="content">
		<h1 class="display-2">Contact Us</h1>

		<div class="fr-view">
			<p>Pig pork enim, shoulder duis sint voluptate sirloin. Beef ribs venison spare ribs, nulla eu drumstick hamburger. Ex burgdoggen sunt swine, filet mignon do porchetta mollit doner aute tongue deserunt turducken rump occaecat. Pancetta chuck picanha enim esse cupidatat kevin elit. Officia landjaeger ham hock strip steak do. Laboris exercitation proident commodo eu buffalo. Sunt velit eiusmod short loin excepteur filet mignon beef ribs ball tip adipisicing t-bone corned beef drumstick sed.</p>
		</div>

	</div>
	<div class="row">
		<div class="col-md-8 offset-md-2">
			<h3 class="text-primary">Fill out this form to contact us.</h3>

			<p>* Indicates a required field</p>

			<form method="POST" action="{{ route('contacts.store') }}">
				@csrf
				<fieldset>
					<legend>Your Information</legend>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="first_name">First Name*</label>
							<input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" value="{{ old('first_name') }}" required>
						</div>
						<div class="form-group col-md-6">
							<label for="last_name">Last Name*</label>
							<input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" value="{{ old('last_name') }}" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-md-8">
							<label for="email">Email*</label>
							<input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ old('email') }}" required>
						</div>
						<div class="form-group">
							<select class="form-control" name="market">
								<option value="">Area of Interest</option>
								@foreach($markets as $market)
								<option value="{{ $market->id }}">{{ $market->name }}</option>
								@endforeach
							</select>
						</div>
						<div class="form-group">
							<select class="form-control" name="contact_type">
								<option value="">Department</option>
								<option value="advertising">Advertising</option>
								<option value="distribution">Distribution</option>
								<option value="other">Something Else</option>
							</select>
						</div>
						<div class="form-group col-md-4">
							<label for="comment">Your Comment*</label>
							<textarea class="form-control" id="comment" name="comment" rows="5" value="{{ old('comment') }}" required></textarea>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<legend>Sunny Day Guide Newsletter</legend>
					<div class="form-group">
						<p>We&rsquo;d love to send you exclusive deals and the latest info about Sunny Day Guide. We&rsquo;ll always treat your personal information with care and won't add you to any lists you didn&rsquo;t request. You can, of course, unsubscribe at any time.</p>
						<div class="custom-control custom-radio">
							<input type="radio" id="sdg_consent1" name="sdg_consent" class="custom-control-input" value="1" required>
							<label class="custom-control-label" for="sdg_consent1">Yes! Please subscribe me to Sunny Day Guide&rsquo;s newsletter.</label>
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
				<button type="submit" class="btn btn-editorial btn-lg btn-block text-uppercase">{{ $buttonText ?? 'Submit' }}</button>
			</form>

			@include ('partials._messages')

		</div>
	</div>
</div>