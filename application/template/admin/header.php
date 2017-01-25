<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>admin</title>
<script type="text/javascript" src="<?php echo base_url();?>application/template/admin/ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/template/admin/style.css" media="screen">
<script type="text/javascript"
src="https://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script> 

<script type="text/javascript"> 
 
$(document).ready(function() {
 
	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});
 
});
</script>
<script type="text/javascript">
function show_confirm()
{
var r=confirm("Are you sure?");

if (r==false)
  {
   return false;
  }


}

</script>
	
</head>

