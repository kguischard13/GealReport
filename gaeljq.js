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

	$('.Players').click(function() {
		
		var divID = $(this).attr("id");
		var num = parseInt(divID);


		$.post("AthleteBio.php",{athID : num}, function(data, textStatus) {
			$('#athleteBio').show();
			$('#athleteBio').html(data);
		});
		

	});
});