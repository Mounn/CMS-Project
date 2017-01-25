<?php include('header.php'); ?>
<body id="edit_page">
	
<?php include('top.php');?>
<div id="wrapper">

	<div class="errors">
	<?php echo validation_errors();  ?>
	</div>
	
<?php echo $msg; ?>
	
	
<ul class="tabs">
    <li class=""><a href="#tab1">General </a></li>
     <li class=""><a href="#tab4">Visibility </a></li>
    <li class=""><a href="#tab2">SEO Options</a></li>
	<li class=""><a href="#tab3">Side bar</a></li>
</ul>

<?php foreach( $page as $show ): ?>

<div class="tab_container">

    <div class="tab_content" id="tab1" style="display: none;">
     <!-- General Section -->
<?php echo form_open(); ?>
	
	<p><label>Name</labe><br /><input  type="text" name="name" value="<?php echo $show->name; ?>" /></p>	
	<p><label>Slug</labe><br /><input  type="text" value="<?php echo $show->slug; ?>" name="slug" /></p>

	<p><label>Parent Page</p>
	    <select name="parent_page">    
	 <option value=""> None </option>
	<?php foreach($pages as $page): ?>
	    
	    <option value="<?php echo $page->id; ?>"><?php echo $page->name; ?></option>
	    
	    
	<?php endforeach; ?>    
	</select></p>

	<p><label>Content</labe><br />
		<textarea name="content"><?php echo $show->content; ?></textarea></p>


	<p><input type="submit" class="buttons" value="Save Changes"  /></p>
	   </div>


    <div class="tab_content" id="tab2" style="display: block;">
	
        <!--Seo Options Section-->

	<p><label>Page Title</labe><br /><textarea class="short" name="title"><?php echo $show->title; ?></textarea></p>
	<p><label>Meta Descriptions</labe><br /><textarea class="short" name="description"><?php echo $show->description; ?></textarea></p>
    <p><label>Meta Keywords</labe><br /><textarea class="short" name="keywords"><?php echo $show->keywords; ?></textarea></p>
	<p><input type="submit" class="buttons" value="Save Changes" /></p>

	</div>
	
	
	
	
	    <div class="tab_content" id="tab3" style="display: none;">
		
		<textarea name="sidebar"<?php echo $show->sidebar; ?></textarea>
			<p><input type="submit" class="buttons" value="Save Changes" /></p>
		</div>
		
		
		
			    <div class="tab_content" id="tab4" style="display: none;">
		
		        	<p><label>Show in main menu ?</label>
		<select name="show">
	<option value=""> --- </option>
	<option value="Yes">Yes</option>
	<option value="No">No</option>
	</select>
	</p>
	

	
	
	<p><label>Order</labe><br /><input  type="text" name="page_order" class="mini" value="<?php echo $page->page_order; ?>"/></p>
	<p><input type="submit" class="buttons" value="Save Changes" /></p>
		</div>	
		
		
</div>
	<?php endforeach; ?>
		<?php echo form_close(); ?>
</div>



</div>
<?php include('footer.php'); ?>