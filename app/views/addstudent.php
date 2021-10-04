<?php require_once "header.php" ?>

<div>
    <h1>Add a student</h1>
    <form action="/addstudent/query" method="POST" enctype= "multipart/form-data">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm" placeholder="Confirm Password">
        <input type="text" name="fullname" placeholder="Full Name">
        <input type="email" name="email" placeholder="Email">
        <input type="tel" name="phone" placeholder="Phone Number">
        <?= "$data[message]<br>" ?>
        <button type="submit" name="submit">Add</button>
    </form>
</div>

<?php require_once "footer.php" ?>