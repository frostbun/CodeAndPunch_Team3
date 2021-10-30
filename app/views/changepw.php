<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1>Change password</h1>
    <form action="/changepw/query" method="POST" enctype= "multipart/form-data">
        <input type="hidden" name="token" value="<?=$_SESSION["token"]?>">
        <div class="form-floating">
            <input class="form-control mb-2" type="password" name="password" placeholder="Password">
            <label>Password</label>
        </div>
        <div class="form-floating">
            <input class="form-control mb-2" type="password" name="newpass" placeholder="New Password">
            <label>New Password</label>
        </div>
        <div class="form-floating">
            <input class="form-control mb-2" type="password" name="confirm" placeholder="Confirm Password">
            <label>Confirm Password</label>
        </div>
        <p class="text-danger"><?=$data["message"]?></p>
        <button class="btn btn-primary" type="submit" name="submit">Change</button>
    </form>
</div>

<?php require_once "footer.php" ?>