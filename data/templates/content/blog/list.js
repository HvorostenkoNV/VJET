$(function()
	{
	$(".blog-list-add-form-call-button").click(function()
		{
		var $form = $(this).next(".blog-list-add-form");
		
		if($form.is(":visible")) $form.slideUp();
		else                     $form.slideDown();
		});
	});