$(document).ready(function () {

    $('#user_feedback_form').on('submit',function(event){
        event.preventDefault();

        var formData = $(this).serialize();
        console.log(formData);
        var submitBtn = $('#submitBtn');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '/Healwave/admin/feedback',
            method: 'POST',
            data: formData,
            beforeSend: function () {
                submitBtn.text('Submitting..');
            },
            success: function (response) {
                console.log(response);
                $('.sent-message')
                  .removeClass('alert alert-success')
                  .html('')
                  .addClass('alert alert-success')
                  .text(response.message)
                  .show();
                setTimeout(function() {
                    $('.sent-message').fadeOut();
                }, 3000);
                $('$user_feedback_form input').html('');
            },
            error: function (xhr,error) {
                console.log(error);
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    displayErrors(errors);
                }
            },
            complete: function () {
                submitBtn.text('Send Message');
            }
        })
        function displayErrors(errors) {
            $('#user_feedback_form input, #user_feedback_form textarea').each(function() {
                $(this).removeClass('is-invalid');
                $(this).attr('placeholder', '');
            });

            if (errors.fullname) {
                $('#name').addClass('is-invalid');
                $('#name').attr('placeholder', errors.fullname[0]);
            }

            if (errors.email) {
                $('#email').addClass('is-invalid');
                $('#email').attr('placeholder', errors.email[0]);
            }

            if (errors.subject) {
                $('#subject').addClass('is-invalid');
                $('#subject').attr('placeholder', errors.subject[0]);
            }

            if (errors.message) {
                $('textarea[name="message"]').addClass('is-invalid');
                $('textarea[name="message"]').attr('placeholder', errors.message[0]);
            }
        }
    });
})