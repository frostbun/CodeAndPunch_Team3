<?php require_once "header.php" ?>

<div>
    <h1>Homeworks</h1>    
    <h3> <a href="chat/<?=$data["teacher"]["username"]?>">Teacher: <?=$data["teacher"]["fullname"]?></a> </h3>
    <table>
        <tr>
            <th>No.</th>
            <th>Given</th>
            <th>Deadline</th>
            <th>Status</th>
        </tr>
        <?php
            foreach($data["file"] as $file) {
                if(strlen($file["hint"])) continue;
                echo "<tr>";
                echo "<td>" . ++$count . "</td>";
                // echo "<td> <a href='/download/homework/$file[name]'>$file[name]</a> </td>";
                echo "<td> <a href='/index.php?url=download/homework/$file[name]'>$file[name]</a> </td>";
                echo "<td>$file[deadline]</td>";
                echo "<td>$file[status]</td>";
                if($_SESSION["type"] == "Teacher") {
                    echo "<td> <a href='/status/$file[id]'>View</a> </td>";
                }
                else if($file["status"] == "Not handed in") {
                    echo "<td> <a href='/upload/1/$file[id]'>Submit</a> </td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    <?php 
        if($_SESSION["type"] == "Teacher") {
            echo '<p> <a href="/upload/0">Give new homework</a> </p>';
        }
    ?>
</div>

<?php require_once "footer.php" ?>