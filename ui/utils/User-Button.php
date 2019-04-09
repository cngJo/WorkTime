<div id="user-button">
    <button class="btn btn-dropdown">{{ @user.name }}</button>
    <div id="user-dropdown">
        <ul>
            <check if="{{ @SESSION.loggedin == 'true' }}">
                <true>
                    <li><a href="profile">{{ @header.profile }}</a></li>
                    <li><a href="logout">{{ @header.logout }}</a></li>
                </true>
                <false>
                    <li><a href="register">{{ @header.register }}</a></li>
                    <li><a href="login">{{ @header.login }}</a></li>
                </false>
            </check>
        </ul>
    </div>
</div>
