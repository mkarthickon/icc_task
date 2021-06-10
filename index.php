<?php	
	include 'add_new_record.php';
	include_once('crud.php');
	
	$objSelect 	= new CrudConnect();
	$conn 		= $objSelect->connect();
	
	if (isset($_GET['pageno'])) 
	{
		$pageno = $_GET['pageno'];
	} 
	else 
	{
		$pageno = 1;
	}
	$no_of_records_per_page = 3;
	$offset = ($pageno-1) * $no_of_records_per_page;

	$total_pages_sql = "SELECT COUNT(*) FROM students s, results r where s.rollno = r.rollno";
	$result = mysqli_query($conn,$total_pages_sql);
	$total_rows = mysqli_fetch_array($result)[0];
	$total_pages = ceil($total_rows / $no_of_records_per_page);
	
	$res_data = $objSelect->select($offset, $no_of_records_per_page);
	
?>
<html>
<head>
<title>Main Page</title>
<!-- Bootstrap CDN -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
    .bs-example{
    	margin: 20px;
    }
</style>
</head>
<body>		
	<table class="table table-dark">
		<thead>
			<tr >
			<th scope="col">Id</th>
			<th scope="col">Rollno</th>
			<th scope="col">Name</th>
			<th scope="col">Email</th>
			<th scope="col">Mobile</th>
			<th scope="col">Department</th>
			<th scope="col">Subject</th>
			<th scope="col">Mark Obtain</th>
			<th scope="col">Total Mark</th>
			<th scope="col">Result</th>
			<th scope="col">Grade</th>
			<th scope="col"></th>				
			</tr>
		</thead>
		<tbody>
			<?php
				while($row = mysqli_fetch_array($res_data))
				{
					$id 			= $row['id'];
					$rollno 		= $row['rollno'];
					$name 			= $row['name'];
					$email 			= $row['email'];
					$mobile 		= $row['mobile'];
					$dept 			= $row['dept'];
					$subject 		= $row['subject'];
					$mark_obtain 	= $row['mark_obtain'];
					$total_mark 	= $row['total_mark'];
					$result 		= $row['result'];
					$grade 			= $row['grade'];
			?>								   
					<tr>
					<td><?php echo $id; ?></td>
					<td><?php echo $rollno; ?></td>
					<td><?php echo $name; ?></td>
					<td><?php echo $email; ?></td>
					<td><?php echo $mobile; ?></td>
					<td><?php echo $dept; ?></td>
					<td><?php echo $subject; ?></td>
					<td><?php echo $mark_obtain; ?></td>
					<td><?php echo $total_mark; ?></td>
					<td><?php echo $result; ?></td>
					<td><?php echo $grade; ?></td>
					<td>
					<a href="edit_delete.php?id=<?php echo $id; ?>&rollno=<?php echo $rollno; ?>&name=<?php echo $name; ?>&email=<?php echo $email; ?> &mobile=<?php echo $mobile; ?>&dept=<?php echo $dept; ?>&subject=<?php echo $subject; ?>">Edit/Delete</a>
					</td>
					</tr>
			<?php
				}
			?>
		</tbody>
	</table>
	<h3>Total Records : <?php echo $total_rows; ?></h3>

    <ul class="pagination">
        <li><a href="?pageno=1"><h4>First</h4></a></li>
        <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><h4>Prev</h4></a>
        </li>
        <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>"><h4>Next</h4></a>
        </li>
        <li><a href="?pageno=<?php echo $total_pages; ?>"><h4>Last</h4></a></li>
    </ul>
	
</body>
</html>