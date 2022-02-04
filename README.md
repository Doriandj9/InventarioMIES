# Sistema de Inventario 
Este es un sistema desarrollado para el MIES por un grupo de desarrollo de software como practicas preprofesionales

## Integrantes del grupo de desarrollo 

- [Dorian Armijos](https://github.com/Doriandj9)
- [Bryan Chiliquina](#)
```html
El sistema de Sistema de Inventario se base en el patron arquitectonico MVC(Model View Controller) 
empezando donde el la carpeta src/ continen todas las clases que se van usar dentro del sistema 
-controllers esta carpeta contiene todos los controladores del sistema que estan conectados con los modelos
-aplication esta carpeta continen las clases que utiliza unicamente este sistema como la clase RoutesAplication que contiene todas las rutas del sistema
-frame esta carpeta contiene el codigo que puede ser reutilizdo en otros proyectos como es la clase EntryPoint que es el punto de partida que se encarga de lograr el enrutamiento del sistema


Seguido Tenemos la carpeta models donde se encuentra los modelos como es la clase DataBaseTable que contiene todas las consultas a la base de datos que puede realizar un modelo ademas de los demas modelos que contrala la logica del negocio, seguido de esta clase tenemos la carpeta conection que dentro de esta se encuentra la clase con la coneccion a la base de datos

Luego tenemos la carpeta con las Views(vistas) aqui hay las diferentes vistas que genera el sistema las cuales se presentan segun lo dicte el controlador 

```
## Base de Datos

```html
El sistema utiliza la base de datos PostgresSQL siendo la mas utilizada para los sistemas empresariales o robustos para poder utilizar el sistema debe realizar un restore en Postgres SQL tomando el archivo que se encuentra dentro de la carpeta Database
```
