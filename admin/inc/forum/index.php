
<div class="form-clean">
	<div class="row">
		<div class="col-md-12 form-container">
			<div class="row">
				<div class="col-md-12">
					<h1 class="page-header">Forum</h1>
				</div>
			</div>

	<?php include('config_forum.php');
	if(@$_GET['action'] == '') {
	?>
	<div class="panel panel-default">
		<div class="panel-heading">Tempat Diskusi dan Tanya-Jawab &nbsp; <a href="?page=forum&action=new_category?id=<?php echo $dnn1['id']; ?>" class="btn btn-primary btn-sm">Tambah Kategori</a></div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-hover">
					<tr>
						<th class="forum_cat">Kategori</th>
						<th class="forum_ntop">Topik</th>
						<th class="forum_nrep">Balasan</th>
						<th class="forum_act">Aksi</th>
					</tr>
					<?php
					$dn1 = mysql_query('select c.id, c.name, c.description, c.position, (select count(t.id) from topics as t where t.parent=c.id and t.id2=1) as topics, (select count(t2.id) from topics as t2 where t2.parent=c.id and t2.id2!=1) as replies from categories as c group by c.id order by c.position asc');
					$nb_cats = mysql_num_rows($dn1);
					while($dnn1 = mysql_fetch_array($dn1)) { ?>
						<tr>
							<td class="forum_cat">
								<a href="?page=forum&action=list_topics?parent=<?php echo $dnn1['id']; ?>" class="title"><?php echo htmlentities($dnn1['name'], ENT_QUOTES, 'UTF-8'); ?></a>
								<div class="description"><?php echo $dnn1['description']; ?></div>
							</td>
							<td><?php echo $dnn1['topics']; ?></td>
							<td><?php echo $dnn1['replies']; ?></td>
							<td>
								<a href="?page=forum&action=delete_category?id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/delete.png" alt="Delete" /></a>
								<?php if($dnn1['position']>1){ ?><a href="<?=$forum_path?>move_category.php?action=up&id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/up.png" alt="Move Up" /></a><?php } ?>
								<?php if($dnn1['position']<$nb_cats){ ?><a href="<?=$forum_path?>move_category.php?action=down&id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/down.png" alt="Move Down" /></a><?php } ?>
								<a href="?page=forum&action=edit_category?id=<?php echo $dnn1['id']; ?>"><img src="<?php echo $design; ?>/images/edit.png" alt="Edit" /></a>
							</td>
						</tr>
						<?php
					} ?>
				</table>
			</div>
		</div>
	</div>
	<?php
	} else if(@$_GET['action'] == 'list_topics') {
		include 'list_topics.php';
	} else if(@$_GET['action'] == 'new_category') {
		include 'new_category.php';
	} else if(@$_GET['action'] == 'delete_category') {
		include 'delete_category.php';
	} else if(@$_GET['action'] == 'edit_category') {
		include 'edit_category.php';
	} ?>

</div>
</div>
</div>
