
<?php
function generarCodigo($longitud) {
    $key = '';
    $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
    $max = strlen($pattern)-1;
    for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
    return $key;
}

//Ejemplo de uso


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>HTML</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
</head>
<style>
    *{
        font-family: 'Roboto', sans-serif;
    }
#nuestroinput{
    display: block;
    padding:20px;
    color:#fff;
    background: #2f89fc;
    box-shadow: 2px 2px 10px rgb(0,0,0,.25);
    max-width: 250px;
    margin: auto;
    text-align: center;
}
label[for="nuestroinput"]{

}
</style>
<body>
<?php echo generarCodigo(7)?>
<form>
    <label for="nuestroinput"><ion-icon name="cloud-upload-outline"></ion-icon> Elige un fotografia</label>
    <input id="nuestroinput" type="file" accept="image/png, image/jpeg">
</form>
</body>
</html>
