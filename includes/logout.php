<?php
function is_user_logged_in(): bool
{
    return isset($_SESSION['username']);
}
function logout(): void
{
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        session_destroy();
    }header("Location: ../index.php?logout=success");
}
logout();