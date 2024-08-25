<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
    // Establish database connection
    $dsn = "mysql:host=localhost;dbname=pms";
    $conn = new PDO($dsn, "root", "");

    // Retrieve data from the database
    $sql = "SELECT * FROM contestant ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Fetch the data as an associative array
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<table class="table table-sm" style=" color: black;" id="myTable">
            <thead class="text-center">
                <tr>
                    <th>Contestant No</th>
                    <th>Contestant Name</th>
                    <th>Contestant Description</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody class="text-center">
                  <?php foreach ($data as $row) { ?>
                <tr>
                    <td><?php echo $row['contestant_no']; ?></td>
                    <td><?php echo $row['contestant_name']; ?></td>
                    <td><?php echo $row['contestant_description']?></td>
                    <td class="d-table-cell float-none" style="text-align: center;">
                    <form method="POST">
                        <button class="edit-button" type="button" data-bs-target="#modal-3" data-bs-toggle="modal" style="font-size: 12px;"><i class="fa fa-pencil" style="font-size: 12px;"></i>edit</button>
                    
                        <button class="btn btn-primary" type="submit" name="delete_contestant" value="<?=$row['id']?>" data-bs-toggle="modal" style="font-size: 12px;"><i class="fa fa-trash"></i></button>
                    </form>
                    </td>
                    
                    
                </tr>
                <?php
}
?>
            </tbody></table>

<form id="myForm">
  <label for="firstName">First Name:</label>
  <input type="text" id="firstName" name="firstName">
  <br>
  <label for="lastName">Last Name:</label>
  <input type="text" id="lastName" name="lastName">
  <br>
  <label for="email">Email:</label>
  <input type="email" id="email" name="email">
  <br>
  <button type="submit">Submit</button>
</form>

<script type="text/javascript">
	// Get the table and form elements
const table = document.getElementById('myTable');
const form = document.getElementById('myForm');

// Add event listener to the table
table.addEventListener('click', function(event) {
  console.log(event.target);
  // Check if the clicked element is a button
  if (event.target.className === 'edit-button') {
    // Get the row of the clicked button
    const row = event.target.parentNode.parentNode;
    
    // Extract the data from the row
    const columns = row.querySelectorAll('td');
    if (columns.length >= 3) {
      const firstName = columns[0].textContent;
      const lastName = columns[1].textContent;
      const email = columns[2].textContent;
  
  // Pre-fill the form fields with the extracted data
  form.firstName.value = firstName;
  form.lastName.value = lastName;
  form.email.value = email;
    }
}
else{
  alert('row not 3');
}
});
</script>

</body>
</html>