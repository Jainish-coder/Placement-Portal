<?php
    session_start();
    $err = false;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
<style type="text/css">
    .space{
        margin-left: 10mm 
    }
</style>
</head>
<body>
<?php
    if(isset($_POST['sub']))
    {
        require('db.php');
        $rollno = $_POST['rollno'];
        $passwd = $_POST['passwd'];
        $stmt = $conn->query("SELECT * FROM plcmtportal.student WHERE student.rollno=$rollno AND student.passwd=$passwd");

        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        if($row)
        {
            $_SESSION['rollno']=$row['rollno'];
            $_SESSION['name']=$row['fname']." ".$row['lname'];
            $_SESSION['prog_name']=$row['prog_name'];
            
            header("Location: std_db_jobs.php");
        }
        else
        {
            $err = true;
        }
    }
?>

    <form class="form" action="" method="post" name="login">
        <h1 class="login-title">Student Login</h1>

        <input type="text" class="login-input" name="rollno" placeholder="Roll Number"  required/>
        <input type="password" class="login-input" name="passwd" placeholder="Password"  required/>
        <input type="submit" name="sub" value="Log In" class="login-button" />
        <p class="error">
            <?php
            if($err)
                echo "Invalid credentials!";
            ?>
        </p>
        <p class="link"><a href="std_signup.php">New Registration</a><span class="space"></span><a href="job_login.php">For companies</a></p>
        
    </form>
</body>
</html>