<?php require_once "header.php" ?>

<div class="container text-center">
    <h1>Homeworks</h1>    
    <h3 onclick='navigate("/chat/<?=$data["teacher"]["username"]?>")'>Teacher: <?=$data["teacher"]["fullname"]?></h3>
    <h3>Email: <?=$data["teacher"]["email"]?></h3>
    <h3>Phone Number: <?=$data["teacher"]["phone"]?></h3>
    <table class="table table-striped table-hover">
        <thead> <tr>
            <th>No.</th>
            <th>Given</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Submit</th>
        </tr> </thead>
        <tbody> <?php
            foreach($data["file"] as $file) {
                if(strlen($file["hint"])) continue;
                echo "<tr class='align-middle' onclick='navigate(\"/download/homework/$file[name]\")'>";
                    echo "<th>" . ++$count . "</th>";
                    echo "<td>$file[name]</td>";
                    echo "<td>$file[deadline]</td>";
                    echo "<td>$file[status]</td>";
                    echo "<td>";
                if($_SESSION["type"] === "Teacher") {
                    echo "<a class='btn btn-outline-primary btn-sm' href='/status/$file[id]'>View</a>";
                }
                else if($file["status"] === "Not handed in") {
                    echo "<a class='btn btn-outline-primary btn-sm' href='/upload/1/$file[id]'>Hand In</a>";
                }
                else {
                    echo "<a class='btn btn-outline-primary btn-sm' href='/upload/delhandin/$file[id]'>Remove</a>";
                }
                    echo "</td>";
                echo "</tr>";
            }
        ?> </tbody>
    </table>
    <?php 
        if($_SESSION["type"] === "Teacher") {
            echo '<p> <a class="btn btn-outline-primary" href="/upload/0">Give new homework</a> </p>';
        }
    ?>
</div>

<?php require_once "footer.php" ?>