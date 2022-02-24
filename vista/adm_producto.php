<?php
session_start();
if ($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3) {
    include_once 'layouts/header.php';
?>

    <title>Adm | Editar Dados</title>

    <?php
    include_once 'layouts/nav.php';
    ?>
     <div class="modal fade" id="crearlote" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar lote de produto</h3>
                        <button data-dismiss="modal" area-label="close" class="close">
                            <span arial-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="add-lote" style="display: none;">
                            <span><i class="fas fa-check m-1"></i>Lote criado com sucesso</span>
                        </div>
                      
                        <form id="form-crear-lote">
                        <div class="form-group">
                            <label for="nombre_producto_lote">Produto: </label>
                            <label id="nombre_producto_lote">Nome do produto: </label>
                        </div>
                        <div class="form-group">
                                <label for="proveedor">Fornecedores: </label>
                                <select name="presentacion" id="proveedor" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <div class="form-group">
                                <label for="stock">Estoque: </label>
                                <input id="stock" type="number" class="form-control" placeholder="Digite o estoque">
                            </div>
                            <div class="form-group">
                                <label for="vencimiento">Vencimento: </label>
                                <input id="vencimiento" type="date" class="form-control" placeholder="Digite o vencimento">
                            </div>
                            <input type="hidden" id="id_lote_prod">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-2">Salvar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-2">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

      <div class="modal fade" id="cambiologo" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Alterar logo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="logoatual" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                    </div>
                    <div class="text-center">
                        <b id="nombre_logo">
                        </b>
                    </div>
                    <div class="alert alert-success text-center" id="edit" style="display: none;">
                        <span><i class="fas fa-check m-1"></i>Imagem alterada com sucesso</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noedit" style="display: none;">
                        <span><i class="fas fa-times m-1"></i>Formato não suportado</span>
                    </div>
                    <form id="form-logo" enctype="multipart/form-data">
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="photo" class="input-group">
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_logo_prod" id="id_logo_prod">
                            <input type="hidden" name="avatar" id="avatar">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn bg-gradient-primary">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="crearproducto" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar produto</h3>
                        <button data-dismiss="modal" area-label="close" class="close">
                            <span arial-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                        <div class="alert alert-success text-center" id="add" style="display: none;">
                            <span><i class="fas fa-check m-1"></i>Produto criado com sucesso</span>
                        </div>

                        <div class="alert alert-danger text-center" id="noadd" style="display: none;">
                            <span><i class="fas fa-times m-1"></i>Produto já existente</span>
                        </div>
                        <div class="alert alert-success text-center" id="edit_prod" style="display: none;">
                            <span><i class="fas fa-check m-1"></i>Produto editado</span>
                        </div>
                       
                        <form id="form-crear-producto">
                            <div class="form-group">
                                <label for="nombre_producto">Nome</label>
                                <input id="nombre_producto" type="text" class="form-control" placeholder="Digite o nome do produto" required>
                            </div>
                            <div class="form-group">
                                <label for="concentracion">Concentração</label>
                                <input id="concentracion" type="text" class="form-control" placeholder="Digite a concentração do produto">
                            </div>
                            <div class="form-group">
                                <label for="adicional">Adicional</label>
                                <input id="adicional" type="text" class="form-control" placeholder="Digite uma descrição">
                            </div>
                            <div class="form-group">
                                <label for="precio">Preço</label>
                                <input id="precio" type="number" class="form-control" value="1" placeholder="Digite o preço do produto" required>
                            </div>
                            <div class="form-group">
                                <label for="laboratorio">Laboratorio</label>
                                <select name="laboratorio" id="laboratorio" class="form-control select2" style="width: 100%" ></select>
                            </div>
                            <div class="form-group">
                                <label for="tipo">Tipo</label>
                                <select name="tipo" id="tipo" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <div class="form-group">
                                <label for="presentacion">Apresentação</label>
                                <select name="presentacion" id="presentacion" class="form-control select2" style="width: 100%"></select>
                            </div>
                            <input type="hidden" id="id_edit_prod">

                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn bg-gradient-primary float-right m-2">Salvar</button>
                        <button type="button" data-dismiss="modal" class="btn btn-outline-secondary float-right m-2">Fechar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Gestão de produtos <button id="button-crear" type="button" data-toggle="modal" data-target="#crearproducto" class="btn bg-gradient-primary ml-5">Criar produto</button></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestão de produtos</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Buscar produto</h3>
                        <div class="input-group">
                            <input type="text" id="buscar-producto" class="form-control float-left" placeholder="Escreva o nome do produto">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="productos" class="row d-flex align-items-stretch">

                        </div>
                    </div>
                    <div class="card-footer">

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
<?php
    include_once 'layouts/footer.php';
} else {
    header('Location: ../index.php');
}
?>

<script src="../js/Producto.js"></script>