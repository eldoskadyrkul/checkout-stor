<?php 

class CreateDb {

	public $servername;
	public $dbname;
	public $username;
	public $password;
	public $tablename;
	public $con;

	function __construct(
		$dbname = "store_db",
		$tablename = "products",
		$servername = "localhost",
		$username = "root",
		$password = "")
	{
		$this->dbname = $dbname;
		$this->tablename = $tablename;
		$this->servername = $servername;
		$this->username = $username;
		$this->password = $password;

		// create connection
		$this->con = mysqli_connect($servername, $username, $password);

		// check connection
		if (!$this->con) {
			die("Connection failed:" .mysqli_connect_error());
		}

		// query
		$sql = "CREATE DATABASE IF NOT EXISTS $dbname";

		// execute query
		if (mysqli_query($this->con, $sql)) {
			$this->con = mysqli_connect($servername, $username, $password, $dbname);

			// sql to create new table
			$sql = "CREATE TABLE IF NOT EXISTS $tablename
					(id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
					product_name VARCHAR(51) NOT NULL,
					product_price FLOAT,
					product_image VARCHAR(100))";

			if (!mysqli_query($this->con, $sql)) {
				echo "Error creating table: ". mysqli_error($this->con);
			}
		} else {
			return false;
		}
	}

	public function getData()
	{		
		$sql = "SELECT * FROM $this->tablename";

		$result = mysqli_query($this->con, $sql);

		if (mysqli_num_rows($result) > 0) {
			return $result;
		}
	}

	public function insertData($name, $price, $img)
	{

		$things_name = trim($_POST[$name]);
		$things_price = trim($_POST[$price]);
		$things_image = $_FILES[$img]['tmp_name'];		
		$things_image_name = $_FILES[$img]['name'];
		$things_image_file = file_get_contents($things_image);

		if(is_uploaded_file($_FILES[$img]["tmp_name"]))
        {
            $user_avatarsNameString = move_uploaded_file($_FILES[$img]["tmp_name"], "image/".$_FILES[$img]["name"]);
        } else {
            echo("Ошибка загрузки файла");
        }

		$sql = "INSERT INTO $this->tablename (`product_name`, `product_price`, `product_image`) VALUES ('".$things_name."', '".$things_price."', '".$things_image_name."')";

		if (mysqli_query($this->con, $sql)) {
			print('Data added was succesfully');
		} else {
			echo mysqli_error($this->con);
		}

	}
}

?>