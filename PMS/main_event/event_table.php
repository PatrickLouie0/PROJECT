<?php
    // Establish database connection
    $dsn = "mysql:host=localhost;dbname=pms";
    $conn = new PDO($dsn, "root", "");

    // Retrieve data from the database
    $sql = "SELECT * FROM main_event WHERE user_id ='{$_SESSION['username']}'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch the data as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table class="table table-bordered mx-3" id="myTable" style="color: black;width: 98%;border: 2px solid black;">

            <thead class="text-center">
                <tr style="border-color: black;">
                    <th style="border-color: black;">Event Name</th>
                    <th style="border-color: black;">Event Description</th>
                    <th style="border-color: black;">Date Start</th>
                    <th style="border-color: black;">Time Start</th>
					<th style="border-color: black;">Date End</th>
                    <th style="border-color: black;">Time end</th>
                    <th style="text-align: center;width: 10%;">Action</th>
                    <th style="text-align: center;width: 10%;">Website</th>

                </tr>
            </thead>
            <tbody class="text-center">
                  <?php foreach ($data as $row) { //date('h:i A',strtotime($row['event_time_start']))?>
                <tr id="event-row-<?= $row['id'] ?>" style="border-color: black; ">
                    <td style="border-color: black;"><?php echo ucwords($row['main_event_name']); ?></td>
                    <td style="border-color: black;"><?php echo $row['main_event_description']; ?></td>
                    <td style="border-color: black;"><?=$row['event_date_start']?></td>

                    <td style="border-color: black;"><?=$row['event_time_start']?></td>
                    <td style="border-color: black;"><?=$row['event_date_end']?></td>
                    <td style="border-color: black;"><?=$row['event_time_end']?></td>
                    <td style=";border-color: black;">
                     <form method="POST">
                         
                    	<a href="../event/event.php?id=<?=$row['main_event_id']?>"><i class="fa fa-eye" style="color: black"></i></a>
                    	<button class="btn btn-primary" type="button" data-bs-target="#modal-1" onclick="editevent(<?php echo $row['id']; ?>)" data-bs-toggle="modal" style="background-color: transparent;border-style: none; margin-top: -4%"><i class="fa fa-pencil" style="color: black"></i></button>
                       <button name="delete_event" type="submit" value="<?=$row['main_event_id']?>" style="background-color: transparent;border-style: none; margin-top: -4%"><i class="fa fa-trash" style="color: black;"></i></button>
                        </form>
                    </td>
                    <td style="border-color: black" main_event_id="<?=$row['main_event_id']?>">
                            <a href="../home/home.php?id=<?=$row['main_event_id']?>"><i class="fa fa-eye" style="color: black"></i></a>
                <button class="btn btn-primary" 
                    type="button" 
                    data-bs-target="#modal-3" 
                    data-bs-toggle="modal"
                    onclick="retrieveData(<?=$row['main_event_id']?>)" 
                    style="background-color: transparent;border-style: none; margin-top: -4%">
                    <i class="fa fa-pencil" style="color: black"></i>
                </button>

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
    var main_event = document.getElementById("event-row-" + id).cells[6].getAttribute("main_event_id");
   
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
    document.getElementById("main_event").value = main_event;
}

function retrieveData(id) {
  const xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const data = JSON.parse(xhr.responseText);
      // Do something with the retrieved data
      document.getElementById("modal-body").innerHTML = data;
    }
  };
  xhr.open('GET', `refresh.php?id=${id}`, true);
  xhr.send();
}

</script>
       