<?php

    if(empty(session_id()) && !isset($_SESSION)) {
        session_start();
        print_r(session_id());
    }

    print_r($_SESSION);
    print_r($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Generador de Clases</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/default.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php
if(isset($_SESSION["errProyecto"])){
    if(!empty($_SESSION["errProyecto"])) {
        echo '<div class="alert alert-danger">';
        foreach($_SESSION["errProyecto"] as $e) {
            echo '<li>'.$e.'</li>';
        }
        echo '</div>';
    }
}
?>

<div class="container">

    <!-- Static navbar -->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Generador de Clases</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <form id="frmAbrir" method="post" action="abrir.php" enctype="multipart/form-data">
                    <ul class="nav navbar-nav navbar-right">
                        <li><input class="btn btn-default" name="archivo" type="file" value="Seleccionar Archivo"></li>
                        <li><input class="btn btn-default" type="submit" value="Abrir"></li>
                    </ul>
                </form>
            </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
    </nav>

    <!-- Begin page content -->
    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-sm-6">
                            Lista de clases
                        </div>
                        <div class="col-sm-6">
                            <span class="pull-right">
                                <a href="editarClase.php" class="btn btn-default" name="Agregar" >Agregar Clase</a>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="displayInput">
                        <?php
                            function mostrarVariables($V) {
                                $tmp = "[";
                                $sep = "";
                                foreach($V as $e) {
                                    $tmp .= $sep.$e['nombreCampo'];
                                    $sep = ", ";
                                }
                                return $tmp."]";
                            }

                            if(isset($_SESSION['clases'])) {
                                $elems = $_SESSION['clases'];
                                foreach ($elems as $i => $elem) {
                                    echo '<div class="dynamic">'.
                                        '<div class="col-sm-8">'.
                                        '<p><strong>'.$elem['nombre'].'</strong><br/>'.mostrarVariables($elem['campos']).'</p>'.
                                        '</div>'.
                                        '<div class="col-sm-2">'.
                                        '<a href="editarClase.php?id='.$i.'" class="btn btn-default">Editar clase</a>'.
                                        '</div>'.
                                        '<div class="col-sm-2">'.
                                        '<a href="borrarClase.php?id='.$i.'" class="remNew btn btn-warning">Eliminar clase</a>'.
                                        '</div>'.
                                        '<div class="clearfix">&nbsp;</div>'.
                                        '</div>';

                                }
                            }
                        ?>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">Nombre de Proyecto</div>
                <div class="panel-body">
                    <div class="form-add">
                        <div class="row">
                            <form method="post" action="generar.php">
                                <div class="col-sm-9">
                                    <input class="form-control" type="text" name="proyecto" value="<?php if(isset($_SESSION['proyecto'])) { echo $_SESSION['proyecto']; } ?>" placeholder="Nombre del Proyecto" required>
                                </div>
                                <div class="col-sm-3">
                                    <a href="limpiar.php" class="btn btn-danger" onclick="return confirm('¿Realmente quieres borar todo?\nSe perderán todos los campos.');">Eliminar</a>
                                    <input class="btn btn-success" type="submit" value="Generar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/jquery-2.2.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        var addDiv = $('.displayInput');
        var i = $('#displayInput').length;

        addDiv.on('click', '#remNew', function () {
            if (i > 0) {
                $(this).parents('#dynamic').remove();
                i--;
            }
            return false;
        });

    });
</script>


</body>
</html>