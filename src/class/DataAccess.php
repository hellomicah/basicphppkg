<?php
class DataAccess {

	protected $host 	= '';
	protected $database = '';
	protected $username = '';
	protected $password = '';
	protected $charset 	= '';
	protected $conn 	= '';

	protected $pdo_options = [
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	];
	
    public function __construct($db)
    {
        $this->host = $db['host'];
        $this->conn = $db['connection'];
        $this->database = $db['database'];
        $this->username = $db['username'];
        $this->password = $db['password'];
        $this->charset 	= $db['charset'];
    }

    public function connect() {

		$dsn = $this->conn.":host=".$this->host.";dbname=".$this->database.";charset=".$this->charset;

		try {
		     return new PDO($dsn, $this->username, $this->password, $this->pdo_options);
		} 
		catch (\PDOException $e) {
		     throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
    }

    /*	
     *	Executes SELECT SQL Query
	 *	
     */
    public function fetch($table, $selector='*', $condition='') {
    	try {
	    	$pdo = $this->connect();
	    	$pdo->beginTransaction();

			if ( $condition !='' ){
				$sql = 'SELECT '.$selector.' FROM '.$table.' '.$condition['statement'];
				$stmt = $pdo->prepare( $sql );
				$stmt->execute( $condition['bind_values'] );
			}
			else {
				$sql = 'SELECT '.$selector.' FROM '.$table;
				$stmt = $pdo->prepare( $sql );
				$stmt->execute();
			}
			$results = $stmt->fetch();

			$pdo->commit();
			return $results;
		}
		catch (Exception $e){
		    $pdo->rollback();
		    throw $e;
		}
    }

    /*	
     *	Executes UPDATE SQL Query
	 *	
     */
    public function update($table, $data, $condition) {
    	try {
	    	$pdo = $this->connect();
	    	$pdo->beginTransaction();
		
			$sql = 'UPDATE '.$table.' SET '.$data.' '.$condition['statement'];
			$stmt = $pdo->prepare( $sql );
			$results = $stmt->execute( $condition['bind_values'] );
			
			$pdo->commit();
			
			return $results;
		}
		catch (Exception $e){
		    $pdo->rollback();
		    throw $e;
		}
    }

    /*	
     *	Executes INSERT SQL Query
	 *	
     */
    public function create($table, $columns, $data ) {
    	try {
	    	$pdo = $this->connect();
	    	$pdo->beginTransaction();

	    	$sql = 'INSERT INTO '. $table .' ('. $columns .') VALUES ('. $data['bind_keys'] .')';
			$stmt = $pdo->prepare($sql);
			$results = $stmt->execute( $data['bind_values'] );
			
			$pdo->commit();

			return $results;
		}
		catch (Exception $e){
		    $pdo->rollback();
		    throw $e;
		}
    }

    /*	
     *	Executes Generic SQL Query
	 *	
     */
    public function query($sql) {
    	try {
	    	$pdo = $this->connect();
	    	$pdo->beginTransaction();
 
	    	$stmt = $pdo->query($sql);

	    	$results = array();
			foreach ($stmt as $row)
			{
			    $results[] = $row;
			}
			
			$pdo->commit();

			return $results;

		} 
		catch (Exception $e){
		    $pdo->rollback();
		    throw $e;
		}
    }
}