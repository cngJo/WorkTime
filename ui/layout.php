<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WorkTimes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css"/>
    <link rel="stylesheet" href="ui/css/time.css">
    <link rel="stylesheet" href="ui/css/lib.css">
</head>
<body>

<div id="application" class="container">
    <div class="row header">
        <div class="column column-50 column-offset-25">
            <h1 class="color-{{ @allTime['color'] }}">
                <span class="sign">{{ @allTime['sign'] }}</span>
                <span class="time">{{ @allTime['time'] }}</span>
            </h1>
        </div>
    </div>
    <div class="row">
        <div class="column column-25 div-center">
            <ul>
                <repeat group="{{ @times }}" value="{{ @time }}">
                    <li class="color-{{ @times['color'] }}">
                        <table>
                            <tr>
                                <td class="date">{{ @time['date'] }}</td>
                                <td class="sign color-{{ @time['color'] }}">{{ @time['sign'] }}</td>
                                <td class="time color-{{ @time['color'] }}">{{ @time['time'] }}</td>
                            </tr>
                        </table>
                    </li>
                </repeat>
            </ul>

            <div class="buttons">
                <a href="get" class="button button-clear color-green div-center">{{ @main.overtime }}</a>
                <a href="take" class="button button-clear color-red div-center">{{ @main.reduce_overtime }}</a>
            </div>
        </div>
    </div>
</body>
</html>
