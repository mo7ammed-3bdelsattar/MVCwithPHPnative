<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC | User</title>
</head>

<body>
    <h1>User Details</h1>
    <?php
    if ($user === null) {
        echo "<tr><td colspan='3'>User not found</td></tr>";
    } else {
    ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php
            foreach ($user as $u): ?>
                <tr>
                    <td><?php echo htmlspecialchars($u['id']); ?></td>
                    <td><?php echo htmlspecialchars($u['name']); ?></td>
                    <td><?php echo htmlspecialchars($u['email']); ?></td>
                </tr>
            <?php
            endforeach;
            ?>
        </table>
    <?php
    }
    ?>
</body>

</html>