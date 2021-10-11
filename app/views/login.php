<?php require_once "header.php" ?>

<div>
    <h1>Login</h1>
    <p>Don't have account? <a href="/register">Register here</a></p>
    <form action="/login/query" method="POST" enctype= "multipart/form-data">
        <input type="text" name="username" placeholder="Username" value="<?=$data["user"]["username"]?>">
        <input type="password" name="password" placeholder="Password">
        <?=$data["message"]?> <br>
        <button type="submit" name="submit">Login</button>
    </form>
</div>

<?php require_once "footer.php" ?>