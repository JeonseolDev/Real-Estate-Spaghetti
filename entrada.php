<?php 
    require 'includes/funciones.php';

    incluirTemplate('header', $inicio = false);
 ?>

    <main class="contenedor seccion contenido-centrado">
        <h1>Casa en Venta frente al bosque</h1>

        
        
        <picture>
            <source srcset="build/img/destacada.webp" type="image/webp">
            <source srcset="build/img/destacada.jpg" type="image/jepg">
            <img src="build/img/destacada.jpg" alt="Imagen de la propiedad" loading="lazy">
        </picture>

        <p class="informacion-meta">Escrito el: <span>20/6/22</span> por: <span>Admin</span></p>
        
        <div class="resumen-propiedad">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea aliquam tenetur incidunt repellendus voluptatum ad cumque optio? Eum, id, recusandae, 
                praesentium nostrum velit porro culpa officia sequi debitis quaerat dolorum?</p>
        </div>
    </main>


    <?php incluirTemplate('footer');?>