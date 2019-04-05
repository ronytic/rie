</head>

<body class="">
    <div style="position:fixed;top:0px;left:0px;z-index:10000;width:100%; display:none;" id="CuadroCargador">
    <div style="background-color:#FFF;width:165px;border-bottom-left-radius:10px;border-bottom-right-radius:10px;margin:0px auto;"><img src="<?=$folder;?>imagenes/cargador/30.gif" alt=""></div>
    </div>
    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element">
                        <span>
                        <div class="row">
                            <a href="<?=$folder;?>">
                                <img alt="image" class="img-thumbnail col-lg-12" src="<?php echo $folder?>imagenes/logo/logo.jpg" />
                            </a>
                        </div>
                        </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $nombrecompleto?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $Cargo?> <b class="caret"></b></span> </span> </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <?php /*?><li><a href="<?php echo $folder?>usuarios/perfil/">Perfil</a></li>
                            <li><a href="<?php echo $folder?>contactos/">Contactos</a></li>
                            <li><a href="<?php echo $folder?>correo/">Correo</a></li>
                            <li class="divider"></li><?php */?>
                            <li><a href="<?php echo $folder?>login/logout.php">Salir</a></li>
                        </ul>
                    </div>
                    <div class="logo-element text-center">
                        <a href="<?=$folder;?>">
                            <img src="<?=$folder;?>imagenes/favicon.ico" class="img-thumbnail" class=" " width="60%">
                        </a>
                    </div>
                </li>
                <li class="active"><a href="<?php echo $folder?>"><i class="fa fa-home"></i> <span class="nav-label">Inicio</span> </a></li>
                <?php foreach($menu->mostrar($_SESSION['NivelAcceso']) as $m){
                $subm=$submenu->mostrar($_SESSION['NivelAcceso'],$m['CodMenu'])
                ?>
                <li>
                    <a class="menuopcion" rel="<?=$m['CodMenu'];?>" href="#"><i class="fa <?php echo $m['Icono']?>"></i> <span class="nav-label"><?php echo $m['Nombre']?></span> <?php if(count($subm)){?><span class="fa arrow"></span><?php }?></a>
                    <ul class="nav nav-second-level collapse">
                        <?php foreach($subm as $sm){?>
                        <li><a href="<?php echo $folder?><?php echo $m['Url']?><?php echo $sm['Url']?>"><i class="fa <?php echo $sm['Icono']!=""?$sm['Icono']:'';//fa-arrow-right?>"></i><?php echo $sm['Nombre']?></a></li>
                        <?php }?>
                    </ul>
                </li>
                <?php }?>
            </ul>
        </div>
    </nav>

        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header pull-left">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                <a class="logocentreadopequeno hidden-lg hidden-md hidden-sm" href="<?=$folder;?>">
                    <img alt="image" class="img-thumbnail" src="<?php echo $folder?>imagenes/logo/logo.jpg" width="100"/>
                </a>
            <form role="search" class="navbar-form-custom" action="busqueda/">
                <div class="form-group">
                    <input type="text" placeholder=""  class="form-control disabled" name="top-search" id="top-search" readonly>
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right pull-right">
                <li>
                    <span class="m-r-sm text-muted hide-lg"></span>
                    <span class="m-r-sm text-muted "><?php echo $solonombre?></span>
                </li>
                <li>
                </li>
                <?php /*?><!--<li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo $folder;?>imagenes/usuarios/a7.jpg">
                                </a>
                                <div class="media-body">
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo $folder;?>imagenes/usuarios/a4.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?php echo $folder;?>imagenes/usuarios/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Leer todos los Mensajes</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>-->


<!--                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Tienes 16 Mensajes
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 Nuevos Contactos
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Tres Inicios de Sesión
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>Ver Todas las Alertas</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>-->

                <?php */?>
                <li>
                    <a href="<?php echo $folder?>login/logout.php" class="btn btn-xs">
                        <i class="fa fa-sign-out"></i> Salir
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-6">
                    <h2><?php echo $titulo?></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="<?php echo $folder?>">Inicio</a>
                        </li>
                        <li class="active">
                            <strong><?php echo $titulo?></strong>
                        </li>
                    </ol>
                </div>
                <div class="col-sm-6">
                    <div class="title-action">
                        <!--<a href="#" class="btn btn-primary">Acciones</a>-->
                    </div>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
