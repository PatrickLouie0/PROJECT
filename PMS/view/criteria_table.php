<?php
    // Establish database connection
$id = $_GET['id'];
    $dsn = "mysql:host=localhost;dbname=pms";
    $conn = new PDO($dsn, "root", "");

    // Retrieve data from the database
    $sql = "SELECT * FROM criteria where event_id ='$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch the data as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<table class="table table-bordered" style=" color: black;border-color: black">
            <thead class="text-center">
                <tr >
                    <th colspan="4">
                        Criteria
                    </br>
                    </th>
                </tr>
                <tr>
                    <th class="text-left">Criteria Name</th>
                    <th style="width: 10%">Criteria %</th>
                    <th class="text-left">Criteria Description</th>
                    <th style="width: 10%">action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                  <?php foreach ($data as $row) { ?>
                <tr id="rows-<?= $row['id'] ?>">
                    <td class="text-left"><?php echo ucwords($row['criteria_name']); ?></td>
                    <td><?php echo $row['criteria_percent'].'%'; ?></td>
                    <td class="text-left"><?=$row['criteria_description']?></td>
                    <td class="d-table-cell float-none" style="text-align: center;">
                        <form method="POST">
                        
                             <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-3" onclick="editRow(<?php echo $row['id']; ?>)" style="font-size: 12px;margin-top: 1px;">
                                <i class="fa fa-pencil"></i>
                            </button>
 
                        
                        <button class="btn btn-primary" 
                        type="submit" name="delete_criteria" value="<?=$row['id']?>" 
                         data-bs-target="#modal-3" data-bs-toggle="modal" style="font-size: 12px;margin-top: 1px;">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    </td>
                    
                    
                </tr>
                <?php
}
?>
            </tbody>
        </table>
    <script type="text/javascript">

     function editRow(id) {
        // Retrieve the data from the current row
        var name = document.getElementById("rows-" + id).cells[0].innerText;
        var percent = document.getElementById("rows-" + id).cells[1].innerText;
        var description = document.getElementById("rows-" + id).cells[2].innerText;

        // Show the data in the modal fields
        document.getElementById("criterianame").value = name;
        document.getElementById("criteriapercent").value = percent;
        document.getElementById("criteriadescription").value = description;
        document.getElementById("criteria_name_value").value = name;
        document.getElementById("criteria_percent_value").value = percent;
        document.getElementById("criteria_description_value").value = description;
    }
    </script>