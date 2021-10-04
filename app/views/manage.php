<?php require_once "header.php" ?>

<div>
    <table>
        <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
        <?php
            foreach($data["user"] as $user) {
                echo "<tr>";
                echo "<td>" . ++$count . "</td>";
                echo "<td>$user[username]</td>";
                echo "<td>$user[fullname]</td>";
                echo "<td>$user[email]</td>";
                echo "<td>$user[phone]</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <a href="/addstudent">Add a student</a>
</div>

<?php require_once "footer.php" ?>