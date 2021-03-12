<?php
// Did the user came from the submit button?
if (isset($_POST['login-submit'])) {
    require "dbh.inc.php";

    $userPwd = $_POST['pwd'];
    $username = $_POST['userid'];

    if (empty($username) || empty($userPwd)) {
        header("Location: ../index.php?error=emptyfields");
        exit(); ///////////ALWAYS EXIT() AFTER HEADER!!!!!/////////
    } else {
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "connection failed";
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($userPwd, $row['pwd']);
                if (!$pwdCheck) {
                    header("location: ../index.php?error=incorrectpwd");
                    exit();
                } else if ($pwdCheck) {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['username'] = $row['username'];
                    header("location: ../index.php?login=success");
                } else {

                    header("location: ../index.php?error=incorrectpwd");
                    exit();
                }
            }
        }
    }
} //first if

else {
    header("Location: ../index.php");
    exit();
}
