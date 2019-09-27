$(function() {
	$('#calendar-create-invocation').click(function(event) {
		event.preventDefault();
		// Clear out old invocation code
		$('#write-invocation-code-here').empty();

		var displaymethod = $('#display-method').val();

		var cal = $('#calendar-name').val();
		var tpl = '';
		var year = '' ;

		var isStatic = $('#calendar-option-static').is(':checked');
		var isNarrow = $('#calendar-option-narrow').is(':checked');

		var begin = '';
		var end = '';
		if( year != '' ) {
			var d = new Date();
			
			var begin = year+'01';
			var end = year+'12';
		}

		var parameters = '?cal='+ cal +'&tpl='+ tpl;
		if( isStatic )
			parameters += '&static';

		if( isNarrow )
			parameters += '&narrow';

		if( year != '' )
			parameters += '&begin='+ begin +'&end='+ end;

		var popupsrc  = 'http://calendars.branson.com/calendar.php'+parameters;
		var iframesrc = 'getcalendar.php'+parameters;

		var invocationcodeHTML = '';
		invocationcodeHTML += '<scr'+'ipt src="http://calendars.branson.com/js/2.1/calendar.js" type="text/javascript"></scr'+'ipt>'+"\r\n";
		invocationcodeHTML += '<scri'+'pt type="text/javascript">'+"\r\n";
		invocationcodeHTML += 'var BransonCalendar = new BransonCalendarWidget("'+ cal +'", "'+ tpl +'");'+"\r\n";
		if( year != '' )
			invocationcodeHTML += 'BransonCalendar.range("'+ begin +'", "'+ end +'");'+"\r\n";
		if( isStatic )
			invocationcodeHTML += 'BransonCalendar.setStatic();'+"\r\n";
		if( isNarrow )
			invocationcodeHTML += 'BransonCalendar.setNarrow();'+"\r\n";
		invocationcodeHTML += 'BransonCalendar.display();'+"\r\n";
		invocationcodeHTML += '</scr'+'ipt>'+"\r\n";
		invocationcodeHTML += '<noscr'+'ipt><a href="'+popupsrc+'" target="_blank">Click here</a> to view the calendar.</noscr'+'ipt>';
		$('#write-invocation-code-here').text(invocationcodeHTML);
		$('#write-invocation-code-here').trigger('focus').trigger('select');

		var previewembed = '<iframe id="calendarFRM" frameborder="0" noresize="noresize" width="560" scrolling="no"  src="'+iframesrc+'"></iframe>';
		$('#preview-invocation').html(previewembed);

	});
});