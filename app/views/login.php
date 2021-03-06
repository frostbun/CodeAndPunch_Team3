<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1>Login</h1>
    <p>Don't have account? <a href="/register">Register here</a></p>
    <form action="/login/query" method="POST" enctype= "multipart/form-data">
        <div class="form-floating">
            <input class="form-control mb-2" type="text" name="username" placeholder="Username" value="<?=$data["user"]["username"]?>">
            <label>Username</label>
        </div>
        <div class="form-floating">
            <input class="form-control mb-2" type="password" name="password" placeholder="Password">
            <label>Password</label>
        </div>
        <p class="text-danger"><?=$data["message"]?></p>
        <button class="btn btn-primary" type="submit" name="submit">Login</button>
    </form>
</div>

<?php require_once "footer.php" ?>