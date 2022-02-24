$(document).ready(function() {
    buscar_pre();
    var funcion;
    var edit = false;
    $('#form-crear-presentacion').submit(e => {
        let nombre_presentacion = $('#nombre-presentacion').val();
        let id_editado = $('#id_editar_pre').val();
        if (edit == false) {
            funcion = 'crear';
        } else {
            funcion = 'editar';
        }
        $.post('../controlador/ApresentacaoController.php', { nombre_presentacion, id_editado, funcion }, (response) => {
            if (response == 'add') {
                $('#add-pre').hide('slow');
                $('#add-pre').show(1000);
                $('#add-pre').hide(5000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_pre();
            }
            if (response == 'noadd') {
                $('#noadd-pre').hide('slow');
                $('#noadd-pre').show(1000);
                $('#noadd-pre').hide(5000);
                $('#form-crear-presentacion').trigger('reset');
            }
            if (response == 'edit') {
                $('#edit-pre').hide('slow');
                $('#edit-pre').show(1000);
                $('#edit-pre').hide(5000);
                $('#form-crear-presentacion').trigger('reset');
                buscar_pre();
            }
            edit == false;
        })
        e.preventDefault();
    });

    function buscar_pre(consulta) {
        funcion = 'buscar';
        $.post('../controlador/ApresentacaoController.php', { consulta, funcion }, (response) => {
            const presentaciones = JSON.parse(response);
            let template = '';
            presentaciones.forEach(presentacion => {
                template += `
                    <tr preId="${presentacion.id}" preNombre="${presentacion.nombre}">
                        <td>${presentacion.nombre}</td>
                        <td>
                            <button class="editar-pre btn btn-success" title="Editar apresentação" type="button" data-toggle="modal" data-target="#crearpresentacion">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="excluir-pre btn btn-danger" title="Excluir apresentação">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#presentaciones').html(template)
        })
    }
    $(document).on('keyup', '#buscar-presentacion', function() {
        let valor = $(this).val();
        if (valor != '') {
            buscar_pre(valor);
        } else {
            buscar_pre();
        }
    })
    $(document).on('click', '.excluir-pre', (e) => {
        funcion = "excluir";
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('preId');
        const nombre = $(elemento).attr('preNombre');

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
                $.post('../controlador/ApresentacaoController.php', { id, funcion }, (response) => {
                    edit == false;
                    if (response == 'Excluido') {
                        swalWithBootstrapButtons.fire(
                            'Excluido',
                            'Apresentação ' + nombre + ' foi excluido!',
                            'success'
                        )
                        buscar_pre();
                    } else {
                        swalWithBootstrapButtons.fire(
                            'Não foi possivel excluir',
                            'Apresentação ' + nombre + 'não foi excluido porque a produtos cadastrados nele!!',
                            'error'
                        )
                        buscar_pre();
                    }
                })
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Apresentação ' + nombre + ' esta a salvo :)',
                    'error'
                )
                buscar_pre();
            }
        })
    })
    $(document).on('click', '.editar-pre', (e) => {
        const elemento = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(elemento).attr('preId');
        const nombre = $(elemento).attr('preNombre');
        $('#id_editar_pre').val(id);
        $('#nombre-presentacion').val(nombre);
        edit = true;
    })
});