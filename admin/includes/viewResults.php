<?php
$election_id = $_GET['viewResult']
?>

<div class="row my-3">
    <div class="col-12">
        <h3>Election Results</h3>

        <?php
        $fetchingActiveElections = mysqli_query($db, "SELECT * FROM elections WHERE id = '" . $election_id . "' ") or die(mysqli_error($db));
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
                            <!-- <th>Action</th> -->
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
                            $fetchingVotes = mysqli_query($db, "SELECT * FROM votings WHERE candidate_id = '" . $candidate_id . "' ") or die(mysqli_error($db));
                            $totalVotes = mysqli_num_rows($fetchingVotes);


                        ?>
                            <tr>
                                <td><img style="width:80px; height: 80px; border: 5px solid #FFD700; border-radius: 100%;" src="<?php echo $candidate_photo; ?> "></td>
                                <td><?php echo "<b>" . $candidateData['candidate_name'] . "</b> <br>" . $candidateData['candidate_details']  ?></td>
                                <td><?php echo $totalVotes ?></td>

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

        <hr>
        <h3>Voting Details</h3>
        <table class="table">
            <tr>
                <th>S.No</th>
                <th>Voter Email</th>
                <th>Voted To</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
            <?php
            $fetchingVoteDetails = mysqli_query($db, "SELECT * FROM votings WHERE election_id = '" . $election_id . "' ");
            $number_of_votes = mysqli_num_rows($fetchingVoteDetails);

            if ($number_of_votes) {
                $sno = 1;
                while ($data = mysqli_fetch_assoc($fetchingVoteDetails)) {
                    $voters_id = $data['voters_id'];
                    $candidate_id = $data['candidate_id'];
                    $fetchingUsername = mysqli_query($db, "SELECT * FROM  users WHERE id = '" . $voters_id . "'") or die(mysqli_error($db));
                    $isDataAvailable = mysqli_num_rows($fetchingUsername);
                    $userData = mysqli_fetch_assoc($fetchingUsername);

                    if ($isDataAvailable) {
                        $username = $userData['email_id'];
                        $contact_No = $userData['phone_no'];
                    } else {
                        $username = "No_Data";
                    }

                    $fetchingCandidate = mysqli_query($db, "SELECT * FROM  candidate_details WHERE id = '" . $candidate_id . "'") or die(mysqli_error($db));
                    $isDataAvailable = mysqli_num_rows($fetchingUsername);
                    $candidateData = mysqli_fetch_assoc($fetchingCandidate);

                    if ($isDataAvailable) {
                        $candidate_name = $candidateData['candidate_name'];
                    } else {
                        $candidate_name = "No_Data";
                    }
            ?>
                    <tr>
                        <td><?php echo $sno++; ?></td>
                        <td><?php echo $username; ?></td>
                        <td><?php echo $candidate_name; ?></td>
                        <td><?php echo $data['vote_date'] ?></td>
                        <td><?php echo $data['vote_time'] ?></td>
                    </tr>
            <?php
                }
            } else {
                echo "sorry, There is no any vote details available!";
            }
            ?>
        </table>

    </div>
</div>



<!-- <td>
                                    <?php
                                    $checkIfVoteCasted = mysqli_query($db, "SELECT * FROM votings WHERE voters_id= '" . $_SESSION['user_id'] . "' AND election_id = '" . $election_id . "'") or die(mysqli_error($db));
                                    $isVoteCasted = mysqli_num_rows($checkIfVoteCasted);

                                    if ($isVoteCasted) {
                                        $voteCastedData = mysqli_fetch_assoc($checkIfVoteCasted);
                                        $voteCastedToCandidate = $voteCastedData['candidate_id'];

                                        if ($voteCastedToCandidate == $candidate_id) {
                                    ?>
                                            <p class="bg-success col-3 p-2 text-white">Voted</p>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <button class="btn btn-success" onclick="castVote(<?php echo $election_id; ?>,<?php echo $candidate_id; ?>, <?php echo $_SESSION['user_id']; ?>)">Vote</button>
                                    <?php
                                    }

                                    ?>
                                </td> -->