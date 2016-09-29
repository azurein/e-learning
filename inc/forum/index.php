<?php include('config_forum.php');
if(@$_GET['action'] == '') {
?>
<a href="new_category.php" class="button">New Category</a>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<tr>
			<th class="forum_cat">Category</th>
			<th class="forum_ntop">Topics</th>
			<th class="forum_nrep">Replies</th>
			<th class="forum_act">Action</th>
		</tr>
		<?php
		$dn1 = mysql_query('select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
		$nb_cats = mysql_num_rows($dn1);
		while($dnn1 = mysql_fetch_array($dn1)) { ?>
			<tr>
				<td class="forum_cat">
					<a href="list_topics.php?parent=<?php echo $dnn1['id']; ?>" class="title"><?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
					<div class="description"><?php echo $dnn1['description']; ?></div>
				</td>
				<td><?php echo $dnn1['topics']; ?></td>
				<td><?php echo $dnn1['replies']; ?></td>
				<td>
					<a href="?page=forum&action=delete?id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/delete.png" alt="Delete" /></a>
					<?php if($dnn1['position']>1){ ?><a href="<?=$forum_path?>move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/up.png" alt="Move Up" /></a><?php } ?>
					<?php if($dnn1['position']<$nb_cats){ ?><a href="<?=$forum_path?>move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/down.png" alt="Move Down" /></a><?php } ?>
					<a href="<?=$forum_path?>edit_category.php?id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/edit.png" alt="Edit" /></a>
				</td>
			</tr>
		<?php
		} ?>
	</table>
</div>
<?php
} else if(@$_GET['action'] == 'delete') { ?>
	<?php echo "asd" ?>
<?php
} ?>
