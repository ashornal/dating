<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2/15/2018
 * Time: 4:48 PM
 */

/**
 * Class Member.class represents a member of the dating site
 */
class Member
{
    protected $fname;
    protected $lname;
    protected $age;
    protected $gender;
    protected $phone;
    protected $email;
    protected $state;
    protected $seeking;
    protected $bio;

    /**
     * Member.class constructor.
     * @param $fname first name of user
     * @param $lname last name of user
     * @param $age age of user
     * @param $gender gender of user
     * @param $phone phone number of user
     */
    public function __construct($fname, $lname, $age, $gender, $phone)
    {
        $this->fname = $fname;
        $this->lname = $lname;
        $this->age = $age;
        $this->gender = $gender;
        $this->phone = $phone;
    }

    //Setters & Getters
    /**
     * Sets the first name of the user
     * @param $fname first name
     */
    function setFName($fname)
    {
        $this->fname = $fname;
    }
    /**
     * Gets the first name of user
     * @return first name of user
     */
    function getFName()
    {
        return $this->fname;
    }
    /**
     * Sets the last name of the user
     * @param $lname last name
     */
    function setLName($lname)
    {
        $this->lname = $lname;
    }
    /**
     * Get the last name of user
     * @return last name of user
     */
    function getLName()
    {
        return $this->lname;
    }
    /**
     * Sets the age of the user if its a number
     * @param $age age of user
     */
    function setAge($age)
    {
        //set the age if is numeric
        if (is_numeric($age))
        {
            $this->age = $age;
        }
        //if not, set age to 0
        $this->age = "0";
    }
    /**
     * Get the age of the user
     * @return age of user
     */
    function getAge()
    {
        return $this->age;
    }
    /**
     * Sets the gender of the user
     * @param $gender gender of user
     */
    function setGender($gender)
    {
        $this->gender = $gender;
    }
    /**
     * Get the gender of the user
     * @return gender of user
     */
    function getGender()
    {
        return $this->gender;
    }
    /**
     * Sets the phone number of the user if is numeric
     * @param $phone phone number of user
     */
    function setPhone($phone)
    {
        //phone must be numeric
        if(is_numeric($phone))
        {
            $this->phone = $phone;
        }
        //if not, default number is set
        $this->phone = "1234567890";
    }
    /**
     * Get the phone number of user
     * @return phone number of user
     */
    function getPhone()
    {
        return $this->phone;
    }
    /**
     * Sets the email of the user if contains "@"
     * @param $email email of user
     */
    function setEmail($email)
    {
        //email must contain "@"
        if (strpos($email, '@') !== false)
        {
            $this->email = $email;
        }
        //if not , default email is empty
        $this->email = " ";
    }
    /**
     * Get the email of user
     * @return email of user
     */
    function getEmail()
    {
        return $this->email;
    }
    /**
     * Sets the state location of user
     * @param $location state of user
     */
    function setState($state)
    {
        $this->state = $state;
    }
    /**
     * Get the state of the user
     * @return state of the user
     */
    function getState()
    {
        return $this->state;
    }
    /**
     * Set what gender the user is seeking
     * @param $seeking gender user is seeking
     */
    function setSeeking($seeking)
    {
        $this->seeking = $seeking;
    }
    /**
     * Get the seeking gender of user
     * @return gender user is seeking
     */
    function getSeeking()
    {
        return $this->seeking;
    }
    /**
     * Sets the biography of the user
     * @param $bio biography of user
     */
    function setBio($bio)
    {
        $this->bio = $bio;
    }
    /**
     * Get the bio of the user
     * @return biography of user
     */
    function getBio()
    {
        return $this->bio;
    }
}