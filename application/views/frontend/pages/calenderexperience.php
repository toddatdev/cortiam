<!--<link rel = "stylesheet" type = "text/css" href = "--><?php //echo base_url(); ?><!--assets/css/yearstyle.css">-->
<link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>assets/css/yearpicker.css">

<!--<script type = 'text/javascript' src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script type = 'text/javascript' src = "https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type = 'text/javascript' src = "<?php echo base_url(); ?>assets/js/yearpicker.js"></script>

<input type="text" class="yearpicker form-control" id="experience" name="experience" value="" />
<script>
$(document).ready(function() {
    $(".yearpicker").yearpicker({
        startYear: 1950,
        endYear: 2050
    });

    $(".yearpicker").val('Select');
});
</script>