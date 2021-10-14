<?php require_once "header.php" ?>

<div class="container text-center">
    <h1><?=$data["hwfilename"]?> status</h1>
    <table class="table table-striped table-hover">
        <thead> <tr>
            <th>No.</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>File</th>
        </tr> </thead>
        <tbody> <?php
            foreach($data["student"] as $student) {
                echo "<tr class='align-middle' ".($student["handedin"]?"onclick='navigate(\"/download/handin/$student[username]/$data[hwfileid]/$student[filename]\")'":"").">";
                    echo "<th>" . ++$count . "</th>";
                    echo "<td>$student[username]</td>";
                    echo "<td>$student[fullname]</td>";
                    echo "<td>$student[status]</td>";
                echo "</tr>";
            }
        ?> </tbody>
    </table>
</div>

<?php require_once "footer.php" ?>