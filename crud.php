<?php
Class CrudConnect
{			
	public $servername 	= "localhost";
	public $username 	= "root";
	public $password 	= "";
	public $database 	= "test";
	public $conn;
	
	public function __construct() {
		self::connect();
	}
	function connect()
	{
		$this->conn = mysqli_connect($this->servername, $this->username,$this->password,$this->database);
		// Check connection
		if (mysqli_connect_errno()){
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
			die();
		}
		return $this->conn;
		
	}			
	function select($offset, $no_of_records_per_page)
	{								
		$sql = "SELECT r.id, s.rollno, s.name, s.email, s.mobile, s.dept, r.subject, r.total_mark, r.mark_obtain, r.result, r.grade
				FROM students s, results r
				WHERE s.rollno = r.rollno
				ORDER BY r.id ASC 
				LIMIT $offset, $no_of_records_per_page";
				
		$select_result = mysqli_query($this->conn,$sql);
		echo mysqli_error($this->conn);
		
		return $select_result;
	}
	
	function Insert($arrInsertFields = array())
	{			
		$rollno 		= $arrInsertFields['rollno'];
		$name 			= $arrInsertFields['name'];
		$email 			= $arrInsertFields['email'];
		$mobile 		= $arrInsertFields['mobile'];
		$dept 			= $arrInsertFields['dept'];
		$subject		= $arrInsertFields['subject'];
		$mark_obtain	= $arrInsertFields['mark_obtain'];
		$result			= $arrInsertFields['result'];
		$grade 			= $arrInsertFields['grade'];	
		
		if(!empty($rollno))
		{				
			$rollno			= mysqli_real_escape_string($this->conn,$rollno);
			$name			= mysqli_real_escape_string($this->conn,$name);		
			$email			= mysqli_real_escape_string($this->conn,$email);
			$mobile			= mysqli_real_escape_string($this->conn,$mobile);
			$dept			= mysqli_real_escape_string($this->conn,$dept);
			$subject		= mysqli_real_escape_string($this->conn,$subject);
			$mark_obtain	= mysqli_real_escape_string($this->conn,$mark_obtain);
			$result			= mysqli_real_escape_string($this->conn,$result);
			$grade			= mysqli_real_escape_string($this->conn,$grade);
			
			$sql_dup = "select * from students s, results r where s.rollno = r.rollno and s.dept = '$dept' and s.rollno = '$rollno' and r.subject = '$subject' ";
			$exe_dup = mysqli_query($this->conn,$sql_dup);
			$check_dup = mysqli_fetch_array($exe_dup);
			
			if(empty($check_dup))
			{
				$sql_dup2 = "select * from students where dept = '$dept' and rollno = '$rollno' and name = '$name' and mobile = '$mobile' ";
				$exe_dup2 = mysqli_query($this->conn,$sql_dup2);
				$check_dup2 = mysqli_fetch_array($exe_dup2);
				
				if(empty($check_dup2))
				{
					$student = "INSERT INTO students (rollno, name, email, mobile, dept) 
							VALUES ('$rollno', '$name', '$email', '$mobile', '$dept')";
							
					mysqli_query($this->conn, $student);
					echo mysqli_error($this->conn);
				}
				else if(!empty($check_dup2))
				{
					$upd = "Update students set rollno = '$rollno', name = '$name'
						, email = '$email' , mobile = '$mobile' , dept = '$dept' where rollno = '$rollno' ";
															
					mysqli_query($this->conn, $upd);
					echo mysqli_error($this->conn);
				}
						
				$sresult = "INSERT INTO results (rollno, subject, total_mark, mark_obtain, result, grade) 
						VALUES ('$rollno', '$subject', '100', '$mark_obtain', '$result', '$grade')";
						
				mysqli_query($this->conn, $sresult);
				echo mysqli_error($this->conn);
				
				echo "<script>alert('Insert New Record Successfully'); window.location='index.php';</script>";
			}
			else
			{
				echo '<script>alert("Duplicate Records Not allowed")</script>';			
			}
		}			
	}
	function UpdateRecord($arrUpdate = array())
	{
		$id				= $arrUpdate['id'];
		$rollno 		= $arrUpdate['rollno'];
		$name 			= $arrUpdate['name'];
		$email 			= $arrUpdate['email'];
		$mobile 		= $arrUpdate['mobile'];
		$dept 			= $arrUpdate['dept'];
		$subject		= $arrUpdate['subject'];
		$mark_obtain	= $arrUpdate['mark_obtain'];
		$result			= $arrUpdate['result'];
		$grade 			= $arrUpdate['grade'];
		
		if(!empty($mark_obtain))
		{
			$id				= mysqli_real_escape_string($this->conn,$id);
			$rollno			= mysqli_real_escape_string($this->conn,$rollno);
			$name			= mysqli_real_escape_string($this->conn,$name);		
			$email			= mysqli_real_escape_string($this->conn,$email);
			$mobile			= mysqli_real_escape_string($this->conn,$mobile);
			$dept			= mysqli_real_escape_string($this->conn,$dept);
			$subject		= mysqli_real_escape_string($this->conn,$subject);
			$mark_obtain	= mysqli_real_escape_string($this->conn,$mark_obtain);
			$result			= mysqli_real_escape_string($this->conn,$result);
			$grade			= mysqli_real_escape_string($this->conn,$grade);

			$upd = "Update students set rollno = '$rollno', name = '$name'
					, email = '$email' , mobile = '$mobile' , dept = '$dept' where rollno = '$rollno' ";
														
			mysqli_query($this->conn, $upd);
			echo mysqli_error($this->conn);

			$sresult = "Update results set subject='$subject', mark_obtain='$mark_obtain', result='$result', grade='$grade' where rollno ='$rollno' and id = '$id' ";
					
			mysqli_query($this->conn, $sresult);
			echo mysqli_error($this->conn);
			
			echo "<script>alert('Updated Successfully'); window.location='index.php';</script>";
								
		}
		else
		{
			echo '<script>alert("Mark Obtain Should not be empty")</script>';
		}
	}
	function DeleteRecord($arrDelete = array())
	{
		$id				= $arrDelete['id'];
		$rollno 		= $arrDelete['rollno'];
		$name 			= $arrDelete['name'];
		$email 			= $arrDelete['email'];
		$mobile 		= $arrDelete['mobile'];
		$dept 			= $arrDelete['dept'];
		$subject		= $arrDelete['subject'];
		
		$sql_dup 		= "select * from results where rollno = '$rollno'";
		$exe_dup 		= mysqli_query($this->conn,$sql_dup);
		$check_dup 		= mysqli_num_rows($exe_dup);
		
		if($check_dup > 1)
		{
			$rdeleted = "Delete from results where id = '$id' and rollno = '$rollno' and subject = '$subject' ";
			
			mysqli_query($this->conn, $rdeleted);
			echo mysqli_error($this->conn);
				
			echo "<script>alert('Deleted Successfully'); window.location='index.php';</script>";
		}
		else if($check_dup == 1)
		{
			$sdelete = "Delete from students where rollno = '$rollno' ";
			mysqli_query($this->conn, $sdelete);
			echo mysqli_error($this->conn);
				
			$rdelete = "Delete from results where id = '$id' and rollno = '$rollno' and subject = '$subject' ";
			
			mysqli_query($this->conn, $rdelete);
			echo mysqli_error($this->conn);
			
			echo "<script>alert('Deleted Successfully'); window.location='index.php';</script>";	
		}
	}
	function __destruct()
	{
		mysqli_close($this->conn);
	}
}
?>