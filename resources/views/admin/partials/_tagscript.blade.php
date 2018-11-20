{{-- Assign jQuery to the window so that plugins can read it from the global scope. 
Then we are assigning the Selectize Plugin to any input with the id of “tags”.
https://laravel-news.com/how-to-add-tagging-to-your-laravel-app --}}

<script>
$( document ).ready(function() {
    $('#tags').selectize({
        plugins: ['remove_button'],
        delimiter: ',',
        persist: false,
        valueField: 'tag',
        labelField: 'tag',
        searchField: 'tag',
        options: tags,
        create: function(input) {
            return {
                tag: input,
                value: input,
            }
        }
    });
});
</script>
<script>
var tags = [
	@foreach ($tags as $tag)
	{tag: "{{ $tag }}"},
	{value: "{{ $tag }}"},
	@endforeach
];
</script>