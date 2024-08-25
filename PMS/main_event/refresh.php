<?php
include('../con.php');
$id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
$stmt = $pdo->prepare("SELECT * FROM website WHERE main_event_id = :main_event_id");
$stmt->bindParam(':main_event_id', $id);
$stmt->execute();
$count = $stmt->rowCount();
if ($count > 0) {
    $get = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $data = '';
    foreach ($get as $row) {
        $data .= ' 
          <form method="POST" enctype="multipart/form-data" id="">
              
        <input type="text" id="main_event_id" name="main_event_id" value="'.$row['main_event_id'].'" hidden >
          <div class="mb-3 "><label class="form-label">picture</label>
        <label style="color: white;">website Picture</label>
      <img src="assets/picture/'.$row['picture'].'" class="d-block" id="website_picture" onclick="trigger()" style="width: 350px; height: 150px;" data-index="(a-2)">
<input type="file" name="image" onchange="display(event)" id="website-picture" style="display: none;" data-index="(a-2)">

                </div>
                <div class="mb-3"><label class="form-label"  >Facebook Lik</label>
                  <input class="form-control form-control" type="text" name="facebooklink" value="'.$row['facebooklink'].'">
                </div>
                <div class="mb-3"><label class="form-label"  >Instagram Lik</label>
                  <input class="form-control form-control" type="text" name="instagramlink" value="'.$row['instagramlink'].'">
                </div>
                <div class="mb-3"><label class="form-label"  >Twitter Lik</label>
                  <input class="form-control form-control" type="text" name="twitterlink" value="'.$row['twitterlink'].'">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="submit" name="update_web_info">Save</button></div>
                    </form>
                </div>

               ';
    }
    echo json_encode($data);
} else {
    // no results found
}
?>