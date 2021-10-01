<?php
    require_once "include/header.php";
?>

<div>
    <h1>Register</h1>
    <p>Already have account? <a href="/login">Login here</a></p>
    <form action="/" method="POST" enctype= "multipart/form-data">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="ConfirmPassword" placeholder="Confirm Password">
        <button type="submit" name="submit">Register</button>
    </form>
</div>

<?php
    require_once "include/footer.php";
?>
