<?php
if (isset($_GET['added'])) {
?>
    <div class="alert alert-success col-4 m-2" role="alert">
        New Candidate has been added successfully...!
    </div>
<?php
} else if (isset($_GET['largeFile'])) {
?>
    <div class="alert alert-warning col-4 m-2" role="alert">
        Candidate image is too large, consider upload image less than 5mb.
    </div>

<?php
} else if (isset($_GET['invalidFile'])) {

?>
    <div class="alert alert-warning col-4 m-2" role="alert">
        Invalid file format...!, Only .jpg, .jpeg, .png files are allowed.
    </div>

<?php

} else if (isset($_GET['failed'])) {

?>
    <div class="alert alert-danger col-4 m-2" role="alert">
        Image upload failed!. Please try again...
    </div>

<?php
}
?>

<div class="row m-1">
    <div class="col-4">
        <h3>Add New Candidates</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <select class="form-control" name="election_id" required>
                    <option value="">Select Option</option>
                    <?php
                    $fetchingElections = mysqli_query($db, "SELECT * FROM elections") or die(mysqli_error($db));
                    $isAnyElections = mysqli_num_rows($fetchingElections);

                    if ($isAnyElections) {
                        while ($row = mysqli_fetch_assoc($fetchingElections)) {
                            $election_id = $row['id'];
                            $election_name = $row['election_topic'];
                    ?>
                            <option value="<?php echo $election_id; ?>" class="text-black"><?php echo $election_name; ?></option>
                        <?php
                        }
                    } else {
                        ?>
                        <option>Please add election first!</option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="candidate_name" id="" placeholder="Candidate Name" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="file" name="candidate_photo" required class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" name="candidate_details" placeholder="Candidate Details" class="form-control" required>
            </div>
            <input type="submit" value="Add Candidate" name="addCandidateBtn" class='btn btn-warning'>
        </form>
    </div>
    <div class="col-8">
        <h3>Upcoming Elections</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Election Topic</th>
                    <th scope="col"># Candidates</th>
                    <th scope="col">Starting Date</th>
                    <th scope="col">Ending Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fetchingData = mysqli_query($db, "SELECT * FROM elections") or die(mysqli_error($db));
                $isAnyElectionAdded = mysqli_num_rows($fetchingData);

                if ($isAnyElectionAdded) {
                    $sno = 1;
                    while ($row = mysqli_fetch_assoc($fetchingData)) {
                ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo $row['election_topic']; ?></td>
                            <td><?php echo $row['no_of_candidates']; ?></td>
                            <td><?php echo $row['starting_date']; ?></td>
                            <td><?php echo $row['ending_date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <a href="" class="btn btn-sm btn-warning">Edit</a>
                                <a href="" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="7" class="text-danger">There is no Elections added yet!</td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>


<?php
if (isset($_POST['addCandidateBtn'])) {
    $election_id = mysqli_real_escape_string($db, $_POST['election_id']);
    $candidate_name = mysqli_real_escape_string($db, $_POST['candidate_name']);
    $candidate_details = mysqli_real_escape_string($db, $_POST['candidate_details']);
    $inserted_by = $_SESSION['email_id'];
    $inserted_on = date("Y-m-d");

    //candidate profile photo logic
    $targetted_folder = "../assets/images/add-candidates/";
    $candidate_photo =  $targetted_folder . rand(1111111111, 99999999999) . $_FILES['candidate_photo']['name'];
    $candidate_photo_tmp_name = $_FILES['candidate_photo']['tmp_name'];
    $candidate_photo_type = strtolower(pathinfo($candidate_photo, PATHINFO_EXTENSION));
    $allowed_types = array("jpg","jpeg","png");
    $candidate_photo_size = $_FILES['candidate_photo']['size'];

    // candidate photo must be less than 5mb; 5mb === 5000000 bytes
    if ($candidate_photo_size < 5000000) {
        if (in_array($candidate_photo_type, $allowed_types)) {
            if (move_uploaded_file($candidate_photo_tmp_name, $candidate_photo)) {

                //Inserting into db
                mysqli_query($db, "INSERT INTO candidate_details(election_id,candidate_name,candidate_details,candidate_photo,inserted_by,inserted_on)
                VALUES ('" . $election_id . "','" . $candidate_name . "','" . $candidate_details . "','" . $candidate_photo . "', '" . $inserted_by . "',
                '" . $inserted_on . "')") or die(mysqli_error($db));

             
            ?>
                 <script>
                    location.assign("index.php?addElections=1&added=1")
                </script> 
            <?php

            } else {
            ?>
                <script>
                    location.assign("index.php?addCandidate=1&failed=1")
                </script>
            <?php
            }
        } else {
            ?>
            <script>
                location.assign("index.php?addCandidate=1&invalidFile=1")
            </script>
        <?php
        }
    } else {
        ?>
        <script>
            location.assign("index.php?addCandidate=1&largeFile=1")
        </script>
<?php
    }

    echo $candidate_photo_type;
}

?>