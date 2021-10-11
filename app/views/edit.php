<?php require_once "header.php" ?>

<div>
    <h1>Edit <?=$data["user"]["username"]?>information</h1>
    <form action="/edit/query?>" method="POST" enctype= "multipart/form-data">
        <?php
            if($_SESSION["type"] == "Teacher") {
                echo "<input type='text' name='fullname' placeholder='Full Name' value='" . $data["user"]["fullname"] . "'>";
            }
        ?>
        <input type="hidden" name="username" value="<?=$data["user"]["username"]?>">
        <input type="email" name="email" placeholder="Email" value="<?=$data["user"]["email"]?>">
        <input type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" value="<?=$data["user"]["phone"]?>">
        <?=$data["message"]?> <br>
        <button type="submit" name="submit">Change</button>
    </form>
</div>

<?php require_once "footer.php" ?>