jQuery(document).ready(function()
{
	jQuery(".ced_product_show").hide();
	jQuery(".ced_product_show_click").live("click",function()
	{
		jQuery(this).parent("p").next(".ced_product_show").slideToggle()
	})
});