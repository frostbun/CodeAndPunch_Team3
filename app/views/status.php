<?php require_once "header.php" ?>

<div>
    <h1><?=$data["hwfilename"]?> status</h1>
    <table>
        <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>File</th>
        </tr>
        <?php
            foreach($data["student"] as $student) {
                echo "<tr>";
                echo "<td>" . ++$count . "</td>";
                echo "<td>$student[username]</td>";
                echo "<td>$student[fullname]</td>";
                // echo "<td> <a href='/download/handin/$data[hwfileid]/$student[username]/$student[filename]'>$student[filename]</a> </td>";
                echo "<td> <a href='/index.php?url=download/handin/$data[hwfileid]/$student[username]/$student[filename]'>$student[filename]</a> </td>";
                echo "</tr>";
            }
        ?>
    </table>
</div>

<?php require_once "footer.php" ?>