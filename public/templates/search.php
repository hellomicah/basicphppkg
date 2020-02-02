<!-- Search page -->

<!-- Example below -->
<div>
	<p>This is the <?php echo ucwords($_main); ?> page body</p>
</div>

<?php


try {

	$connection = new DataAccess($config->db);

	$page_title = str_replace("/","",$_SERVER['REQUEST_URI']);

	//Generic Query
	print_r($connection->query("Select * from users"));


} catch (Exception $e) {
    //connection failed
    print_r( $e );
}
