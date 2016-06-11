<?php

$db = mysqli_connect('localhost','root','') or
            die('Unable to connect. Check your connection parameters.');
            
$query = 'CREATE DATABASE IF NOT EXISTS couch';
mysqli_query($db,$query) or die(mysqli_error($db));

mysqli_select_db($db,'couch') or die(mysqli_error($db)); 

$query = 'CREATE TABLE IF NOT EXISTS pais(
             id INTEGER NOT NULL AUTO_INCREMENT,
             iso char(2) DEFAULT NULL,
             nombre varchar(80) DEFAULT NULL,
             PRIMARY KEY (id)
        ) ENGINE= InnoDB';
        mysqli_query($db,$query) or die(mysqli_error($db));

$query = 'CREATE TABLE IF NOT EXISTS user(
                id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
                perfil VARCHAR(100) NOT NULL,
                premium tinyint DEFAULT 0, 
                username VARCHAR(100) NOT NULL,
                email   VARCHAR(255) NOT NULL,
                f_nacimiento DATE NOT NULL,
                nombre VARCHAR(100),
                apellido VARCHAR(100),
                pass    VARBINARY(1000) NOT NULL,
                nacionalidad INTEGER NOT NULL,
                habilitado TINYINT DEFAULT 1, 
                PRIMARY KEY(id),
                FOREIGN KEY(nacionalidad) REFERENCES pais(id)
        )
        ENGINE=InnoDB';
        mysqli_query($db,$query) or die(mysqli_error($db));
        
echo 'Base de datos creada correctamente';


?>