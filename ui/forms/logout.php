<!doctype html>
<html lang="en">
<head>
    <include href="utils/head.php" />
</head>
<body>
<include href="utils/header.php" />
<div class="content">
    <h3 class="color-red">{{ @SESSION.error.message }}</h3>
    <div class="row">
        <div class="column column-50 column-offset-25 div-center">
            <h1>{{ @logout.title }}</h1>
            <form action="logout" method="post">
                <input type="checkbox" name="all"> {{ @logout.allDevices }} <br>
                <input type="submit" value="{{ @logout.submit }}">
            </form>
        </div>
    </div>
</div>

</body>
<include href="utils/scripts.php" />
</html>
