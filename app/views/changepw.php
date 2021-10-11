<?php require_once "header.php" ?>

<div>
    <h1>Change password</h1>
    <form action="/changepw/query" method="POST" enctype= "multipart/form-data">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="newpass" placeholder="New Password">
        <input type="password" name="confirm" placeholder="Confirm Password">
        <?=$data["message"]?> <br>
        <button type="submit" name="submit">Change</button>
    </form>
</div>

<?php require_once "footer.php" ?>