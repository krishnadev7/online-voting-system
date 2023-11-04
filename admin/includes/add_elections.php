<?php
if (isset($_GET['added'])) {
?>
    <div class="alert alert-success col-4 m-2" role="alert">
        New Election has been added successfully...!
    </div>
<?php
} else if (isset($_GET['delete_id'])) {
    mysqli_query($db, "DELETE FROM elections WHERE id = '" . $_GET['delete_id'] . "' ") or die(mysqli_error($db));
?>
    <div class="alert alert-danger col-4 m-2" role="alert">
        Your Election has been deleted successfully...!
    </div>
<?php
}
?>

<div class="row m-1">
    <div class="col-4">
        <h3>Add New Election</h3>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="election_topic" id="" placeholder="election topic" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="number" name="no_of_candidates" id="" placeholder="No. of Candidates" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="starting_date" id="" required placeholder="starting date" class="form-control" required>
            </div>
            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="ending_date" id="" placeholder="ending date" class="form-control" required>
            </div>
            <input type="submit" value="Add Election" name="addElectionBtn" class='btn btn-warning'>
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
                        $election_id = $row['id'];
                ?>
                        <tr>
                            <td><?php echo $sno++; ?></td>
                            <td><?php echo $row['election_topic']; ?></td>
                            <td><?php echo $row['no_of_candidates']; ?></td>
                            <td><?php echo $row['starting_date']; ?></td>
                            <td><?php echo $row['ending_date']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <!-- <a href="" class="btn btn-sm btn-warning">Edit</a> -->
                                <button href="" class="btn btn-sm btn-danger" onclick="deleteData(<?php echo $election_id; ?>)">Delete</button>
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


<script>
    const deleteData = (e_id) => {
        let c = confirm("Are you sure wanted to delete it?");

        if (c == true) {
            location.assign(`index.php?addElections=1&delete_id=${e_id}`);
        }
    }
</script>

<?php
if (isset($_POST['addElectionBtn'])) {
    $election_topic = mysqli_real_escape_string($db, $_POST['election_topic']);
    $no_of_candidates = mysqli_real_escape_string($db, $_POST['no_of_candidates']);
    $starting_date = mysqli_real_escape_string($db, $_POST['starting_date']);
    $ending_date = mysqli_real_escape_string($db, $_POST['ending_date']);
    $inserted_by = $_SESSION['email_id'];
    $inserted_on = date("Y-m-d");

    $curr_date = date_create($inserted_on);
    $start_date = date_create($starting_date);
    $end_date = date_create($ending_date);


    if ($curr_date < $start_date) {
        $status = "Inactive";
    } elseif ($curr_date >= $start_date && $curr_date <= $end_date) {
        $status = "Active";
    } else {
        $status = "Inactive";
    }

    //Inserting into db
    mysqli_query($db, "INSERT INTO elections(election_topic,no_of_candidates,starting_date,ending_date,status,inserted_by,inserted_on)
        VALUES ('" . $election_topic . "','" . $no_of_candidates . "','" . $starting_date . "','" . $ending_date . "','" . $status . "',
        '" . $inserted_by . "','" . $inserted_on . "')") or die(mysqli_error($db));

    // 
?>
    // <script>
        location.assign("index.php?addElections=1&added=1")
    </script>
    // <?php
    }
        ?>