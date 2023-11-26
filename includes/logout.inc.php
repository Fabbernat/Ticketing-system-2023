<a href="../index.php">Vissza a főoldalra</a>

<?php
session_start();

if (isset($_SESSION['username'])) {
    $felhasznalonev = $_SESSION['username'];

    $stmt = mysqli_prepare($conn, "UPDATE felhasznalo SET is_logged_in = false WHERE felhasznalonev = ?");
    mysqli_stmt_bind_param($stmt, "s", $felhasznalonev);

    if (mysqli_stmt_execute($stmt)) {
        // Unset and destroy the session
        unset($_SESSION['username']);
        session_destroy();

        // Redirect to index.php with a logout success message
        header("Location: ../index.php?logout=success");
        // Ensure script stops after redirect
        exit();
    } else {
        $GLOBALS['login'] = "wrong_password";
        header("Location: ../index.php?login=wrong_password#login");
        exit();
    }
} else {
    // Redirect to index.php with a logout failure message
    header("Location: ../index.php?logout=failure");
    // Ensure script stops after redirect
    exit();
}