<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1>Submit homework</h1>
    <form action="/upload/newhandin/<?=$data["id"]?>" method="POST" enctype= "multipart/form-data">
        <input class="form-control-file mb-2" type="file" name="file" accept=".txt">
        <p class="text-danger"><?=$data["message"]?></p>
        <button class="btn btn-primary" type="submit" name="submit">Upload</button>
    </form>
</div>

<?php require_once "footer.php" ?>