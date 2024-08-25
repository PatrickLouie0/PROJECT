<?php
    // Establish database connection
$id = $_GET['id'];
    $dsn = "mysql:host=localhost;dbname=pms";
    $conn = new PDO($dsn, "root", "");

    // Retrieve data from the database
    $sql = "SELECT * FROM judge where event_id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch the data as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table table-bordered" style=" color: black; border-color: black">
            <thead class="text-left">
                <tr >
                    <th colspan="3" class="text-center">
                        Judge
                    </br>
                </th>
                </tr>
                <tr>
                    <th> Name</th>
                    <th> Code</th>
                    <th style="width: 10%;text-align: center;">action</th>
                </tr>
            </thead>
            <tbody class="text-left">
                  <?php foreach ($data as $row) { ?>
                <tr id="judge-row-<?= $row['id'] ?>">
                    <td><?php echo ucwords($row['judge_name']); ?></td>
                    <td><?php echo $row['judge_password']; ?></td>

                    <td class="d-table-cell float-none" style="text-align: center;">
                        <form method="POST">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-2" onclick="editjudge(<?php echo $row['id']; ?>)" style="font-size: 12px;margin-top: 1px;">
                                <i class="fa fa-pencil"></i>
                        </button>
 
                        <button class="btn btn-primary" type="submit" name="delete_judge" value="<?=$row['id']?>" data-bs-target="#modal-3" data-bs-toggle="modal" style="font-size: 12px;margin-top: 1px;"><i class="fa fa-trash"></i></button>
                    </form>
                    </td>
                    
                    
                </tr>
                <?php
}
?>
            </tbody>
        </table>

    <script type="text/javascript">


     function editjudge(id) {
        // Retrieve the data from the current row
        var name = document.getElementById("judge-row-" + id).cells[0].innerText;
        var percent = document.getElementById("judge-row-" + id).cells[1].innerText;
       
        // Show the data in the modal fields
        document.getElementById("judge_name").value = name;
        document.getElementById("judge_password").value = percent;
        document.getElementById("judge_name_value").value = name;
        document.getElementById("judge_password_value").value = percent;
       }
    </script>