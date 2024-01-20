<?php require_once('../inc/header.php'); ?>
<style>
	.log {
		font-size: 17px;
		border-radius: 12px;
		color: rgb(218, 218, 218);
		border: none;
		padding: 2px;
		font-weight: 700;
		cursor: pointer;
		position: relative;
		overflow: hidden;
		transition: all 0.4s;
	}

	.log span {
		border-radius: 10px;
		padding: 5px 15px;
		text-shadow: 0px 0px 20px #4b4b4b;
		width: 100%;
		display: flex;
		align-items: center;
		gap: 12px;
		color: inherit;
		transition: all 0.4s;
	}
</style>
<!-- Content -->
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<?php require_once('../inc/logo-header.php'); ?>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<?php require_once('../inc/nav-header.php'); ?>
			<!-- End Navbar Header -->
		</div>

		<!-- Sidebar -->
		<?php require_once('../inc/nav-sidebar.php'); ?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex justify-content-between align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Daily Time Log: <span class="ml-2">A.M.</span></h2>
							</div>
							<div class="d-flex" style="gap:7px;">
								<div>
									<button class="log bg-success" onclick="handleTimeIn(<?= $intern_id ?>, '<?= $currentTime ?>', '<?= $currentDate ?>', '<?= $formattedCurrentTime ?>')">
										<span><i class="fas fa-clock"></i> Time-In</span>
									</button>
								</div>
								<div>
									<button class="log bg-danger" onclick="handleTimeOut(<?= $intern_id ?>, '<?= $currentTime ?>', '<?= $currentDate ?>', '<?= $formattedCurrentTime ?>')">
										<span><i class="fas fa-clock"></i> Time-Out</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="card bg-light" style="border-radius:10px;">
						<div class="card-body">
							<div class="table-responsive">
								<table id="dailyTimeLog" class="table table-striped table-hover" style="width:100%;">
									<thead>
										<tr>
											<th>Date</th>
											<th>Arrival</th>
											<th>Departure</th>
											<th>Hours Late</th>
											<th>Minutes Late</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$fetchMyTimeLogQuesry = "SELECT * FROM `daily_time_records` WHERE intern_id = '$intern_id' ORDER BY date DESC";
											$result = $db->conn->query($fetchMyTimeLogQuesry);
											if ($result->num_rows > 0):
												// output data of each row
												while($row = $result->fetch_assoc()):
										?>
										<tr>
											<td><?= date_create($row['date'])->format('M d, Y') ?></td>
											<td><?= date_create($row['arrival_am'])->format('h:i A'); ?></td>
											<td><?= $row['departure_am'] ? date_create($row['departure_am'])->format('h:i A'):''; ?></td>
											<td><?= $row['hours_late_am'] ?></td>
											<td><?= $row['minutes_late_am'] ?></td>
										</tr>
										<?php endwhile; else: ?>
										<tr>
											<td class="text-center" colspan="5">No Time Log.</td>
										</tr>
										<?php endif;?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container-fluid">			
				</div>
			</footer>
		</div>
		
		<!-- Custom Color  -->
		<?php require_once('../inc/custom-color.php'); ?>
		<!-- End Custom Color -->
	</div>
<!-- End of Content -->
<script>
	$(document).ready(function() {
		$('#dailyTimeLog').DataTable({
			});
	})

	function time_in_am(intern_id, time, date, formattedCurrentTime){
		$.ajax({
			url: '../backend/API.php?f=time_in_am',
			method: 'POST',
			data: {
				intern_id: intern_id,
				time: time,
				date: date
			},
			dataType: 'json',
			success: function(response) {
				if(response.success == true){
					swal({
						title: "Time-in Recoded",
						text: "Time check: " + formattedCurrentTime,
						icon: "success",
						button: "Okay",
					});

					setTimeout(function() {
						location.reload();
					}, 3000);
				}
				else{
					console.log(response.message)
					swal({
						title: response.message,
						icon: "error",
						button: "Okay",
					});

					setTimeout(function() {
						
					}, 3000);
				}
			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
			}
		});
	}

	function time_out_am(intern_id, time, date, formattedCurrentTime){
		$.ajax({
			url: '../backend/API.php?f=time_out_am',
			method: 'POST',
			data: {
				intern_id: intern_id,
				time: time,
				date: date
			},
			dataType: 'json',
			success: function(response) {
				if(response.success == true){
					swal({
						title: "Time-out Recoded",
						text: "Time check: " + formattedCurrentTime,
						icon: "success",
						button: "Okay",
					});

					setTimeout(function() {
						location.reload();
					}, 3000);
				}
				else{
					console.log(response.message)
					swal({
						title: response.message,
						icon: "error",
						button: "Okay",
					});

					setTimeout(function() {
						
					}, 3000);
				}
			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
			}
		});
	}


	function handleTimeIn(intern_id, time, date, formattedCurrentTime){
		swal({
			title: "Please Confirm Your Time in",
			icon: "warning",
			buttons: {
				cancel: "Cancel",
				confirm: "Confirm",
			},
		})
		.then((willDelete) => {
			if (willDelete) {
				time_in_am(intern_id, time, date, formattedCurrentTime);
			}
		});
	}

	function handleTimeOut(intern_id, time, date, formattedCurrentTime){
		swal({
			title: "Please Confirm Your Time out",
			icon: "warning",
			buttons: {
				cancel: "Cancel",
				confirm: "Confirm",
			},
		})
		.then((willDelete) => {
			if (willDelete) {
				time_out_am(intern_id, time, date, formattedCurrentTime);
			}
		});
	}
</script>

<?php require_once('../inc/footer.php'); ?>