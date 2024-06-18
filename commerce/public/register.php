<?php
// public/register.php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/controllers/PersonneController.php';

$controller = new PersonneController();
$controller->inscrirePersonne();
?>
