<h2>Member Portal Access</h2>

<form action="?p=portal" method="post" id="left-form">
    <fieldset>
        <legend>
            <h3>Member Login</h3>
        </legend>
        <label for="username">Username/Email:</label>
        <input name="username" type="text" value="testmember" required><br>

        <label for="pwd">Password:</label>
        <input name="pwd" type="password" minlength="8" value="$uper$ecret" required><br>

        <input name="submitLogin" type="submit" value="Log In"><br>
    </fieldset>
</form>

<form action="?p=portal" method="post" id="right-form">
    <fieldset>
        <legend>
            <h3>Register New Member</h3>
        </legend>
        <div><em>All fields required</em></div><br>
        <label for="firstName">Name:</label>
        <input name="firstName" type="text" placeholder="First Name"><input name="lastName" type="text" placeholder="Last Name">

        <label for="username">Username:</label>
        <input name="username" type="text" placeholder="e.g. bfuser123" required><br>

        <label for="email">Email:</label>
        <input name="email" type="email" placeholder="e.g. email@example.com"></br>

        <label for="pwd">Password: </label>
        <input name="pwd" type="password" minlength="8" placeholder="minimum 8 characters" required><br>

        <label for="pwdConfirm">Confirm Password: </label>
        <input name="pwdConfirm" type="password" minlength="8" placeholder="passwords must match" required><br>

        <input name="submitRegister" type="submit" value="Register"><br>
    </fieldset>
</form>