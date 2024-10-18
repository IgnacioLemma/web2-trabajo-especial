<?php

class HostelModel {
    protected $db;

    public function __construct() {
        $this->db = new PDO(
            "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8",
            MYSQL_USER,
            MYSQL_PASS
        );
        $this->_deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();

        if (count($tables) == 0) {
            $sql = <<<END
            CREATE TABLE IF NOT EXISTS `habitaciones` (
                `id_habitacion` int(11) NOT NULL AUTO_INCREMENT,
                `Nombre` varchar(50) NOT NULL,
                `Tipo` varchar(20) NOT NULL,
                `Capacidad` int(11) NOT NULL,
                `Precio` int(11) NOT NULL,
                `foto_habitacion` varchar(250) NOT NULL,
                PRIMARY KEY (`id_habitacion`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
            
                CREATE TABLE IF NOT EXISTS `reservas` (
                `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
                `id_habitacion` int(11) NOT NULL,
                `Check_in` date NOT NULL,
                `Check_out` date NOT NULL,
                `nombre_cliente` varchar(100) NOT NULL,
                `id_usuario` int(11) NOT NULL,
                PRIMARY KEY (`id_reserva`),
                FOREIGN KEY (`id_habitacion`) REFERENCES `habitaciones`(`id_habitacion`),
                FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id_usuario`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                CREATE TABLE IF NOT EXISTS `usuarios` (
                `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
                `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                `password` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                PRIMARY KEY (`id_usuario`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

                INSERT INTO `habitaciones` (`id_habitacion`, `Nombre`, `Tipo`, `Capacidad`, `Precio`, `foto_habitacion`) VALUES
                (1, 'Habitación Individual - Vista al Mar', 'Individual', 1, 500, 'https://images.mirai.com/INFOROOMS/100376630/gjBzIcx65ubJ9C5vs79K/gjBzIcx65ubJ9C5vs79K_large.jpg'),
                (2, 'Habitación Doble - Cama King', 'Doble', 2, 750, 'https://media-cdn.tripadvisor.com/media/photo-s/2b/f4/2c/da/caption.jpg'),
                (3, 'Habitación Doble - Cama Queen', 'Doble', 2, 600, 'https://media-cdn.tripadvisor.com/media/photo-s/1a/0c/cf/f8/habitacion-doble-vista.jpg'),
                (4, 'Suite - Lujo en París', 'Suite', 4, 1500, 'https://parisjetaime.com/data/layout_image/30121_Shangri-La-Paris-L\'Appartement-Prince-Bonaparte--630x405--%C2%A9-Shangri-La-Paris.jpg'),
                (5, 'Habitación Compartida - Backpackers', 'Compartida', 8, 2000, 'https://www.hostelclub.com/images/habitacion_compartidas_ppal.jpg'),
                (6, 'Habitación Individual - Relax en Buenos Aires', 'Individual', 1, 600, 'https://q-xx.bstatic.com/xdata/images/hotel/max500/413405904.jpg?k=d27c2589893f8424f6c69dc5ce5ea7323be3b258e97a797c07d15dc54c70904b&o='),
                (7, 'Habitación Doble - Romántica en Mendoza', 'Doble', 2, 800, 'https://hotelaguadelcorral.com.ar/staticmotor7/galerias/9cc697d50917ca10bc5096b4ad301eca/b6237f8f059157af09ff657c87f9bda7.jpg'),
                (8, 'Suite - Paraíso en Cancún', 'Suite', 4, 1800, 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2b/e4/f2/3d/crown-cancun-room-honeymoon.jpg?w=700&h=-1&s=1'),
                (9, 'Habitación Compartida - Aventura en Bariloche', 'Compartida', 6, 1500, 'https://content.r9cdn.net/rimg/himg/34/c9/02/leonardo-46490-179652986-849190.jpg?width=500&height=350&xhint=1560&yhint=1000&crop=true'),
                (10, 'Habitación Familiar - Escape a la Costa', 'Familiar', 5, 2500, 'https://www.es.kayak.com/rimg/himg/e9/99/e2/expedia_group-2184499-47f024-627486.jpg?width=1366&height=768&crop=true'),
                (11, 'Habitación Individual - Refugio en Rosario', 'Individual', 1, 700, 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/528037185.jpg?k=3b7d21b34c4fab9026e1d0e7e4abded76a9f3b4f904308738981733928d894db&o=&hp=1'),
                (12, 'Habitación Doble - Oasis en Dubai', 'Doble', 2, 850, 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/472430169.jpg?k=7e2c59608867bc52ee353b6f9dd2a8855988f7abb2c989246c587cc8c2fe6c5a&o=&hp=1'),
                (13, 'Suite - Experiencia en Bora Bora', 'Suite', 4, 2000, 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/2c/b0/b8/60/suite-hotels.jpg?w=1200&h=-1&s=1'),
                (14, 'Habitación Compartida - Comunidad en Córdoba', 'Compartida', 6, 1700, 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/597938449.jpg?k=eb7c888e454e6fe0cd09d3339a9b11b29c4fcb38df3c84660d2927ab03e896aa&o=&hp=1'),
                (15, 'Habitación Familiar - Recuerdos en Tandil', 'Familiar', 5, 3000, 'https://q-xx.bstatic.com/xdata/images/hotel/max500/116111713.jpg?k=6adb6d6f9a51968a56c3c730cfb1370a7120e346d67facca36973b9528bdacf2&o='),
                (16, 'Habitación Deluxe - Estilo en Ibiza', 'Deluxe', 3, 2200, 'https://hotel.hardrock.com/ibiza/es/files/6218/23809775_ImageLargeWidth.jpg'),
                (17, 'Habitación Económica - Ahorro en La Plata', 'Economica', 2, 500, 'https://static.erm-assets.com/r3-0-1-987/dynamicimages/resize/ar-erm/H16032604414973/5/1024.jpg?modified=20190724160256'),
                (18, 'Habitación Premium - Lujo en Las Vegas', 'Premium', 4, 2500, 'https://dlq00ggnjruqn.cloudfront.net/prometheus/getImage?id=415637&width=940&height=530'),
                (19, 'Habitación Deluxe - Vista a la Ciudad de Nueva Yor', 'Deluxe', 3, 2400, 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/487976928.jpg?k=0bc195a80e41c80c47963a441c91cb719f93ad1cc001b0a8e09cdc7d6c360a36&o=&hp=1'),
                (20, 'Habitación Económica - Confort en Tandil', 'Económica', 2, 450, 'https://media-cdn.tripadvisor.com/media/photo-s/17/60/60/a8/hotel-francia.jpg');

                INSERT INTO `reservas` (`id_reserva`, `id_habitacion`, `Check_in`, `Check_out`, `nombre_cliente`, `id_usuario`) VALUES
                (4, 1, '2024-10-01', '2024-10-05', 'Juan', 1),
                (7, 1, '2024-10-03', '2024-10-07', 'Marisa', 1),
                (8, 4, '2024-10-03', '2024-10-20', 'Edena', 1),
                (11, 3, '2024-10-02', '2024-10-18', 'Noa', 2),
                (16, 5, '2024-10-01', '2024-10-25', 'Jorge', 1),
                (19, 4, '2024-09-20', '2024-09-25', 'hola mundo', 3),
                (22, 5, '2025-02-03', '2025-03-06', 'test 2', 0);
            
                CREATE TABLE `usuarios` (
                `id_usuario` int(11) NOT NULL,
                `email` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                `password` char(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
        END;
        $this->db->exec($sql);
    }
}

    // Obtener todas las habitaciones
    public function getRooms() {
        $query = $this->db->prepare('SELECT * FROM habitaciones');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    // Obtener habitaciones por ID
    public function getRoomById($id_habitacion) {
        $query = $this->db->prepare('SELECT * FROM habitaciones WHERE id_habitacion = ?');
        $query->execute([$id_habitacion]);
        return $query->fetch(PDO::FETCH_OBJ); // Devolver un objeto con los datos de la habitación
    }

    // ABM B
    public function addRoom($roomData) {
        $query = $this->db->prepare("INSERT INTO habitaciones (Nombre, Tipo, Capacidad, Precio, foto_habitacion) VALUES (?, ?, ?, ?, ?)");
        return $query->execute([$roomData['nombre'], $roomData['tipo'], $roomData['capacidad'], $roomData['precio'], $roomData['foto_habitacion']]);
    }
    
    public function deleteRoom($roomId) {
        $query = "DELETE FROM habitaciones WHERE id_habitacion = :id_habitacion";
        $query = $this->db->prepare($query);
        $query->bindParam(':id_habitacion', $roomId, PDO::PARAM_INT);
        return $query->execute();
    }

    public function updateRoom($id, $data) {
        $query = $this->db->prepare("UPDATE habitaciones SET Nombre = ?, Tipo = ?, Capacidad = ?, Precio = ?, foto_habitacion = ? WHERE id_habitacion = ?");
        return $query->execute([$data['Nombre'], $data['Tipo'], $data['Capacidad'], $data['Precio'], $data['foto_habitacion'], $id]);
    }
    

// ABM A

    //Obtenemos las categorias
    public function showListCategory() {
        $query = $this->db->prepare("SELECT DISTINCT Tipo FROM habitaciones"); //Obtenemos los tipos de habitaciones
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener habitaciones por tipo (categoría)
    public function getHabitacionesPorTipo($tipo) {
        $query = $this->db->prepare("SELECT * FROM habitaciones WHERE Tipo = ?");
        $query->execute([$tipo]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    //Buscar reserva
    public function showReservation(){
        $query = $this->db->prepare("SELECT * FROM reservas");
        $query->execute();
        $reservation = $query->fetchAll(PDO::FETCH_OBJ);
        return $reservation;
    }
    public function addReservation($id_habitacion, $nombre_cliente, $Check_in, $Check_out) {
        $query = $this->db->prepare("INSERT INTO reservas (id_habitacion, Check_in, Check_out, nombre_cliente) VALUES (?, ?, ?, ?)");
        $query->execute([$id_habitacion, $Check_in, $Check_out, $nombre_cliente]);
    }
    public function deleteReservation($id_reserva) {
        $query = $this->db->prepare("DELETE FROM reservas WHERE id_reserva = ?");
        return $query->execute([$id_reserva]);
    }
    //Buscar habitacion ID para la reserva
    public function getReservationById($id_reserva) {
        $query = $this->db->prepare('SELECT * FROM reservas WHERE id_reserva = ?');
        $query->execute([$id_reserva]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function UpdateReservation($id_reserva, $id_habitacion, $nombre_cliente, $check_in, $check_out) {
        $query = $this->db->prepare('UPDATE reservas SET id_habitacion = ?, nombre_cliente = ?, Check_in = ?, Check_out = ? WHERE id_reserva = ?');
        return $query->execute([$id_habitacion, $nombre_cliente, $check_in, $check_out, $id_reserva]);
    }
}