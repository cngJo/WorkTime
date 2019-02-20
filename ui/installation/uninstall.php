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
            <h1>Uninstall WorkTime</h1>
            <form action="uninstall" method="post">
                <h2 class="color-red">You are about to uninstall WorkTime this has the following consequences:</h2>
                <ul>
                    <li>Your Database gets dropped (deleted) => All your data is deledted</li>
                    <li>The Database Configuration gets deleted.</li>
                    <li>The files of WorkTime get <span class="color-red"><b>NOT</b></span> deleted</li>
                </ul>
                <input type="checkbox" id="sure" name="sure" required/> I am sure, that I want to uninstall WorkTime and I understood, that my data can <b class="color-red">NOT</b> be restored
                <input type="submit" value="Uninstall">
            </form>
        </div>
    </div>
</div>

</body>
</html>
