<?php
include "retrieve.php";
$success = $_GET['success'] ?? null;
$error = $_GET['error'] ?? null;
?>
<!doctype html>
<html lang="en">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<title>PDC10 Registrations</title>
<style>
    body {
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-responsive {
        margin: 50px 0;
    }
	.table-wrapper {
		min-width: 1000px;
    background: #fff;
    padding: 20px 25px;
		border-radius: 3px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		background: #FCC89B;
		color: #FF5FA2;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
  table.table tr th, table.table tr td {
    border-color: #e9e9e9;
		vertical-align: middle;
  }
	table.table tr th:last-child {
		width: 200px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
	table.table td a:hover {
		color: #2196F3;
	}

</style>

</head>

<body>
<div class="container-sm">

  <?php if (!is_null($success)): ?>
  <div class="alert alert-success" role="alert">
    Your registration has been successfully completed.
  </div>
  <?php endif ?>

  <?php if (!is_null($error)): ?>
  <div class="alert alert-danger" role="alert">
    Failed to upload file; the format is not supported.
  </div>
  <?php endif ?>

  <div class="container">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-xs-6">
							<h2><b>Registrations</b></h2>
						</div>
						<div class="col-xs-6">
            <form method="POST" action="register.php">
              <button class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Registration</span></a>
            </form>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<thead>
						<tr>
            <th scope="col">ID</th>
            <th scope="col">Complete Name</th>
            <th scope="col">Email</th>
            <th scope="col">Picture</th>
            <th scope="col">Registered Date</th>
						</tr>
					</thead>
					<tbody>
              <?php
                  $retrieve = new Retrieve;
                  $retrieveData = $retrieve->retrieveData();
                  foreach($retrieveData as $data){
              ?>
                  <tr>
                  <th scope="row"><?php echo $data['id']?></th>
                  <td><?php echo $data['complete_name']?></td>
                  <td><?php echo $data['email']?></td>
                  <td><?php echo "<img width=100px; height=100px; src=" . $data['picture_path'] . ">";?></td>
                  <td><?php echo $data['registered_at']?></td>
                  </tr>
              <?php } ?>				
					</tbody>
				</table>
      </div>

</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
-->
</body>
</html>