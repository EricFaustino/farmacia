<?php
session_start();

if ($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
?>
    <title>Adm | Editar Dados</title>

    <?php
    include_once 'layouts/nav.php';
    ?>
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
                    <div class="alert alert-success text-center" id="edit-prov" style="display: none;">
                        <span><i class="fas fa-check m-1"></i>Imagem alterada com sucesso</span>
                    </div>
                    <div class="alert alert-danger text-center" id="noedit-prov" style="display: none;">
                        <span><i class="fas fa-times m-1"></i>Formato não suportado</span>
                    </div>
                    <form id="form-logo" enctype="multipart/form-data">
                        <div class="input-group mb-3 ml-5 mt-2">
                            <input type="file" name="photo" class="input-group">
                            <input type="hidden" name="funcion" id="funcion">
                            <input type="hidden" name="id_logo_prov" id="id_logo_prov">
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

    <div class="modal fade" id="crearproveedor" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar fornecedor</h3>
                        <button data-dismiss="modal" area-label="close" class="close">
                            <span arial-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                    <div class="alert alert-success text-center" id="add-prov" style="display: none;">
                        <span><i class="fas fa-check m-1"></i>Fornecedor criado com sucesso</span>
                    </div>

                    <div class="alert alert-danger text-center" id="noadd-prov" style="display: none;">
                        <span><i class="fas fa-times m-1"></i>Fornecedor ja existente</span>
                    </div>

                    <div class="alert alert-success text-center" id="edit-prove" style="display: none;">
                        <span><i class="fas fa-check m-1"></i>Fornecedor editado</span>
                    </div>

                        <form id="form-crear">
                            <div class="form-group">
                                <label for="nombre">Nome</label>
                                <input id="nombre" type="text" class="form-control" placeholder="Digite o nome do fornecedor" required>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Telefone</label>
                                <input id="telefono" type="number" class="form-control" placeholder="Digite o telefone do fornecedor" required>
                            </div>
                            <div class="form-group">
                                <label for="correo">E-mail</label>
                                <input id="correo" type="email" class="form-control" placeholder="Digite o e-mail do fornecedor">
                            </div>
                            <div class="form-group">
                                <label for="direccion">CNPJ</label>
                                <input id="direccion" type="text" class="form-control" placeholder="Digite o CNPJ do fornecedor" required>
                            </div>
                            <input type="hidden" id="id_edit_prov">
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
                        <h1>Gestão de fornecedores <button type="button" data-toggle="modal" data-target="#crearproveedor" class="btn bg-gradient-primary ml-5">Criar fornecedor</button></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestão de fornecedores</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Buscar fornecedores</h3>
                        <div class="input-group">
                            <input type="text" id="buscar_proveedor" class="form-control float-left" placeholder="Escreva o nome do fornecedor">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="proveedores" class="row d-flex align-items-stretch">
                            
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
}else{
    header('Location: ../index.php');
}
?>
<script src="../js/Proveedor.js"></script>