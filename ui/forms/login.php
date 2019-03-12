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
            <h1>{{ @login.title }}</h1>
            <form action="login" method="post">
                <label for="username">{{ @login.username }}</label>
                <input type="text" name="username" id="username">
                <label for="password">{{ @login.password }}</label>
                <input type="password" name="password" id="password">
                <input type="submit" value="{{ @login.submit }}">
            </form>
        </div>
    </div>
</div>

</body>
</html>
