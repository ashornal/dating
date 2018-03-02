<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 3/1/2018
 * Time: 10:28 PM
 */

/*
 * CREATE TABLE IF NOT EXISTS `mydb`.`Members` (
  `member_id` INT NOT NULL AUTO_INCREMENT,
  `fname` VARCHAR(45) NULL,
  `lname` VARCHAR(45) NULL,
  `age` INT NULL,
  `gender` VARCHAR(10) NULL,
  `phone` INT NULL,
  `email` VARCHAR(45) NULL,
  `state` VARCHAR(45) NULL,
  `seeking` VARCHAR(15) NULL,
  `bio` TEXT NULL,
  `premium` TINYINT(1) NULL,
  `image` VARCHAR(45) NULL,
  `interests` VARCHAR(100) NULL,
  PRIMARY KEY (`member_id`))
 */
require_once '/home/ashornal/config.php';


class Database
{
    protected $dbh;

    function __construct()
    {
        try {
            //Instantiate a database object
            $this->dbh = new PDO(DB_DSN, DB_USERNAME,
                DB_PASSWORD );
            //echo "Connected to database!!!";
        }
        catch (PDOException $e) {
            echo $e->getMessage();
            //echo "Not Connected...";
        }
    }

    function insertMember($fname, $lname, $age, $gender, $phone, $email, $state, $seeking, $bio, $premium, $image, $interests)
    {
        global $dbh;

        //1. Define the query
        $sql = "INSERT INTO Members(fname, lname, age, gender, phone, email, state, seeking, bio, premium, image, interests)
          VALUES (:fname, :lname, :age, :gender, :phone, :email, :state, :seeking, :bio, :premium, :image, :interests)";

        //2. Prepare the statement
        $statement = $dbh->prepare($sql);

        //3. Bind parameters
        $statement->bindParam(':fname', $fname, PDO::PARAM_STR);
        $statement->bindParam(':lname', $lname, PDO::PARAM_STR);
        $statement->bindParam(':age', $age, PDO::PARAM_STR);
        $statement->bindParam(':gender', $gender, PDO::PARAM_STR);
        $statement->bindParam(':phone', $phone, PDO::PARAM_STR);
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':state', $state, PDO::PARAM_STR);
        $statement->bindParam(':seeking', $seeking, PDO::PARAM_STR);
        $statement->bindParam(':bio', $bio, PDO::PARAM_STR);
        $statement->bindParam(':premium', $premium, PDO::PARAM_STR);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':interests', $interests, PDO::PARAM_STR);


        //4. Execute the query
        $result = $statement->execute();

        $id = $dbh->lastInsertId();
    }

    function getMembers()
    {
        
    }
}