<?php include('header.php'); ?>

<body id="add_page">

<!-- Include top menu -->
<?php include('top.php');?>
	
<div id="wrapper">

	<div class="errors">
	<?php echo validation_errors();  ?>
	</div>
	
	<?php echo $msg; ?>
	
	
<ul class="tabs">
    <li class=""><a href="#tab1">Pagina Toevoegen </a></li>
</ul>



<div class="tab_container">

    <div class="tab_content" id="tab1" style="display: none;">
     <!-- General Section -->
<?php echo form_open(); ?>
	
	<p><label>Menu Naam</labe><br /><input  type="text" name="name" /></p>
	<p><label>Paginaurl</labe><br /><input  type="text" name="slug" /></p>
	<p><label>Volgorde</labe><br /><input  type="text" name="page_order" class="mini"/></p>
	</select></p>
	<p><label>Content</labe><br /><textarea name="content"></textarea></p>
	<p><label>Zijbalk</labe><br /><textarea name="sidebar"></textarea></p>
	<p><label>Laten zien op website?</label>
		<select name="show">
	<option value="Yes">Ja</option>
	<option value="No">Nee</option>
	</select>
	</p>
	<p><input type="submit" class="buttons" value="Add Pagina" /></p>
		</div>
		
		
		
		
		
		
</div>

</div>
	<?php echo form_close(); ?>

<?php include('footer.php');?>