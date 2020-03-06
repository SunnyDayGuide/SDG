<template>
	<div>
		<a href="#" class="share d-flex flex-column ml-3" @click="$modal.show('bucket-list-email-modal')">
			<div class="fa-stack fa-sm">
				<i class="fas fa-circle fa-stack-2x"></i>
				<i class="fas fa-envelope fa-stack-1x fa-inverse"></i>
			</div>
			<div class="text">Email</div>
		</a>

	<modal 
		name="bucket-list-email-modal"
		height="auto"
		width="50%"
		classes="bg-white rounded-0 shadow-inner"
		>
			<div class="container p-5 mx-auto">
				<h3>jgjwgdjahgd</h3>
				<form 
				class="mx-auto mt-4" 
				@submit.prevent="sendEmail" 
				novalidate
				>
				<div class="form-group">
					<input 
						type="email" 
						class="form-control" 
						id="email" 
						placeholder="Email*"  
						v-model="email" 
						@keydown="delete errors.email" 
						required>

					<span 
						class="small text-highlight pt-2" 
						v-text="errors.email[0]" 
						v-if="errors.email"
					></span>

				</div>

				<div class="form-group my-4">
					<div class="alert alert-editorial small" role="alert">
						Your information will be only used to provide you with the information that you have requested. By using this website and submitting this form, you agree to our <a href="privacy-policy" class="text-reset alert-link">Privacy and Cookie Policy</a>.
					</div>
				</div>

				<div class="form-group d-flex justify-content-end contact-form-buttons mt-4">
					<a 
						class="btn btn-outline-highlight btn-lg text-uppercase mr-3" 
						@click="cancel"
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
	props: {
		bucket: String,
	},

	data() {
		return {
			email: '',
			errors: {},
			submitted: false
		}
	},

	methods: {
		cancel() {
			this.$modal.hide('bucket-list-email-modal');
			this.resetForm();
		},

		sendEmail() {
			this.submitted = true;

			axios
				.post('/bucket-list/send', {email: this.email, bucket: this.bucket})
				.then(() => {
					this.$modal.hide('bucket-list-email-modal');

					this.resetForm();

					swal('Enjoy your vacation!', 'We are glad to have helped you fill your bucket!', 'success');
				})
				.catch(errors => {
					this.errors = errors.response.data.errors;
				});
		},

		resetForm() {
			this.email = '';
			this.submitted = false;
		}
	},
};
</script>