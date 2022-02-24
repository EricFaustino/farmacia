$(document).ready(function() {
    buscar_lab();
    var funcion;
    var edit = false;
    $('#form-crear-laboratorio').submit(e => {
        let nombre_laboratorio = $('#nombre-laboratorio').val();
        let id_editado = $('#id_editar_lab').val();
        if (edit == false) {
            funcion = 'crear';
        } else {
            funcion = 'editar';
        }
        $.post('../controlador/LaboratorioController.php', { nombre_laboratorio, id_editado, funcion }, (response) => {
            if (response == 'add') {
                $('#add-laboratorio').hide('slow');
                $('#add-laboratorio').show(1000);
                $('#add-laboratorio').hide(5000);
                $('#form-crear-laboratorio').trigger('reset');
                buscar_lab();
            }
            if (response == 'noadd') {
                $('#noadd-laboratorio').hide('slow');
                $('#noadd-laboratorio').show(1000);
                $('#noadd-laboratorio').hide(5000);
                $('#form-crear-laboratorio').trigger('reset');
            }
            if (response == 'edit') {
                $('#edit-lab').hide('slow');
                $('#edit-lab').show(1000);
                $('#edit-lab').hide(5000);
                $('#form-crear-laboratorio').trigger('reset');
                buscar_lab();
            }
            edit == false;
        })
        e.preventDefault();
    });

    function buscar_lab(consulta) {
        funcion = 'buscar';
        $.post('../controlador/LaboratorioController.php', { consulta, funcion }, (response) => {
            const laboratorios = JSON.parse(response);
            let template = '';
            laboratorios.forEach(laboratorio => {
                template += `
                    <tr labId="${laboratorio.id}" labNombre="${laboratorio.nombre}" labAvatar="${laboratorio.avatar}">
                        <td>${laboratorio.nombre}</td>
                        <td>
                            <img src="${laboratorio.avatar}" class="img-fluid rounded" width="70" heigth="70">
                        </td>
                        <td>
                            <button class="avatar btn btn-info" title="Altera imagem" type="button" data-toggle="modal" data-target="#cambiologo">
                                <i class="far fa-image"></i>
                            </button>
                            <button class="editar btn btn-success" title="Editar laboratorio" type="button" data-toggle="modal" data-target="#crearlaboratorio">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="excluir btn btn-danger" title="Excluir laboratorio">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#laboratorios').html(template)
        })
    }
    $(document).on('keyup', '#buscar_laboratorio', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_lab(valor);
        } else {
            buscar_lab();
        }
    })
    $(document).on('click', '.avatar', (e) => {
        funcion = "cambiar_logo";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labNombre');
        const avatar = $(elemento).attr('labAvatar');
        $('#logoatual').attr('src', avatar);
        $('#nombre_logo').html(nombre);
        $('#funcion').val(funcion);
        $('#id_logo_lab').val(id);
    })
    $('#form-logo').submit(e => {
        let formData = new FormData($('#form-logo')[0]);
        $.ajax({
            url: '../controlador/LaboratorioController.php',
            type: 'POST',
            data: formData,
            cache: false,
            processData: false,
            contentType: false
        }).done(function(response) {
            const json = JSON.parse(response);
            if (json.alert == 'edit') {
                $('#logoatual').attr('src', json.ruta)
                $('#form-logo').trigger('reset');
                $('#edit').hide('slow');
                $('#edit').show(1000);
                $('#edit').hide(5000);
                buscar_lab();
            } else {
                $('#noedit').hide('slow');
                $('#noedit').show(1000);
                $('#noedit').hide(5000);
                $('#form-logo').trigger('reset');
            }
        });
        e.preventDefault();
    })
    $(document).on('click', '.excluir', (e) => {
        funcion = "excluir";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labNombre');
        const avatar = $(elemento).attr('labAvatar');

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger mr-3'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Deseja excluir ' + nombre + '?',
            text: "Esta ação não podera ser desfeita!",
            imageUrl: '' + avatar + '',
            imageWidth: 100,
            imageHeight: 100,
            /*   icon: 'warning', */
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Não, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/LaboratorioController.php', { id, funcion }, (response) => {
                    edit == false;
                    if (response == 'Excluido') {
                        swalWithBootstrapButtons.fire(
                            'Excluido',
                            'O laboratorio ' + nombre + ' foi excluido!',
                            'success'
                        )
                        buscar_lab();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Não foi possivel excluir',
                            'O laboratorio ' + nombre + 'não foi excluido porque a produtos cadastrados nele!!',
                            'error'
                        )
                        buscar_lab();
                    }
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'O laboratorio ' + nombre + ' esta a salvo :)',
                    'error'
                )
                buscar_lab();
            }
        })
    })
    $(document).on('click', '.editar', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('labId');
        const nombre = $(elemento).attr('labNombre');
        $('#id_editar_lab').val(id);
        $('#nombre-laboratorio').val(nombre);
        edit = true;
    })
});