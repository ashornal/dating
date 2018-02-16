<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2/2/2018
 * Time: 5:04 PM
 */
// empty array of errors
$errors = array();
// only check conditions when on page
if($_SERVER['REQUEST_URI'] == "/328/assignments/week3/dating/pages/personal")
{
    if(!validName($firstName))
    {
        $errors['firstName'] = "Please enter a valid name.";
    }
    if(!validName($lastName))
    {
        $errors['lastName'] = "Please enter a valid name.";
    }
    if(!validAge($age))
    {
        $errors['age'] = "Must be 18 or older.";
    }
    if(!validPhone($phone))
    {
        $errors['phone'] = "Invalid Number. Numbers and dashes only.";
    }
}
if ($_SERVER['REQUEST_URI'] == "/328/assignments/week3/dating/pages/interests")
{
    if (!validIndoor($indoor))
    {
        $errors['indoors'] = "Please select valid activities.";
    }
    if (!validOutdoor($outdoor))
    {
        $errors['outdoors'] = "Please select valid activities.";
    }
}
// must be true to submit
$success = sizeof($errors) == 0;
//  string is all alphabetic
function validName($name)
{
    return ctype_alpha($name);
}
//age is numeric and over 18
function validAge($age)
{
    return is_numeric($age) && $age >= 18;
}
// valid phone w/ numbers and -
function validPhone($phone)
{
    if (is_numeric($phone) || (strpos($phone, "-") && !ctype_alpha($phone))){
        if (strpos($phone, "-") && (strlen($phone) == 12)){
            return true;
        }
        if (strlen($phone) == 10){
            return true;
        }
    }
    return false;
}
// must be one of the checkboxes
function validOutdoor($activities)
{
    global $f3;
    $outside = false;
    if (isset($activities) && !empty($activities)) {
        foreach ($activities as $activity)
        {
            $outside = in_array($activity, $f3->get('outdoors'));
        }
        $outside = true;
    }

    return $outside;
}
// must be one of the checkboxes
function validIndoor($activities)
{
    global $f3;
    $inside = false;
    if (isset($activities) && !empty($activities)) {
        foreach ($activities as $activity)
        {
            $inside = in_array($activity, $f3->get('indoors'));
        }
        $inside = true;
    }
    return $inside;
}
