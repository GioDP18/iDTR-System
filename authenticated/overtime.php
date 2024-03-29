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
								<h2 class="text-white pb-2 fw-bold">Daily Time Log: <span class="ml-2">Overtime</span></h2>
							</div>
							<div class="d-flex" style="gap:7px;">
								<?php if($overtime_status == 0): ?>
								<div>
									<button class="log bg-success" onclick="handleOvertimeStart(<?= $intern_id ?>, '<?= $currentTime ?>', '<?= $currentDate ?>', '<?= $formattedCurrentTime ?>')">
										<span><i class="fas fa-clock"></i> Start Overtime</span>
									</button>
								</div>
								<?php else: ?>
								<div>
									<button class="log bg-danger" onclick="handleOvertimeStop(<?= $intern_id ?>, '<?= $currentTime ?>', '<?= $currentDate ?>', '<?= $formattedCurrentTime ?>')">
										<span><i class="fas fa-clock"></i> Stop Overtime</span>
									</button>
								</div>
								<?php endif; ?>
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
											<th>Time Started</th>
											<th>Time Ended</th>
											<th>Overtime Duration</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$fetchMyTimeLogQuesry = "SELECT * FROM `daily_time_records` WHERE intern_id = '$intern_id' AND overtime_start IS NOT NULL ORDER BY date DESC";
											$result = $db->conn->query($fetchMyTimeLogQuesry);
											if ($result->num_rows > 0):
												// output data of each row
												while($row = $result->fetch_assoc()):
										?>
										<tr>
											<td><?= date_create($row['date'])->format('M d, Y') ?></td>
											<td><?= $row['overtime_start'] ? date_create($row['overtime_start'])->format('h:i A'):''; ?></td>
											<td><?= $row['overtime_end'] ? date_create($row['overtime_end'])->format('h:i A'):''; ?></td>
											<td><?= $row['overtime_duration']; ?></td>
										</tr>
										<?php endwhile; else: ?>
										<tr>
											<td class="text-center" colspan="6">No Overtime Log.</td>
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

	let intervalId;

	function showNotification(title, options) {
		// Check if the browser supports notifications
		if (!('Notification' in window)) {
			console.error('This browser does not support system notifications.');
			return;
		}

		// Check notification permission
		Notification.requestPermission().then(function (permission) {
			console.log('Notification Permission:', permission);

			if (permission === 'granted') {
				// Create a notification
				const notification = new Notification(title, options);
			} else {
				console.error('Permission for notifications denied by user.');
			}
		});
	}

	function startOvertimer() {
		console.log('Overtime Started');
		const startTime = Date.now();
		const options = {
			body: 'The overtime timer has started.',
		};

		showNotification('Overtime Started', options);

		// Schedule notifications every hour
		intervalId = setInterval(function () {
			const elapsedTime = (Date.now() - startTime) / 1000;
			const hours = Math.floor(elapsedTime / 3600);
			const minutes = Math.floor((elapsedTime % 3600) / 60);

			const timerOptions = {
				body: `Elapsed Time: ${hours} hours and ${minutes} minutes.`,
			};

			showNotification('Overtime Reminder', timerOptions);
		}, 60000);
	}

	function stopOvertimer() {
		clearInterval(intervalId);
		console.log('Interval cleared');
		showNotification('Overtime Stopped');
	}

	function startOvertime(intern_id, time, date, formattedCurrentTime){
		$.ajax({
			url: '../backend/API.php?f=start_overtime',
			method: 'POST',
			data: {
				intern_id: intern_id,
				time: time,
				date: date
			},
			dataType: 'json',
			success: function(response) {
				if(response.success == true){
					startOvertimer()
					swal({
						title: "Overtime Started!",
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

	function stopOvertime(intern_id, time, date, formattedCurrentTime){
		$.ajax({
			url: '../backend/API.php?f=stop_overtime',
			method: 'POST',
			data: {
				intern_id: intern_id,
				time: time,
				date: date
			},
			dataType: 'json',
			success: function(response) {
				if(response.success == true){
					stopOvertimer()
					swal({
						title: "Overtime Recoded",
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


	function handleOvertimeStart(intern_id, time, date, formattedCurrentTime){
		swal({
			title: "Please confirm to start your overtime",
			text: "Time check: " + formattedCurrentTime,
			icon: "warning",
			buttons: {
				cancel: "Cancel",
				confirm: "Confirm",
			},
		})
		.then((willDelete) => {
			if (willDelete) {
				startOvertime(intern_id, time, date, formattedCurrentTime);
			}
		});
	}

	function handleOvertimeStop(intern_id, time, date, formattedCurrentTime){
		swal({
			title: "Please Confirm Your Time out",
			text: "Time check: " + formattedCurrentTime,
			icon: "warning",
			buttons: {
				cancel: "Cancel",
				confirm: "Confirm",
			},
		})
		.then((willDelete) => {
			if (willDelete) {
				stopOvertime(intern_id, time, date, formattedCurrentTime);
			}
		});
	}
</script>

<?php require_once('../inc/footer.php'); ?>