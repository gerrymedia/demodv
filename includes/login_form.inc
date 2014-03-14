<?php

/* 
 * HTML of login form
 */

?>
<h1>User Login</h1>
<form action="login.php?do=login" method="post">
    <label for="username">Username</label>
    <input class="form-input" name="username" type="text" />
    <label for="password">Password</label>
    <input class="form-input" name="password" type="password" />
    <button class="btn btn-default form-submit" id="edit-submit" name="op" value="Log in" type="submit">Log in</button>
    
</form>

<p>Code Tester Direct Access - <a href="login.php?do=direct">Click Here</a></p>