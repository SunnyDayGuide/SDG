<bucket-button 
	item-id="{{ $item->id }}" 
	item-class="{{ $class }}" 
	button-style="{{ $button }}" 
	bucket-id="{{ $bucketId }}" 
	in-bucket="{{ $item->isInBucket() }}" 
	v-on:added="bucketItemAdded" 
	v-on:removed="bucketItemRemoved"
>
</bucket-button>