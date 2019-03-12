<!doctype html>
<html lang="en">
<head>
    <include href="utils/head.php"/>
</head>
<body>
<include href="utils/header.php"/>
<div class="container">
    <div class="row">
        <div class="column-50 column-offset-25">
            <h1>{{ @notLoggedIn.header }}</h1>
            <p>{{ @notLoggedIn.message }}</p>
        </div>
    </div>
</div>
</body>
<include href="utils/scripts.php"/>
</html>
