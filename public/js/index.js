$(document).ready(function () {

    $(document).on('change', '.form-check-input', function(){
        data = $(this).attr('data-param');
        token = $('meta[name="csrf_token"]').attr('content');
        console.log(token);
        $.ajax({
            url: "action",
            type: "POST",
            headers: {'X-CSRF-TOKEN': token},
            data: {
                data: data,
                _token: token,
            },
            beforeSend: function () {
                $.blockUI({
                    message: 'Carregando...',
                    timeout: 2000,
                })
            },
        }).done(function (result) {
            console.log(result)
            $.unblockUI();
        }).fail(function(result){
            console.log(result)
            $.unblockUI();
            alert('não foi possível buscar os dados');
        })
    });
    
});
function deleteRegistroPontos(rotaUrl, id_objeto) {
    if (confirm('Deseja confirmar a exclusão?')) {
        $.ajax({
            url: rotaUrl,
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
            data: {
                id: id_objeto,
            },
            dataType: '',
            beforeSend: function () {
                $.blockUI({
                    message: 'Carregando...',
                    timeout: 2000,
                })
            },
        }).done(function (data) {
            if (data.success == true) {
                window.location.reload();    
            } else {
                alert('houve um erro')
            };
        }).fail(function(data){
            console.log(data);
            $.unblockUI();
            alert('não foi possível buscar os dados');
        })
    }
}