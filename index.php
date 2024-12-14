<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
// define('ROOT_PATH', __DIR__ . '/');
require_once __DIR__ . "/templates/header.php";
require_once __DIR__ . "/templates/main-content.php";
require_once __DIR__ . "/templates/footer.php";
?>
<script src="index.js"></script>