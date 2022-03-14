<?php include("../template/encabezado.php")?>

<?php

$txtId=(isset($_POST['txtId']))?$_POST['txtId']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtCanti=(isset($_POST['txtCanti']))?$_POST['txtCanti']:"";
$txtPrecioV=(isset($_POST['txtPrecioV']))?$_POST['txtPrecioV']:"";
$txtDescripcion=(isset($_POST['txtDescripcion']))?$_POST['txtDescripcion']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("../config/bdd.php");

//Acciones Botones
switch ($accion){

        case "Agregar";
            $sentenciaSQL=$conexion->prepare("INSERT INTO tbl_materiasp (nombre_mat, unidadmed_mat, costouni_mat, descripcion_mat) VALUES (:nombre_mat, :unidadmed_mat, :costouni_mat, :descripcion_mat);");
            $sentenciaSQL->bindParam(':nombre_mat',$txtNombre);
            $sentenciaSQL->bindParam(':unidadmed_mat',$txtCanti);
            $sentenciaSQL->bindParam(':costouni_mat',$txtPrecioV);
            $sentenciaSQL->bindParam(':descripcion_mat',$txtDescripcion);
            $sentenciaSQL->execute();
            echo $txtNombre='';
            echo $txtCanti='';
            echo $txtPrecioV='';
            echo $txtDescripcion='';

        break;

        case "Modificar":

            $sentenciaSQL=$conexion->prepare("UPDATE tbl_materiasp SET nombre_mat=:nombre_mat WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':nombre_mat',$txtNombre); 
            $sentenciaSQL->bindParam(':id_materia',$txtId);
            $sentenciaSQL->execute();

            $sentenciaSQL=$conexion->prepare("UPDATE tbl_materiasp SET unidadmed_mat=:unidadmed_mat WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':unidadmed_mat',$txtCanti); 
            $sentenciaSQL->bindParam(':id_materia',$txtId);
            $sentenciaSQL->execute();

            $sentenciaSQL=$conexion->prepare("UPDATE tbl_materiasp SET costouni_mat=:costouni_mat WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':costouni_mat',$txtPrecioV); 
            $sentenciaSQL->bindParam(':id_materia',$txtId);
            $sentenciaSQL->execute();

            $sentenciaSQL=$conexion->prepare("UPDATE tbl_materiasp SET descripcion_mat=:descripcion_mat WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':descripcion_mat',$txtDescripcion); 
            $sentenciaSQL->bindParam(':id_materia',$txtId);
            $sentenciaSQL->execute();

            header("Location:materiasp.php");//actualizar pagina
            
        break;

        case "Cancelar":
            header("Location:materiasp.php");
            break;
        
        case "Seleccionar":
            $sentenciaSQL=$conexion->prepare("SELECT * FROM tbl_materiasp WHERE id_materia=:id_materia");
            $sentenciaSQL->bindParam(':id_materia',$txtId);    
            $sentenciaSQL->execute();
            $Producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY); //cargar datos uno a uno y rellenar id's

            $txtNombre=$Producto['nombre_mat'];
            $txtCanti=$Producto['unidadmed_mat'];
            $txtPrecioV=$Producto['costouni_mat'];
            $txtDescripcion=$Producto['descripcion_mat'];
            
            break;

        case "Borrar":
        $sentenciaSQL=$conexion->prepare("DELETE FROM tbl_materiasp WHERE id_materia=:id_materia");
        $sentenciaSQL->bindParam(':id_materia',$txtId);
        $sentenciaSQL->execute();    
        
        header("Location:materiasp.php");
            break;

}

//MOSTRAR REGISTRO
$sentenciaSQL=$conexion->prepare("SELECT * FROM tbl_materiasp");
$sentenciaSQL->execute();
$listaMateriasP=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="col-md-4">
    <b>Formulario Ingreso Materias Primas e Insumos</b>
    <br/><br/>
    <div class="card">
        <div class="card-header">
            Datos de Materia Prima
        </div>

        <div class="card-body">
            <form method="POST" enctype="multipart/formdata">

        <div class = "form-group">
        <label for="txtId">Id Producto:</label>
        <input type="text" required readonly class="form-control" value="<?php echo $txtId; ?>" name="txtId" id="txtId" >
        </div>

        <div class = "form-group">
        <label for="txtNombre">Nombre:</label>
        <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre"  placeholder="Ingrese Nombre Materia">
        </div>

        <div class = "form-group">
        <label for="txtCanti">Unidad Medida:</label>
        <input type="text" required class="form-control" value="<?php echo $txtCanti; ?>" name="txtCanti" id="txtCanti"  placeholder="Ingrese Unidad Medida">
        </div>

        <div class = "form-group">
        <label for="txtPrecioV">Costo Unitario:</label>
        <input type="text" required class="form-control" value="<?php echo $txtPrecioV; ?>" name="txtPrecioV" id="txtPrecioV"  placeholder="Ingrese Costo Unitario">
        </div>  

        <div class = "form-group">
        <label for="txtPrecioV">Descripcion:</label>
        <textarea type="text" required class="form-control" value="<?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion"  placeholder="Ingrese Descripcion"></textarea>
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


<div class="col-md-8" id="Tabla Materias">
</br></br>
<table class="table table-info table-hover table-bordered table-sm">
    <thead>
        <tr>
            
            <th>Nombre</th>
            <th>Unidad Medida</th>
            <th>Costo Unitario</th>
            <th>Descripcion</th>

        </tr>
    </thead>
    <tbody>
        
    <?php foreach($listaMateriasP as $tbl_materiasp){?>
        <tr>
            
            <td><?php echo $tbl_materiasp['nombre_mat']?></td>
            <td><?php echo $tbl_materiasp['unidadmed_mat']?></td>
            <td><?php echo $tbl_materiasp['costouni_mat']?></td>
            <td><?php echo $tbl_materiasp['descripcion_mat']?></td>

            <td>
                
                <form method="post">
                <input type="hidden" name="txtId" id="txtId" value="<?php echo $tbl_materiasp['id_materia'];?>"/>
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