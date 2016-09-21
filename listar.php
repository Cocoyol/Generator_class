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
                <form id="frmAbrir" method="post" action="abrir.php">
                    <ul class="nav navbar-nav navbar-right">
                        <li><input class="btn btn-default" type="file" value="Seleccionar Archivo"></li>
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
                <div class="panel-heading">Nombre de Proyecto</div>
                <div class="panel-body">
                    <div class="form-add">
                        <div class="row">
                            <div class="col-sm-9">
                                <input class="form-control" type="text" name="proyecto" value="" placeholder="Proyecto..." required>
                            </div>
                            <div class="col-sm-3">
                                <a class="btn btn-default" href="#" id="addNew">Agregar Clase</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Lista de clases</div>
                <div class="panel-body">
                    <div class="displayInput">

                    </div>
                </div>
            </div>
            <div class="pull-right">
                <input class="btn btn-success" type="submit" value="Generar">
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

        $('#addNew').on('click', function () {
            $('<div id="dynamic">' +
                '<div class="col-sm-8">' +
                '<input type="text" class="form-control" id="nombreCampo'+i+'" size="40" name="nombreCampo['+i+']" value="" placeholder="Nombre de Clase" />' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<a href="javascript:;" id="edNew" class="btn btn-default">Editar Clase</a>' +
                '</div>' +
                '<div class="col-sm-2">' +
                '<a href="javascript:;" id="remNew" class="btn btn-default">Eliminar Clase</a>' +
                '</div>' +
                '<div class="clearfix">&nbsp;</div>' +
                '</div>').appendTo(addDiv);
            i++;
            return false;
        });

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