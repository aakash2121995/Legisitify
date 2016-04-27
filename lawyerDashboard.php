<html>
<head><title>Legistify</title>
<link href="Content/bootstrap.min.css" rel="stylesheet" />
<script src="Scripts/jquery-1.9.1.min.js"></script>
<script src="Scripts/bootstrap.js"></script>
<script type="text/javascript">
$(function()
{
    //when acceptance of the appointment takes place
    $('#accept').click(function()
    {
        userId = this.name;
       // alert(userId)
        $.post("appointStat.php",{userID:userId,action:"Confirmed"},function(data){
                
                window.location="lawyerDashboard.php"
            
        })
    })
    //when declination of the appointment takes place
    $('#decline').click(function()
    {
        userId = this.name;

        $.post("appointStat.php",{userID:userId,action:"Not accepted"},function(data){
                //alert(data)
                window.location="lawyerDashboard.php"
            
        })
    })
    // for updation of non availabilty time
     $('#nonavailtime').click(function(){

            dateSelected = $('#dateNonavail').val()
             if(dateSelected!="")
                {
                    $.post("setDate.php",{date_:dateSelected}).done(function(data){
                        window.location = "lawyerDashboard.php"
                    })
                }
            else
                alert("Please select a date")
        })
})
</script>
</head>
<body>
    <div class="container">
    <div class="row">
        <div>

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#dashboard" aria-controls="home" role="tab" data-toggle="tab">Dashboard</a>
                </li>
                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a>
                </li>
                
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="dashboard">
                    <div class="container">
                            <h1>Dashboard</h1>
                            <hr>
                            <div class="row col-md-10 col-md-offset-1 custyle">
                                <table class="table table-striped custab">
                                    <?php
                                    require "connect.php";
                                    session_start();
                                    if(!$_SESSION['loggedin']) // checking if lawyer is logged in 
                                        header("Location: index.html");
                                     /* For putting date into input of non availablity */
                                    $query = "Select NonAvailablity from lawyer where lawyerId = $_SESSION[id]";
                                    $result = mysqli_query($db,$query);
                                    $date = mysqli_fetch_row($result)[0];

                                    echo "
                                    <script type=\"text/javascript\">
                                    \$(function(){
                                             \$('#dateNonavail').val('$date'); 
                                    }) 
                                    </script>";

                                    /* for appointment details */
                                    $query = "Select * from appointment where lawyerID = $_SESSION[id]";
                                    $result = mysqli_query($db,$query);
                                    $num_rows = mysqli_num_rows($result);
                                    if($num_rows>0)
                                    echo "
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Requestors Name</th>
                                            <th>Status</th>

                                        </tr>
                                    </thead>";
                                    else
                                        echo "You have no notification";

                                    
                                    while ($row = mysqli_fetch_row($result)) {
                                        /* for name of the users */
                                        $query_ = "Select Name from user where userId = $row[1]";
                                        $result_ = mysqli_query($db,$query_);
                                        $row_ = mysqli_fetch_row($result_);
                                        echo"
                                            <tr>
                                        <td>$row[2]</td>
                                        <td>$row_[0]</td>";
                                        switch ($row[3]) {
                                            case 'Fixed':
                                                echo"
                                        <td>
                                            <button id='accept' name=$row[1] class='btn btn-primary'>Accept</button>
                                            <button id='decline' name=$row[0] class='btn btn-danger'>Decline</button>
                                        </td>
                                    </tr>
                                        ";
                                                break;

                                            case 'Confirmed':
                                            echo"<td><span class='label label-success'>Accepted</span></td>";
                                            break;
                                            default:
                                                echo"<td><span class='label label-danger'>Not accepted</span></td>";
                                                break;
                                        }
                                        
                                    }
                                    
                                    ?>
                                </table>
                            </div>
                        </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <h1>Profile</h1>
                    <hr>
                    <button id = "nonavailtime" class = "btn-primary">Set Non-availabilty time</button>
                    <input id = "dateNonavail" type="date" min='<?php echo date("Y-m-d"); ?>'></input>
                    <hr>
                    <a href = "logout.php"><button class = "btn-primary">Log out</button></a>
                </div>
                
            </div>

        </div>
    </div>
</div>
<body>

</html>