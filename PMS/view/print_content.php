<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title></title>
    <script type="text/javascript" src="assets/javascript/javascript.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <style type="text/css">
        table,th,td,tr
        {
            border-color: black;
            border-width: 3px;
        }
        @media print {
  body {
    width: 210mm;
    height: 297mm;
    margin: 20mm;
  }
}

    </style>
</head>
<body>
    <!--Edit criteria-->
<?php
        $con = mysqli_connect('localhost','root','','pms');
        $id = $_GET['id'];
        $event = "";
        $stmt = mysqli_query($con,"SELECT event_name FROM event WHERE event_id = $id");
        if (mysqli_num_rows($stmt)>0) {
            $res = mysqli_fetch_assoc($stmt);
            $event = ucfirst($res['event_name']);
        }
        ?>
                  
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
<div id="print">
        <div class="container">
        
        <h1 class="text-center mt-4" style="color: rgb(239,187,0);"><?=$event?></h1>
        <div>
            <div class="d-flex" style="column-count: 2">
<!--start of judge table-->

<table class="table table-bordered" style=" color: black; margin-right: 10px;">
            <thead class="text-left">
                <tr>
                    <th colspan="2" class="text-center">Judge</th>
                </tr>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                </tr>
            </thead>
            <tbody class="text-left">
<?php foreach ($data as $row) { ?>
                <tr id="judge-row-<?= $row['id'] ?>">
                    <td><?php echo $row['judge_name']; ?></td>
                    <td><?php echo $row['judge_password']; ?></td>                   
                </tr>
<?php
    }
?>
            </tbody>
</table>

<!--end of judge table-->

<!--start of criteria table-->
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
<table class="table table-bordered" style=" color: black;">
            <thead class="text-left">
                <tr >
                    <th colspan="2" class="text-center">
                        Criteria
                    </th>
                </tr>
                <tr>
                    <th>Criteria Name</th>
                    <th style="width: 30%;text-align: center;">Criteria %</th>
                </tr>
            </thead>

            <tbody class="text-left">
                  <?php foreach ($data as $row) { ?>
                <tr id="rows-<?= $row['id'] ?>">
                    <td><?php echo $row['criteria_name']; ?></td>
                    <td class="text-center"><?php echo $row['criteria_percent'].'%'; ?></td>
                <?php
}
?>
            </tbody>
        </table>
<!--end of criteria table-->
        </div>

        <div class="table-responsive">
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
<table class="table table-bordered" style=" color: black;" id="contestant-table">
            <thead class="text-left">
                <tr >
                    <th colspan="4" class="text-center">
                        Contestant
                    </th>
                </tr>
                <tr>
                    <th class="text-center">No</th>
                    <th>Name</th>
                    <th style="text-align: center;">Age</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody class="text-left">
                  <?php foreach ($data as $row) { ?>
                <tr id="row-<?= $row['id'] ?>">
                    <td style="width: 5%;text-align: center;"><?php echo $row['contestant_no']; ?></td>
                    <td style="width: 20%"><?php echo $row['contestant_name']; ?></td>
                    <td style="width: 10%;text-align: center;"><?php echo $row['age']?></td>
                    <td><?php echo $row['contestant_description']?></td>
                </tr>
<?php
}
?>
            </tbody>
        </table>

           
        </div>
    </div>
</div>
</body>
</html>

