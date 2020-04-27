/* Funciones JavaScript
   Versión 0.1
   Autor: Victor Tuiran
   comentarios: select dinamico via ajax
*/
$(document).ready(function () {
    $('#provider').on('change', function () {
        var provider_id = $(this).val();
        if (provider_id) {
            $.ajax({
                url: '/api/getAllArticlesByIdProvider/' + provider_id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    $('#article').empty();
                    $.each(data, function (key, value) {
                        $('#article').append('<option value="' + key + '">' + value + '</option>');
                    });
                }
            });
        } else {
            $('#article').empty();
        }
    });
});