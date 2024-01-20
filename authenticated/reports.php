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
								<h2 class="text-white pb-2 fw-bold">Reports</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-12">
							<div class="card full-height">
								<div class="card-body">
									<?php
										echo $_SESSION['firstname'];
										echo $_SESSION['lastname'];
										echo $_SESSION['gender'];
										echo $_SESSION['birthdate'];
									?>
								</div>
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

<?php require_once('../inc/footer.php'); ?>