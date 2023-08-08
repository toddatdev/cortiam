			</div>
			<!-- /content area -->

			<!-- Footer -->
			<div class="navbar navbar-expand-lg navbar-light">
				<div class="text-center d-lg-none w-100">
					<button type="button" class="navbar-toggler dropdown-toggle" data-toggle="collapse" data-target="#navbar-footer">
						<i class="icon-unfold mr-2"></i>
						Footer
					</button>
				</div>

				<div class="navbar-collapse collapse" id="navbar-footer">
					<span class="navbar-text">
						&copy; <?php echo date('Y');?>. <a href="<?php echo base_url('ct-admin/');?>">Cortiam Administration Panel</a>
					</span>

					<ul class="navbar-nav ml-lg-auto">
					</ul>
				</div>
			</div>
			<!-- /footer -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

		<!--begin Page Scripts -->
    <?php if (isset($footer_data['js_files'])) { echo "\n\t<script src=\"".implode("\"></script>\n\t<script src=\"",$footer_data['js_files'])."\"></script>\n";}?>

	<!-- end Body -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCywz554GE2hipurlh2Yoc0XRhh7Ut3_3k&libraries=places"></script>

<!--            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>-->
<script>	

	// console.log(_states_);

	//console.log(_cities_['Florida']);
    var statesArray = [];
    var cityArray   = [];
    var zipCode     = '';
    var country = '';
    var route = '';
    var state = '';
    var city = '';
    var streetNumber = '';
    var oldStates   = _states_;

    var options = {
        componentRestrictions: { country: 'us' },
        fields: ['address_components', 'geometry'],
        types: ['address']
    };

	var input = document.getElementById('address');
	var brokerage_address = document.getElementById('brokerage_address');

	if(input !== '')
	{
    	google.maps.event.addDomListener(window, 'load', initialize);
	}


	if(brokerage_address !== '')
	{
		google.maps.event.addDomListener(window, 'load', brokerage);

	}



	function initialize() { 

	
		var autocomplete = new google.maps.places.Autocomplete(input, options);
		autocomplete.addListener('place_changed', function () { 
			var place = autocomplete.getPlace();

			//json = JSON.stringify(place, true);
			let placesLength = place.address_components;


			for (const component of place.address_components) {
            // @ts-ignore remove once typings fixed
            const componentType = component.types[0];


                switch (componentType) {
                    case 'street_number': {
                        streetNumber = component.long_name;
                        break;
                    }
                    case 'route': {
                        route = component.long_name;
                        break;
                    }
                    case 'postal_code': {
                        zipCode = component.long_name;
                        break;
                    }
                    case 'postal_code_suffix': {
                        break;
                    }
                    case 'locality':
                        city = component.long_name;
                        break;
                    case 'administrative_area_level_1': {
                        state = component.long_name;

                        break;
                    }
                    case 'country': {
                        country = component.long_name;

                        break;
                    }
                }
		}

			$('#state').select2("destroy").select2();
			$('#city').select2("destroy").select2();

			$('#state').empty();
			$('#city').empty();

			$('#zipcode').val('');

			statesArray = [];
			// zipCode     = '';

			jQuery('#state').select2({
		 		 	data:  oldStates,
		  			placeholder: 'Select a City',
		  			allowClear: true
	  			});


			// for (let index = 0; index < placesLength.length; index++) {
			// 	let element = placesLength[index]['long_name'];
            //
			// 	if( $.isNumeric(element))
			// 	{
			// 		zipCode    = element;
			// 	}

            for (var i = 0; i < oldStates.length; i++)
            {
                if (oldStates[i] === state)
                {
                    statesArray.push(oldStates[i]);
                }
            }
				
				// let arrayOfCities = _cities_[statesArray[0]];
                //
				// if(arrayOfCities)
				// {
				// 	for (var i = 0; i < arrayOfCities.length; i++)
				// 	{
                //
				// 		console.log(element);
				// 		findstring = element.split(" ");
				// 		if (arrayOfCities[i].match(findstring[0]))
				// 		{
				// 			//city = arrayOfCities[i];
				// 		}
				// 	}
				// }

				
				

				//return results;s
			// }


			// alert(_cities_[city]);


			if(zipCode !== '')
			{
				$('#zipcode').val(zipCode);
			}

			if(statesArray.length > 0)
			{
				$('#state').select2("destroy").select2();

				// console.log(oldStates);
				
				jQuery('#state').select2({
		 		 	data:  oldStates,
		  			placeholder: 'Select a City',
		  			allowClear: true
	  			});

				let valArr = statesArray.filter(unique);	 	
			
				jQuery('#state').val(null).trigger("change");
				jQuery('#state').val(valArr[0]).trigger("change");

				$("#city").select2("destroy").select2();

				// let getCity = '';
				
				 getCity = _cities_[statesArray[0]];

				 if(city !== '')
				 {
					getCity.unshift(city);
				 }
				
				//console.log(getCity);

				jQuery('#city').select2({
					data: getCity,
					placeholder: 'Select a State',
					allowClear: true
				});


			}
		
			//console.log(cityArray[0]);

            $('#address').val(`${streetNumber}  ${route}`);


			if(city !== '')
			{	
				
				$('#city').val(city).trigger('change');

			}
            else{
				jQuery('#city').select2({
		 		 	data:  _cities_[statesArray[0]],
		  			placeholder: 'Select a City',
		  			allowClear: true
	  			});
			}



		});

	}



	function brokerage()
	{

		var autocomplete = new google.maps.places.Autocomplete(brokerage_address,options);
  
  		autocomplete.addListener('place_changed', function () {
  			var place = autocomplete.getPlace();
            let placesLength = place.address_components;


			for (const component of place.address_components) {
            // @ts-ignore remove once typings fixed
            const componentType = component.types[0];


                switch (componentType) {
                    case 'street_number': {
                        streetNumber = component.long_name;
                        break;
                    }
                    case 'route': {
                        route = component.long_name;
                        break;
                    }
                    case 'postal_code': {
                        zipCode = component.long_name;
                        break;
                    }
                    case 'postal_code_suffix': {
                        break;
                    }
                    case 'locality':
                        city = component.long_name;
                        break;
                    case 'administrative_area_level_1': {
                        state = component.long_name;

                        break;
                    }
                    case 'country': {
                        country = component.long_name;

                        break;
                    }
                }
		}

		


			
			$('#brokerage_state').select2("destroy").select2();
			$('#brokerage_city').select2("destroy").select2();

			$('#brokerage_state').empty();
			$('#brokerage_city').empty();

			$('#brokerage_zipcode').val('');


			statesArray = [];
			cityArray   = [];
			// zipCode     = '';
			jQuery('#brokerage_state').select2({
		 		 	data:  oldStates,
		  			placeholder: 'Select a City',
		  			allowClear: true
	  			});

			// for (let index = 0; index < placesLength.length; index++) {
			// 	let element = placesLength[index]['long_name'];
            //
			// 	if( $.isNumeric(element))
			// 	{
			// 		zipCode    = element;
			// 	}

            for (var i = 0; i < oldStates.length; i++)
            {
                if (oldStates[i] === state)
                {
                    statesArray.push(oldStates[i]);
                }
            }



            // let arrayOfCities = _cities_[statesArray[0]];
                //
				// if(arrayOfCities)
				// {
				// 	for (var i = 0; i < arrayOfCities.length; i++)
				// 	{	console.log(element);
				// 		findstring = element.split(" ");
				// 		if (arrayOfCities[i].match(findstring[0]))
				// 		{
				// 			//city = arrayOfCities[i];
				// 		}
				// 	}
				// }
			// }

			if(zipCode !== '')
			{
				$('#brokerage_zipcode').val(zipCode);
			}

			if(statesArray.length > 0)
			{
				$('#brokerage_state').val(statesArray).trigger('change');

				$("#brokerage_city").select2("destroy").select2();


				
				getCity = _cities_[statesArray[0]];

				if(city !== '')
				{
					getCity.unshift(city);
				}


				jQuery('#brokerage_city').select2({
					data: getCity,
					placeholder: 'Select a State',
					allowClear: true
				});
			}


			$('#brokerage_address').val(`${streetNumber}  ${route}`);
            // $('#address').val(`${streetNumber}  ${route}`);

				if(city !== '')
				{	
					
					$('#brokerage_city').val(city).trigger('change');

				}
                else{
					jQuery('#brokerage_city').select2({
							data:  _cities_[statesArray[0]],
							placeholder: 'Select a City',
							allowClear: true
						});
				}

  		});
	}


	jQuery('#state').select2({
		  data: oldStates,
		placeholder: 'Select a State',
		allowClear: true
	});

    jQuery('#editstate').select2({
        data: oldStates,
        placeholder: 'Select a State',
        allowClear: true
    });


	jQuery('#state').on('select2:select', function (e) {
		var selected_state = e.params.data;
		  jQuery('#city').select2({
			  data: _cities_[selected_state.id],
			  placeholder: 'Select a City',
			  allowClear: true
        });
    });
  
	  jQuery('#city').select2({
		  data:  _cities_[''+jQuery('#state').val()+''],
		  placeholder: 'Select a City',
		  allowClear: true
	  });




	  jQuery('#brokerage_state').select2({
	data: _states_,
  placeholder: 'Select a State',
  allowClear: true
});


jQuery('#brokerage_state').on('select2:select', function (e) {
  var selected_state = e.params.data;
	jQuery('#brokerage_city').select2({
		data: _cities_[selected_state.id],
		placeholder: 'Select a City',
	  //   selected:"Florida",
		allowClear: true
  });
});

jQuery('#brokerage_city').select2({
	data:  _cities_[''+jQuery('#state').val()+''],
	placeholder: 'Select a City',
	allowClear: true
});
  


	const unique = (value, index, self) => {
 		 return self.indexOf(value) === index
	}

</script>


<script>
	jQuery(document).on('focusout', '#email', function(){
		var base_url = window.location.origin;
    	let email = $(this).val();
		jQuery.ajax({
			type: "post",
			url: base_url+"/ajax/signup-email",
  		    data: { email : email},
			dataType: "json",
			success: function(response){
				if(response.success == "success")
				{
					
					Swal.fire({
						  icon: 'info',
						  title: 'Warning',
						  text: 'Email alrady exist, Please add new one',
						  confirmButtonClass: "btn-danger"
						});


					return false;	
				}					

			}
		});
		
	});
</script>

		<!--end Page Scripts -->
	</body>

	<!-- end Body -->
</html>