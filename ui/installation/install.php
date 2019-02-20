<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Install WorkTime</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css"/>
    <link rel="stylesheet" href="ui/css/install.css">
</head>
<body>

<div class="content">
    <div class="row">
        <div class="column column-50 column-offset-25 div-center">
            <h1>Install WorkTime</h1>
            <form action="install" method="post">
                <label for="input-host">Database Host</label>
                <input type="text" id="input-host" name="host" value="" />
                <label for="input-user">Database Username</label>
                <input type="text" id="input-user" name="user" value="" />
                <label for="input-pass">Database Password</label>
                <input type="text" id="input-pass" name="pass" value="" />
                <input type="submit" value="Install">
            </form>
        </div>
    </div>
</div>

</body>
</html>
