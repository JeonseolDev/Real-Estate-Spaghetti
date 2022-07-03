<?php 

    // Base de datos
    require '../../includes/config/database.php';
    $db = conectarDB();

    // Consultar para obtener los vendedores

    $consulta = "SELECT * FROM vendedores";
    $resultado = mysqli_query($db, $consulta);

    // Arreglo con mensajes de errores
    $errores = [];
    
    $titulo = '';
    $precio = '';
    $descripcion = '';
    $habitaciones = '';
    $baños = '';
    $estacionamiento = '';
    $vendedorId = '';

    // Asignar files hacia una variable
    
    $imagen = $_FILES['imagen'] ?? null;

    // Ejecutar el codigo después de que el usuario envia el formulario
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
        $precio = mysqli_real_escape_string($db, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
        $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
        $baños = mysqli_real_escape_string($db, $_POST['baños']);
        $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
        $vendedorId = mysqli_real_escape_string($db, $_POST['vendedorId']);
        $creado = date('Y-m-d');

        if(!$titulo) {
            $errores[] = "Debes añadir un titulo";
        }

        if(!$precio){
            $errores[] = "Debes añadir un precio";
        }

        if(strlen($descripcion) < 50) {
            $errores[] = "La descripción es obligatoria y debe tener al menos 50 caracteres";
        }

        if(!$habitaciones) {
            $errores[] = "Debes añadir una habitacion/es";
        }

        if(!$baños) {
            $errores[] = "Debes añadir un baño/s";
        }

        if(!$estacionamiento) {
            $errores[] = "Debes añadir un estacionamiento/s";
        }

        if(!$vendedorId) {
            $errores[] = "Debes elegir un vendedor";
        }

        if(!$imagen['name']) {
            $errores [] = "Debes poner una imagen";
        }

        // Validar por tamaño (100kb máximo)
        
        if($imagen['size'] > 100000 || $imagen['error']) {
            $errores[] = "La imagen es muy pesada";
        }


        
        // Revisar que el arreglo de errores este vacío

        if(empty($errores)) {

            /** Subida de archivos */
            
            // Crear una carpeta
            
            $carpetaImagenes = '../../imagenes';
            
            if(!is_dir($carpetaImagenes)) {
                mkdir($carpetaImagenes);
            }
            // Generar un nombre unico

            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Subir la imagen

            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . "/" . $nombreImagen);

            $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedorId) VALUES ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$baños', '$estacionamiento', '$creado', '$vendedorId')";

            $resultado = mysqli_query($db, $query);

            if ($resultado) {
                // Redireccionar al usuario.

                header('Location: /bienesraices/admin/index.php?resultado=1');
        }
        }

        // Insertar en la base de datos

        
    }
    
    require '../../includes/funciones.php';

    incluirTemplate('header', $inicio = false);
 ?>

    <main class="contenedor seccion">
        <h1>Crear Propiedad</h1>
        <a href="/bienesraices/admin/index.php" class="boton boton-verde">Volver</a>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php endforeach; ?>

        <form action="/bienesraices/admin/propiedades/crear.php" class="formulario" method="POST" enctype="multipart/form-data">
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo;?>">
                
                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio;?>">

                <label for="imagen">Imagen</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" value="<?php echo $descripcion;?>"></textarea>
            </fieldset>
            <fieldset>
                <legend>Información propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number" id="habitaciones" name="habitaciones" placeholder="EJ: 1" min="1" max="9" value="<?php echo $habitaciones;?>">

                <label for="baños">Baños:</label>
                <input type="number" id="baños" name="baños" placeholder="EJ: 1" min="1" max="9" value="<?php echo $baños;?>">
                
                <label for="estacionamientos">Estacionamientos:</label>
                <input type="number" id="estacionamientos" name="estacionamiento" placeholder="EJ: 1" min="1" max="9" value="<?php echo $estacionamiento;?>">
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                
                <select name="vendedorId">
                    <option value="">--Seleccione--</option>
                    <?php while($row = mysqli_fetch_assoc($resultado)): ?>
                        <option <?php echo $vendedorId === $row['id'] ? 'selected' : '' ;?>value="<?php echo $row['id']; ?>">
                        <?php echo $row['nombre'] . " " . $row['apellido']; ?></option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Crear Propiedad" class="boton boton-verde"> 
        </form>
    </main>
    
<?php 
    incluirTemplate('footer');
?>