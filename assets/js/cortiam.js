videoSrc = '';
jQuery(document).ready(function() {
	jQuery('.ytvideo').click(function() {
	    videoSrc = jQuery(this).data( "src" );
	});

	jQuery('#videoModal').on('shown.bs.modal', function (e) {
		jQuery("#video").attr('src', videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" );
	})

	jQuery('#videoModal').on('hide.bs.modal', function (e) {
    jQuery("#video").attr('src', '');
	})

	jQuery('body').on('click', '#res_menu_icon', function (ev) {
		ev.preventDefault();
		jQuery('#mainnav').toggleClass('mobilemenu');
	});

  jQuery('.format-phone-number').formatter({
      pattern: '{{999}}-{{999}}-{{9999}}'
  });


// Function To Play Youtube video on Agents on cortiam page when we click on play button
	jQuery('.play_img').click(function() {
		iframeSrc = jQuery('.ytvideoiframe iframe').attr('src');
	});

	jQuery('#playvideoModal').on('shown.bs.modal', function (e) {
		jQuery('.ytvideoiframe iframe').attr('src', iframeSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0" );
	})

	jQuery('#playvideoModal').on('hide.bs.modal', function (e) {
		jQuery('.ytvideoiframe iframe').attr('src', '');
		jQuery('.ytvideoiframe iframe').attr('src', iframeSrc);
	})


	// Function For See Less Or See More Agent Bio
	var biotext = jQuery('.agent-bio').text();
	function getAgentBio(){
		jQuery('.agent-bio').text(function(_, txt) {
			if(txt.length > 500){
				txt = txt.substr(0, 500) + "...";
				jQuery(this).parent().append("<a href='javascript:void(0);' name='bio-more' class='bio-more'>Read More</a>");
			}
			jQuery(this).html(txt)
		});
	}
	getAgentBio();
	jQuery('body').on('click', 'a[name=bio-more]', function (ev) {
		jQuery('.agent-bio').html(biotext);
		jQuery('.bio-more').css('display', 'none');
		jQuery('.agent-bio').text(function(_, txt) {
			if(txt.length > 500){
				txt = txt.substr(0, 500) + "...";
				jQuery(this).parent().append("<a href='javascript:void(0);' name='bio-less' class='bio-less'>See Less</a>");
			}
		});
	});
	jQuery('body').on('click', 'a[name=bio-less]', function (ev) {
		getAgentBio();
		jQuery('.bio-less').css('display', 'none');
	});


	// Function For See Less Or See More Real State Specialization
	var specialtext = jQuery('.state-special').text();
	function getSpecialization(){
		jQuery('.state-special').text(function(_, txt) {
			if(txt.length > 300){
				txt = txt.substr(0, 300) + "...";
				jQuery(this).parent().append("<a href='javascript:void(0);' name='special-more' class='special-more'>Read More</a>");
			}
			jQuery(this).html(txt)
		});
	}
	getSpecialization();
	jQuery('body').on('click', 'a[name=special-more]', function (ev) {
		jQuery('.state-special').html(specialtext);
		jQuery('.special-more').css('display', 'none');
		jQuery('.state-special').text(function(_, txt) {
			if(txt.length > 300){
				txt = txt.substr(0, 300) + "...";
				jQuery(this).parent().append("<a href='javascript:void(0);' name='special-less' class='special-less'>See Less</a>");
			}
		});
	});
	jQuery('body').on('click', 'a[name=special-less]', function (ev) {
		getSpecialization();
		jQuery('.special-less').css('display', 'none');
	});

	// Function For See Less Or See More Real Estate Focus
	var focustext = jQuery('.state-focus').text();
	console.log(focustext.length);
	function getStateFocus(){
		jQuery('.state-focus').text(function(_, txt) {
			if(txt.length > 300){
				txt = txt.substr(0, 300) + "...";
				jQuery(this).parent().append("<a href='javascript:void(0);' name='focus-more' class='focus-more'>Read More</a>");
			}
			jQuery(this).html(txt)
		});
	}
	getStateFocus();
	jQuery('body').on('click', 'a[name=focus-more]', function (ev) {
		jQuery('.state-focus').html(focustext);
		jQuery('.focus-more').css('display', 'none');
		jQuery('.state-focus').text(function(_, txt) {
			if(txt.length > 300){
				txt = txt.substr(0, 300) + "...";
				jQuery(this).parent().append("<a href='javascript:void(0);' name='focus-less' class='focus-less'>See Less</a>");
			}
		});
	});
	jQuery('body').on('click', 'a[name=focus-less]', function (ev) {
		getStateFocus();
		jQuery('.focus-less').css('display', 'none');
	});

});