<h2>Show Schedule<small class="text-muted"> / {{ $show->name }}</small></h2>
<div id="{{ $show->gadget->gadget_slug }}" class="{{ $show->gadget->gadget_slug }} show-gadget">
	<script type="application/javascript">
		var show = document.getElementsByClassName('{{ $show->gadget->gadget_slug }}');
		var BransonCalendar = new BransonCalendarWidget('{{ $show->gadget->gadget_slug }}', 'green');
		BransonCalendar.display();
	</script>
</div>

{{-- This is still not right because of Vue, but I cannot get oti to work with OLD script from branson.com --}}