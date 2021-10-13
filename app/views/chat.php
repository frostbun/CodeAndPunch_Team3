<?php require_once "header.php" ?>

<div class="container text-center" style="width: 30%">
    <h1>Chat with <?=$data["otherUser"]?></h1>
    <form id="form" action="/chat/query/<?=$data["otherUser"]?>" method="POST" enctype= "multipart/form-data">
        <div class="input-group">
            <input class="form-control form-control-lg" id="text" type="text" name="text" placeholder="Write something..." autofocus>
            <button class="btn btn-outline-primary btn-lg" id="submit" type="submit" name="submit">Send</button>
        </div>
    </form>
    <?php
        foreach($data["message"] as $message) {
            if($message["sender"] === $data["otherUser"]) {
                echo "<p class='text-start fs-4'>$message[content]</p>";
                echo "<p class='text-start fw-lighter fst-italic'><small>$message[datetime]</small></p>";
            }
            else {
                echo "<p class='text-end fs-4' id='$message[id]' ondblclick='edit(\"$data[otherUser]\", \"$message[id]\", \"$message[content]\")'>$message[content]</p>";
                echo "<p class='text-end fw-lighter fst-italic'><small>$message[datetime]</small></p>";
                // echo "<a href='/chat/delete/$data[otherUser]/$message[id]'>Delete</a>";
            }
        }
    ?>
</div>

<?php require_once "footer.php" ?>