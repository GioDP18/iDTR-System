<?php
require_once('conn.php');

$db = new DBConnection(); // Instantiate the DBConnection class

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
    $stmt = $db->conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if ($password === $user['password']) {
                session_start();
                $_SESSION['authenticated'] = true;
                $_SESSION['id'] = $user['id'];

                // Reidrect to home page
                echo "<script>location.href='../authenticated/index.php'</script>";
            } else {
                echo "<script>location.href='../index.php?error-login=Invalid Credentials, Please try again.'</script>";
            }
        } else {
            echo "<script>location.href='../index.php?error-login=This user does not exists.'</script>";
        }

        $stmt->close();
    } else {
        echo "Error in database query";
    }
}


if(isset($_POST['logout'])){
    session_destroy();
    $_SESSION['authenticated'] = false;
    echo "<script>location.href='../index.php?logout-message=Logged out successfully!'</script>";
}

?>
