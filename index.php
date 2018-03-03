<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 1/17/2018
 * Time: 9:12 PM
 */

//Require the autoload file
require_once('vendor/autoload.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 3);

//Create an instance of the Base Class
$f3 = Base::instance();

//require_once('/home/ashornal/debug.php');


$f3->set('states', array("Washington","California","Idaho","Oregon"));
$f3->set('indoors', array( "tv", "movies", "cooking", "board games", "puzzles", "reading", "playing cards", "video games"));
$f3->set('outdoors', array( "hiking", "biking", "swimming", "collecting", "walking", "climbing"));


//Define a default route
$f3->route('GET /', function()
{
    $template = new Template();
    echo $template->render('pages/home.html');
}
);
//form 1
$f3->route("GET|POST /pages/personal", function($f3, $params)
{
    if(isset($_POST['submit']))
    {
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];

        $_SESSION['firstName'] = $firstName;
        $_SESSION['lastName'] = $lastName;
        $_SESSION['age'] = $age;
        $_SESSION['gender'] = $gender;
        $_SESSION['phone'] = $phone;

        include('model/validate.php');

        if(isset($_POST['premium']))
        {
            $member = new PremiumMember($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['age'],
                $_SESSION['gender'], $_SESSION['phone']);
            $_SESSION['member'] = $member;

            $premium = $_POST['premium'];
            $_SESSION['premium'] = $premium;
            $f3->set('premium', $premium);
        }
        else
        {
            $member = new Member($_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['age'],
                $_SESSION['gender'], $_SESSION['phone']);
            $_SESSION['member'] = $member;

        }

        $f3->set('firstName', $firstName);
        $f3->set('lastName', $lastName);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);
        $f3->set('errors', $errors);
        $f3->set('success', $success);
        $f3->set('member', $member);
    }

    $template = new Template();
    echo $template->render('pages/personal.html');
    if($success)
    {
        $f3->reroute('./profile');
    }
}
);
//form 2
$f3->route("GET|POST /pages/profile", function($f3, $params)
{
    $member = $_SESSION['member'];

    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $state = $_POST['state'];
        $bio = $_POST['bio'];
        $seeking = $_POST['seeking'];

        $_SESSION['email'] = $email;
        $_SESSION['state'] = $state;
        $_SESSION['bio'] = $bio;
        $_SESSION['seeking'] = $seeking;


        include('model/validate.php');

        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('bio', $bio);
        $f3->set('seeking', $seeking);
        $f3->set('errors', $errors);
        $f3->set('success', $success);
        $f3->set('member', $member);

        $member->setEmail($email);
        $member->setState($state);
        $member->setSeeking($seeking);
        $member->setBio($bio);

        $_SESSION['member'] = $member;
    }
    $template = new Template();
    echo $template->render('pages/profile.html');
    if($success)
    {
        if($member instanceof PremiumMember)
        {
            $f3->reroute('./interests');
        }
        else
        {

            $f3->reroute('./summary');
        }
    }
}
);
//form 3
$f3->route("GET|POST /pages/interests", function($f3,$params)
{
    $member = $_SESSION['member'];

    if (isset($_POST['submit'])) {
        $indoor = $_POST['indoors'];
        $outdoor = $_POST['outdoors'];

        $_SESSION['indoor'] = $indoor;
        $_SESSION['outdoor'] = $outdoor;

        include('model/validate.php');

        $f3->set('indoor', $indoor);
        $f3->set('outdoor', $indoor);
        $f3->set('errors', $errors);
        $f3->set('success', $success);
        $f3->set('member', $member);

        $member->setIndoorActivities($indoor);
        $member->setOutdoorActivities($outdoor);
    }
    $template = new Template();
    echo $template->render('pages/interests.html');
    if ($success)
    {
        $f3->reroute('./summary');
    }
}
);
//summary
$f3->route('GET|POST /pages/summary', function($f3,$params)
{
    $member = $_SESSION['member'];

    $f3->set('firstName', $_SESSION['firstName']);
    $f3->set('lastName', $_SESSION['lastName']);
    $f3->set('age', $_SESSION['age']);
    $f3->set('gender', $_SESSION['gender']);
    $f3->set('phone', $_SESSION['phone']);
    $f3->set('email', $_SESSION['email']);
    $f3->set('state', $_SESSION['state']);
    $f3->set('seeking', $_SESSION['seeking']);
    $f3->set('indoor', $_SESSION['indoor']);
    $f3->set('outdoor', $_SESSION['outdoor']);
    $f3->set('bio', $_SESSION['bio']);
    $f3->set('member', $member);

    $interests = "null";
    $image = "null";
    $premium = 0;
    if($member instanceof PremiumMember)
    {
        $interests = implode(", ", $member->getIndoorActivities()).", ".implode(", ", $member->getOutdoorActivities());
        $premium = 1;
    }

    $database = new Database();
    $database->insertMember($member->getFname(), $member->getLname(), $member->getAge(), $member->getGender(), $member->getPhone(),
        $member->getEmail(), $member->getState(), $member->getSeeking(), $member->getBio(), $premium, $image, $interests);

    $template = new Template();
    echo $template->render('pages/summary.html');
}
);
//member list
$f3->route('GET|POST /admin', function($f3, $params) {
    $database = new Database();
    $member = $database->getMembers();
    $f3->set('members', $member);

    $template = new Template();
    echo $template->render('pages/member.html');
}
);

//Run Fat-Free
$f3->run();