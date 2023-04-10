$(document).ready(function() {

    $('#resgistrarGrupo').submit(function (e) {

        e.preventDefault();
    
        var nombre = $('#nombre').val();
        var icono = $('#icono').val();
        var orden = $('#orden').val();
        var id = $('#ID').val();
        var _token = $("input[name=_token]").val();
    
        var ruta;
    
        if (id == "") {
    
            ruta = "{{ route('admin.grupoStore') }}";
        } else if (id != "") {
            ruta = "{{ route('admin.grupoUpdate') }}";
    
        }
    
        $.ajax({
    
            url: ruta,
            type: "POST",
            data: {
                nombre: nombre,
                icono: icono,
                orden: orden,
                id: id,
                _token: _token
    
            },
    
            success: function (response) {
    
                if (response) {
                    $('#exampleModal').modal('hide');
                    $('#tabla').DataTable().ajax.reload();
                    $('#resgistrarGrupo')[0].reset();
    
                }
            }
        });
    });
    
    
    
    $(document).on('click', 'button[name="delete"]', function () {
        var id;
    
        id = $(this).attr('id');
    
        var nombre = $('#nombre').val();
        var icono = $('#icono').val();
        var orden = $('#orden').val();
        var _token = $("input[name=_token]").val();
    
        $.ajax({
    
            url: "{{ route('admin.grupoDestroy') }}",
            type: 'GET',
            data: {
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#tabla').DataTable().ajax.reload();
            }
        });
    });
    
    
    $('#exampleModal').on('hide.bs.modal', function (e) {
        // Restablecer el valor del campo 1
        $('#nombre').val('');
        $('#icono').val('');
        $('#orden').val('');
    });
    
    
    $(document).on('click', 'button[name="edit"]', function () {
        var id = $(this).attr('id');
    
        $.ajax({
    
            url: "{{ route('admin.grupoEdit') }}",
            type: 'get',
            data: {
                id: id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
    
                if (response != null) {
                    var nombre = response.success.nombre;
                    var icono = response.success.icono;
                    var orden = response.success.orden;
    
                    $('#exampleModal').modal('show');
    
                    $('#nombre').val(nombre);
                    $('#icono').val(icono);
                    $('#orden').val(orden);
                    $('#ID').val(id);
    
                }
    
            }
        });
    });
    
});

