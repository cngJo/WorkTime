<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>WorkTimes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css"/>
    <link rel="stylesheet" href="ui/css/lib.css">
</head>
<body>

<div id="application" class="container">
    <div class="row">
        <div class="column column-50 column-offset-25">
            <fieldset>
                <legend>{{ @profile.profileInformation.header }}</legend>
                <p>{{ @SESSION.profile.message }}</p>
                <form action="changeUserInformation" method="post">
        </div>
    </div>
    <div class="row">
        <div class="column column-50 column-offset-25">
            <label for="input-username">{{ @profile.profileInformation.username }}</label>
            <input type="text" name="username" id="input-username" value="{{ @user.username }}">
        </div>
    </div>
    <div class="row">
        <div class="column column-50 column-offset-25">
            <label for="input-email">{{ @profile.profileInformation.email }}</label>
            <input type="email" name="email" id="input-email" value="{{ @user.email }}">
        </div>
    </div>
    <div class="row">
        <div class="column column-50 column-offset-25">
            <label for="input-password">{{ @profile.profileInformation.password }}</label>
            <input type="password" name="password" id="input-password">
        </div>
    </div>
    <div class="row">
        <div class="column column-50 column-offset-25">
            <label for="input-role">{{ @profile.profileInformation.role }}</label>
            <input type="text" name="role" id="input-role" value="{{ @user.role }}" disabled>
        </div>
    </div>
    <div class="row">
        <div class="column column-50 column-offset-25">
            <input type="submit" name="save" id="input-save" value="{{ @profile.profileInformation.save }}">
        </div>
    </div>
    <div class="row">
        <div class="column column-50 column-offset-25">
            <fieldset>
                <legend>{{ @profile.overtime.header }}</legend>
        </div>
    </div>
    <div class="row">
        <div class="column column-50 column-offset-25">
            <h1 class="color-{{ @user.overtime['color'] }}">
                <span class="sign">{{ @user.overtime['sign'] }}</span>
                <span class="time">{{ @user.overtime['time'] }}</span>
            </h1>
        </div>
    </div>
</div>

</body>
</html>
