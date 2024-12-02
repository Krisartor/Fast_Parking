<?php include('app/config.php'); ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Fast Parking</title>
</head>
<body style="background-image: url('public/imagenes/Parqueadero.jpg');
              background-repeat:no-repeat; 
              z-index: -3;
              background-size: 100vw 100vh;">

<nav class="navbar navbar-expand-lg navbar-dark bg-info">
  <div class="container-fluid">

    <a class="navbar-brand" href="#">
      <img src="/docs/5.1/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
      Fast Parking
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link active" href="#">Sobre Nosotros</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Modulos
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <a class="nav-link active" href="#">Contactanos</a>
        </li>
        <li class="nav-item dropdown active">
        
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Ingresar
            </button>
      </form>
    </div>
  </div>
</nav>

<div class="container">
<div class="row">
                    <div class="col-md-12">

                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Mapeo actual del parqueo</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>

                            </div>

                            <div class="card-body" style="display: block;">
                                <div class="row">
                                    <?php
                                    $query_mapeos = $pdo->prepare("SELECT * FROM tb_mapeos WHERE estado = '1' ");
                                    $query_mapeos->execute();
                                    $mapeos = $query_mapeos->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($mapeos as $mapeo){
                                        $id_map = $mapeo['id_map'];
                                        $nro_espacio = $mapeo['nro_espacio'];
                                        $estado_espacio = $mapeo['estado_espacio'];

                                        if($estado_espacio == "LIBRE"){ ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $nro_espacio;?></h2>

                                                    <button class="btn btn-success" style="width: 100%;height: 114px"
                                                            data-toggle="modal" data-target="#modal<?php echo $id_map;?>">
                                                        <p><?php echo $estado_espacio;?></p>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modal<?php echo $id_map;?>" tabindex="-1"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">INGRESO DEL VEHICULO</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-3 col-form-label">Placa: <span><b style="color: red">*</b></span></label>
                                                                        <div class="col-sm-6">
                                                                            <input type="text" style="text-transform: uppercase" class="form-control" id="placa_buscar<?php echo $id_map;?>">
                                                                        </div>
                                                                        <div class="col-sm-3">
                                                                            <button class="btn btn-primary" id="btn_buscar_cliente<?php echo $id_map;?>" type="button">
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                                                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                                                                </svg>
                                                                                 Buscar
                                                                            </button>
                                                                            <script>
                                                                                $('#btn_buscar_cliente<?php echo $id_map;?>').click(function () {
                                                                                    var placa = $('#placa_buscar<?php echo $id_map;?>').val();
                                                                                    var id_map = "<?php echo $id_map;?>";

                                                                                    if(placa == ""){
                                                                                        alert('Debe de llenar el campo placa');
                                                                                        $('#placa_buscar<?php echo $id_map;?>').focus();
                                                                                    }else{
                                                                                        var url = 'clientes/controller_buscar_cliente.php';
                                                                                        $.get(url,{placa:placa,id_map:id_map},function (datos) {
                                                                                            $('#respuesta_buscar_cliente<?php echo $id_map;?>').html(datos);
                                                                                        });
                                                                                    }
                                                                                });
                                                                            </script>
                                                                        </div>
                                                                    </div>

                                                                    <div id="respuesta_buscar_cliente<?php echo $id_map;?>">

                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Fecha de ingreso:</label>
                                                                        <div class="col-sm-8">
                                                                            <?php
                                                                            date_default_timezone_set("America/Bogota");
                                                                            $fechaHora = date("Y-m-d h:i:s");
                                                                            $dia = date('d');
                                                                            $mes = date('m');
                                                                            $ano = date('Y');
                                                                            ?>
                                                                            <input type="date" class="form-control" id="fecha_ingreso<?php echo $id_map;?>" value="<?php echo $ano."-".$mes."-".$dia; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Hora de ingreso:</label>
                                                                        <div class="col-sm-8">
                                                                            <?php
                                                                            date_default_timezone_set("America/Bogota");
                                                                            $fechaHora = date("Y-m-d h:i:s");
                                                                            $hora = date('H');
                                                                            $minutos = date('i');
                                                                            ?>
                                                                            <input type="time" class="form-control" id="hora_ingreso<?php echo $id_map;?>"  value="<?php echo $hora.":".$minutos; ?>">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Cuvículo:</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" id="cuviculo<?php echo $id_map;?>" value="<?php echo $nro_espacio; ?>">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                    <button type="button" class="btn btn-primary" id="btn_registrar_ticket<?php echo $id_map;?>">Imprimir ticket</button>
                                                                    <script>
                                                                        $('#btn_registrar_ticket<?php echo $id_map;?>').click(function () {

                                                                           var placa = $('#placa_buscar<?php echo $id_map;?>').val();
                                                                           var nombre_cliente = $('#nombre_cliente<?php echo $id_map;?>').val();
                                                                           var nit_ci = $('#nit_ci<?php echo $id_map;?>').val();
                                                                           var fecha_ingreso = $('#fecha_ingreso<?php echo $id_map;?>').val();
                                                                           var hora_ingreso = $('#hora_ingreso<?php echo $id_map;?>').val();
                                                                           var cuviculo = $('#cuviculo<?php echo $id_map;?>').val();
                                                                           var user_session = "<?php echo $usuario_sesion; ?>";


                                                                           if(placa == ""){
                                                                              alert('Debe de llenar el campo Placa');
                                                                               $('#placa_buscar<?php echo $id_map;?>').focus();
                                                                           }else if(nombre_cliente == ""){
                                                                                alert('Debe de llenar el campo nombre del cliente');
                                                                               $('#nombre_cliente<?php echo $id_map;?>').focus();
                                                                           }else if(nit_ci == ""){
                                                                               alert('Debe de llenar el campo Nit/Ci');
                                                                               $('#nit_ci<?php echo $id_map;?>').focus();
                                                                           }
                                                                           else{

                                                                               var url_1 = 'parqueo/controller_cambiar_estado_ocupado.php';
                                                                               $.get(url_1,{cuviculo:cuviculo},function (datos) {
                                                                                   $('#respuesta_ticket').html(datos);
                                                                               });

                                                                               var url_2 = 'clientes/controller_registrar_clientes.php';
                                                                               $.get(url_2,{nombre_cliente:nombre_cliente,nit_ci:nit_ci,placa:placa},function (datos) {
                                                                                   $('#respuesta_ticket').html(datos);
                                                                               });

                                                                               var url_3 = 'tickets/controller_registrar_ticket.php';
                                                                               $.get(url_3,{placa:placa,nombre_cliente:nombre_cliente,nit_ci:nit_ci,fecha_ingreso:fecha_ingreso,hora_ingreso:hora_ingreso,cuviculo:cuviculo,user_session:user_session},function (datos) {
                                                                                   $('#respuesta_ticket').html(datos);
                                                                               });


                                                                           }

                                                                        });
                                                                    </script>
                                                                </div>
                                                                <div id="respuesta_ticket">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </center>
                                            </div>

                                            <?php
                                        }
                                        if($estado_espacio == "OCUPADO"){ ?>
                                            <div class="col">
                                                <center>
                                                    <h2><?php echo $nro_espacio;?></h2>
                                                    <button class="btn btn-info" id="btn_ocupado<?php echo $id_map;?>" data-toggle="modal"
                                                            data-target="#exampleModal<?php echo $id_map;?>">
                                                            <img src="<?php echo $URL;?>/public/imagenes/carro.png" width="100px">
                                                    </button>

                                                    <?php

                                                    $query_datos_cliente = $pdo->prepare("SELECT * FROM tb_tickets WHERE cuviculo = '$nro_espacio' AND estado = '1' ");
                                                    $query_datos_cliente->execute();
                                                    $datos_clientes = $query_datos_cliente->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach($datos_clientes as $datos_cliente){
                                                        $id_ticket = $datos_cliente['id_ticket'];
                                                        $placa_auto = $datos_cliente['placa_auto'];
                                                        $nombre_cliente = $datos_cliente['nombre_cliente'];
                                                        $nit_ci = $datos_cliente['nit_ci'];
                                                        $cuviculo = $datos_cliente['cuviculo'];
                                                        $fecha_ingreso = $datos_cliente['fecha_ingreso'];
                                                        $hora_ingreso = $datos_cliente['hora_ingreso'];
                                                        $user_sesion = $datos_cliente['user_sesion'];
                                                    }
                                                    ?>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal<?php echo $id_map;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Datos del cliente</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Placa:</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" style="text-transform: uppercase" class="form-control" value="<?php echo $placa_auto;?>" id="placa_buscar<?php echo $id_map;?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Nombre:</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" value="<?php echo $nombre_cliente; ?>" id="nombre_cliente<?php echo $id_map;?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">NIT/CI: </label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" value="<?php echo $nit_ci;?>" id="nit_ci<?php echo $id_map;?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Fecha de ingreso:</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" value="<?php echo $fecha_ingreso;?>" id="fecha_ingreso<?php echo $id_map;?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Hora de ingreso:</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" value="<?php echo $hora_ingreso;?>" id="hora_ingreso<?php echo $id_map;?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row">
                                                                        <label for="staticEmail" class="col-sm-4 col-form-label">Cuvículo:</label>
                                                                        <div class="col-sm-8">
                                                                            <input type="text" class="form-control" value="<?php echo $cuviculo;?>" id="cuviculo<?php echo $id_map;?>" disabled>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                                                                    <a href="tickets/controller_cancelar_ticket.php?id=<?php echo $id_ticket;?>&&cuviculo=<?php echo $cuviculo;?>" class="btn btn-danger">Cancelar ticket</a>
                                                                    <a href="tickets/reimprimir_ticket.php?id=<?php echo $id_ticket;?>" class="btn btn-primary">Volver a Imprimir</a>
                                                                    <button type="button" class="btn btn-success" id="btn_facturar<?php echo $id_map;?>">Facturar</button>
                                                                    <?php
                                                                    ///////////////////// recupera el id del cliente
                                                                    $query_datos_cliente_factura = $pdo->prepare("SELECT * FROM tb_clientes WHERE placa_auto = '$placa_auto' AND estado = '1' ");
                                                                    $query_datos_cliente_factura->execute();
                                                                    $datos_clientes_facturas = $query_datos_cliente_factura->fetchAll(PDO::FETCH_ASSOC);
                                                                    foreach($datos_clientes_facturas as $datos_clientes_factura){
                                                                        $id_cliente_facturacion = $datos_clientes_factura['id_cliente'];
                                                                    }
                                                                    /////////////////////////////////////////////////////////////////7
                                                                    ?>
                                                                    <script>
                                                                        $('#btn_facturar<?php echo $id_map;?>').click(function () {
                                                                            var id_informacion = "<?php echo $id_informacion; ?>";
                                                                            var nro_factura = "<?php echo $contador_del_nro_de_factura; ?>";
                                                                            var id_cliente = "<?php echo $id_cliente_facturacion;?>";
                                                                            var fecha_ingreso = "<?php echo $fecha_ingreso; ?>";
                                                                            var hora_ingreso = "<?php echo $hora_ingreso; ?>";
                                                                            var cuviculo = "<?php echo $cuviculo; ?>";
                                                                            var user_sesion = "<?php echo $user_sesion; ?>";

                                                                            var url_4 = 'facturacion/controller_registrar_factura.php';
                                                                            $.get(url_4,{id_informacion:id_informacion,nro_factura:nro_factura,id_cliente:id_cliente,fecha_ingreso:fecha_ingreso,hora_ingreso:hora_ingreso,cuviculo:cuviculo,user_sesion:user_sesion},function (datos) {
                                                                                $('#respuesta_factura<?php echo $id_map;?>').html(datos);
                                                                            });

                                                                        });
                                                                    </script>
                                                                </div>
                                                                <div id="respuesta_factura<?php echo $id_map;?>">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p><?php echo $estado_espacio;?></p>
                                                </center>
                                            </div>
                                            <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                    ?>


                                </div>
                            </div>

                        </div>



                    </div>
                </div>
</div>
     <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="public/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="public/js/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="public/js/jquery-3.7.1.min.js" integrity="" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->

</body>
</html>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inicio de Sesión</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Usuario/Email</label>
                    <input type="email" id="usuario" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Contraseña</label>
                    <input type="password" id="password" class="form-control">
                </div>
            </div>

            <div id="respuesta">

            </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn_ingresar">Ingresar</button>
      </div>
    </div>
  </div>
</div>

<script>
    $('#btn_ingresar').click(function(){
      login();

    });

    $('#password').keypress(function(e){
      if(e.which == 13){
          login();
      } 
    });

    function login(){

      var usuario = $('#usuario').val();
        var password_user = $('#password').val();
        
      if(usuario == ""){
          alert('Debe introducir su usuario...');
          $('#usuario').focus();
      }else if(password_user == ""){
          alert('Debe introducir su Contraseña...');
          $('#password').focus();
        
      }else{
        var url = 'login/controller_login.php'
        $.post(url,{usuario:usuario, password_user: password_user},function(datos){
        $('#respuesta').html(datos);
        });
      
      }

    }
</script>