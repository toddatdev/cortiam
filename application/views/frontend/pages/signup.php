<style>
    @media only screen and (min-width: 1200px){
        .findagent.jumbotron{
            padding: 9.2rem 2rem 4rem 2rem !important;        
        }
    }
    @media only screen and (min-width: 991px) and (max-width: 1200px){
        .findagent.jumbotron{
            padding: 4.1rem 2rem 7rem 2rem !important;       
        }
    }
    @media only screen and (max-width: 430px){
        .findagent.jumbotron {
            padding: 4rem 0rem 4rem 0rem !important;
        }
    }
    @media only screen and (max-width: 576px){
        .findagent.jumbotron {
            padding: 4rem 2rem 4.6rem 1rem !important;
        }
    }
    @media only screen and (max-width: 767px){
        .findagent.jumbotron {
            padding: 2rem 2rem 5.8em 2rem !important;
        }
    }



</style>
<main role="main">
	<div class="findagent jumbotron jumbotron-fluid mb-0">
	  <div class="container">
			<div class="row">
			  <div class="col-md-6 offset-md-3">
					<h1 class="headline">Get Started</h1>
                  <br>
			  </div>
			  <div class="col-md-6 my-3 my-md-0">
			  	<a class="button-orange" href="<?php echo base_url('sign-up-customer');?>" role="button" style="width: 350px">CUSTOMER</a>
			  </div>
			  <div class="col-md-6">
			  	<a class="button-orange" href="<?php echo base_url('sign-up-agent');?>" role="button" style="width: 350px">REAL ESTATE AGENT</a>
			  </div>
		  </div>
	  </div>
	</div>
</main>
