<?php ob_start(); ?>
<?php include_once('includes/header.php'); ?>

<?php
	
	if (isset($_GET['id'])) {
		$ID = clean($_GET['id']);
	} else {
		$ID = clean('');
	}

	// get image file from table
	$sql = "SELECT channel_type, channel_image FROM tbl_channel WHERE id = '$ID'";
	$result = $connect->query($sql);
	$row = $result->fetch_assoc();

	$channel_type = $row['channel_type'];
	$channel_image = $row['channel_image'];

	// delete data from menu table
	$sql_delete = "DELETE FROM tbl_channel WHERE id = '$ID'";
	$delete = $connect->query($sql_delete);

	// if delete data success
	if ($delete) {
		if ($channel_type == 'URL') {
			unlink('upload/'.$channel_image);
		} else {
			if ($channel_image != '') {
				unlink('upload/'.$channel_image);
			} else {
				//do nothing
			}
		}

		$_SESSION['msg'] = "Channel deleted successfully...";
	    header( "Location: channel.php");
	     exit;
	}

?>

<?php include_once('includes/footer.php'); ?>