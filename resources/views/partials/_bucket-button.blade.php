<bucket-button 
	item-id="{{ $item->id }}" 
	item-class="{{ get_class($item) }}" 
	button-style="{{ $button }}" 
	in-bucket="{{ $item->isInBucket() }}" 
	v-on:added="bucketItemAdded" 
	v-on:removed="bucketItemRemoved"
>
</bucket-button>