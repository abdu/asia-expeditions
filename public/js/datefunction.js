$(function(){
	
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
	var from = $('#from').datepicker({
	  onRender: function(date) {
	    return date.valueOf() < now.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  if (ev.date.valueOf() > to.date.valueOf()) {
	    var newDate = new Date(ev.date)
	    newDate.setDate(newDate.getDate() + 1);
	    to.setValue(newDate);
	  }
	  from.hide();
	  to.update();
	  $('#to')[0].focus();
	}).data('datepicker');
	var to = $('#to').datepicker({
	  onRender: function(date) {
	    return date.valueOf() <= from.date.valueOf() ? 'disabled' : '';
	  }
	}).on('changeDate', function(ev) {
	  to.hide();
	}).data('datepicker');






	
});