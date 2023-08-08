<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<main role="main">
	<div class="findagent jumbotron jumbotron-fluid mb-0 success-container">
	  <div class="container">
		  <h1 class="headline thank-you">Thank You For Joining Cortiam</h1>
	  </div>
	</div>
	<div class="signup-content thankyou text-center">
	  <div class="container">
			<div class="row px-5 success-row">
			  <div class="col-md-8 offset-md-2">
					<p class="mb-3">Your registration has been submitted successfully. Your account is availabile and full access will be activated once validated by Cortiam. </p>
					<p><a href="javascript:void(0);" data-toggle="modal" data-target="#myModal">Resend Email Verification </a></p>
					<p><br><a href="<?php echo base_url('login');?>" class="button-orange">LOGIN</a></p>
			  </div>
		  </div>
  	</div>
	</div>
</main>



<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
		  <h4 class="modal-title">Email Verification</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
			<center>
				<p>We have sent you an email that contain a link  to complete your registration</p>
				<p>Pleae check your spam inbox, you can't find the email, we can send it</p>
				<a href="javascript:void(0);" class="btn btn-primary btn-lg resend-email" data-toggle="modal" data-target="#myModal" data-url="<?php echo base_url('ajax/resend-email');?>">Resend Email</a>
			</center>
        </div>
        <div class="modal-footer">
          <a type="button" class="btn btn-primary text-white" data-dismiss="modal">Close</a>
        </div>
      </div>

    </div>
  </div>

