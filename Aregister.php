<?php
 include 'connection.php';
 session_start();
 if(!isset($_SESSION['username']))
 {
    header("location:Alogout.php");
 }
 if(isset($_POST['submit']))
 {
    $fname=$_POST["inputFirstName"];
    $lname=$_POST["inputLastName"];
    $email=$_POST["inputEmailAddress"];
    $password=$_POST["inputPassword"];
    $cpassword=$_POST["inputConfirmPassword"];  
    if($password==$cpassword)
    {
        $qCount="SELECT * from `verifier_reg` where `email`='$email'";
        $isExist=mysqli_query($connection,$qCount);
       if (mysqli_num_rows($isExist) ==0)
        {
          $sql1="INSERT INTO `verifier_reg`(`firstname`, `lastname`, `email`, `password`) VALUES ('$fname', '$lname','$email', '$password')";

          if(mysqli_query($connection,$sql1))
          {
             header("location:Adashboard.php");
           }
           else
           {
            echo "<script> alert('ERROR IN REGISTRATION');</script>";
           }
        }
    }
    else{
        echo "<script> alert('PASSWORD NOT SAME');</script>";
    }

}
        ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register Verifer</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <form method='post'>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" name="inputFirstName" type="text" placeholder="Enter first name" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Last Name</label>
                                                        <input class="form-control py-4" name="inputLastName" type="text" placeholder="Enter last name" required/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" name="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" required />
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputPassword">Password</label>
                                                        <input class="form-control py-4" name="inputPassword" type="password" placeholder="Enter password" required />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                        <input class="form-control py-4" name="inputConfirmPassword" type="password" placeholder="Confirm password" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mt-4 mb-0"><input type="submit" name="submit" class="btn btn-primary btn-block" onclick="valid()" value="Create Account"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
    <script type="text/javascript">

function valid()      
{
 var name,number,email,pswd,rpswd;

 fname=document.getElementByName('inputFirstName').value;
 lname=document.getElementByName('inputLastName').value;
 email=document.getElementByName('inputEmailAddress').value;
 pswd=document.getElementByName('inputPassword').value;
 rpswd=document.getElementByName('inputConfirmPassword').value;

 if(fname == "")
 {
    document.getElementByName('inputFirstName').innerHTML = "*Provide First Name";        
     return false;        
 }        
 if(lname == "")
 {
    document.getElementByName('inputLastName').innerHTML = "*Provide First Name";        
     return false;        
 }   

 if(email == "")
{
    document.getElementByName('inputEmailAddress').innerHTML = "*Provide Mail ID";
    return false;
}

if(pswd == "")
{
    document.getElementByName('inputPassword').innerHTML = "*Provide password";
    return false;
}
if((pswd.length < 5) || (pswd.length >= 20))
{
    document.getElementByName('inputPassword').innerHTML = "*Password contain 5 to 20 characters";
    return false;
}

if(rpswd == "" )
{
    document.getElementByName('inputConfirmPassword').innerHTML = "*Confirm password";
    return false;
}

}
</script>
</html>
