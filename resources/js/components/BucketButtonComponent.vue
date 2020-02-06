<template>
	<div>
		<a @click="buttonMethod" class="text-reset text-decoration-none" :class="this.styles">
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
		styles: String,
	},

	data() {
		return {
			buttonMethod: this.addToBucket,
			user: {},
			errors: {},
			added: '',
			idArray: [],
			cookieDate: '',
			cookieValue: this.$cookies.get("BUCKET_"+this.itemClass),
		};
	},

	mounted() {
		var date = new Date
		this.cookieDate = date.setDate(date.getDate() + 365);

		this.idArray = [];
		if (this.cookieValue != null) {
			this.idArray = this.cookieValue.split('+');
		}
		this.isAdded();
	},

	methods: {
		isAdded() {
			if (this.cookieValue != null) {
				if (this.idArray.includes(this.itemId)) {
					this.added = true;
				} else this.added = false;
			} 
			else this.added = false;
		},

		addToBucket() {			
			this.added = true;
			this.setCookie();
			this.buttonMethod = this.removeFromBucket;
			this.$emit('added');
		},

		removeFromBucket() {
			this.added = false;
			this.removeFromCookie();
			this.buttonMethod = this.addToBucket;
			this.$emit('removed');
		},

		setCookie() {
			if (this.cookieValue != null) {
				var idString = this.cookieValue + '+' + this.itemId;
			} else idString = this.itemId;

			// set new cookie
			this.$cookies.set("BUCKET_"+this.itemClass, idString, { expires: "1y" });

			this.cookieValue = this.$cookies.get("BUCKET_"+this.itemClass),
			this.idArray = this.cookieValue.split('+');
		},

		removeFromCookie() {
			console.log(this.idArray);

			var cookieValue = this.$cookies.get("BUCKET_"+this.itemClass);
			this.idArray = [];
			this.idArray = cookieValue.split('+');

			const index = this.idArray.indexOf(this.itemId);
			if (index > -1) {
				this.idArray.splice(index, 1);
			}

			var idString = this.idArray.join('+');

			this.$cookies.set("BUCKET_"+this.itemClass, idString, { expires: this.cookieDate });

			this.cookieValue = this.$cookies.get("BUCKET_"+this.itemClass);

			if (this.cookieValue != null) {
				this.idArray = this.cookieValue.split('+');
			}

			console.log(idString); 

			console.log('removed!', this.itemId);
		},

	}
};

</script>