<?php include('header.php'); ?>
<body id="login">
	
<div class="errors">
	<?php echo validation_errors(); echo $error; ?>
	</div>
	<body>

	<div id="loginbox">
		
<?php echo form_open(); ?>
<p><input type="text" name="username" value="Admin"  /></p>
<p><input type="password" name="password" value="Password" /></p>
<p><input type="submit" name="login" class="buttons" value="Login" /></p>

<?php echo form_close(); ?>

</div>
