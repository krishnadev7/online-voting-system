<?php
require_once("./includes/header.php");
require_once("./includes/navigation.php");
?>

<div class="row my-3">
    <div class="col-12">
        <h3>Voters Panel</h3>

        <?php
        $fetchingActiveElections = mysqli_query($db, "SELECT * FROM elections WHERE status = 'Active' ") or die(mysqli_error($db));
        $activeElections = mysqli_num_rows($fetchingActiveElections);

        if ($activeElections) {

            while ($data = mysqli_fetch_assoc($fetchingActiveElections)) {
                $election_id = $data['id'];
                $election_topic = $data['election_topic'];

        ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="4" class="text-white" style="background-color: black;">
                                <h5>ELECTION TOPIC: <?php echo strtoupper($election_topic); ?></h5>
                            </th>
                        <tr>
                            <th>Photo</th>
                            <th>Candidate Details</th>
                            <th>No. of votes</th>
                            <th>Action</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $fetchingCandidates = mysqli_query($db, "SELECT * FROM candidate_details WHERE election_id = '" . $election_id . "' ") or die(mysqli_error($db));

                        while ($candidateData = mysqli_fetch_assoc($fetchingCandidates)) {
                            $candidate_id = $candidateData['id'];
                            $candidate_photo = $candidateData['candidate_photo'];

                            //fetching candidate votes
                            $fetchingVotes = mysqli_query($db,"SELECT * FROM votings WHERE candidate_id = '".$candidate_id."' ") or die(mysqli_error($db));
                            $totalVotes = mysqli_num_rows($fetchingVotes);

                        ?>
                            <tr>
                                <td><img style="width:80px; height: 80px; border: 5px solid #FFD700; border-radius: 100%;" src="<?php echo $candidate_photo; ?> "></td>
                                <td><?php echo "<b>" . $candidateData['candidate_name'] . "</b> <br>" . $candidateData['candidate_details']  ?></td>
                                <td><?php echo $totalVotes?></td>
                                <td><button class="btn btn-success">Vote</button></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            <?php
            }
        } else {
            ?>
            <p class="text-danger">No any active election.</p>
        <?php
        }
        ?>
    </div>
</div>

<?php
require_once("./includes/footer.php");
?>