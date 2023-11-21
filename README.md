<center>
<h1>EXPLICACION A MEDIAS  DE LAS CARPETAS:</h1>
 

BASE_DE_DATOS: Aqui simplemente guardo las BD que creamos y ya

app/http/controllers: Aqui guardamos los controladores para consultar/insertar/eliminar/editar info de la bd. Pueden copiar y pegar los archivos que estan dentro. Recomiendo que cada uno se cree una carpeta para no revolver todos los controladores

public/css: aqui se guardan los estilos css

public/js: aqui se guardan los js que crean, recomiendo que cada uno se cree un archivo SuNombre.js para no jodernos entre nosotros cambiando funciones

resources/views: aqui se guardan los "html" para el frontEnd. para crearlos debe de seguir la estructura Nombre.blade.php y trabaja normal como un html o como un php, como usted quiera

<h1>EXPLICACION DE ARCHIVOS:</h1>

config/database.php: Esto simplemente crea la conexion con la bd, tiene que especificar el nombre de la bd, el usuario y su password. Hay comentarios, vayan y revisen. Tambien  pueden copiar y pegar y funciona

.env: esto inicia la aplicacion, no lo muevan, lo unico que hay que cambiar ahi es la conexion de la base de datos MySQL a la misma que usaron en database.php

routes/web.php: aqui se agregan las rutas para acceder a las vistas de la aplicacion. lastimosamente sobre este archivo tenemos que trabajar todos juntos, asi que por medio //comentarios dividan su espacion de trabajo con su nombre, para que nadie toque lo que no deberia

routes/api.php: aqui se agregan las rutas para acceder a las APIs de la aplicacion. lastimosamente sobre este archivo tambien tenemos que trabajar todos juntos, asi que por medio //comentarios dividan su espacion de trabajo con su nombre, para que nadie toque lo que no deberia

</center>