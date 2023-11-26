<!DOCTYPE html>
<html lang=“en”>
<head>
    <meta charset=“UTF-8”>
    <title>Felhasználók listázása</title>
</head>
<body>
<a href="../admin.php">Vissza az "Admin műveletek" oldalra</a>
<a href="../user.php">Vissza a "Felhasználó műveletek" oldalra</a>
<a href="../index.php">Vissza a főoldalra</a> <table border='1'>
    <?php include_once "dbh.inc.php";

    $sql = "SELECT felhasznalonev, email, vezeteknev, keresztnev, szerep FROM felhasznalo;"; $result = mysqli_query($conn, $sql); $resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0): ?> <th>felhasznalonev</th><th>email</th><th>vezeteknev</th><th>keresztnev</th><th>szerep</th> <?php while ($row = mysqli_fetch_assoc($result)): ?> <tr> <td><?= $row['felhasznalonev'] ?></td> <td><?= $row['email'] ?></td> <td><?= $row['vezeteknev'] ?></td> <td><?= $row['keresztnev'] ?></td> <td><?= $row['szerep'] ?></td> </tr> <?php endwhile; ?> <?php endif; ?> </table>

</body>
</html>