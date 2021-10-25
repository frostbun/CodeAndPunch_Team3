<?php require_once "header.php" ?>

<div class="container text-center">
    <h1>Students</h1>
    <h3>Teacher: <?=$data["teacher"]["fullname"]?></h3>
    <h3>Email: <?=$data["teacher"]["email"]?></h3>
    <h3>Phone Number: <?=$data["teacher"]["phone"]?></h3>
    <table class="table table-striped table-hover">
        <thead> <tr>
                <th>No.</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Chat</th>
        </tr> </thead>
        <tbody> <?php
            foreach($data["student"] as $student) {
                echo "<tr class='align-middle'";
                if($_SESSION["type"] === "Teacher") {
                    echo "onclick='navigate(\"/edit/$student[username]\")'";
                }
                echo ">";
                    echo "<th>" . ++$count . "</th>";
                    echo "<td>$student[username]</td>";
                    echo "<td>$student[fullname]</td>";
                    echo "<td>$student[email]</td>";
                    echo "<td>$student[phone]</td>";
                    echo "<td>";
                    if($_SESSION["user"] !== $student["username"]) {
                        "<a class='btn $student[buttonType] btn-sm' href='/chat/$student[username]'>Chat</a>";
                    }
                    echo "</td>";
                echo "</tr>";
            }
        ?> </tbody>
    </table>
    <?php
        if($_SESSION["type"] === "Teacher") {
            echo '<p> <a class="btn btn-outline-primary" href="/addstudent">Add a student</a> </p>';
        }
        else {
            echo '<p> <a class="btn '.$data["teacher"]["buttonType"].'" href="/chat/'.$data["teacher"]["username"].'">Chat with teacher</a> </p>';
        }
    ?>
    <p> <a class="btn btn-outline-primary" href="/edit/<?=$_SESSION["user"]?>">Edit personal information</a> </p>
    <p> <a class="btn btn-outline-primary" href="/changepw">Change password</a> </p>
</div>

<?php require_once "footer.php" ?>