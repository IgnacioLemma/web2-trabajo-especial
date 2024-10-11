# TRABAJO PRACTICO ESPECIAL WEB2

# TABLA DE CONTENIDOS
 - [Proyecto](#descripción-del-proyecto-hostel)
 - [Diagrama](#diagrama)
 - [Estructura](#estructura-de-las-tablas)
 - [Relaciones](#relacion-1-a-n)
 - [Idea de Funcionalidad](#idea-de-funcionalidad)
 - [Autores](#autores)
 - [Extra](#extra)

## Descripción del Proyecto Hostel

    Un hostel es un tipo de alojamiento economico, generalmente
    de estadia corta en donde se comparten areas comunes, como
    las habitaciones, baño y comedores.
    El objetivo del proyecto es crear un sitio donde el usuario pueda
    reservar habitaciones de difertes tamaños, segun la capacidad,
    en una fecha determinada, adaptandose a las preferencas y seleccionado
    el hostel que le interese, reservandolo.
    Para ello se realizara tecnologias backend como php y base de datos
    SQL para almacenar los detalles de los hostel, como la disponibilidad,
    precios y las reservaciones

## Diagrama

![Diagrama DER de la base de datos](./public/img/DER/diagrama_entrega1.png)

> Diagrama DER de la base de datos

## Estructura de las Tablas

### Habitaciones

| Columna       | Tipo     | Descripcion                                        |
|---------------|----------|--------------------------------------------------  |
| id_habitacion | INT      | ID unico de la habitacion [Clave primaria]         |
| Nombre        | VARCHAR  | Nombre de la habitacion                            |
| Tipo          | VARCHAR  | Tipo de habitación (individual, doble, compartida) |
| Capacidad     | INT      | Capacidad de la habitacion                         |
| Precio        | INT      | Precio de la habitacion                            |

## Reservas

| Columna       | Tipo     | Descripcion                                            |
|---------------|----------|--------------------------------------------------------|
| id_reserva    | INT      | ID unico de la reserva [Clave primaria]                |
| id_habitacion | INT      | ID unico de la habitacion [Clave foranea]              |
| Check_in      | DATE     | Fecha de inicio de la reserva                          |
| Check_out     | DATE     | Fecha de fin de la reserva                             |
| nombre_cliente| VARCHAR  | Nombre del cliente                                     |

## Relacion 1 a N

- Habitaciones a Reservas
    - Cada habitacion puede tener varias reservas a lo largo del tiempo:
        - Una misma habitacion puede ser reservada en diferentes momentos, para diferentes fechas y multiples clientes
        - La tabla reservas puede tener varias accesos con el mismo id_habitacion, cada una representando una reserva distinta en fechas diferentes
    - Cada reserva está asociada a una única habitacion:
        - Cada acceso en la tabla reservas está asociada a una sola habitacion por el id_habitacion entonces cada reserva está asociada con una  habitación especifica.

## Idea de Funcionalidad
  
| id_habitacion | Nombre       | Tipo       | Capacidad | Precio |
|---------------|--------------|------------|-----------|--------|
| 1             | Habitacion 1 | Individual | 1         | 500    |
| 2             | Habitacion 2 | Doble      | 2         | 750    |
| 3             | Habitacion 3 | Doble      | 2         | 600    |
| 4             | Habitacion 4 | Suite      | 4         | 1500   |
| 5             | Habitacion 5 | Compartida | 8         | 2000   | 

| id_reserva | id_habitacion | Check_in    | Check_out | nombre_cliente  |
|------------|---------------|-------------|-----------|-----------------|
| 4          | 1              | 2024-10-01 | 2024-10-05 | Juan           |
| 5          | 2              | 2024-10-01 | 2024-10-15 | Mati           |
| 7          | 1              | 2024-10-03 | 2024-10-07 | Marisa         |
| 8          | 4              | 2024-10-03 | 2024-10-20 | Edena          |
| 11         | 3              | 2024-10-02 | 2024-10-18 | Noa            |
| 16         | 5              | 2024-10-01 | 2024-10-25 | Jorge          |

## AUTORES

- Lemma Ignacio
    - **Mail**: ignaciolemma1803@gmail.com
- Barrionuevo Noa
    - **Mail**: barrionuevonoa18@gmail.com


#### EXTRA
    
    Debido a un error en vscode, el autor *Lemma Ignacio* realizara commit desde otra cuenta de github
