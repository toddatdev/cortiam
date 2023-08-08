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
	if(input !== '')
	{
    	google.maps.event.addDomListener(window, 'load', initialize);
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

			// $('#zipcode').val('');

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
            // else{
			// 	jQuery('#city').select2({
		 	// 	 	data:  _cities_[statesArray[0]],
		  	// 		placeholder: 'Select a City',
		  	// 		allowClear: true
	  		// 	});
			// }
		});

	}



	jQuery('#state').select2({
		  data: oldStates,
		placeholder: 'Select a State',
		allowClear: true
	});
    jQuery('#city').select2({
        placeholder: 'Select a State',
        allowClear: true
    });

	jQuery('#state').on('select2:select', function (e) {
		var selected_state = e.params.data;

		$.ajax({
        url: "seller/ajax/get-all-cities",
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

            if(dataResult)
            {
                $("#city").html("");

                jQuery('#city').select2({
                    placeholder: 'Select a State',
                    allowClear: true
                });
                
                for (let index = 0; index <dataResult.length; index++)
                {
                    var newOption = new Option(dataResult[index].city_name, dataResult[index].city_name, true, true);
                    $('#city').append(newOption).trigger('change');

                }

            }
        }
    });
});

  
	//   jQuery('#city').select2({
	// 	  data:  _cities_[''+jQuery('#state').val()+''],
	// 	  placeholder: 'Select a City',
	// 	  allowClear: true
	//   });
  

//123...
	const unique = (value, index, self) => {
 		 return self.indexOf(value) === index
	}

</script>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<!--                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>-->
<!--                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->





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