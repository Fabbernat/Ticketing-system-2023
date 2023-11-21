<?php
$sql = "
INSERT INTO felhasznalok (felhasznalonev, email, jelszo, vezeteknev, keresztnev, szerep)
VALUES
('user1', 'user1@example.com', 'password1', 'John', 'Doe', 'Felhasználó');";
$result = mysqli_query($conn, $sql);

header("Location: ../index.php?signup=success");