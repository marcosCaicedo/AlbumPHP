<?php 
include "header.php";
include "C:\Apache24\htdocs\ConexionDB\config.php";
include "C:\Apache24\htdocs\proyectoPHP\Conexion.php";

$connDB =new ConexionBD($host, $usuario, $contrasena, $base_de_datos);
$query="SELECT id_hero,nombre_img,img,descripcion FROM dota_database.heroes_imagenes";
$rsHeroes= $connDB->ejecutarConsulta($query);

$destinoImg = "fotos/";


if($_POST){

    global $connDB;
    global $destinoImg;

    $nombreProyecto = $_POST['projectName'];
    $descripcionProyecto =  $_POST['descripcion'];  
    $nombreImagen = $_FILES['imageName']['name'];    
    $nombreTmp = $_FILES['imageName']['tmp_name'];

    //$destinoImg = "fotos/";

    $query0 = "INSERT INTO `dota_database`.`heroes_imagenes` (id_hero,nombre_img,img,descripcion) VALUES (NULL,'$nombreProyecto','$nombreImagen','$descripcionProyecto')";
     
    //Guardado de imagenes
    $resultadoGuardado = move_uploaded_file($nombreTmp,$destinoImg.$nombreImagen);
    if(!$resultadoGuardado){
        echo "Guardado erroneo";
    }else{
        echo "Guardado Exito";
    }
    
    $connDB->ejecutarConsulta($query0);

    header("location:projectAlbum.php");
}

if($_GET){

    global $connDB;

    global $destinoImg;
    //$destinoImg = "fotos/";
    $idBorrar =  $_GET['borrar'];
    
    $query2 = "SELECT img from heroes_imagenes WHERE id_hero = $idBorrar";
    $imagen = $connDB->ejecutarConsulta($query2);
    $imagenBorrar = $imagen[0]['img'];
    // echo "imagenBorrar :";
    // var_dump($imagenBorrar);

    //echo "destinoBorrar: ".$destinoImg.$imagenBorrar;

   $resultadoBorrado = unlink($destinoImg.$imagenBorrar);

   if($resultadoBorrado){
       echo "<br/>"."Borrado con Exito"."<br/>";
    }else{
    echo "<br/>"."Borrado erroneo"."<br/>";
}

    $query1 = "DELETE FROM `dota_database`.`heroes_imagenes` WHERE (`id_hero` = '$idBorrar')";
    $connDB->ejecutarConsulta($query1);

    header("location:projectAlbum.php");

}
?>




<br/>
<br/>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                        <div class="card">
                        <div class="card-header">
                            Datos del proyecto
                        </div>
                        <div class="card-body">
                        <form action="projectAlbum.php" method="post" enctype="multipart/form-data">
                            Nombre del proyecto: <input required class="form-control" type="text" name="projectName">
                            <br/>
                            Nombre de la imagen: <input required class="form-control" type="file" name="imageName">
                            <br/>
                            Descripcion:
                            <br/>
                                        <textarea required name="descripcion" id="" cols="30" rows="5"></textarea>
                            <br/>            
                            <input class="btn btn-success" type="submit" value="Enviar Proyecto">
                        </form>

                        </div>
                        <div class="card-footer text-muted">Footer</div>
            </div>
            </div>
            <div class="col-md-6">
                    <table
                    class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE PROYECTO</th>
                            <th scope="col">IMAGEN</th>
                            <th scope="col">DESCRIPCION</th>
                            <th scope="col">ACCIONES</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($rsHeroes as $heroe){?>
                        <tr >
                            <td><?php echo $heroe['id_hero'] ?></td>
                            <td><?php echo $heroe['nombre_img'] ?></td>                                  
                            <td> <img width="100" height="100" src="<?php echo $destinoImg.$heroe['img'] ?>" > </td>                                  
                            <td><?php echo $heroe['descripcion'] ?></td>                                  
                            <td> <a name="" id="" class="btn btn-primary" href="?borrar=<?php echo $heroe['id_hero'];  ?>" role="button">Eliminar</a> </td>                                  
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    

    
 

   
    






<?php include "footer.php"?>
