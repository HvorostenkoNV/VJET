$(function()
	{
	$(".blog-detail-add-comments-form-call-button").click(function()
		{
		var $form = $(this).next(".blog-detail-add-comments-form");
		
		if($form.is(":visible")) $form.slideUp();
		else                     $form.slideDown();
		});
	});