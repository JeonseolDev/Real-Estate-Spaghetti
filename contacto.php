<?php 
    require 'includes/funciones.php';

    incluirTemplate('header', $inicio = false);
 ?>

    <main class="contenedor seccion">
        <h1>Contacto</h1>

        <picture>
            <source srcset="build/img/destacada3.webp" type"image/webp">
            <source srcset="build/img/destacada3.jpg" type"image/jpeg">
            <img src="build/img/destacada3.jpg" alt="Imagen Contacto" loading="lazy">
        </picture>
    

    <h2>Llene el formulario de Contacto</h2>

    <form action="" class="formulario">
        <fieldset>
            <legend>Información Personal</legend>

            <label for="nombre">Nombre</label>
            <input type="text" placeholder="Tu Nombre" id="nombre">

            <label for="email">Nombre</label>
            <input type="email" placeholder="Tu Email" id="email">

            <label for="telefono">Nombre</label>
            <input type="tel" placeholder="Tu Teléfono" id="telefono">

            <label for="nombre">Mensaje:</label>
            <textarea name="" id="mensaje"></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Vende o Compra</label>
            <select name="" id="opciones">
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="Compra">Compra</option>
                <option value="Vende">Vende</option>
            </select>
            <label for="presupuesto">Presupuesto</label>
            <input type="number" placeholder="Tu Presupuesto" id="presupuesto">
        </fieldset>
        <fieldset>
            <legend>Contacto</legend>
            <p>Como desea ser contactado</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-telefono">

                <label for="contactar-email">Email</label>
                <input name="contacto" type="radio" value="telefono" id="contactar-email">
            </div>
            <p>Si eligió teléfono, elija la fecha y la hora</p>
            
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00">
        </fieldset>
        
        <input type="submit" value="enviar" class="boton-verde">
    </form>
</main>


<?php incluirTemplate('footer');?>