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

  const currentUrl = window.location.href;
  if (currentUrl === 'http://127.0.0.1:8000/Healwave/admin/settings') {
    $(document).ready(function () {

      // When a nav-link is clicked, save its href in local storage
      $('.nav-link').click(function () {
          localStorage.setItem('activeTab', $(this).attr('href'));
      });

      // On page load, retrieve the saved tab from local storage
      const savedTab = localStorage.getItem('activeTab');
      console.log(savedTab);

      if (savedTab) {
          console.log('reload');
          // If there's a saved tab, deactivate all active tabs and their content
          $('.nav-link.active').removeClass('active');
          $('.tab-pane.active').removeClass('active show');

          // Activate the saved tab
          $('.nav-link[href="' + savedTab + '"]').addClass('active');
          $(savedTab).addClass('active show');
      } else {
          console.log('default');
          // If there's no saved tab, ensure the first tab and its content are active
          $('.nav-link').first().addClass('active');
          $('.tab-pane').first().addClass('active show');
      }
    });
  }


