<?php

//Verify if the button was pressed || and that the user came from the form and not directly
if (isset($_POST['signup-submit']))
{
include "dbh.inc.php";
//assign variables to the form fields
    $username = $_POST['userid'];
    $useremail = $_POST['useremail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];


//Verify if the form is empty in any of the fields

    if(empty('userid') || empty('useremail') || empty('pwd') || empty('pwd-repeat'))
    {
        //if it's empty make a redirect and send the info in the URL
        header("Location: ../signup.php?error=emptyfields&userid=".$username."&email=".$useremail);
        //Exit method is required so the code stop here
        exit();  
    }

    // Check both email and username, redirect if wrong. Later check each one separetely
    else if (!filter_var($useremail, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username))
    {
        header("Location: ../signup.php?error=invalidemailuserid");
        exit();
    }
    else if (!filter_var($useremail, FILTER_VALIDATE_EMAIL))
    {//send username to the field if only email is wrong
        header("Location: ../signup.php?error=invalidemail&userid=".$username); 
        exit(); 
    }
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username))
    {//send email to the field if only username is wrong
        header("Location: ../signup.php?errorinvaliduserid&useremail=".$useremail);
        exit();
    }
//check if both passwords are equal
    else if($password !== $passwordRepeat){
               
        header("Location: ../signup.php?error=passwordnotequal&userid=".$username."&useremail=".$useremail); 
        exit();
    }
    //check if username already exist in database with prepared statement
    else 
    {
       $sql = "SELECT username FROM users WHERE username=?";
       $stmt = mysqli_stmt_init($conn);
       if (!mysqli_stmt_prepare($stmt,$sql)) //check error in the query
       {
        header("Location: ../signup.php?sqlerror");
        exit();
       }
       else{
           mysqli_stmt_bind_param($stmt, "s", $username);
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt); //store the result in a variable
           $resultCheck = mysqli_stmt_num_rows($stmt); //check number of rows in the variable
           if ($resultCheck > 0){ //if greater than zero means there is a row with same username
            header("Location: ../signup.php?error=usernametaken&useremail=".$useremail); 
            exit();
        }else {
            //insert info in the database with prepared statements
            
            $sql = "INSERT INTO users(username, useremail, pwd) VALUES(?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql)) //check error in the query
            {
                header("Location: ../signup.php?sqlerror");
                exit();
            }
            else{
                // HASH password
            $passwordHashed = password_hash($password,PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "sss", $username, $useremail, $passwordHashed);
                mysqli_stmt_execute($stmt);
                header("Location: ../signup.php?signup=success");
                exit();
            }


       }
       

    }

    } 
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else{
    header("Location: ../signup.php");
    exit();
}