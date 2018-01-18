<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 1/17/2018
 * Time: 9:12 PM
 */
//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base::instance();

//Define a default route
$f3->route('GET /', function()
{

    $view = new View;
    echo $view->render
    ('pages/home.html');
}
);

//Run Fat-Free
$f3->run();