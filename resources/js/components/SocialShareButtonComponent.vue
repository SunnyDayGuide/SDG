<template>
	<div>
		<a href="#" @click.prevent="windowPopup" class="text-center d-flex flex-column ml-3">
			<div class="fa-stack fa-sm">
				<i class="fas fa-circle fa-stack-2x"></i>
				<i class="fab fa-stack-1x fa-inverse" :class="iconClass"></i>
			</div>
			<div class="text" v-text="shareText"></div>
		</a>
	</div>
</template>

<script>
	export default {
		props: {
			url: '',
			network: '',
			message: '',
			via: '',
			hashtags: ''
		},

		data() {
			return {
				width: 600,
				height: 500,
				iconClass: '',
				shareText: '',
			};
		},

		created() {
			if (this.network == 'facebook') {
				this.iconClass = 'fa-facebook-f'
				this.shareText = 'Share',
				this.shareUrl = this.facebookUrl
			} 
			if (this.network == 'twitter') {
				this.iconClass = 'fa-twitter'
				this.shareText = 'Tweet',
				this.shareUrl = this.twitterUrl
			}
		},

		computed: {
			facebookUrl: function () {
		      return 'https://www.facebook.com/sharer/sharer.php?u=' + this.url
		    },

		    twitterUrl: function () {
		      return 'http://twitter.com/share?' + 'text=' + this.message + '&url=' + this.url + '&hashtags=' + this.hashtags + '&via=' + this.via
		    },

		},

		methods: {
			windowPopup() {
			  // Calculate the position of the popup so it’s centered on the screen.
			  var left = (screen.width / 2) - (this.width / 2),
			      top = (screen.height / 2) - (this.height / 2);

			  window.open(
			    this.shareUrl,
			    "",
			    "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width=" + this.width + ",height=" + this.height + ",top=" + top + ",left=" + left
			  );
			}

		}
	};
</script>