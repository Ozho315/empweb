<?php include("../template/encabezado.php")?>

<?php

$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtCanti=(isset($_POST['txtCanti']))?$_POST['txtCanti']:"";
$txtPrecioV=(isset($_POST['txtPrecioV']))?$_POST['txtPrecioV']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bdd.php");

//Acciones Botones
switch ($accion){

        case "Agregar";
            $sentenciaSQL=$conexion->prepare("INSERT INTO tbl_productos (nombre_prod, canti_prod, precio_prod) VALUES (:nombre_prod, :canti_prod, :precio_prod);");
            $sentenciaSQL->bindParam('nombre_prod',$txtNombre);
            $sentenciaSQL->bindParam('canti_prod',$txtCanti);
            $sentenciaSQL->bindParam('precio_prod',$txtPrecioV);
            $sentenciaSQL->execute();
        break;

        case "Modificar";
            echo "Presiona boton para Modificar";
        break;

        case "Cancelar";
            echo "Presiona boton para Cancelar";
            break;

}

//MOSTRAR REGISTRO
$sentenciaSQL=$conexion->prepare("SELECT * FROM tbl_productos");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-5">
    Formulario Nuevos Productos
    <br/><br/>
    <div class="card">
        <div class="card-header">
            Datos de Producto
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/formdata">

        <div class = "form-group">
        <label for="txtId">Id Producto:</label>
        <input type="text" class="form-control" name="txtId" id="txtId"  placeholder="Ingrese Id Producto">
        </div>

        <div class = "form-group">
        <label for="txtNombre">Nombre:</label>
        <input type="text" class="form-control" name="txtNombre" id="txtNombre"  placeholder="Ingrese Nombre Producto">
        </div>

        <div class = "form-group">
        <label for="txtCanti">Cantidad:</label>
        <input type="text" class="form-control" name="txtCanti" id="txtCanti"  placeholder="Ingrese Cantidad Producto">
        </div>

        <div class = "form-group">
        <label for="txtPrecioV">Precio de Venta:</label>
        <input type="text" class="form-control" name="txtPrecioV" id="txtPrecioV"  placeholder="Ingrese Precio Venta">
        </div>
    
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>
    

            </form>

        </div>
        
    </div>
    
</div>

<div class="col-md-7">
    
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID Producto</th>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Preciode Venta</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach($listaProductos as $tbl_productos){?>
        <tr>
            <td><?php echo $tbl_productos['id_prod']?></td>
            <td><?php echo $tbl_productos['nombre_prod']?></td>
            <td><?php echo $tbl_productos['canti_prod']?></td>
            <td><?php echo $tbl_productos['precio_prod']?></td>

            <td>
                Seleccionar | Borrar
                <form method="post">
                <input type="hidden" name="txtId" id="txtId" value="<?php echo $tbl_productos['id_prod'];?>">
                <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"/>
                <input type="submit" name="accion" value="Borrar" class="btn btn-danger"/>

                </form>
            </td>            

        </tr>
    <?php }?>
    </tbody>
</table>

</div>

<?php include("../template/pie.php")?>