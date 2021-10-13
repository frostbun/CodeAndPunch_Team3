<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1>Add a student</h1>
    <form action="/addstudent/query" method="POST" enctype= "multipart/form-data">
        <div class="form-floating">
            <input class="form-control mb-2" type="text" name="username" placeholder="Username" value="<?=$data["user"]["username"]?>">
            <label>Username</label>
        </div>
        <div class="form-floating">
            <input class="form-control mb-2" type="password" name="password" placeholder="Password">
            <label>Password</label>
        </div>
        <div class="form-floating">
            <input class="form-control mb-2" type="password" name="confirm" placeholder="Confirm Password">
            <label>Confirm Password</label>
        </div>
        <div class="form-floating">
            <input class="form-control mb-2" type="text" name="fullname" placeholder="Full Name" value="<?=$data["user"]["fullname"]?>">
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
        <button class="btn btn-primary" type="submit" name="submit">Add</button>
    </form>
</div>

<?php require_once "footer.php" ?>