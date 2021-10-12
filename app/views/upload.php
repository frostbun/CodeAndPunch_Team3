<?php require_once "header.php" ?>

<div>
    <h1>Upload your file</h1>
    <form action="/upload/<?=$data["type"]?>" method="POST" enctype= "multipart/form-data">
        <label><?=$data["label"]?></label>
        <input type="file" name="file" accept=".pdf, .doc, .docx, .txt">
        <?php
            if($data["type"] == "newhomework") {
                echo "<label>Deadline:</label>";
                echo "<input type='date' id='deadline' name='deadline' value='" . date('Y-m-d') . "' min='" . date('Y-m-d') . "'>";
            }
            if($data["type"] == "newgame") {
                echo "<label>Hint:</label>";
                echo "<textarea name='hint' placeholder='hint...' cols='50' rows='3'></textarea>";
            }
        ?>
        <?=$data["message"]?> <br>
        <button type="submit" name="submit">Upload</button>
    </form>
</div>

<?php require_once "footer.php" ?>