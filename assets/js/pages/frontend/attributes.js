jQuery(document).ready(function() {

    $('#attributes').select2({
        maximumSelectionLength: 5,
        placeholder:'Select an attributes',
    });

    $('#agentSubmitAns').click(function(){
        $('#message').text('');
        let attributes =$('#attributes').select2("val");

        if(attributes.length == 0)
        {
            $('#message').text('Please select an attribute');
            return false;
        }else{

            $('#agentSurveyFormSubmit').submit();
        }

    });

});