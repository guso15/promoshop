/*!
 * jQuery UI 1.8.18
 *
*/

$(function() {
	$.datepicker.regional['de'] = {
		closeText: 'schließen',
		prevText: '&#x3c;zur&#252;ck',
		nextText: 'Vor&#x3e;',
		currentText: 'heute',
		monthNames: ['Januar','Februar','M&#228;rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
		monthNamesShort: ['Jan','Feb','M&#228;r','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez'],
		dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag'],
		dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
		dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
		weekHeader: 'Wo',
		dateFormat: 'dd.mm.yy',
		firstDay: 1,
		minDate: '+3',
		isRTL: false,
		showMonthAfterYear: false,
		yearSuffix: '',
		beforeShowDay: function(date){
			if(date.getDay()>=1 && date.getDay()<=5){
				return [true,""];
			} else {
				return [false,""];
			}
		}
	};
	$.datepicker.setDefaults($.datepicker.regional['de']);
});

$(function() {
		var dates = $( "#starttime, #endtime" ).datetimepicker({
			defaultDate: "+3",
			changeMonth: true,
			numberOfMonths: 2,
			maxDate: '+6m',
			stepMinute: 15,
			minuteGrid: 15,
			hourGrid: 1,
			hourMin: 9,
			hourMax: 17,
			hourText: 'Stunde',
			timeText: 'Zeit',
			closeText: 'Schlie&#223;en',
			onSelect: function( selectedDate ) {
				var option = this.id == "starttime" ? "minDate" : "maxDate",
					instance = $( this ).data( "datepicker" ),
					date = $.datepicker.parseDate(
						instance.settings.dateFormat ||
						$.datepicker._defaults.dateFormat,
						selectedDate, instance.settings 
					);
					
					if (this.id == "starttime") {
						var selectedArray = selectedDate.split('.');
						selectedDate = "";
						var selectedDay = 0;					
						for (var i=0; i < selectedArray.length; i++) {
							selectedDate += selectedArray[i] + ".";
						}
					}

			dates.not( this ).datepicker( "option", option, selectedDate );
		}
	});
});
