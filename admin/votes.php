<?php require 'includes/session.php'; ?>
<?php require 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

	<?php require 'includes/navbar.php'; ?>
	<?php require 'includes/menubar.php'; ?>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Votes
		</h1>
		<ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active">Votes</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<?php
		if ( isset( $_SESSION['error'] ) ) {
			echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . '
            </div>
          ';
			unset( $_SESSION['error'] );
		}
		if ( isset( $_SESSION['success'] ) ) {
			echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . '
            </div>
          ';
			unset( $_SESSION['success'] );
		}
		?>
		<div class="row">
		<div class="col-xs-12">
			<div class="box">
			<div class="box-header with-border">
				<a href="#reset" data-toggle="modal" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</a>
			</div>
			<div class="box-body">
				<table id="example1" class="table table-bordered">
				<thead>
					<th class="hidden"></th>
					<th>Position</th>
					<th>Candidate</th>
					<th>Votes</th>
				</thead>
				<tbody>
					<?php
					$sql = 'SELECT positions.description AS pos_desc, 
               candidates.firstname AS canfirst, candidates.lastname AS canlast, 
               COUNT(votes.id) AS vote_count 
                FROM positions
                LEFT JOIN candidates ON positions.id = candidates.position_id
                LEFT JOIN votes ON candidates.id = votes.candidate_id
                GROUP BY positions.id, candidates.id
                ORDER BY positions.priority ASC, canlast ASC, canfirst ASC';

					$query = $conn->query( $sql );

					while ( $row = $query->fetch_assoc() ) {
						echo "
                      <tr>
                          <td class='hidden'></td>
                          <td>" . $row['pos_desc'] . '</td>
                          <td>' . $row['canfirst'] . ' ' . $row['canlast'] . '</td>
                          <td>' . $row['vote_count'] . '</td>
                      </tr>
                      ';
					}

					?>
				</tbody>
				</table>
			</div>
			</div>
		</div>
		</div>
	</section>   
	</div>
	
	<?php require 'includes/footer.php'; ?>
	<?php require 'includes/votes_modal.php'; ?>
</div>
<?php require 'includes/scripts.php'; ?>
</body>
</html>
