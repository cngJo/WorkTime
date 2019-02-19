<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WorkTimes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css"/>
    <link rel="stylesheet" href="ui/css/time.css">
</head>
<body>

<div class="container">
    <div class="row">
        <div class="column column-50 div-center">
            <check if="{{ @type=='get' }}">
                <true>
                    <h1>Überstunden aufbauen</h1>
                </true>
                <false>
                    <h1>Überstunden abbauen</h1>
                </false>
            </check>

            <form action="api/{{ @type }}" method="post">
                <label for="input-date">Datum</label>
                <input type="text" id="input-date" name="date" maxlength="8" minlength="8" placeholder="dd.mm.yy">
                <label for="input-hours">Hours</label>
                <input type="number" max="24" min="0" id="input-hours" name="hours" placeholder="hours">
                <label for="input-minutes">Minutes</label>
                <input type="number" max="60" min="0" id="input-minutes" name="minutes" placeholder="minutes">
                <input type="submit" class="button" value="Submit">
            </form>
        </div>
    </div>
</div>

</body>
</html>
