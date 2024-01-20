<?php require_once('../inc/header.php'); ?>

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
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Dashboard</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title" style="font-weight:bold;">Completed Hours</div>
									<div class="d-flex flex-wrap justify-content-between pb-2 pt-4" style="position:relative; align-items:center">
										<div>
											<i class="fas fa-hourglass-end" style="font-size:6rem; color:#0ea511; opacity:70%"></i>
										</div>
										<div>
											<h1><?= $completed_hours ?></h1>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title" style="font-weight:bold;">Remaining Hours</div>
									<div class="d-flex flex-wrap justify-content-between pb-2 pt-4" style="position:relative; align-items:center">
										<div>
											<i class="fas fa-hourglass-end text-danger" style="font-size:6rem; transform:rotate(180deg); opacity:70%"></i>
										</div>
										<div>
											<h1><?= $remaining_hours ?></h1>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row d-flex mt-3" style="flex-direction:column;">
						<div>
							<h2 class="fw-bold">Status:</h2>
						</div>
						<div class="d-flex" style="align-items:center; margin-left:4.5rem;">
						<?php if($status == 0):?>
							<p style="width:2rem; height:1rem; background-color:#ef2121;"></p>
						<?php elseif($status == 1):?>
							<p style="width:2rem; height:1rem; background-color:#00ba00;"></p>
						<?php endif;?>
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

<?php require_once('../inc/footer.php'); ?>