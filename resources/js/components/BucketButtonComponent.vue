<template>
	<div>
		<a @click="buttonMethod" class="text-reset text-decoration-none bucket-btn bucket-btn-sm">
			<span class="icon-bucket position-relative text-primary">
				<span class="bucket-items text-white">
					<font-awesome-icon :icon="added ? 'minus-circle' : 'plus-circle'" />
				</span>
			</span>
		</a>
	</div>
</template>

<script>
export default {
	props: {
		itemId: String,
		itemClass: String,
	},

	data() {
		return {
			buttonMethod: this.addToBucket,
			user: {},
			errors: {},
			added: false,
		};
	},

	methods: {
		addToBucket() {
			this.addToSession();
			this.added = true;
			this.buttonMethod = this.removeFromBucket;
		},

		removeFromBucket() {
			this.removeFromSession();
			this.added = false;
			this.buttonMethod = this.addToBucket;
		},

		addToSession() {
			console.log(this.itemId); // this will be code to add to session bucket cookie whatever
		},

		removeFromSession() {
			console.log('removed!', this.itemId);
		}
	}
};

</script>