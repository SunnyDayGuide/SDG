<template>
	<div>
		<a 
		class="" 
		@click="$modal.show('contact-us-modal')"
		>
		Contact Us
	</a>

	<modal 
	name="contact-us-modal"
	height="auto"
	width="100%"
	:pivotY="1"
	classes="bg-white rounded-0 shadow-inner"
	>
	<div class="container py-4 mx-auto">
		<h1 class="text-center">Have a Question?</h1>
		<form 
			autocomplete="off" 
			class="col-md-8 offset-md-2 p-4 mx-auto" 
			@submit.prevent="contactUs" 
			@keydown="submitted = false"
		>

			<input type="hidden" name="_token" :value="csrf">

			<fieldset>
				<div class="form-row">
					<div class="form-group col-md-6">
						<input 
							type="text" 
							class="form-control" 
							id="first_name" 
							placeholder="First Name*" 
							v-model="message.first_name" 
							@keydown="delete errors.first_name" 
							required>

						<span 
							class="small text-highlight pt-2" 
							v-text="errors.first_name[0]" 
							v-if="errors.first_name"
						></span>
					</div>

					<div class="form-group col-md-6">
						<input 
							type="text" 
							class="form-control" 
							id="last_name" 
							placeholder="Last Name*"  
							v-model="message.last_name" 
							@keydown="delete errors.last_name" 
							required>

						<span 
							class="small text-highlight pt-2" 
							v-text="errors.last_name[0]" 
							v-if="errors.last_name"
						></span>
					</div>
				</div>

				<div class="form-group">
					<input 
						type="email" 
						class="form-control" 
						id="email" 
						placeholder="Email*"  
						v-model="message.email" 
						@keydown="delete errors.email" 
						required>

					<span 
						class="small text-highlight pt-2" 
						v-text="errors.email[0]" 
						v-if="errors.email"
					></span>
				</div>

				<div class="form-group">
					<select class="form-control" v-model="message.market">
						<option disabled value="">Destination of Interest</option>
						<option value="1">Branson, MO</option>
						<option value="2">Myrtle Beach, SC</option>
						<option value="3">Hatteras-Ocracoke, NC</option>
						<option value="4">Outer Banks, NC</option>
						<option value="5">Ocean City, MD</option>
						<option value="6">Delaware Beaches</option>
						<option value="7">Sarasota-Bradenton, FL</option>
						<option value="8">Sanibel-Captiva &amp; Fort Myers Beach, FL</option>
						<option value="9">Virginia Beach, VA</option>
						<option value="10">Smoky Mountains, TN</option>
						<option value="11">Williamsburg, VA</option>
					</select>
				</div>

				<div class="form-group">
					<select class="form-control" v-model="message.department">
						<option disabled value="">Department</option>
						<option value="advertising">Advertising</option>
						<option value="distribution">Distribution</option>
						<option value="other">Something Else</option>
					</select>
				</div>

				<div class="form-group">
					<label for="comment">Your Comment*</label>
					<textarea 
						class="form-control" 
						id="comment" 
						v-model="message.comment" 
						@keydown="delete errors.comment" 
						rows="5" 
						required
					></textarea>

					<span 
						class="small text-highlight pt-2" 
						v-text="errors.comment[0]" 
						v-if="errors.comment"
					></span>
				</div>

			</fieldset>

			<fieldset>
				<div class="form-group">
					<p>We&rsquo;d love to send you exclusive deals and the latest info about Sunny Day Guide. We&rsquo;ll always treat your personal information with care and won't add you to any lists you didn&rsquo;t request. You can, of course, unsubscribe at any time.</p>
					<div class="custom-control custom-radio">
						<input type="radio" id="sdg_consent1" class="custom-control-input" value="1" v-model="message.sdg_consent">
						<label class="custom-control-label" for="sdg_consent1">Yes! Please subscribe me to Sunny Day Guide&rsquo;s newsletter.</label>
					</div>
					<div class="custom-control custom-radio">
						<input type="radio" id="sdg_consent2" class="custom-control-input" value="0" v-model="message.sdg_consent" >
						<label class="custom-control-label" for="sdg_consent2">No, thank you. I&rsquo;d rather not subscribe right now.</label>
					</div>
				</div>
			</fieldset>

			<div class="form-group my-4">
				<div class="alert alert-editorial" role="alert">
					Your information will be only used to provide you with the information that you have requested. By using this website and submitting this form, you agree to our <a href="privacy-policy" class="text-reset alert-link">Privacy and Cookie Policy</a>.
					<div class="form-check pt-3">
						<input type="hidden" name="cookie_consent" value="0" />
						<input class="form-check-input" type="checkbox" v-model="message.cookie_consent">
						<label class="form-check-label" for="cookie_consent">
							I agree to these terms and conditions.*
						</label>

						<span class="small text-highlight pt-2" v-text="errors.cookie_consent[0]" v-if="errors.cookie_consent"></span>

					</div>
				</div>
			</div>
			<div class="form-group">
				<input 
					type="text" 
					class="form-control" 
					id="verification" 
					placeholder="What is 1 + 4?" 
					v-model="message.verification" 
					@keydown="delete errors.verification" 
					required>

				<span 
					class="small text-highlight pt-2" 
					v-text="errors.verification[0]" 
					v-if="errors.verification"
				></span>

			</div>

			<div class="form-group d-flex justify-content-end contact-form-buttons mt-4">
				<a 
					class="btn btn-outline-highlight btn-lg text-uppercase mr-3" 
					@click="$modal.hide('contact-us-modal')"
				>
					Cancel
				</a>
				<button type="submit" class="btn btn-highlight btn-lg text-uppercase" :disabled="submitted">Send</button>
			</div>
			
		</form>
	</div>
</modal>
</div>
</template>

<script>
export default {
	data() {
		return {
			csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),

			message: {
				market: '',
				department: '',
			},
			errors: {},
			submitted: false
		};
	},

	methods: {
		contactUs() {
			this.submitted = true;

			axios
				.post('/contact', this.message)
				.then(() => {
					this.$modal.hide('contact-us-modal');

					swal('Thanks for your input!', 'We will be in touch soon.', 'success');
				})
				.catch(errors => {
					this.errors = errors.response.data.errors;
				});
		}
	}
};
</script>