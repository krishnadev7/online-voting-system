<div class="row m-1">
    <div class="col-4">
        <h3>Add New Election</h3>
        <form method="POST">
            <div class="form-group">
                <input type="text" name="election_topic" id="" required placeholder="election topic" class="form-control">
            </div>
            <div class="form-group">
                <input type="number" name="no_of_candidates" id="" required placeholder="No. of Candidates" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="starting_date" id="" required placeholder="starting date" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" onfocus="this.type='Date'" name="ending_date" id="" required placeholder="ending date" class="form-control">
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
            <th scope="col">Election Name</th>
            <th scope="col"># Candidates</th>
            <th scope="col">Starting Date</th>
            <th scope="col">Ending Date</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
     </table>
    </div>
</div>


<?php
     if(isset($_POST['addElectionBtn'])){
        $election_topic = mysqli_real_escape_string($db,$_POST['election_topic']);
        $no_of_candidates = mysqli_real_escape_string($db,$_POST['no_of_candidates']);
        $starting_date = mysqli_real_escape_string($db,$_POST['starting_date']);
        $ending_date = mysqli_real_escape_string($db,$_POST['ending_date']);
        $inserted_by = $_SESSION['email_id'];
        $inserted_on = date("Y-m-d");

        $date1 = date_create($inserted_on);
        $date2 = date_create($starting_date);
        $diff = date_diff($date1,$date2);
       

        if($diff->format("%R%a") > 0){
             echo "Active";
        }else{
            echo "Inactive";
        };

        //Inserting into db
        // mysqli_query($db,"INSERT INTO elections(election_topic,no_of_candidates,starting_date,ending_date,status,inserted_by,inserted_on) VALUES ('". ."')")
     }
?>
