<?php
# @Author: Wendy Guadalupe Magaña Argente <wendylu>
# @Date:   2017-09-02T23:36:13-05:00
# @Email:  wendyargente@nube.unadmexico.mx
# @Project: Turing
# @Filename: Database.php
# @Last modified by:   wendylu
# @Last modified time: 2017-09-10T08:40:18-05:00
# @License: MIT

/*
 * ------------------------------------------------------
 * CONFIGURACIÓN DE LA BASE DE DATOS
 * ------------------------------------------------------
 *
 * Las siguientes variables, son para establecer la
 * conexión con la base de datos.
 */
if (ENVIRONMENT == "development")
{
  return $config = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => 'master',
    'database' => 'biblioteca'
  );
}
else
{
  return $config = array(
    'hostname' => 'localhost',
    'username' => 'id2705905_wendyargente',
    'password' => 'Master10',
    'database' => 'id2705905_biblioteca'
  );
}
