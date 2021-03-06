    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../css/adminlte.min.css">
    <!-- sweetalert2 style -->
    <link rel="stylesheet" href="../css/sweetalert2.css">
    <!-- Select2 style -->
    <link rel="stylesheet" href="../css/select2.css">
    <!-- CSS -->
    <link rel="stylesheet" href="../css/main.css">

    <link rel="stylesheet" href="../css/compra.css">
    </head>

    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="../vista/adm_catalogo.php" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item d-none d-sm-inline-block">
                        <a href="#" class="nav-link">Contato</a>
                    </li>
                    <li  class="nav-item dropdown" id="cat-carrinho" style="display:none">
                        <img src="../img/carrinho.png" class="imagen-carrito nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span id="contador" class="contador badge badge-danger"></span>
                        </img>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <table class="carro table table-hover text-nowrap p-0">
                                <thead class="table-success">
                                <tr>
                                    <th>Codigo: </th>
                                    <th>Nome: </th>
                                    <th>Concentra????o: </th>
                                    <th>adicional: </th>
                                    <th>Pre??o: </th>
                                    <th>Remover</th>
                                </tr>
                                </thead>
                                <tbody id="lista">
                                
                                </tbody>
                            </table>
                            <a href="#" id="procesar-pedido" class="btn btn-danger btn-block">Processar compra</a>
                            <a href="#" id="limpar-carrinho" class="btn btn-primary btn-block">Limpar carrinho</a>
                    </div>
                    </li>
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <a href="../controlador/Logout.php">Encerrar Sess??o</a>
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="../vista/adm_catolago.php" class="brand-link">
                    <img src="../img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light">Farmacia</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img id="avatar4" src="../img/avatar.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">
                                <?php
                                echo $_SESSION['nombre_us'];
                                ?>
                            </a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                            <li class="nav-header">Usu??rio</li>
                            <li class="nav-item">
                                <a href="../vista/editar_datos_personales.php" class="nav-link">
                                    <i class="nav-icon fas fa-user-cog"></i>
                                    <p>
                                        Dados do Usu??rio
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="adm_usuario.php" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Gest??o de usuarios
                                    </p>
                                </a>
                            </li>
                            <li class="nav-header">Armaz??m</li>
                            <li class="nav-item">
                                <a href="adm_producto.php" class="nav-link">
                                    <i class="nav-icon fas fa-pills"></i>
                                    <p>
                                        Gest??o de produtos
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="adm_atributo.php" class="nav-link">
                                    <i class="nav-icon fas fa-vials"></i>
                                    <p>
                                        Gest??o de atributo
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="adm_lote.php" class="nav-link">
                                    <i class="nav-icon fas fa-cubes"></i>
                                    <p>
                                        Gest??o de lote
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="adm_compra.php" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        Compras
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="adm_proveedor.php" class="nav-link">
                                    <i class="nav-icon fas fa-truck"></i>
                                    <p>
                                        Gest??o de fornecedores
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>