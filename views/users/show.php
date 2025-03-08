<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <h2>User</h2>
            <?php if(isset($user)){?>
            <div>
                <h3> <?= $user["name"];  ?> </h3>
                <p>  <?= $user['email']; ?> </p>
            </div>
            <?php }else{ ?>
                <p> User not found</p>
            <?php } ?>
</body>
</html>