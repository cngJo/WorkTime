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
            <input type="text" name="username" id="input-username" value="{{ @loggedInUser.username }}">
        </div>
    </div>
    <div class="row">
        <div class="column column-50 column-offset-25">
            <label for="input-email">{{ @profile.profileInformation.email }}</label>
            <input type="email" name="email" id="input-email" value="{{ @loggedInUser.email }}">
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
            <input type="text" name="role" id="input-role" value="{{ @loggedInUser.role }}" disabled>
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
            <h1 class="color-{{ @loggedInUser.overtime['color'] }}">
                <span class="sign">{{ @loggedInUser.overtime['sign'] }}</span>
                <span class="time">{{ @loggedInUser.overtime['time'] }}</span>
            </h1>
        </div>
    </div>

    <check if="{{ @loggedInUser.role === 'admin' }}">
        <fieldset>
            <legend>{{ @profile.otherUsers.header }}</legend>
        <table>
            <tr>
                <th>{{ @profile.otherUsers.id }}</th>
                <th>{{ @profile.otherUsers.username }}</th>
                <th>{{ @profile.otherUsers.email }}</th>
                <th>{{ @profile.otherUsers.role }}</th>
                <th>{{ @profile.otherUsers.overtime }}</th>
            </tr>
            <repeat group="{{ @users }}" value="{{ @user }}">
                <tr>
                    <td>{{ @user.id }}</td>
                    <td>{{ @user.username }}</td>
                    <td>{{ @user.email }}</td>
                    <td>{{ @user.role }}</td>
                    <td class="color-{{ @user.overtime['color'] }}">
                        <span class="sign">{{ @user.overtime['sign'] }}</span>
                        <span class="time">{{ @user.overtime['time'] }}</span>
                    </td>
                </tr>
            </repeat>
        </table>
        </fieldset>
    </check>
</div>

</body>
</html>
