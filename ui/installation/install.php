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
            <h1>{{ @installation.title }}</h1>
            <form action="install" method="post">
                <label for="input-host">{{ @installation.form.db_host.title }}</label>
                <input type="text" id="input-host" name="host" value="" />
                <label for="input-user">{{ @installation.form.db_user.title }}</label>
                <input type="text" id="input-user" name="user" value="" />
                <label for="input-pass">{{ @installation.form.db_pass.title }}</label>
                <input type="password" id="input-pass" name="pass" value="" />
                <label for="input-lang">{{ @installation.form.lang.title }}</label>
                <select name="lang" id="input-lang">
                    <repeat group="{{ @languages }}" value="{{ @lang }}">
                        <option value="{{ @lang }}">{{ @lang }}</option>
                    </repeat>
                </select>
                <fieldset>
                    <legend>{{ @installation.form.adminuser.heading }}</legend>
                    <label for="input-admin-username">{{ @installation.form.adminuser.username.title }}</label>
                    <input type="text" name="admin-username" id="input-admin-username">
                    <label for="input-admin-email">{{ @installation.form.adminuser.email.title }}</label>
                    <input type="email" name="admin-email" id="input-admin-email">
                    <label for="input-admin-password">{{ @installation.form.adminuser.password.title }}</label>
                    <input type="password" name="admin-password" id="input-admin-password">
                </fieldset>
                <input type="submit" value="{{ @installation.form.submit }}">
            </form>
        </div>
    </div>
</div>

</body>
</html>
