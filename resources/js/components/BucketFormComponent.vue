<template>
	<div class="bucket-form mb-3">
		<form>
			<div class="form-row">
				<div class="form-group col-md-6">
					<input type="text" v-model="bucket.name" class="form-control form-control-lg" :placeholder="namePlaceholder" @change="updateBucket">
				</div>

				<div class="form-group col-md-3">
					<div class="input-group">
						<v-date-picker
						  v-model="bucket.start_date"
						  @input="updateBucket"
						  :min-date="new Date()"
						  :input-props="{ class: 'form-control form-control-lg', placeholder: startPlaceholder}"
						/>
						<div class="input-group-append">
							<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
						</div>
					</div>
				</div>

				<div class="form-group col-md-3">
					<div class="input-group">
						<v-date-picker
						  v-model="bucket.end_date"
						  @input="updateBucket"
						  :min-date="bucket.start_date"
						  :input-props="{ class: 'form-control form-control-lg', placeholder: endPlaceholder}"
						/>
						<div class="input-group-append">
							<div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</template>

<script>
	export default {
		props: {
			bucketId: String,
			namePlaceholder: String,
			startPlaceholder: String,
			endPlaceholder: String,
		},

		data() {
			return {
				bucket: {
					name: this.namePlaceholder,
					start_date: new Date(this.startPlaceholder),
					end_date: new Date(this.endPlaceholder),
				}
			};
		},

		methods: {
			updateBucket() {
				axios.post('/bucket-list', this.bucket);
			},

		},

	};
</script>