<?php require_once "header.php" ?>

<div class="container text-center">
    <h1>Games</h1>    
    <h3>Teacher: <?=$data["teacher"]["fullname"]?></h3>
    <h3>Email: <?=$data["teacher"]["email"]?></h3>
    <h3>Phone Number: <?=$data["teacher"]["phone"]?></h3>
    <table class="table table-striped table-hover">
        <thead> <tr>
            <th>No.</th>
            <th>Hint</th>
            <th>Answer</th>
        </tr> </thead>
        <tbody> <?php
            foreach($data["file"] as $file) {
                if(!strlen($file["hint"])) continue;
                echo "<tr class='align-middle'>";
                    echo "<th>" . ++$count . "</th>";
                    echo "<td class='text-break' style='max-width: 20rem'>$file[hint]</td>";
                    echo "<td>";
                    if($_SESSION["type"] === "Student") {
                        echo "<form action='/game/query/$file[id]' method='POST' enctype='multipart/form-data'>";
                        echo "<div class='input-group'>";
                            echo "<input type='text' class='form-control form-control-sm' name='answer' placeholder='Answer'>";
                            echo "<button class='btn btn-outline-primary btn-sm' type='submit' name='submit'>Submit</button>";
                        echo "</div>";
                        echo "</form>";
                    }
                    else {
                        echo "<a class='btn btn-outline-primary btn-sm' href='/upload/delgame/$file[id]'>Delete</a>";
                    }
                    echo "</td>";
                echo "</tr>";
            }
        ?> </tbody>
    </table>
    <?php 
        if($_SESSION["type"] === "Teacher") {
            echo '<p> <a class="btn btn-outline-primary" href="/upload/2">New Game</a> </p>';
        }
    ?>
</div>

<?php require_once "footer.php" ?>