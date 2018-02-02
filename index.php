<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 1/17/2018
 * Time: 9:12 PM
 */
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 3);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base Class
$f3 = Base::instance();

//set debug level
$f3->set('DEBUG', 3);


//Define a default route
$f3->route('GET /', function()
{

    $view = new View;
    echo $view->render
    ('pages/home.html');
}
);
$f3->route("GET /pages/personal", function()
{
    $template = new Template();
    echo $template->render('pages/personal.html');
}
);
$f3->route("POST /pages/profile", function()
{
    $template = new Template();
    echo $template->render('pages/profile.html');
    $_SESSION['firstName'] = $_POST['firstName'];
    $_SESSION['lastName'] = $_POST['lastName'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];
}
);
$f3->route("POST /pages/interests", function()
{
    $template = new Template();
    echo $template->render('pages/interests.html');
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['bio'] = $_POST['bio'];}
);
$f3->route('GET|POST /pages/summary', function($f3) {
    $_SESSION['indoor'] = $_POST['indoor'];
    echo "<h1>".$_SESSION['indoor']."</h1>";
    $f3->set('indoor', $_SESSION['indoor']);
    $f3->set('firstName', $_SESSION['firstName']);
    $f3->set('lastName', $_SESSION['lastName']);
    $f3->set('phone', $_SESSION['phone']);
    $f3->set('phone', $_SESSION['phone']);
    $template = new Template();
    echo $template->render('pages/summary.html');
}
);
/*
$f3->route("POST /pets/results", function()
{
    $_SESSION['color'] = $_POST['color'];
    echo "<h1>Results Page</h1>";
    echo "Thank you for ordering a ".$_SESSION['color']. " ".$_SESSION['animal'];
}
);

$f3->route("GET|POST /new-pet", function($f3)
{


    if(isset($_POST['submit'])) {

        $color = $_POST['pet-color'];
        $type = $_POST['pet-type'];
        $name = $_POST['pet-name'];


        include ('model/validate.php');

    }
    $f3->set('color', $color);
    $f3->set('type', $type);
    $f3->set('name', $name);
    $f3->set('errors', $errors);
    $f3->set('success', $success);

    $template = new Template();
    echo $template->render('views/new-pet.html');
}
);*/

//Run Fat-Free
$f3->run();