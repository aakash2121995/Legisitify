<html>
<head><title>Legistify</title>
<link href="Content/bootstrap.min.css" rel="stylesheet" />
<script src="Scripts/jquery-1.9.1.min.js"></script>
</head>
<body>
<?php 
// error_reporting(0);
require "connect.php";
session_start();
if(!$_SESSION['loggedin'])  // checking if user is logged in
    header("Location: index.html");
?>
<script type="text/javascript">
    $( function(){
        $('button').click(function(){
            id = "#" + this.id
            dateSelected = $('input').filter(id).val()
            nonAvailDate = $('td[name="nonavail"]').filter(id).text()
            if(dateSelected == nonAvailDate)
                alert("Lawyer is not available")
            else if(dateSelected!="")
                {
                    $.post("fixAppointment.php",{date_:dateSelected,lawyerID:this.id}).done(function(data){
                        alert("Appointment is fixed")
                        window.location = "userIndex.php"
                    })
                }
            else
                alert("Please select a date for appointment")
                

        })
})
</script>
<div id="fullscreen_bg" class="fullscreen_bg"/>
<div class="container">
	<h1>Lawyers</h1>
    <p align="right">
    <a href = "logout.php"><button class="btn-primary">Log out</button></a>   
</p>
	<hr>
    <div class="row col-md-10 col-md-offset-1 custyle">
    <table class="table table-striped custab">
    <thead>
        <tr>
            <th>Name</th>
            <th>Experience</th>
            <th class="text-center">Category</th>
            <th>Non-Availabilty</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
            <?php   
                    
                    $today = date('Y-m-d') ;
                    /* for details of the lawyers and appointments*/
                    $query = "select * from lawyer";
                    $result = mysqli_query($db,$query);
                    while ($row = mysqli_fetch_row($result)) {
                       echo "
                        <tr>
                        <td>$row[3] $row[4]</td>
                        <td>$row[5] </td>
                        <td  class='text-center'>$row[6]</td>
                        <td name='nonavail' id = $row[0]>$row[7]</td>
                        ";
                        /*for checking the details of already made appointments*/
                        $query_ = "SELECT status,DateOfAppointment from appointment where userID = $_SESSION[id] and lawyerID = $row[0]";
                        $result_ = mysqli_query($db,$query_);
                        
                        //$row_ = appointmentFixed($_SESSION['id'],$row[0]);
                        if(mysqli_num_rows($result_)>0){
                            $row_ = mysqli_fetch_row($result_);
                            $status = $row_[0];
                            $DateOfAppointment = $row_[1];
                        }
                        
                        if(mysqli_num_rows($result_)==0){
                        echo"<td><button id =$row[0] class='btn btn-primary'>Fix</button></td>
                        <td><input type='date' id=$row[0]  min=$today></input></td>
                        </tr>";
                    }

                    else if($status == "Fixed")
                        echo"<td><span class='label label-warning'>$row_[0]</span></td>
                        <td>$DateOfAppointment</td>
                        </tr>";

                    else if($status== "Confirmed")
                        echo"<td><span class='label label-success'>$row_[0]</span></td>
                        <td>$DateOfAppointment</td>
                        </tr>";
                    else
                        echo"<td><span class='label label-danger'>$row_[0]</span></td>
                        <td>$DateOfAppointment</td>
                        </tr>";


                    }
                ?>
            
    </div>
</div>

<body>

</html>