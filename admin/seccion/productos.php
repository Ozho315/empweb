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
            $sentenciaSQL->bindParam(':nombre_prod',$txtNombre);
            $sentenciaSQL->bindParam(':canti_prod',$txtCanti);
            $sentenciaSQL->bindParam(':precio_prod',$txtPrecioV);
            $sentenciaSQL->execute();
        break;

        case "Modificar":

            $sentenciaSQL=$conexion->prepare("UPDATE tbl_productos SET nombre_prod=:nombre_prod WHERE id_prod=:id_prod");
            $sentenciaSQL->bindParam(':nombre_prod',$txtNombre); 
            $sentenciaSQL->bindParam(':id_prod',$txtId);
            $sentenciaSQL->execute();

            $sentenciaSQL=$conexion->prepare("UPDATE tbl_productos SET canti_prod=:canti_prod WHERE id_prod=:id_prod");
            $sentenciaSQL->bindParam(':canti_prod',$txtCanti); 
            $sentenciaSQL->bindParam(':id_prod',$txtId);
            $sentenciaSQL->execute();

            $sentenciaSQL=$conexion->prepare("UPDATE tbl_productos SET precio_prod=:precio_prod WHERE id_prod=:id_prod");
            $sentenciaSQL->bindParam(':precio_prod',$txtPrecioV); 
            $sentenciaSQL->bindParam(':id_prod',$txtId);
            $sentenciaSQL->execute();

            header("Location:productos.php");//actualizar pagina
            
        break;

        case "Cancelar":
            header("Location:productos.php");
            break;
        
        case "Seleccionar":
            $sentenciaSQL=$conexion->prepare("SELECT * FROM tbl_productos WHERE id_prod=:id_prod");
            $sentenciaSQL->bindParam(':id_prod',$txtId);    
            $sentenciaSQL->execute();
            $Producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY); //cargar datos uno a uno y rellenar id's

            $txtNombre=$Producto['nombre_prod'];
            $txtCanti=$Producto['canti_prod'];
            $txtPrecioV=$Producto['precio_prod'];
            
            break;

        case "Borrar":
        $sentenciaSQL=$conexion->prepare("DELETE FROM tbl_productos WHERE id_prod=:id_prod");
        $sentenciaSQL->bindParam(':id_prod',$txtId);
        $sentenciaSQL->execute();    
        
        header("Location:productos.php");
            break;

}

//MOSTRAR REGISTRO
$sentenciaSQL=$conexion->prepare("SELECT * FROM tbl_productos");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

//MOSTRAR REGSITRO MATERIAS PRIMAS

$sentenciaSQL2=$conexion->prepare("SELECT nombre_mat FROM tbl_materiasp");
$sentenciaSQL2->execute();
$listaMaterias=$sentenciaSQL2->fetchAll(PDO::FETCH_BOTH);

?>

<div class="col-md-4">
    <b>Formulario Nuevos Productos</b>
    <br/><br/>
    <div class="card">
        <div class="card-header ">
            Datos de Producto
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/formdata">

        <div class = "form-group">
        <label for="txtId">Id Producto:</label>
        <input type="text" required readonly class="form-control" value="<?php echo $txtId; ?>" name="txtId" id="txtId"  >
        </div>

        <div class = "form-group">
        <label for="txtNombre">Nombre:</label>
        <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre"  placeholder="Ingrese Nombre Producto">
        </div>

        <div class = "form-group">
        <label for="txtCanti">Cantidad:</label>
        <input type="text" required class="form-control" value="<?php echo $txtCanti; ?>" name="txtCanti" id="txtCanti"  placeholder="Ingrese Cantidad Producto">
        </div>

        <div class = "form-group">
        <label for="txtPrecioV">Precio de Venta:</label>
        <input type="text" required class="form-control" value="<?php echo $txtPrecioV; ?>" name="txtPrecioV" id="txtPrecioV"  placeholder="Ingrese Precio Venta">
        </div>  

        <div class="form-group">
        <label for="validationCustom04" class="form-label">Materia Prima</label></br>   
        <select class="form-select" id="validationCustom04" required>
        <option selected disable value="">Elegir opcion</option>
        <option>

        <?php foreach($listaMaterias as $tbl_materiasp){?>
            <tr>
            <td>
                <?php 
                    
                    echo $tbl_materiasp[1];
            
                ?>
            </td>
            </tr>
        <?php }?>

        </option>
        </select>
        </div>
    
            <div class="btn-group" role="group" aria-label="">
                <button type="submit" name="accion" <?php echo ($accion=="Seleccionar")?"disabled":""?> value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""?> value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" <?php echo ($accion!="Seleccionar")?"disabled":""?> value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>
    

            </form>

        </div>
        
    </div>
    
</div>

<div class="col-md-8">
</br>
</br>

<table class="table table-info table-hover table-bordered table-sm">
    <thead>
        <tr>
        
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Preciode Venta</th>
            <th>Acciones</th>

        </tr>
    </thead>
    <tbody>
    <?php foreach($listaProductos as $tbl_productos){?>
        <tr>
            
            <td><?php echo $tbl_productos['nombre_prod']?></td>
            <td><?php echo $tbl_productos['canti_prod']?></td>
            <td><?php echo $tbl_productos['precio_prod']?></td>

            <td>
                
                <form method="post">
                <input type="hidden" name="txtId" id="txtId" value="<?php echo $tbl_productos['id_prod'];?>"/>
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