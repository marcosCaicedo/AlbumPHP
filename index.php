<?php include "header.php";?>
<?php include "C:\Apache24\htdocs\ConexionDB\config.php";
      include "C:\Apache24\htdocs\proyectoPHP\Conexion.php";
?>

<?php

$connDB =new ConexionBD($host, $usuario, $contrasena, $base_de_datos);
$query="SELECT id_hero,nombre_img,img,descripcion FROM dota_database.heroes_imagenes";
$rsHeroes= $connDB->ejecutarConsulta($query);
$imgAlmacen = "fotos/";
// $imgNombre= $rsHeroes[0]['img'];
// echo$imgAlmacen.$imgNombre;

?>

<div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($rsHeroes as $heroe){?>

            
                        <div class="col">
                            <div class="card">
                            <img width="100" height="300" src="<?php echo $imgAlmacen.$heroe['img'] ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $heroe['nombre_img'];?></h5>
                                <p class="card-text"><?php echo $heroe['descripcion']  ?></p>
                            </div>
                            </div>
                        </div>
                        

        <?php } ?>
</div>

<?php include "footer.php"?>