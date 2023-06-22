<?php
session_start();
session_destroy();
header("Location: http://localhost/Sistema_MesaPartes/Acceso/");
?>