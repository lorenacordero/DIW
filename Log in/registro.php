<html>
    <body>
        <?php

        $nombre=$email=$password="";
        $nombreErr=$emailErr=$passwordErr="";

        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty($_POST["nombre"])) {
                $nombreErr = "obligatorio";
              } else {
                $nombre = test_input($_POST["nombre"]);
              }
            
            if (empty($_POST["email"])) {
                $emailErr = "obligatorio";
            } else {
                $email = test_input($_POST["email"]);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "correo erroneo";
                }
            }
            
            if (empty($_POST["password"])) {
                $passwordErr = "obligatorio";
              } else {
                $password = test_input($_POST["password"]);
              }

        }

        
        if(empty($nombreErr) && empty($emailErr) && empty($passwordErr) && !empty($nombre) && !empty($email) && !empty($password)){
            $conexion = mysqli_connect("localhost:3307", "root", "", "registro") or
            die("Problemas con la conexión");

            mysqli_query($conexion, "insert into registros(nombre,email,password) values  
                ('$_POST[nombre]','$_POST[email]', '$_POST[password]')") or 
                die("Problemas en el select".mysqli_error($conexion));

            mysqli_close($conexion);
            echo "<h1>Datos insertados correctamente</h1>";
        }

        ?>
    </body>
</html>