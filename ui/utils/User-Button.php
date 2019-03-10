<div id="user-button">
    <button class="btn btn-dropdown">{{ @user.name }}</button>
    <div id="user-dropdown">
        <ul>
            <check if="{{ @SESSION.loggedin != 'false' }}">
                <true>
                    <li><a href="profile">{{ @user.profile }}</a></li>
                    <li><a href="logout">{{ @user.logout }}</a></li>
                </true>
                <false>
                    <li><a href="register">{{ @user.register }}</a></li>
                    <li><a href="login">{{ @user.login }}</a></li>
                </false>
            </check>
        </ul>
    </div>
</div>
