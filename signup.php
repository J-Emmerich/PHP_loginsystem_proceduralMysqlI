<?php

require_once "header.php";

?>

<main>

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