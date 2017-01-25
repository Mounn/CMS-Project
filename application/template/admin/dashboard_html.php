<?php include('header.php'); ?>

<body id="dashboard">

<?php include('top.php');?>
	
<div id="wrapper">



	
<ul class="tabs">
    <li class=""><a href="#tab1">Website Pages</a></li>

</ul>



<div class="tab_container">

    <div class="tab_content" id="tab1" style="display: none;">

	<table>
	<tr class="head">
	<td>Menu Naam</td><td>Actie</td>
	</tr>
	<?php $c = 0; ?>
	<?php foreach ( $allpages as $page ): ?>
	<tr class="<?php echo ($c++%2==1) ? 'odd' : 'even'; ?>">
	<td width="40%"><?php echo $page->name; ?></td>
	
	<td><a class="abutton" href="edit_pagee/<?php echo $page->id;?>">Bewerken</a>
		<a class="abutton" href="delete_pagee/<?php echo $page->id;?>" onclick="show_confirm()">Verwijderen</a>
		</td>
	</tr>
	<?php endforeach; ?>
	</table>
	<br /><a href="add_page" class="buttons">Add Nieuw</a>
	   </div>










</div>


</div>

<?php include('footer.php');?>