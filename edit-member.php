<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['hmmsuid']==0)) {
  header('location:logout.php');
  } else{
    if(isset($_POST['submit']))
  {

$eid=$_GET['editid'];
 $fname=$_POST['fname'];
 $gender=$_POST['gender'];
 $age=$_POST['age'];
 $weight=$_POST['weight'];
 $relation=$_POST['relation'];

$sql="update tblmember set FullName=:fname,Gender=:gender,Age=:age,Weight=:weight,Relation=:relation where ID =:eid";

$query=$dbh->prepare($sql);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':weight',$weight,PDO::PARAM_STR);
$query->bindParam(':relation',$relation,PDO::PARAM_STR);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
 $query->execute();

   echo '<script>alert("Member detail has been updated")</script>';
    echo "<script>window.location.href ='manage-member.php'</script>";

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Health Monitoring Management System - Update Member</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
   <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">bkLib.onDomLoaded(nicEditors.allTextAreas);</script>
</head>

<body>
    <div class="main-wrapper">
       
        <?php include_once('includes/header.php');?>
        <?php include_once('includes/sidebar.php');?>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Update Member</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="card-title">Update Member</h4>
                            <form method="post">
                               <?php
$eid=$_GET['editid'];
$sql="SELECT * from  tblmember where ID=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Full Name</label>
                                    <div class="col-md-10">
                                        <input type="text" value="<?php  echo $row->FullName;?>" name="fname" required="true" class="form-control">
                                    </div>
                                </div>
                                 <div class="form-group row">
                                    <label class="col-form-label col-md-2">Age (in years)</label>
                                    <div class="col-md-10">
                                        <input type="text" value="<?php  echo $row->Age;?>" name="age" required="true" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Gender</label>
                                    <div class="col-md-10">
                   <?php if($row->Gender=="Male")
{?>                    
              <input type="radio" name="gender" id="gender" value="Female" >Female</label>
              <label>
              <input type="radio" name="gender" id="gender" value="Male" checked="true">Male
                            </label><?php } if($row->Gender=="Female")

{?>


                             <input type="radio" name="gender" id="gender" value="Female" checked="true" >Female</label>
              <label>
              <input type="radio" name="gender" id="gender" value="Male" >Male
          <?php } ?>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Weight (in kg)</label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="<?php  echo $row->Weight;?>" name="weight" required="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label col-md-2">Relation</label>
                                    <div class="col-md-10">
                                        <select type="text" class="form-control" name="relation" required="true">
                                            <option value="<?php  echo $row->Relation;?>"><?php  echo $row->Relation;?></option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Brother">Brother</option>
                                            <option value="Sister">Sister</option>
                                            <option value="Wife">Wife</option>
                                            <option value="Daughter">Daughter</option>
                                            <option value="Son">Son</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                               <?php $cnt=$cnt+1;}} ?>  
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                </div>
                            </form>
                        </div>
                   
                    </div>
                </div>
            </div>
           
        </div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- form-basic-inputs23:59-->
</html><?php }  ?>