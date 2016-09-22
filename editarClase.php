<?php
    if(empty(session_id()) && !isset($_SESSION)) {
        session_start();
        print_r(session_id());
    }

    print_r($_SESSION);

    $id = (isset($_GET['id']))?$_GET['id']:0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Template Generate Class</title>

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

<div class="hidden" id="divTipos">
    <?php
        $file = "tipos.json";
        $json = json_decode(file_get_contents($file));

        $tipoOptions = "";
        foreach($json as $e) {
            $tipoOptions .= '<option>'.$e.'</option>';
        }
        echo $tipoOptions;

        function selected($v) {
            global $json;
            $tipoOptions = "";

            foreach($json as $e) {
                $sltd = "";
                if($e == $v) {
                    $sltd = 'selected="selected"';
                }
                $tipoOptions .= '<option '.$sltd.'>'.$e.'</option>';
            }
            return $tipoOptions;
        }
    ?>
</div>

<?php
    if(isset($_SESSION["errClase"])){
        if(!empty($_SESSION["errClase"])) {
            echo '<div class="alert alert-danger">';
            foreach($_SESSION["errClase"] as $e) {
                echo '<li>'.$e.'</li>';
            }
            echo '</div>';
        }
    }
?>
<section>
    <form method="post" action="guardar.php">
        <div class="container">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">Nombre de clase</div>
                    <div class="panel-body">
                        <div class="form-add">
                            <div class="row">
                                <div class="col-sm-9">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                    <input class="form-control" type="text" name="clase" value="<?php if($id) { if(isset($_SESSION['clases'][$id])) { echo $_SESSION['clases'][$id]['nombre']; } } ?>" placeholder="Nombre" required>
                                </div>
                                <div class="col-sm-3">
                                    <a class="btn btn-default" href="#" id="addNew">Agregar variables</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Variables</h3>
                    </div>
                    <div class="panel-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-fields">

                                <div class="displayinput">
                                <?php
                                    if($id) {
                                        if(isset($_SESSION['clases'][$id])) {
                                            $elems = $_SESSION['clases'][$id]['campos'];
                                            foreach ($elems as $i => $elem) {
                                                echo '<div class="dynamic">'.
                                                        '<div class="col-xs-6">'.
                                                            '<input type="text" class="form-control" id="nombreCampo'.$i.'" size="40" name="nombreCampo['.$i.']" value="'.$elem['nombreCampo'].'" placeholder="Nombre de variable" />'.
                                                        '</div>'.
                                                        '<div class="col-xs-3">'.
                                                            '<select class="form-control" id="tipoCampo'.$i.'" name="tipoCampo['.$i.']">'.selected($elem['tipoCampo']).'</select>'.
                                                        '</div>'.
                                                        '<div class="col-xs-3">'.
                                                            '<a href="javascript:;" class="remNew btn btn-default">Eliminar variable</a>'.
                                                        '</div>'.
                                                        '<div class="clearfix">&nbsp;</div>'.
                                                    '</div>';

                                            }
                                        }
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-default" href="index.php">Regresar</a>
                    <input class="btn btn-success" type="submit" value="Agregar">
                </div>
            </div>
        </div>
    </form>
</section>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="assets/js/jquery-2.2.4.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/js/bootstrap.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        var addDiv = $('.displayinput');
        var i = $('.displayinput > .dynamic').length;

        $('#addNew').on('click', function () {
            $('<div class="dynamic">' +
                    '<div class="col-xs-6">' +
                        '<input type="text" class="form-control" id="nombreCampo'+i+'" size="40" name="nombreCampo['+i+']" value="" placeholder="Nombre de variable" />' +
                    '</div>' +
                    '<div class="col-xs-3">' +
                        '<select class="form-control" id="tipoCampo'+i+'" name="tipoCampo['+i+']">' +
                            $('#divTipos').html() +
                        '</select>' +
                    '</div>' +
                    '<div class="col-xs-3">' +
                        '<a href="javascript:;" class="remNew btn btn-default">Eliminar variable</a>' +
                    '</div>' +
                    '<div class="clearfix">&nbsp;</div>' +
                '</div>').appendTo(addDiv);
            i++;
            return false;
        });

        $(document).on('click', '.remNew', function () {
            if (i > 0) {
                $(this).parents('.dynamic').remove();
                i--;
            }
            return false;
        });

    });
</script>


</body>
</html>
