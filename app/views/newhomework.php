<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1>Upload new homework</h1>
    <form action="/upload/newhomework" method="POST" enctype= "multipart/form-data">
        <input class="form-control-file mb-2" type="file" name="file" accept=".pdf, .doc, .docx, .txt">
        <div class="form-floating">
            <input class='form-control mb-2' type='date' name='deadline' value='<?=date('Y-m-d')?>' min='<?=date('Y-m-d')?>'>
            <label>Deadline</label>
        </div>
        <p class="text-danger"><?=$data["message"]?></p>
        <button class="btn btn-primary" type="submit" name="submit">Upload</button>
    </form>
</div>

<?php require_once "footer.php" ?>