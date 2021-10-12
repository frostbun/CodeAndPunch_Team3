<?php require_once "header.php" ?>

<div>
    <h1>Chat with <?=$data["otherUser"]?></h1>
    <form id="form" action="/chat/query/<?=$data["otherUser"]?>" method="POST" enctype= "multipart/form-data">
        <textarea id="text" name="text" placeholder="write something..." cols="50" rows="3"></textarea>
        <button id="submit" type="submit" name="submit">Send</button>
    </form>
    <?php
        foreach($data["message"] as $message) {
            if($message["sender"] == $data["otherUser"]) {
                echo "<h1>$message[content]</h1>";
                echo "<h1>$message[datetime]</h1>";
            }
            else {
                echo "<a href='/chat/delete/$data[otherUser]/$message[id]'>Delete</a>";
                echo "<button onclick='edit(\"$data[otherUser]\", \"$message[id]\", \"$message[content]\")'>Edit</button>";
                echo "<p id='$message[id]'>$message[content]</p>";
                echo "<p>$message[datetime]</p>";
            }
        }
    ?>
</div>

<?php require_once "footer.php" ?>