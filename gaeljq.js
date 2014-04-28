$(document).ready(function() {
	$('#cancelButton, #addButton').click(function() {
		$('#newTeamCustom').toggle();
		$('.checkbox').attr('checked', false);
	});
});