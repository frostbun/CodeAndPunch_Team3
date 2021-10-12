<?php require_once "header.php" ?>

<div>
    <h1>Games</h1>    
    <h3> <a href="chat/<?=$data["teacher"]["username"]?>">Teacher: <?=$data["teacher"]["fullname"]?></a> </h3>
    <table>
        <tr>
            <th>No.</th>
            <th>Hint</th>
            <th>Answer</th>
        </tr>
        <?php
            foreach($data["file"] as $file) {
                if(!strlen($file["hint"])) continue;
                echo "<tr>";
                echo "<td>" . ++$count . "</td>";
                echo "<td>$file[hint]</td>";
                echo "<td> <form action='/game/query/$file[id]' method='POST' enctype='multipart/form-data'>";
                echo "<input type='text' name='answer' placeholder='Answer'>";
                echo "<button type='submit' name='submit'>Submit</button>";
                echo "</form> </td>";
                echo "</tr>";
            }
        ?>
    </table>
    <?php 
        if($_SESSION["type"] == "Teacher") {
            echo '<p> <a href="/upload/2">New Game</a> </p>';
        }
    ?>
</div>

<?php require_once "footer.php" ?>