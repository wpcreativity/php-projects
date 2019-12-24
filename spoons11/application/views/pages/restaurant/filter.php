<ul style="list-style: none;" class="ul-links">
<?php $i=1; foreach ($res_data as $key) { ?>
<?php if ($i==1) { ?>
<li style="color: red;font-weight: bolder;">Restaurant</li>
<?php $i++; } ?>
<li onClick="select('<?php echo $key["r_name"]; ?>');" class="test"><?php echo $key["r_name"]; ?></li>
<?php } ?>

<?php $i=1; foreach ($cuisine as $key) { ?>
<?php  if ($i==1) { ?>
<li style="color: red;font-weight: bolder;">Cuisine</li>
<?php $i++; } ?>
<li onClick="select('<?php echo $key["name"]; ?>');" class="test"><?php echo $key["name"]; ?></li>
<?php } ?>

<?php $i=1; foreach ($menu as $key) { ?>
<?php if ($i==1) { ?>
<li style="color: red;font-weight: bolder;">Menu</li>
<?php $i++; } ?>
<li onClick="select('<?php echo $key["menu_name"]; ?>');" class="test"><?php echo $key["menu_name"]; ?></li>
<?php } ?>


</ul>