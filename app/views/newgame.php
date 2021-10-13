<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1>Upload new game</h1>
    <form action="/upload/newgame" method="POST" enctype= "multipart/form-data">
        <input class="form-control-file mb-2" type="file" name="file" accept=".pdf, .doc, .docx, .txt">
        <div class="form-floating">
            <textarea class="form-control mb-2" name="hint" placeholder="Hint" style="height: 100px"></textarea>
            <label>Hint</label>
        </div>
        <p class="text-danger"><?=$data["message"]?></p>
        <button class="btn btn-primary" type="submit" name="submit">Upload</button>
    </form>
</div>

<?php require_once "footer.php" ?>