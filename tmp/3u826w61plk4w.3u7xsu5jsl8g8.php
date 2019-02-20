<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Install WorkTime</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css"/>
    <link rel="stylesheet" href="ui/css/install.css">
    <link rel="stylesheet" href="ui/css/lib.css">
</head>
<body>

<div class="content">
    <div class="row">
        <div class="column column-50 column-offset-25 div-center">
            <h1><?= ($uninstall['title']) ?></h1>
            <form action="uninstall" method="post">
                <h2 class="color-red"><?= ($uninstall['warning']) ?></h2>
                <ul>
                    <?php foreach (($uninstall['effects']?:[]) as $effect): ?>
                    <li><?= ($effect) ?></li>
                    <?php endforeach; ?>
                </ul>
                <input type="checkbox" id="sure" name="sure" required/><span><?= ($uninstall['checkbox']) ?></span>
                <input type="submit" value="<?= ($uninstall['submit']) ?>">
            </form>
        </div>
    </div>
</div>

</body>
</html>
