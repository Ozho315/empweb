<?php include("template/encabezado.php");?>

<?php

include("admin/config/bdd.php");

//MOSTRAR REGISTROS PRODUCTOS
$sentenciaSQL=$conexion->prepare("SELECT * FROM tbl_productos");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>
    
    <table class="table table-bordered">
    
    <thead>
    
        <tr>
            <th>ID Producto</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Preciode Venta</th>
           
        </tr>
    </thead>
    <tbody>
    <?php foreach($listaProductos as $tbl_productos){?>
        <tr>
            <td><?php echo $tbl_productos['id_prod']?></td>
            <td><?php echo $tbl_productos['nombre_prod']?></td>
            <td><?php echo $tbl_productos['canti_prod']?></td>
            <td><?php echo $tbl_productos['precio_prod']?></td>

            </form>
            </td>            

        </tr>
    <?php }?>
    </tbody>
</table>

<?php include("template/pie.php");?>