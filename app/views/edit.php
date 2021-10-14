<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1>Edit <?=$data["user"]["username"]?> information</h1>
    <form action="/edit/query/<?=$data["user"]["username"]?>" method="POST" enctype= "multipart/form-data">
        <div class="form-floating">    
            <input class="form-control mb-2" type="text" name="fullname" placeholder="Full Name" value="<?=$data["user"]["fullname"]?>"
                <?php 
                    if($_SESSION["type"] === "Student") {
                        echo "disabled readonly";
                    }
                ?>
            >
            <label>Full Name</label>
        </div>
        <div class="form-floating">
            <input class="form-control mb-2" type="email" name="email" placeholder="Email" value="<?=$data["user"]["email"]?>">
            <label>Email</label>
        </div>
        <div class="form-floating">
            <input class="form-control mb-2" type="tel" name="phone" placeholder="Phone Number" pattern="[0-9]{10}" value="<?=$data["user"]["phone"]?>">
            <label>Phone Number</label>
        </div>
        <p class="text-danger"><?=$data["message"]?></p>
        <?php
            if($_SESSION["type"] === "Teacher" && $_SESSION["user"] !== $data["user"]["username"]) {
                echo "<a class='btn btn-outline-primary' href='/delete/".$data["user"]["username"]."'>Delete</a>";
            }
        ?>
        <button class="btn btn-primary" type="submit" name="submit">Change</button>
    </form>
</div>

<?php require_once "footer.php" ?>