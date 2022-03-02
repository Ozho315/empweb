<?php include("../template/encabezado.php")?>

<div class="col-md-5">
    Formulario Nuevos    Productos
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
    <button type="button" class="btn btn-success">Agregar</button>
    <button type="button" class="btn btn-warning">Modificar</button>
    <button type="button" class="btn btn-info">Cancelar</button>
</div>
    

    </form>

        </div>
        
    </div>

    
    
    
</div>

<div class="col-md-7">
    Tabla de Productos (Mostrar datos de productos)

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
        <tr>
            <td>2</td>
            <td>Libro</td>
            <td>15</td>
            <td>$150</td>

            <td>Seleccionar | Borrar</td>            
        </tr>
       
    </tbody>
</table>

</div>

<?php include("../template/pie.php")?>