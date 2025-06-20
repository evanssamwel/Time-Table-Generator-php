<?php session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['ttgaid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit'])){
$ttgaid=$_SESSION['ttgaid'];
$weekday=$_POST['weekday'];
$stime=$_POST['start_time'];
$etime=$_POST['end_time'];

$ret=$dbh->prepare("SELECT id FROM timeslots WHERE day=:weekday and  start_time=:stime and  end_time=:etime");
$ret->bindParam(':weekday',$weekday,PDO::PARAM_STR);
$ret->bindParam(':stime',$stime,PDO::PARAM_STR);
$ret->bindParam(':etime',$etime,PDO::PARAM_STR);
$ret-> execute();
$results=$ret->fetchAll(PDO::FETCH_OBJ);
if($ret->rowCount() == 0){

$sql="insert into timeslots(day, start_time, end_time)values(:weekday, :stime, :etime)";
$query=$dbh->prepare($sql);
$query->bindParam(':weekday',$weekday,PDO::PARAM_STR);
$query->bindParam(':stime',$stime,PDO::PARAM_STR);
$query->bindParam(':etime',$etime,PDO::PARAM_STR);
$query->execute();
$LastInsertId=$dbh->lastInsertId();
if ($LastInsertId>0) {
echo '<script>alert("Time slot has been added.")</script>';
echo "<script>window.location.href ='time-slots.php'</script>";
  }else{
 echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }}
 else{
echo '<script>alert("This time slote Already created.")</script>';
echo "<script>window.location.href ='time-slots.php'</script>";
}}



// Code for deletion
if(isset($_GET['delid']))
{
$rid=intval($_GET['delid']);
$sql="delete from timeslots where id=:rid";
$query=$dbh->prepare($sql);
$query->bindParam(':rid',$rid,PDO::PARAM_STR);
$query->execute();
 echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'time-slots.php'</script>";     
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Time Table Generator :  Create Time Slot</title>

       <!-- Styles -->
    <link href="../assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="../assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/lib/unix.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
</head>

<body>
<?php include_once('includes/sidebar.php');?>
   
    <?php include_once('includes/header.php');?>
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Time Slot</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="dashboard.php">Dashboard</a></li>
                                    <li class="active">Time Slot</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <div id="main-content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>Create A New Time Slot</h4>
                                    <form method="post" name="hjhgh">

               <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Day</label>
<select name="weekday" class="form-control">
    <?php
    $weekdays = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    
    foreach ($weekdays as $day) {
        echo "<option value='$day'>$day</option>";
    }
    ?>
</select>
                                            </div>
                                        </div>


                                        <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>Start Time</label>
        <input type="time" id="start_time" name="start_time" class="form-control border-none input-flat bg-ash" placeholder="Start Time" required="true">
                                            </div>
                                        </div>
      <div class="basic-form m-t-20">
                                            <div class="form-group">
                                                <label>End Time</label>
        <input type="time" id="end_time" name="end_time" class="form-control border-none input-flat bg-ash" placeholder="End Time" required="true">
                                            </div>
                                        </div>


                             
                                   
                                </div>
                                <button class="btn btn-default btn-lg m-b-10 bg-warning border-none m-r-5 sbmt-btn" type="submit" name="submit">Save</button>
                                <button class="btn btn-default btn-lg m-b-10 m-l-5 sbmt-btn" type="reset">Reset</button> 
                            </form>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="card alert">
                                <div class="card-header pr">
                                    <h4>ALL Time Slots</h4>
                                    
                               
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table student-data-table m-t-20">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Day</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
$sql="SELECT * from timeslots";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);

$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                                <tr>
                                                    <td><?php echo htmlentities($cnt);?></td>
                                                    <td>
                                                        <?php  echo htmlentities($row->day);?>
                                                    </td>
                                                    <td><?php  echo htmlentities($row->start_time);?></td>
                                                     <td><?php  echo htmlentities($row->end_time);?></td>
                                                    <td>
                                                <a href="time-slots.php?delid=<?php echo ($row->id);?>"  onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger btn-xs">Delete</a>
                                                    </td>
                                                </tr>
                                                 <?php $cnt=$cnt+1;}} ?> 
                                            
                                             

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->

                    </div>
                    <!-- /# row -->

                    <?php include_once('includes/footer.php');?>
                </div>
            </div>
        </div>
    </div>







    <!-- jquery vendor -->
    <script src="../assets/js/lib/jquery.min.js"></script>
    <script src="../assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../assets/js/lib/menubar/sidebar.js"></script>
    <script src="../assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="../assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->
    <script src="../assets/js/scripts.js"></script>
    <!-- scripit init-->





</body>

</html><?php }  ?>