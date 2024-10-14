<?php require_once 
"./templates/layouts/header.phtml";
?>
<main class="container mt-5">
    <section class="room-list">
        <h2 class="text-center mb-4">Nuestras Habitaciones</h2>
        <div class="row">
            <?php foreach (array_slice($rooms, 0, 6) as $room): // Mostrar solo las 5 habitaciones más recientes ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="<?php echo $room->foto_habitacion; ?>" class="card-img-top" alt="<?php echo $room->Nombre; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $room->Nombre; ?></h5>
                            <p class="card-text"><strong>Tipo:</strong> <?php echo $room->Tipo; ?></p>
                            <p class="card-text"><strong>Capacidad:</strong> <?php echo $room->Capacidad; ?></p>
                            <p class="card-text"><strong>Precio por noche:</strong> $<?php echo $room->Precio; ?></p>
                            <a href="<?php echo BASE_URL . 'showRoomDetails/' . $room->id_habitacion; ?>" class="btn btn-primary">Ver Detalles</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>
<?php 
require_once "./templates/layouts/footer.phtml" 
?>