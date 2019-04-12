<!doctype html>
<html lang="en">

<head>
    <include href="utils/head.php" />
    <link rel="stylesheet" href="ui/css/install.css">
</head>

<body>

    <div class="content">
        <div class="row">
            <div class="column column-50 column-offset-25 div-center">
                <h1>{{ @uninstall.title }}</h1>
                <form action="uninstall" method="post">
                    <h2 class="color-red">{{ @uninstall.warning }}</h2>
                    <repeat group="{{ @uninstall.effects }}" value="{{ @effect }}">
                        <p>{{ @effect }}</p>
                    </repeat>
                    <input type="checkbox" id="sure" name="sure" required /><span>{{ @uninstall.checkbox }}</span>
                    <input type="submit" value="{{ @uninstall.submit }}">
                </form>
            </div>
        </div>
    </div>

</body>

</html>