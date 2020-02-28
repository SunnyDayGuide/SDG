<template>
	<div class="row no-gutters bucket-item" :id="itemId" v-if="shouldDisplay">
		<div class="col-md-11">
			<div class="row no-gutters card-h overlay position-relative" :class="cardClass">
				<div class="col-md-5 mb-md-0">
					<slot name="image"></slot>
				</div>

				<div class="col-md-7 position-static pl-md-0 d-flex flex-column">
					<div class="card-body pb-0 py-md-0 px-0 px-md-4">
						<h5 class="card-title mt-0">
							<slot name="title"></slot>
						</h5>

						<slot name="body"></slot>

						<div class="bucket-buttons my-3">
							<slot name="buttons"></slot>
						</div>

						<div class="form-group">
							<textarea 
							class="form-control" 
							id="notes" 
							v-model="notes" 
							value="notes"
							@change="updateItem"
							rows="2"
							placeholder="Add Note:" 
							></textarea>
						</div>
					</div> <!-- End Card Body -->
				</div>
			</div> <!-- End Row / Card -->
		</div> <!-- End Column -->

		<div class="col-md-1 d-flex flex-md-column align-items-end justify-content-end justify-content-md-start align-items-md-center">
			<div class="text-center mb-md-5">
				<p-check class="p-default p-curve p-fill p-bigger mr-0" color="success" :id="checkboxId" v-model="completed" @change="updateItem">
					<label slot="off-label"></label>
				</p-check>

				<div :class="completed ? 'text-advertiser' : 'text-light'">
					<small v-text="completed ? 'Complete' : 'Check Off'"></small>
				</div>
			</div>

			<div class="text-center ml-5 ml-md-0">
				<a class="text-light trash-can" @click="removeItem">
					<i class="far fa-trash-alt fa-lg" title="remove"></i>
				</a>
				<div class="text-light">
					<small>Remove</small>
				</div>
			</div>
		</div> <!-- End Column -->
	</div>
</template>

<script>
export default {
	props: {
		itemId: String,
		itemClass: String,
		cardClass: String,
		itemNotes: String,
		itemCompleted: ''
	},

	created() {
		this.completed = false;

		if (this.itemCompleted == 1) {
			this.completed = true
		}
	},

	data() {
		return {
			shouldDisplay: true,
			notes: this.itemNotes,
			completed: '',

		};
	},

	computed: {
		checkboxId: function () {
			return 'check_' + this.itemId
		}
	},

	methods: {
		async removeItem() {
			await axios.post('/bucket-item/delete', {
				id: this.itemId,
				class: this.itemClass
			});
			this.shouldDisplay = false;
			this.$emit('removed');
		},

		async updateItem() {
			console.log('updated');
			await axios.post('/bucket-item/update', {
				id: this.itemId,
				class: this.itemClass,
				notes: this.notes,
				completed: this.completed
			});
		},
	}
};
</script>