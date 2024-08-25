<?php
    // Establish database connection
    $dsn = "mysql:host=localhost;dbname=pms";
    $conn = new PDO($dsn, "root", "");
    $main_id = $_GET['id'];
    // Retrieve data from the database
    $sql = "SELECT * FROM event WHERE main_event_id ='$main_id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch the data as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table class="table table-bordered mx-3" id="myTable" style="color: black;width: 98%;border: 2px solid black;">
            <thead class="text-center">
                <tr style="">
                    <th style="width: 20%;border-color: black;">Event Name</th>
                    <th style="width: 40%;border-color: black;">Event Description</th>
                    <th style="border-color: black;">Date Start</th>
                    <th style="border-color: black;">Time Start</th>
					<th style="border-color: black;">Date End</th>
                    <th style="border-color: black;">Time end</th>
                    <th style="text-align: center;width: 10%;">Action</th>

                </tr>
            </thead>
            <tbody class="text-center" style="border-color: black;">
                  <?php foreach ($data as $row) { //date('h:i A',strtotime($row['event_time_start']))?>
                <tr id="event-row-<?= $row['id'] ?>" style="border-color: black; ">
                    <td style="border-color: black;"><?php echo ucwords($row['event_name']); ?></td>
                    <td style="border-color: black;"><?php echo $row['event_description']; ?></td>
                    <td style="border-color: black;"><?=$row['event_date_start']?></td>

                    <td style="border-color: black;"><?=$row['event_time_start']?></td>
                    <td style="border-color: black;"><?=$row['event_date_end']?></td>
                    <td style="border-color: black;"><?=$row['event_time_end']?></td>
                    <td style="display: flex;padding-bottom:26%;border-color: ;" top="<?=$row['top']?>">
                     <form method="POST">
                         
                    	<a href="../view/view_event.php?id=<?=$row['event_id']?>"><i class="fa fa-eye" style="color: black"></i></a>
                    	<button class="btn btn-primary" type="button" data-bs-target="#modal-1" onclick="editevent(<?php echo $row['id']; ?>)" data-bs-toggle="modal" style="background-color: transparent;border-style: none; margin-top: -4%"><i class="fa fa-pencil" style="color: black"></i></button>
                       <button name="delete_event" type="submit" value="<?=$row['event_id']?>" style="background-color: transparent;border-style: none; margin-top: -4%"><i class="fa fa-trash" style="color: black;"></i></button>
                        </form>
                    </td>
                    
                    
                </tr>
                <?php
}
?>
            </tbody>
        </table>
   <script type="text/javascript">
   function editevent(id) {
    // Retrieve the data from the current row
    var event_name = document.getElementById("event-row-" + id).cells[0].innerText;
    var event_description = document.getElementById("event-row-" + id).cells[1].innerText;
    var event_date_start = document.getElementById("event-row-" + id).cells[2].innerText;
    var event_time_start = document.getElementById("event-row-" + id).cells[3].innerText;
    var event_date_end = document.getElementById("event-row-" + id).cells[4].innerText;
    var event_time_end = document.getElementById("event-row-" + id).cells[5].innerText;
    var top = document.getElementById("event-row-" + id).cells[6].getAttribute("top");
   
    // Show the data in the modal fields
    document.getElementById("event_name").value = event_name;
    document.getElementById("event_name_value").value = event_name;
    document.getElementById("event_description").value = event_description;
    document.getElementById("event_date_start").value = event_date_start;
    document.getElementById("event_time_start_value").value = event_time_start;
    document.getElementById("event_date_start_value").value = event_date_start;
    document.getElementById("event_time_start").value = event_time_start;
    document.getElementById("event_date_end").value = event_date_end;
    document.getElementById("event_time_end").value = event_time_end;
    if (top == 0) {
        const myCheckbox = document.getElementById('top');
        myCheckbox.checked = false;
    }
    else
    {
        const myCheckbox = document.getElementById('top');
        myCheckbox.checked = true;    
    }
}

</script>
       