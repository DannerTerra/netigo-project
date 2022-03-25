<?php

require_once "./controllers/PageController.class.php"; 
$controller = new PageController('pages.xml');
$path = str_replace("/","",$requestPath);
$pageContent = $controller->getContent($path);

if(empty($pageContent)){
    require '404.php';
    die();
}

require 'header.php';

require 'content.php';

echo '</body></html>';