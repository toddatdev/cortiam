		   	</div>
			</div>
		</div>
	</main>

		<!--begin Page Scripts -->
    <?php if (isset($footer_data['js_files'])) { echo "\n\t<script src=\"".implode("\"></script>\n\t<script src=\"",$footer_data['js_files'])."\"></script>\n";}?>
		<!--end Page Scripts -->
	</body>

	<!-- end Body -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCywz554GE2hipurlh2Yoc0XRhh7Ut3_3k&libraries=places"></script>

	<script>
        var input = document.getElementById('address');
	var brokerage_address = document.getElementById('brokerage_address');
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


    if(input !== '')
	{
    	google.maps.event.addDomListener(window, 'load', initialize);
	}

	if(brokerage_address !== '')
	{
		google.maps.event.addDomListener(window, 'load', brokerage);

	}

	function brokerage()
	{

		var autocomplete = new google.maps.places.Autocomplete(brokerage_address, options);

  		autocomplete.addListener('place_changed', function () {


  			var place = autocomplete.getPlace();
            let placesLength = place.address_components;

			// let city = '';
			// let state = '';
			// let zipCode = '';

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

			// for (let index = 0; index < placesLength.length; index++)
			// {
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
				// console.log(arrayOfCities);
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

				if(city !== '')
				{

					$('#brokerage_city').val(getCity[0]).trigger('change');

				}else{
					jQuery('#brokerage_city').select2({
							data:  _cities_[statesArray[0]],
							placeholder: 'Select a City',
							allowClear: true
						});
				}

  		});

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


			jQuery('#state').select2({
		 		 	data:  oldStates,
		  			placeholder: 'Select a City',
		  			allowClear: true
	  			});

		statesArray = [];
		cityArray   = [];
		// zipCode     = '';


		// for (let index = 0; index < placesLength.length; index++) {
		//   let element = placesLength[index]['long_name'];
        //
		//   if( $.isNumeric(element))
		//   {
		// 	  zipCode    = element;
		//   }

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
			// 			city = arrayOfCities[i];
			// 		}
			// 	}
			// }

		  //return results;

	  // }


	  if(zipCode !== '')
	  {
		  $('#zipcode').val(zipCode);
	  }

	  if(statesArray.length > 0)
	  {
		  $('#state').val(statesArray).trigger('change');

		  $("#city").select2("destroy").select2();

		  getCity = _cities_[statesArray[0]];

			if(city !== '')
			{
				getCity.unshift(city);
			}


		  jQuery('#city').select2({
			data: getCity,

			  placeholder: 'Select a State',
			  allowClear: true
		  });
	  }


	  $('#address').val(`${streetNumber}  ${route}`);

	  if(city !== '')
	  {

		  $('#city').val(city).trigger('change');

	  }else{
		  jQuery('#city').select2({
				data:  _cities_[statesArray[0]],
				placeholder: 'Select a City',
				allowClear: true
			});
	  }



  });

      //State 



}


var autocomplete = new google.maps.places.Autocomplete(input, options);
    autocomplete.addListener('place_changed', function () {

        var place = autocomplete.getPlace();


        //json = JSON.stringify(place, true);
        let placesLength = place.address_components;

        $('#premiumSearchQuerystate').select2("destroy").select2();
        $('#premiumSearchQuerycity').select2("destroy").select2();

        $('#premiumSearchQuerystate').empty();
        $('#premiumSearchQuerycity').empty();

        $('#premiumSearchQueryzipcode').val('');


        jQuery('#premiumSearchQuerystate').select2({
            data:  oldStates,
            placeholder: 'Select a City',
            allowClear: true
        });

        statesArray = [];
        cityArray   = [];
        // zipCode     = '';
        // city        = '';
        // for (let index = 0; index < placesLength.length; index++) {
        //     let element = placesLength[index]['long_name'];
        //
        //     if( $.isNumeric(element))
        //     {
        //         zipCode    = element;
        //     }


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
            //     for (var i = 0; i < arrayOfCities.length; i++)
            //     {
            //
            //         console.log(element);
            //         findstring = element.split(" ");
            //         if (arrayOfCities[i].match(findstring[0]))
            //         {
            //             city = arrayOfCities[i];
            //         }
            //     }
            // }

            //return results;

        // }



        if(zipCode !== '')
        {
            $('#premiumSearchQueryzipcode').val(zipCode);
        }

        if(statesArray.length > 0)
        {
            $('#premiumSearchQuerystate').val(statesArray).trigger('change');

            $("#premiumSearchQuerycity").select2("destroy").select2();

            getCity = _cities_[statesArray[0]];

            if(city !== '')
            {
                getCity.unshift(city);
            }


            jQuery('#premiumSearchQuerycity').select2({
                data: getCity,

                placeholder: 'Select a State',
                allowClear: true
            });
        }

        if(city !== '')
        {

            $('#premiumSearchQuerycity').val(getCity[0]).trigger('change');

        }else{
            jQuery('#premiumSearchQuerycity').select2({
                data:  _cities_[statesArray[0]],
                placeholder: 'Select a City',
                allowClear: true
            });
        }



    });


