<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <h2>Users</h2>
   
        <?php foreach($users as $key =>$value ): ?>
            <div>
                <h3><?= $key ?></h3>
                <p><?= $value ?></p>
            </div>
        <?php endforeach; ?>

</body>
</html>
