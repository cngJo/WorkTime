<header>
    <nav>
        <div class="clearfix">
            <div class="float-left"><form action="home" method="get" id="home-form"><a onclick="document.querySelector('#home-form').submit()">WorkTime</a></form></div>
            <check if="{{ @SESSION.loggedin == 'true' }}">
                <true>
                    <div class="float-left header-navigation-item"><a href="profile">{{ @header.profile }}</a></div>
                    <div class="float-left header-navigation-item"><a href="logout">{{ @header.logout }}</a></div>
                </true>
                <false>
                    <div class="float-left header-navigation-item"><a href="register">{{ @header.register }}</a></div>
                    <div class="float-left header-navigation-item"><a href="login">{{ @header.login }}</a></div>
                </false>
            </check>
            <div class="float-right">
                <include href="utils/User-Button.php"/>
            </div>
        </div>
    </nav>
</header>
