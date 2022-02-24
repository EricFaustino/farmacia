<?php
session_start();

if ($_SESSION['us_tipo']==1||$_SESSION['us_tipo']==3){
    include_once 'layouts/header.php';
?>
    <title>Adm | Editar Dados</title>

    <?php
    include_once 'layouts/nav.php';
    ?>
    <div class="modal fade" id="confirmar" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">confirmar ação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <img id="avatar3" src="../img/avatar.png" class="profile-user-img img-fluid img-circle">
                    </div>
                    <div class="text-center">
                        <b>
                            <?php
                            echo $_SESSION['nombre_us'];
                            ?>
                        </b>
                    </div>
                    <span>Digite sua senha para conitnuar</span>
                    <div class="alert alert-success text-center" id="confirmado" style="display: none;">
                        <span><i class="fas fa-check m-1"></i>Usuario alterado com sucesso</span>
                    </div>
                    <div class="alert alert-danger text-center" id="rejeitado" style="display: none;">
                        <span><i class="fas fa-times m-1"></i>Senha incorreta</span>
                    </div>
                    <form id="form-confirmar">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-unlock-alt"></i></span>
                            </div>
                            <input id="oldpass" type="password" class="form-control" placeholder="Digite sua senha">
                            <input type="hidden" id="id_user">
                            <input type="hidden" id="funcion">
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

    <div class="modal fade" id="crearusuario" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Criar usuario</h3>
                        <button data-dismiss="modal" area-label="close" class="close">
                            <span arial-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="card-body">

                    <div class="alert alert-success text-center" id="add" style="display: none;">
                        <span><i class="fas fa-check m-1"></i>Usuario criado com sucesso</span>
                    </div>

                    <div class="alert alert-danger text-center" id="noadd" style="display: none;">
                        <span><i class="fas fa-times m-1"></i>DNI ja existente</span>
                    </div>

                        <form id="form-crear">
                            <div class="form-group">
                                <label for="nombre">Nome</label>
                                <input id="nombre" type="text" class="form-control" placeholder="Digite seu nome" required>
                            </div>
                            <div class="form-group">
                                <label for="apellido">Sobrenome</label>
                                <input id="apellido" type="text" class="form-control" placeholder="Digite seu sobrenome" required>
                            </div>
                            <div class="form-group">
                                <label for="edad">Nascimento</label>
                                <input id="edad" type="date" class="form-control" placeholder="Digite seu nascimento" required>
                            </div>
                            <div class="form-group">
                                <label for="dni">DNI (Código de acesso)</label>
                                <input id="dni" type="text" class="form-control" placeholder="Digite seu DNI" required>
                            </div>
                            <div class="form-group">
                                <label for="pass">Senha</label>
                                <input id="pass" type="password" class="form-control" placeholder="Digite sua senha" required>
                            </div>

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
                        <h1>Gestão de usuarios <button id="button-crear" type="button" data-toggle="modal" data-target="#crearusuario" class="btn bg-gradient-primary ml-5">Criar usuario</button></h1>
                        <input type="hidden" id="tipo_usuario" value="<?php echo $_SESSION['us_tipo']?>">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="adm_catalogo.php">Inicio</a></li>
                            <li class="breadcrumb-item active">Gestão de usuarios</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section>
            <div class="container-fluid">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Buscar usuario</h3>
                        <div class="input-group">
                            <input type="text" id="buscar" class="form-control float-left" placeholder="Escreva o nome de usuario">
                            <div class="input-group-append">
                                <button class="btn btn-default"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="usuarios" class="row d-flex align-items-stretch">
                            
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
<script src="../js/Gestion_usuario.js"></script>