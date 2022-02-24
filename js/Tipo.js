$(document).ready(function() {
    buscar_tip();
    var funcion;
    var edit = false;
    $('#form-crear-tipo').submit(e => {
        let nombre_tipo = $('#nombre-tipo').val();
        let id_editado = $('#id_editar_tip').val();
        if (edit == false) {
            funcion = 'crear';
        } else {
            funcion = 'editar';
        }
        $.post('../controlador/TipoController.php', { nombre_tipo, id_editado, funcion }, (response) => {
            if (response == 'add') {
                $('#add-tipo').hide('slow');
                $('#add-tipo').show(1000);
                $('#add-tipo').hide(5000);
                $('#form-crear-tipo').trigger('reset');
                buscar_tip();
            }
            if (response == 'noadd') {
                $('#noadd-tipo').hide('slow');
                $('#noadd-tipo').show(1000);
                $('#noadd-tipo').hide(5000);
                $('#form-crear-tipo').trigger('reset');
            }
            if (response == 'edit') {
                $('#edit-tip').hide('slow');
                $('#edit-tip').show(1000);
                $('#edit-tip').hide(5000);
                $('#form-crear-tipo').trigger('reset');
                buscar_tip();
            }
            edit == false;
        })
        e.preventDefault();
    });

    function buscar_tip(consulta) {
        funcion = 'buscar';
        $.post('../controlador/TipoController.php', { consulta, funcion }, (response) => {
            const tipos = JSON.parse(response);
            let template = '';
            tipos.forEach(tipo => {
                template += `
                    <tr tipId="${tipo.id}" tipNombre="${tipo.nombre}">
                        <td>${tipo.nombre}</td>
                        <td>
                            <button class="editar-tip btn btn-success" title="Editar tipo" type="button" data-toggle="modal" data-target="#creartipo">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="excluir-tip btn btn-danger" title="Excluir tipo">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#tipos').html(template)
        })
    }
    $(document).on('keyup', '#buscar-tipo', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_tip(valor);
        } else {
            buscar_tip();
        }
    })
    $(document).on('click', '.excluir-tip', (e) => {
        funcion = "excluir";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('tipId');
        const nombre = $(elemento).attr('tipNombre');

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
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Não, cancelar!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.post('../controlador/TipoController.php', { id, funcion }, (response) => {
                    edit == false;
                    if (response == 'Excluido') {
                        swalWithBootstrapButtons.fire(
                            'Excluido',
                            'Tipo ' + nombre + ' foi excluido!',
                            'success'
                        )
                        buscar_tip();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Não foi possivel excluir',
                            'Tipo ' + nombre + 'não foi excluido porque a produtos cadastrados nele!!',
                            'error'
                        )
                        buscar_tip();
                    }
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Tipo ' + nombre + ' esta a salvo :)',
                    'error'
                )
                buscar_tip();
            }
        })
    })
    $(document).on('click', '.editar-tip', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('tipId');
        const nombre = $(elemento).attr('tipNombre');
        $('#id_editar_tip').val(id);
        $('#nombre-tipo').val(nombre);
        edit = true;
    })
});