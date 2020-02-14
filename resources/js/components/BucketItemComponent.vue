<template>
	<div :class="divClass" :id="itemId" v-if="shouldDisplay">
		<slot v-bind:removeItem="removeItem"></slot>
	</div>
</template>

<script>
	export default {
		props: {
			itemId: String,
			itemClass: String,
			divClass: String,
		},

		data() {
			return {
				shouldDisplay: true,
				cookieValue: this.$cookies.get("BUCKET_"+this.itemClass),
			};
		},

		mounted(){
          axios.get('/destinations/branson/bucket-list').then(response=>{
              this.entertainers = response.data.entertainers;
              console.log(this.entertainers);
          }); // this is really nothing. just seeing if getting the data works.
        
      },

		methods: {
			removeItem() {
				this.removeFromCookie();
				console.log(this.itemId);
				this.shouldDisplay = false;
			},

			removeFromCookie() {
				var cookieValue = this.$cookies.get("BUCKET_"+this.itemClass);
				var idArray = [];
				idArray = cookieValue.split('+');

				const index = idArray.indexOf(this.itemId);
				if (index > -1) {
					idArray.splice(index, 1);
				}

				var idString = idArray.join('+');

				this.$cookies.set("BUCKET_"+this.itemClass, idString, { expires: "1y" });
			},
		}
	};
</script>