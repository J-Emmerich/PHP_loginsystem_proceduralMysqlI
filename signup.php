<?php

require_once "header.php";

?>

<main>
<h1>Sign Up</h1>

<?php    // Use GET to retrieve information send from server in the url
if(isset($_GET['error']))
{
$error = $_GET['error']; // check if has an error

   switch ($_GET['error']) { // check which error it is 
        case "emptyfields":
        echo "<p>EmptyFields</p>";    
        break;
        case "invalidemail":
            echo "<p>Invalid Email</p>";   
            break;
case "passwordnotequal":
    echo "<p>Password Not Equal</p>";
break;
     default:
        echo "<p>Unknown Error</p>";
    }

} else if ($_GET['signup']){
    echo "<p>Sign Up successful</p>";
}
?>

<form action="includes/signup.inc.php" method="post">
<input type="text" name="userid" placeholder="Your username">
<input type="text" name="useremail" placeholder="Your email">
<input type="password" name="pwd" placeholder="Your password">
<input type="password" name="pwd-repeat" placeholder="Repeat your password">
<button type="submit" name="signup-submit">Submit</button>
</form>

</main>

<?php

require_once "footer.php";
?>