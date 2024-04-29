console.log('kapil did');
$(document).ready(function() {

    $('#tableSearchInput').on("keyup",function() {
        var searchedInput = $(this).val();

        $.ajax({
            url: "{{ route('patient.search') }}",
            method: 'GET',
            data: {'searchedInput':searchedInput},
            success: function (response) {
                console.log(response);
            },
            error: function(error){
                console.log(error);
            }
        })
    })
})