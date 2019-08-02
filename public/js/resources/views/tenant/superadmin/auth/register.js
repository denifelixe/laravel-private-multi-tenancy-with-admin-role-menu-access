$("#store-verification-code").on('click', function() {

	$.ajax({
		url: '/api/superadmin/register/store_verification_code',
		type: 'POST',
		dataType: 'json',
		data: {
			email: $("#email").val()	
		},
		error: function(jqXHR, status, errorThrown) {
			$('input').removeClass('is-invalid');
			$('input').siblings('.invalid-feedback').remove();

			$.each(jqXHR.responseJSON.errors, function(field, errors) {

				$('#' + field).addClass('is-invalid');
				$('#' + field).after(
					'<span class="invalid-feedback" role="alert">' + 
                        '<strong>' + errors.join(', ') + '</strong>' + 
                    '</span>'
				);
			});
		},
		success: function(response, status, jqXHR) {
			$('input').removeClass('is-invalid');
			$('input').siblings('.invalid-feedback').remove();
		}
	});
	
});