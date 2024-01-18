<?php


$con = new mysqli("127.0.0.1","manuel","manuel","dwes");

$sentencia = "select * from familia";

$rtdo = $con->query($sentencia);
echo "<select>";
foreach ($rtdo as $fila)
    echo "<option>{$fila['nombre']}</option>";
echo "</select>";




