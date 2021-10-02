<?php
    require_once "header.php";
?>

<div>
    <h1>Register</h1>
    <p>Already have account? <a href="/login">Login here</a></p>
    <form action="/register/query" method="POST" enctype= "multipart/form-data">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm" placeholder="Confirm Password">
        <input type="text" name="fullname" placeholder="Full Name">
        <input type="email" name="email" placeholder="Email">
        <input type="tel" name="phone" placeholder="Phone Number">
        <?php echo "$data[message]<br>" ?>
        <button type="submit" name="submit">Register</button>
    </form>
</div>

<?php
    require_once "footer.php";
?>
