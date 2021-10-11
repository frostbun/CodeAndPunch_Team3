<?php require_once "header.php" ?>

<div>
    <h1>Add a student</h1>
    <form action="/addstudent/query" method="POST" enctype= "multipart/form-data">
        <input type="text" name="username" placeholder="Username" value="<?=$data["user"]["username"]?>">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm" placeholder="Confirm Password">
        <input type="text" name="fullname" placeholder="Full Name" value="<?=$data["user"]["fullname"]?>">
        <input type="email" name="email" placeholder="Email" value="<?=$data["user"]["email"]?>">
        <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" value="<?=$data["user"]["phone"]?>">
        <?=$data["message"]?> <br>
        <button type="submit" name="submit">Add</button>
    </form>
</div>

<?php require_once "footer.php" ?>