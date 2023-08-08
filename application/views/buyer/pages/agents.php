	
	<style>
		#getagentsTbl_length select{
			border: 1px solid #999999!important;
		}

		@media (max-width:1200px){
			.search-buttons{
				padding: 0px!important;
			}
		}

		.bgsuccess{
		  color: #089A41 !important;
		}
	</style>
	<div class="card">
		<div class="card-header header-elements-inline">
			<h3 class="card-title"><span class="icon-co-big orange list"></span> Agents on Cortiam</h3>
			<div class="header-elements">
				<a href="#" class="dofullscreen"><span class="icon-co-big expand"></span></a>
			</div>
		</div>

	  <div class="card-body">

	  		<div class="row mb-3">
				<div class="col-sm-6 col-md-3">
					<select id="state"  name="state" class="form-control setStateEmpty">

					</select>
				</div>
				<div class="col-sm-6 col-md-3">
					<select id="city"  name="city" class="form-control setCityEmpty">
							
					</select>
				</div>
				<div class="col-sm-6 col-md-3">
					<input type="text" id="zip" name="zip" class="form-control" placeholder="Enter zip code"/>
				</div>

				<div class="col-sm-6 col-md-3 text-center search-buttons">
					<a href="javascript:void(0);" id="search" class="btn btn-success mt-1">Search</a>
					<a href="javascript:void(0);" id="cancel" class="btn btn-danger  mt-1">Cancel</a>

				</div>

			</div>
			<div class="row">
	          
			  <div class="table-responsive">

					<table class="table" id="getagentsTbl">
						<thead class="thead-dark">
							<tr>
								<th style="width: 30%;" >Image</th>
								<th style="width: 30%;" >Name</th>
								<th style="width: 30%;" >Email</th>
								<th style="width: 30%;" >Location</th>
								<th style="width: 30%;" >Zip</th>
								<th style="width: 30%;" >Action</th>
							</tr>						
						</thead>					
					</table>
			  </div>	
		
	  		</div>
		</div>
	</div>	
