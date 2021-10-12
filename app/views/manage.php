<?php require_once "header.php" ?>

<div>
    <h1>Students</h1>
    <h3> <a href="chat/<?=$data["teacher"]["username"]?>">Teacher: <?=$data["teacher"]["fullname"]?></a> </h3>
    <table>
        <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
        <?php
            foreach($data["student"] as $student) {
                echo "<tr>";
                echo "<td>" . ++$count . "</td>";
                echo "<td>$student[username]</td>";
                echo "<td>$student[fullname]</td>";
                echo "<td>$student[email]</td>";
                echo "<td>$student[phone]</td>";
                echo "<td> <a href='/chat/$student[username]'>Chat</a> </td>";
                if($_SESSION["type"] == "Teacher") {
                    echo "<td> <a href='/edit/$student[username]'>Edit</a> </td>";
                    echo "<td> <a href='/delete/$student[username]'>Delete</a> </td>";
                }
                echo "</tr>";
            }
        ?>
    </table>
    <?php 
        if($_SESSION["type"] == "Teacher") {
            echo '<p> <a href="/addstudent">Add a student</a> </p>';
        }
    ?>
    <p> <a href="/edit/<?=$_SESSION["user"]?>">Edit personal information</a> </p>
    <p> <a href="/changepw">Change password</a> </p>
</div>

<?php require_once "footer.php" ?>