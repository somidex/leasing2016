<?php include 'hero/generic.php'; ?>

<div>
	<div class="container">
		<div class="row inquiryForm credsLogin">
			<div class="col-md-12" id="login">
				<h2>LOG IN WITH YOUR CREDENTIALS</h2>

				<form action="<?php echo get_site_url(); ?>/secured/property/parking-application" id="credsForm" role="form">

					<div class="row">
						<div class="col-md-5 col-sm-5">
							<div class="form-group">
								<label for="">Select Request Type</label>
								<select name="appType" id="appType" class="form-control">
									<option value="">Select One</option>
									<option value="1">Parking Space Application</option>
									<option value="2">Events Rental Request</option>
								</select>
							</div>
						</div>
						<div class="col-md-5 col-sm-5">
							<div class="form-group">
								<label for="">Application Reference Number</label>
								<input type="text" name="refNum" id="refNum" class="form-control" />
							</div>
						</div>
						<div class="col-md-2 col-sm-2">
							<div class="form-group">
								<a href="" class="btn btn-lg ctaOrange" id="submitCredentials">SUBMIT</a>
							</div>
						</div>
					</div>

				</form>
			</div>
			<div class="col-md-12" id="detailsPage"></div>
		</div>
	</div>
</div>