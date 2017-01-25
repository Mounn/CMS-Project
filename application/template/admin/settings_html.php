<?php include('header.php'); ?>

<body id="settings">

<?php include('top.php');?>
	
<div id="wrapper">

	<div class="errors">
	<?php echo validation_errors();  ?>
	</div>
	
	<?php echo $msg; ?>

	
<ul class="tabs">
	 <li class=""><a href="#tab1">1</a></li>
    <li class=""><a href="#tab2">2</a></li>
	    <li class=""><a href="#tab3">3</a></li>
</ul>

<?php echo form_open(); ?>


	<?php echo form_close(); ?>


</div>

<?php include('footer.php');?>