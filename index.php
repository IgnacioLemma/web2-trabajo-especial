<?php

// Conexión a la base de datos
$db = new PDO('mysql:host=localhost;dbname=hostel_web2;charset=utf8', 'root', '');

// Consulta a la tabla habitaciones
$query = $db->prepare("SELECT * FROM habitaciones");
$query->execute();

// Obtener los resultados como objetos
$habitaciones = $query->fetchAll(PDO::FETCH_OBJ);

// Mostrar los datos de las habitaciones
foreach($habitaciones as $habitacion) {
    echo "ID: " . $habitacion->id_habitacion . " ; Nombre: " . $habitacion->Nombre . " ; Tipo: " . $habitacion->Tipo . " ; Capacidad: " . $habitacion->Capacidad . " ; Precio: " . $habitacion->Precio;
    echo "<br>";
}
