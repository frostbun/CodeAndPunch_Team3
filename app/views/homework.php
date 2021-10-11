<?php require_once "header.php" ?>

<div>
    <h1><?= $data["teacher"]["fullname"] ?> homeworks</h1>
    <table>
        <tr>
            <th>No.</th>
            <th>Given</th>
            <th>Deadline</th>
            <th>Status</th>
        </tr>
        <?php
            foreach($data["file"] as $file) {
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