<?php

$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');

mysqli_select_db($db,'couch') or die(mysqli_error($db));  

$query = "INSERT INTO tipo_couch(nombre_couch)
          VALUES   ('suit vista al mar'),
                   ('departamento'),
                   ('casa en el bosque'),
                   ('choza'),
                   ('casa en la nieve'),
                   ('casa avion'),
                   ('pension'),
                   ('cabaña'),
                   ('carpa'),
                   ('mansion'),
                   ('resort')";
mysqli_query($db,$query) or die(mysqli_error($db));
echo 'Datos de tipo de couch cargados correctamente';

?>