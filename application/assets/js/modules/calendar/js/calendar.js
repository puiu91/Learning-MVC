	// Date Picker Settings
	$(function() {
		$("#datepicker").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: "yy-mm-dd",
			minDate: new Date(2011, 09-1, 05), 
			maxDate: new Date(2015, 04-1, 26), 
			showButtonPanel: true,
		});
	});

	// Added functionality for Today button when showButtonPanel is set to true
	$.datepicker._gotoToday = function(id) {
		var target = $(id);
		var inst = this._getInst(target[0]);
		if (this._get(inst, 'gotoCurrent') && inst.currentDay) {
			inst.selectedDay = inst.currentDay;
			inst.drawMonth = inst.selectedMonth = inst.currentMonth;
			inst.drawYear = inst.selectedYear = inst.currentYear;
		}
		else {
			var date = new Date();
			inst.selectedDay = date.getDate();
			inst.drawMonth = inst.selectedMonth = date.getMonth();
			inst.drawYear = inst.selectedYear = date.getFullYear();
			this._setDateDatepicker(target, date);
			this._selectDate(id, this._getDateDatepicker(target));
		}
		this._notifyChange(inst);
		this._adjustDate(target);
	}