jQuery('#state').select2({
	data: _states_,
  placeholder: 'Select a State',
  allowClear: true
});

jQuery('#premiumSearchQuerystate').select2({
	data: _states_,
  placeholder: 'Select a State',
  allowClear: true
});


jQuery('#city').select2({
	placeholder: 'Select a City',
	allowClear: true
});

jQuery('#state').on('select2:select', function (e) {

  var selected_state = e.params.data;




  $.ajax({
        url: "agent/ajax/get-all-cities",
        type: "POST",
        dataType: "json",
        data: {
            cache: false,
            id: $(this).val()
        },
        success: function (dataResult) {
            let data = [];
            // $('#query_value_city').val("information").trigger('change');             
            // Append it to the select
			$('#city').select2('destroy');
			$('#city').select2();

            if(dataResult)
            {
                $("#city").html("");
                
                for (let index = 0; index <dataResult.length; index++)
                {
                    var newOption = new Option(dataResult[index].city_name, dataResult[index].city_name, true, true);
                    $('#city').append(newOption).trigger('change');

                }

            }
        }
    });
});

// jQuery('#city').select2({
// 	data:  _cities_[''+jQuery('#state').val()+''],
// 	placeholder: 'Select a City',
// 	allowClear: true
// });



jQuery('#premiumSearchQuerystate').on('select2:select', function (e) {
  var selected_state = e.params.data;
	jQuery('#premiumSearchQuerycity').select2({
		data: _cities_[selected_state.id],
		placeholder: 'Select a City',
	  //   selected:"Florida",
		allowClear: true
  });
});

jQuery('#premiumSearchQuerycity').select2({
	data:  _cities_[''+jQuery('#premiumSearchQuerystate').val()+''],
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
  $.ajax({
        url: "agent/ajax/get-all-cities",
        type: "POST",
        dataType: "json",
        data: {
            cache: false,
            id: $(this).val()
        },
        success: function (dataResult) {
            let data = [];
            // $('#query_value_city').val("information").trigger('change');             
            // Append it to the select
			$('#brokerage_city').select2('destroy');
			$('#brokerage_city').select2();

            if(dataResult)
            {
                $("#brokerage_city").html("");
                
                for (let index = 0; index <dataResult.length; index++)
                {
                    var newOption = new Option(dataResult[index].city_name, dataResult[index].city_name, true, true);
                    $('#brokerage_city').append(newOption).trigger('change');

                }

            }
        }
    });
});

jQuery('#brokerage_city').select2({
	data:  _cities_[''+jQuery('#state').val()+''],
	placeholder: 'Select a City',
	allowClear: true
});

</script>



<div id="avatarmodal" class="modal fade" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title text-center">Edit Your Photo</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="image-cropper-container mb-3 photocropwrap">
					<img src="<?php echo base_url('assets/images/backend/placeholder.png');?>" alt="" class="cropper" id="avatar-cropper-image">
				</div>
				<div class="form-group avatar-cropper-toolbar mb-0">
					<div class="btn-group btn-group-justified d-flex rounded orange-bg">
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="setDragMode" data-option="move" title="Move">
								<span class="icon-co-big white move"></span>
							</button>
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="setDragMode" data-option="crop" title="Crop">
								<span class="icon-co-big white crop"></span>
							</button>
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="zoom" data-option="0.1" title="Zoom In">
								<span class="icon-co-big white zoomin"></span>
							</button>
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="zoom" data-option="-0.1" title="Zoom Out">
								<span class="icon-co-big white zoomout"></span>
							</button>
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="rotate" data-option="-45" title="Rotate Left">
								<span class="icon-co-big white rotateleft"></span>
							</button>
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="rotate" data-option="45" title="Rotate Right">
								<span class="icon-co-big white rotateright"></span>
							</button>
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="scaleX" data-option="-1" title="Flip Horizontal">
								<span class="icon-co-big white fliph"></span>
							</button>
							<button type="button" class="btn bg-orange-700 btn-icon" data-method="scaleY" data-option="-1" title="Flip Vertical">
								<span class="icon-co-big white flipv"></span>
							</button>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="button-danger" data-dismiss="modal">Cancel</button>
				<button type="button" class="button-success" id="dophotocrop">Change</button>
			</div>
		</div>
	</div>
</div>

</html>