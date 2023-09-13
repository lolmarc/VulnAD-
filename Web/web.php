<?php
    $dir_local = "files/"; // Ruta local donde se guardarán los archivos
    #$dir_remote = "\\\\192.168.1.11\\files\\"; // Ruta remota donde se guardarán los archivos
    $selected_dir = $dir_local; // Ruta por defecto: directorio local

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_FILES['userfile'])){
            if(isset($_POST['directory']) && $_POST['directory'] === 'remote'){
                $uploadfile = $dir_remote . basename($_FILES['userfile']['name']);
                $selected_dir = $dir_remote; // Seleccionar directorio remoto
            } else {
                $uploadfile = $dir_local . basename($_FILES['userfile']['name']);
                $selected_dir = $dir_local; // Seleccionar directorio local
            }

            if(move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)){
                echo "Archivo subido correctamente.";
            } else{
                echo "¡Posible ataque de subida de ficheros!";
            }
        }

    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tu sitio web</title>
    <style>
        /* Estilo CSS */
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f1f1f1;
        }

        img {
            width: 150px;
            margin-top: 50px;
        }

        form {
            margin: 20px auto;
            width: 300px;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.15);
        }

        input[type="file"] {
            margin: 20px 0;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.15);
        }

        button {
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            float: center;
            padding: 10px;
        }

        button:hover {
            background-color: #e33326;
        }

        a {
            text-decoration: none;
            color: #333;
        }
    </style>
</head>
<body>
    <img src="logo.png" alt="Logo" />
    <!-- Formulario para subir archivo -->
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="userfile" />
        <br />
        <input type="radio" name="directory" value="local" checked>local
        <input type="radio" name="directory" value="remote"> remoto
        <br />
        <input type="submit" value="Subir archivo" />
    </form>

    <!-- Listado de archivos -->
    <ul>
    <?php
    $files = array_diff(scandir($selected_dir), array('.', '..'));
    foreach($files as $file){
        echo "<li><a href=\"$selected_dir$file\">$file</a>
        <form method=\"POST\">
            <button name=\"delete\" value=\"$file\">Eliminar</button>
            <button name=\"execute\" value=\"$file\">Ejecutar</button>
        </form></li>";
    }
    ?>
    </ul>
</body>
</html>
