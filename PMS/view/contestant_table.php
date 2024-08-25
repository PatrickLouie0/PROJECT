<?php
    // Establish database connection
$id = $_GET['id'];
    $dsn = "mysql:host=localhost;dbname=pms";
    $conn = new PDO($dsn, "root", "");

    // Retrieve data from the database
    $sql = "SELECT * FROM contestant where event_id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch the data as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table class="table table-bordered" style=" color: black;border-color: black" id="contestant-table">
            <thead class="text-center">
                <tr >
                    <th colspan="8">
                        Candidates Information
                    </th>
                </tr>
                <tr>
                    <th>No</th>
                    <th>Picture</th>
                    <th class="text-left">Name</th>
                    <th>Age</th>
                    <th class="text-left">Description</th>
                    <th class="text-left">Motto</th>
                    <th class="text-left">address</th>
                    <th style="width: 10%;">action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                  <?php foreach ($data as $row) { ?>
                <tr id="row-<?= $row['id'] ?>">
                    <td><?php echo $row['contestant_no']; ?></td>
                    <td style="width: 10%; height: 10%"><img src="../contestant/assets/picture/<?= $row['contestant_picture']?>" style="width: 60%;h1eight: 60%"></td>
                    <td class="text-left"><?php echo ucwords($row['contestant_name']); ?></td>
                    <td><?php echo $row['age']?></td>
                    <td class="text-left"><?php echo $row['contestant_description']?></td>
                    <td class="text-left"><?php echo $row['motto']?></td>
                    <td class="text-left"><?php echo $row['address']?></td>
                    <td class="d-table-cell float-none" style="text-align: center;">
                    <form method="POST">
                          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-1" onclick="editcontestant(<?php echo $row['id']; ?>)" style="font-size: 12px;margin-top: 1px;"><i class="fa fa-pencil"></i></button>
 
                      
                        <button class="btn btn-primary" type="submit" name="delete_contestant" value="<?=$row['id']?>" data-bs-toggle="modal" style="font-size: 12px;margin-top: 1px;"><i class="fa fa-trash"></i></button>
                    </form>
                    </td>
                    
                    
                </tr>
                <?php
}
?>
            </tbody>
        </table>
    <script type="text/javascript">


 function editcontestant(id) {
  // Retrieve the data from the current row
  var no = document.getElementById("row-" + id).cells[0].innerText;
  var picturePath = document.getElementById("row-" + id).cells[1].querySelector('img').src;
  var name = document.getElementById("row-" + id).cells[2].innerText;
  var age = document.getElementById("row-" + id).cells[3].innerText;
  var description = document.getElementById("row-" + id).cells[4].innerText;
  var motto = document.getElementById("row-" + id).cells[5].innerText;
  var address = document.getElementById("row-" + id).cells[6].innerText;

  // Show the data in the modal fields
  document.getElementById("conno").value = no;
  document.getElementById("contestant_no_value").value = no;
  document.getElementById("contestant_name_value").value = name;
  document.getElementById("profiledisplay").src = picturePath;
  document.getElementById("contestant_no").value = no;
  document.getElementById("contestant_name").value = name;
  document.getElementById("contestant_age").value = age;
  document.getElementById("contestant_description").value = description;
  document.getElementById("contestant_motto").value = motto;
  document.getElementById("contestant_address").value = address;
}

    </script>
