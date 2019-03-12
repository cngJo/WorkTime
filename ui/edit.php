<!doctype html>
<html lang="en">
<head>
    <include href="utils/head.php"/>
</head>
<body>
<include href="utils/header.php"/>
<div class="container">
    <div class="row">
        <div class="column column-50 div-center">
            <check if="{{ @type=='get' }}">
                <true>
                    <h1>{{ @build_up.title }}</h1>
                </true>
                <false>
                    <h1>{{ @reduce.title }}</h1>
                </false>
            </check>

            <form action="api/{{ @type }}" method="post">
                <input type="hidden" name="user_id" value="{{ @user_id }}">
                <label for="input-date">{{ @edit.date }}</label>
                <input type="text" id="input-date" name="date" maxlength="10" minlength="10" placeholder="dd.mm.yyyy">
                <label for="input-hours">{{ @edit.hours }}</label>
                <input type="number" max="24" min="0" id="input-hours" name="hours" value="0" placeholder="hours">
                <label for="input-minutes">{{ @edit.minutes }}</label>
                <input type="number" max="60" min="0" id="input-minutes" name="minutes" value="0" placeholder="minutes">
                <label for="input-notes">{{ @edit.notes }}</label>
                <textarea name="notes" id="input-notes"></textarea>
                <input type="submit" class="button" value="{{ @edit.submit }}">
            </form>
        </div>
    </div>
</div>

<include href="utils/footer.php"/>

</body>
<include href="utils/scripts.php" />
</html>
