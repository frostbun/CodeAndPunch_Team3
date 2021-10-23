<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1 class="mb-5">Chat with <?=$data["otherUser"]?></h1>
    <form id="form" action="/chat/query/<?=$data["otherUser"]?>" method="POST" enctype= "multipart/form-data">
        <div class="input-group mb-3">
            <input class="form-control form-control-lg" id="text" type="text" name="text" placeholder="Write something..." autofocus>
            <button class="btn btn-primary btn-lg" id="submit" type="submit" name="submit">Send</button>
        </div>
    </form>
    <a class='btn btn-outline-primary btn-sm' id='delete' style="visibility: hidden">Delete</a>
    <button class='btn btn-outline-primary btn-sm' id='cancel' onclick='cancel("<?=$data["otherUser"]?>")' style="visibility: hidden">Cancel</button>
    <?php
        foreach($data["message"] as $message) {
            if($message["sender"] === $_SESSION["user"]) {
                echo "<p class='text-start fs-4 mb-0' id='$message[id]' onclick='edit(\"$data[otherUser]\", \"$message[id]\", \"$message[content]\")'>$message[content]</p>";
                echo "<p class='text-start fw-lighter fst-italic'><small>$message[datetime]</small></p>";
            }
            else {
                echo "<p class='text-end fs-4 mb-0'>$message[content]</p>";
                echo "<p class='text-end fw-lighter fst-italic'><small>$message[datetime]</small></p>";
            }
        }
    ?>
</div>

<?php require_once "footer.php" ?>