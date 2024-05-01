$(document).ready(function() {

    $('#tableSearchInput').on("keyup",function() {
        var searchedInput = $(this).val();

        $.ajax({
            url: "/Healwave/admin/patient/search",
            method: 'GET',
            data: {'searchedInput':searchedInput},
            success: function (response) {
                // console.log(response.data);
                if (response.data === " " || response.data.length === 0) {
                    $('#patientsTable tbody').html(`
                        <tr>
                            <td colspan="6" class="text-center alert alert-info">
                                <strong>No records found!</strong>
                                <br>Try adjusting your search or using different keywords.
                            </td>
                        </tr>
                    `);
                } else{
                    $('#patientsTable tbody').html(response.data);
                }
            },
            error: function(error){
                console.log(error);
            }
        })
    })
})