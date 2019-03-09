<div id="user-button">
    <button class="btn btn-dropdown">{{ @user.name }}</button>
    <div id="user-dropdown">
        <ul>
            <li><a href="register">{{ @user.register }}</a></li>
            <li><a href="login">{{ @user.login }}</a></li>
            <li><a href="logout">{{ @user.logout }}</a></li>
        </ul>
    </div>
</div>
