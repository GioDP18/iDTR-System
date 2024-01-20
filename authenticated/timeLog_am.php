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
									<button class="log bg-success" onclick="time_in_am(<?= $intern_id ?>, '<?= $currentTime ?>', '<?= $currentDate ?>')">
										<span><i class="fas fa-clock"></i> Time-In</span>
									</button>
								</div>
								<div>
									<button class="log bg-danger">
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
							<table id="dailyTimeLog" class="display table table-striped table-hover" >
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
									<tr>
										<td>January 19, 2024</td>
										<td>8:00 AM</td>
										<td>5:00 PM</td>
										<td></td>
										<td>8 Hours</td>
									</tr>
								</tbody>
							</table>
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

	function time_in_am(intern_id, time, date){
		$.ajax({
                url: '../backend/API.php?f=time_in_am',
                method: 'POST',
                data: {
                    intern_id: intern_id,
					time: time,
					date: date
                },
                success: function(response) {
					console.log(response);
                    swal({
                        title: "Time-in Recoded",
 						text: "Time check: " + time,
                        icon: "success",
                        button: "Okay",
                    });

                    setTimeout(function() {
                        location.reload();
                    }, 5000);
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
	}
</script>

<?php require_once('../inc/footer.php'); ?>