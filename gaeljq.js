$(document).ready(function() {
	$('#cancelButton, #addButton').click(function() {
		$('#newTeamCustom').toggle();
		$('.checkbox').attr('checked', false);
	});

	$('.Players').mouseenter(function() {
		$(this).css("background-color", "grey");
	});

	$('.Players').mouseleave(function() {
		$(this).css("background-color", "black");
	});

	$('.Players').click(function(event) {
		var divID = $(this).attr("id");
		

	});
});