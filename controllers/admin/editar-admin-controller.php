<?php
    include('/xampp/htdocs/escuela/config/conexion_PDO.php');

    if(isset($_GET['id_admin'])){
        $txtId = isset($_GET['id_admin'])?$_GET['id_admin']:"";
        $stm = $conexion->prepare('SELECT * FROM admin WHERE id_admin = :txtId');
        $stm->bindParam(":txtId", $txtId);
        $stm->execute();
        $registro = $stm->fetch(PDO::FETCH_LAZY);
        $nombres = $registro['nombres'];
        $apellidos = $registro['apellidos'];
        $edad = $registro['edad'];
    } else{
        echo 'Registro no encontrado!!';
    }

    include('/xampp/htdocs/escuela/config/conexion_mysql_i.php');

    if(isset($_POST['update'])){
      if(
        strlen($_POST['id_admin'])>= 1 &&
        strlen($_POST['nombres'])>= 1 &&
        strlen($_POST['apellidos'])>= 1 &&
        strlen($_POST['edad'])>= 1
      ){
        $id_admin = (isset($_POST['id_admin'])?$_POST['id_admin']:'');
        $nombres = (isset($_POST['nombres'])?$_POST['nombres']:'');
        $apellidos = (isset($_POST['apellidos'])?$_POST['apellidos']:'');
        $edad = (isset($_POST['edad'])?$_POST['edad']:'');
        
        $query = "UPDATE admin SET 
            nombres = ?, 
            apellidos = ?, 
            edad = ?
            WHERE id_admin = ?";

        $stmt = mysqli_prepare($conection, $query);
        mysqli_stmt_bind_param($stmt, 'ssii', $nombres, $apellidos, $edad, $id_admin);
        $result = mysqli_stmt_execute($stmt);
    
        if($result){
          ?>
          <script script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
          <script>
              swal("Datos actualizados con éxito!!!", "", "success");
          </script>
          <?php
        }
        else{
          ?>
          <h3 class="error">Ocurrio un error!!!</h3>
          <?php
        }
      }
      else{
        ?>
        <script script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
          swal("Llena todos los campos!!!");
        </script>
        <?php
      }
    }
    
?>