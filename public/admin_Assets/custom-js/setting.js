  $(document).ready(function() {
    $('#change-password-form').on('submit', function(e) {
      e.preventDefault();
      var formData = $(this).serialize();
      console.log(formData);
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

      $.ajax({
        url: '/Healwave/admin/user/password',
        method: 'PUT',
        type: 'PUT',
        data: formData,

        success: function(response){
          if (response.success) {
            $('#saveForm_errlist').remove();
            $('#success_message').html("").removeClass('alert alert-success');
            $('#success_message').addClass('alert alert-success').append(response.success);
              setTimeout(function() {
                  $('#success_message').hide();
                }, 3000);
            $('#current_password, #password, #password_confirmation').val('');
          }
        },
        error: function (error) {
          console.log(error.responseJSON.errors);
          $('#saveForm_errlist').html("").removeClass('alert alert-danger alert-success');
            if (error.responseJSON.errors) {
              $('#saveForm_errlist').addClass('alert alert-danger');
              $.each(error.responseJSON.errors, function(field, errorMessages) {
                  errorMessages.forEach(function(error) {
                    $('#saveForm_errlist').append('<li>' + error + '</li>');
                  });
              });
            }
        }
      })
    });
  });
