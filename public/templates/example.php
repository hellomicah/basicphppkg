<!-- Example page -->

<!-- Sample HTML below -->
<div>
	<p>This is the <?php echo ucwords($_main); ?> page body</p>
</div>


<!-- Sample class initiation and function call below -->
<?php


try {

	$connection = new DataAccess($config->db);

	$page_title = str_replace("/","",$_SERVER['REQUEST_URI']);

	/* 
	 * 	START - SAMPLE Queries Below
	 *	 uncomment the INSERT, SELECT, UPDATE code section below 
	 *   for sample execution
	 */
	$table = 'Users';


	// INSERT
	/* 
	$columns = 'Username, First_Name, Last_Name, Email, Mobile, Role';
	$data['bind_keys'] = ':Username, :First_Name, :Last_Name, :Email, :Mobile, :Role';
	$data['bind_values'] = [
		'Username' => 'myusername',
		'First_Name' => 'John', 
		'Last_Name' => 'Doe',
		'Email' => 'john123.doe345@mymail.com',
		'Mobile' => '09999999992',
		'Role' => 'Adminstrator',
	];
	print_r($connection->create($table, $columns, $data )); 
	*/


	//SELECT
	/* 
	$condition['statement'] = 'WHERE User_ID=:User_ID AND Username=:Username';
	$condition['bind_values'] = [
		'User_ID' => 6, 
		'Username' => 'myusername'
	];
	print_r($connection->fetch($table, $selector='*', $condition));
	print_r($connection->fetch($table, $selector='First_Name, Last_Name', $condition));
	print_r($connection->fetch($table));
	*/

	//UPDATE
	/* 
	$data = 'First_Name=:First_Name, Last_Name=:Last_Name';
	$condition['statement'] = 'WHERE User_ID=:User_ID AND Username=:Username';
	$condition['bind_values'] = [
		'First_Name' => 'Joanne',
		'Last_Name' => 'Smith',
		'User_ID' => 6, 
		'Username' => 'myusername'
	];
	print_r($connection->update($table, $data, $condition));
	*/

	//Generic Query
	print_r($connection->query("Select * from users where Username='myusername'"));

	/* 
	 * 	END - SAMPLE Queries Below
	 */


} catch (Exception $e) {
    //connection failed
    print_r( $e );
}
