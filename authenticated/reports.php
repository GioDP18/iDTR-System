<?php require_once('../inc/header.php'); ?>
<style>
.report-card {
	display: flex;
	flex-direction: column;
	isolation: isolate;
	position: relative;
	width: 18rem;
	height: 8rem;
	background: #29292c;
	border-radius: 1rem;
	overflow: hidden;
	font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
	font-size: 16px;
	--gradient: linear-gradient(to bottom, #2eadff, #3d83ff, #7e61ff);
	--color: white
}

.report-card:before {
	position: absolute;
	content: "";
	inset: 0.0625rem;
	border-radius: 0.9375rem;
	background-image: url('../assets//img/report-card-bg.png');
	background-size: cover;
	z-index: 2
}

.report-card:after {
	position: absolute;
	content: "";
	width: 0.25rem;
	inset: 0.65rem auto 0.65rem 0.5rem;
	border-radius: 0.125rem;
	background: var(--gradient);
	transition: transform 300ms ease;
	z-index: 4;
}

.report-card:hover:after {
  	transform: translateX(0.15rem)
}

.report-title {
	color: var(--color);
	padding: 0.65rem 0.25rem 0.4rem 1.25rem;
	font-weight: 500;
	font-size: 1.1rem;
	transition: transform 300ms ease;
	z-index: 5;
}

.report-card:hover .report-title {
  	transform: translateX(0.15rem)
}

.report-content {
	color: white;
	padding: 0 1.25rem;
	transition: transform 300ms ease;
	z-index: 5;
}

.report-card:hover .report-content {
  	transform: translateX(0.25rem)
}

.report-glow, .report-border-glow {
	position: absolute;
	width: 20rem;
	height: 20rem;
	transform: translate(-50%, -50%);
	background: radial-gradient(circle closest-side at center, white, transparent);
	opacity: 0;
	transition: opacity 300ms ease;
}

.report-glow {
  	z-index: 3;
}

.report-border-glow {
 	z-index: 1;
}

.report-card:hover .report-glow {
 	opacity: 0.1
}

.report-card:hover .report-border-glow {
  	opacity: 0.1
}

.note {
	color: var(--color);
	position: fixed;
	top: 80%;
	left: 50%;
	transform: translateX(-50%);
	text-align: center;
	font-size: 0.9rem;
	width: 75%;
}

.create-report-btn {
	--bezier: cubic-bezier(0.22, 0.61, 0.36, 1);
	--edge-light: hsla(0, 0%, 50%, 0.8);
	--text-light: rgba(255, 255, 255, 0.4);
	--back-color: 240, 40%;

	cursor: pointer;
	padding: 0.7em 1em;
	border-radius: 0.5em;
	min-height: 2.4em;
	min-width: 3em;
	display: flex;
	align-items: center;
	gap: 0.5em;

	font-size: 15px;
	letter-spacing: 0.05em;
	line-height: 1;
	font-weight: bold;

	background-color: #2885ff;
	color: hsla(0, 0%, 90%);
	border: 0;
	box-shadow: inset 0.4px 1px 4px var(--edge-light);

	transition: all 0.1s var(--bezier);
}

.create-report-btn:hover {
	--edge-light: hsla(0, 0%, 50%, 1);
	text-shadow: 0px 0px 10px var(--text-light);
	box-shadow: inset 0.4px 1px 4px var(--edge-light),
		2px 4px 8px hsla(0, 0%, 0%, 0.295);
	transform: scale(1.1);
}

.create-report-btn:active {
	--text-light: rgba(255, 255, 255, 1);

	background: linear-gradient(
		140deg,
		hsla(var(--back-color), 50%, 1) min(2em, 20%),
		hsla(var(--back-color), 50%, 0.6) min(8em, 100%)
	);
	box-shadow: inset 0.4px 1px 8px var(--edge-light),
		0px 0px 8px hsla(var(--back-color), 50%, 0.6);
	text-shadow: 0px 0px 20px var(--text-light);
	color: hsla(0, 0%, 100%, 1);
	letter-spacing: 0.1em;
	transform: scale(1);
}

#closeCreateModal{
	border: 1px solid #6910a0;
	color: #6910a0;
}

#closeCreateModal:hover{
	background-color: #6910a0;
	color: white;
	border: 1px solid white;
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
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row" style="justify-content:space-between;">
							<div>
								<h2 class="text-white pb-2 fw-bold">Reports</h2>
							</div>
							<div>
								<button class="create-report-btn" data-bs-toggle="modal" data-bs-target="#createNewReport"><i class="fas fa-pen"></i> Create New Report </button>
							</div>
						</div>
					</div>
				</div>

				<!-- Modal -->
				<div class="modal fade" id="createNewReport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog">
						<form action="">
							<div class="modal-content">
								<div class="modal-header">
									<h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="fa-solid fa-pen-to-square"></i> Create New report</h1>
								</div>
								<div class="modal-body">
									<div class="mb-3">
										<label for="reportTitle" class="form-label">Title</label>
										<input type="email" class="form-control" id="reportTitle" placeholder="What's your title?">
									</div>
									<div class="mb-3">
										<label for="reportContent" class="form-label">Content</label>
										<textarea class="form-control" id="reportContent" rows="3"></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn" style="background-color:#6910A0; color:white;" onclick="saveNewReport(event, <?= $intern_id ?>)">Save</button>
									<button type="button" class="btn" id="closeCreateModal" data-bs-dismiss="modal">Close</button>
								</div>
							</div>
						</form>
						
					</div>
				</div>

				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-12">
							<div class="card full-height d-flex p-2" style="margin:0; height:auto; flex-direction:row; gap:17px; overflow-x:auto;">
								<!-- WEEK 1 -->
								<div class="weekly-report">
									<h5 class="text-center fw-bold mt-2">Week 1</h5>
									<div class="card-body" style="margin:-.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">January 21, 2024</div>
											<div class="report-content">Title</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<h5 class="text-center fw-bold mt-1">Week 1</h5>
								</div>

								<!-- WEEK 2 -->
								<div class="weekly-report">
									<h5 class="text-center fw-bold mt-2">Week 2</h5>
									<div class="card-body" style="margin:-.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<h5 class="text-center fw-bold mt-1">Week 2</h5>
								</div>

								<!-- WEEK 3 -->
								<div class="weekly-report">
									<h5 class="text-center fw-bold mt-2">Week 3</h5>
									<div class="card-body" style="margin:-.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<h5 class="text-center fw-bold mt-1">Week 3</h5>
								</div>

								<!-- WEEK 4 -->
								<div class="weekly-report">
									<h5 class="text-center fw-bold mt-2">Week 4</h5>
									<div class="card-body" style="margin:-.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<div class="card-body" style="margin: -.5rem 0">
										<div class="report-card">
											<div class="report-glow"></div>
											<div class="report-border-glow"></div>
											<div class="report-title">Welcome To Uiverse</div>
											<div class="report-content">Contribute to Open Source UI Elements</div>
										</div>
									</div>
									<h5 class="text-center fw-bold mt-1">Week 4</h5>
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

<script>
	// window.onload = function(){

	// }


	function saveNewReport(event, intern_id){
		event.preventDefault();
		$('#createNewReport').modal('hide');
		$.ajax({
			url: '../backend/API.php?f=create_new_report',
			method: 'POST',
			data: {
				intern_id: intern_id,
			    report_title: $('#reportTitle').val(),
				report_content: $('#reportContent').val()
			},
			dataType: 'json',
			success: function(response) {
				if(response.success == true){
					swal({
						title: "Successfully Created your Report!",
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
</script>
<?php require_once('../inc/footer.php'); ?>