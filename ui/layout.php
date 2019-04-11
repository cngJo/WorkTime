<!doctype html>
<html lang="en">

<head>
    <include href="utils/head.php" />
</head>

<body>

    <include href="utils/header.php" />

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
                                <tr class="time-head">
                                    <td class="date">{{ @time['date'] }}</td>
                                    <td class="sign color-{{ @time['color'] }}">{{ @time['sign'] }}</td>
                                    <td class="time color-{{ @time['color'] }}">{{ @time['time'] }}</td>
                                    <td class="remove-entry" title="{{ @main.removeEntry }}">
                                        <form action="api/remove/{{ @time['id'] }}" method="post" class="remove-entry-form"><span class="remove-entry">X</span></form>
                                    </td>
                                </tr>
                                <tr class="note">
                                    <td rowspan="3">{{ @time['note'] }}</td>

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

        <include href="utils/footer.php" />
</body>
<include href="utils/scripts.php" />

</html>