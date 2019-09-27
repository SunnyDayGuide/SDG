function BransonCalendarWidget(calendar, template) {
	if( typeof(template) != 'undefined' )
		this.template = template

	if( typeof(calendar) != 'undefined' )
		this.calendar = calendar
}

BransonCalendarWidget.prototype = {
	calendar: '',
	template: '',
	begin: '',
	end: '',
	narrow: false,
	full_calendar: false,
	legend_position: 'bottom',

	setTemplate: function(template) {
		if( typeof(template) != 'undefined' )
			this.template = template;
	},
	setCalendar: function(calendar) {
		if( typeof(calendar) != 'undefined' )
			this.calendar = calendar;
	},
	range: function(begin, end) {
		if( typeof(begin) != 'undefined' )
			this.begin = begin;
		if( typeof(end) != 'undefined' )
			this.end = end;
	},
	setNarrow: function() {
		this.narrow = true;
	},
	setStatic: function() {
		this.full_calendar = true;
	},
	legendPosition: function(pos) {
		if( typeof(pos) == 'undefined' ) {
			this.legend_position = 'bottom';
			return;
		}
		switch(pos) {
			case 'bottom':
			case 'top':
				this.legend_position = pos;
				break;
		}
	},
	top_legend: function() {
		this.legend_position = 'top';
	},
	bottom_legend: function() {
		this.legend_position = 'bottom';
	},
	display: function() {
		if( this.calendar == '' || this.template == '' )
			return;
		html = '';
		html += '<scr'+'ipt src="https://calendars.branson.com/calendar.php?';
		html += 'tpl='+ this.template +'&amp;cal='+ this.calendar;
		if( this.begin != '' )
			html += '&amp;begin='+ this.begin;
		if( this.end != '' )
			html += '&amp;end='+ this.end;
		if( this.legend_position != '' )
			html += '&amp;legend_position='+ this.legend_position;
		if( this.narrow == true )
			html += '&amp;narrow';
		if( this.full_calendar == true )
			html += '&amp;static';
		html += '&amp;output=js" type="application/javascript"></scr'+'ipt>';
		
	}
};