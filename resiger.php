<?php
@include 'connec.php';
$errors = [];
if(isset($_POST['login'])){
$name = $_POST['username'];
$password =$_POST['password'];
$cpassword =$_POST['cpassword'];
$email =$_POST['email'];
    if(empty($name))
    {
        $errors[] = " declare name";
    }
    if(empty($password))
    {
        $errors[] = " declare password";
    }
    if( empty($cpassword))
    {
        $errors[] = " Password confirmation declaration";
    }
    if(empty($email))
    {
        $errors[] = " gmail declaration ";
    }
    
    if($password != $cpassword)
    {
        $errors[] =" password different from cpassword";
    }
    if(count($errors) ==0)
    {
        $stmt = $conn->prepare("INSERT INTO user1_name (name, password,email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $password,$email); // ss: dữ liệu cần chèn là string, nếu là integer thì sử dụng i
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $errors[] =" thành công";   
        } else {
            $errors[] =" không thành công";   
        }
    
        // Đóng prepared statement
        $stmt->close();
        header("Location: login.php");
    }
}
?>
<?php if (count($errors) ==1 ): ?>
<div class ='i1'>
        <b>Errors:</b>
         <?php 
         foreach ($errors as $error) {
          echo '' . $error ;
        }
        ?>     
</div>
<?php endif; ?>
<?php if (count($errors) >1 ): ?>
<div class ='i3'>
        <b>Errors: declare again</b>
         
</div>
<?php endif; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .tong{
            position: relative;
            background-image: url(https://sbft.hust.edu.vn/wp-content/uploads/2023/07/HUST-C1-b.jpg);
            background-size: cover;
            background-position: center;
            height: 100%; 
        }
        .label{
            margin-left: auto;
            margin-right: auto;
            /* background-color:  #23074d; */
            position: absolute;
            top: 15%;
            left: 0;
            right: 0;
            width: 650px;
            height: 380px;
            border: 2px solid skyblue;
            background-color: snow;
            border-radius: 23px;
        }
        .t1 {
        position: absolute;
        text-align: center;
        width: 100%;
        top: 20%;
        transform: translateY(-50%);
        color: blue;
        }
        /* .a1{
            display: grid;
            justify-content: center;
            align-items: center;
            background-color: aliceblue;
        } */
        .e1{
            grid-row: 1;
            grid-column: 1;
            position: absolute;
            top: 32%;
            left: 30%;
           
        }
        .e2{
            grid-row: 1;
            grid-column: 1;
            position: absolute;
            top: 38%;
            left: 414px;
        }
        .e3{
            grid-row: 1;
            grid-column: 1;
            position: absolute;
            top: 44%;
            left: 412px;
        }
        .e4{
            grid-row: 1;
            grid-column: 1;
            position: absolute;
            top: 50%;
            left: 412px;
        }
        
        .e6{
            grid-row: 1;
            grid-column: 1;
            position: absolute;
            top: 57%;
            left: 30%;
        }
        .e5 input[type=submit]{
            height: 30px;
            width: 100px;
            grid-row: 1;
            grid-column: 1;
            position: absolute;
            top: 62%;
            left: 45%;
            background-color: rgb(0, 110, 255);
            color: aliceblue;
            border-radius: 5px;
        }
        .i1{
            position: absolute;
            top: 65%;
            left: 43%;
            color: red;

        }
        .i3{
            position: absolute;
            top: 65%;
            left: 43%;
            color: red;
        }
        .img_2{
            position: absolute;
            top: -10px;
            left:-104px;
        }
        .i1, .i3 {
        z-index: 1;
        }
    </style>
</head>
<body>
<div class="tong">
    <div>
        <img class="img_2"  src="image/logo1.png"  >
    </div>
    <div class="label"></div>
    <h1 class="t1">REGISTER FOR AN ACCOUNT</h1>
    <form class="a1" action="resiger.php" method="post">
        <div class="e1">
        <label for="s1" style="margin-left: 4px;">Account name</label>
        <input id="s1" style="margin-left: 41px;" type="text" name="username" placeholder="" size="30px">
        </div>
        <br><br>
        <div class="e2">
        <label for="s2"> Password</label>
        <input style="margin-left: 73px;" type="password" name="password" id="s2" placeholder="" size="30px">
        </div>
        <br><br>
        <div class="e3">
        <label for="s3">Cpassword</label>
        <input style="margin-left: 65px;" type="password" name="cpassword" id="s3" placeholder="" size="30px">
        </div>
        <br><br>
        <div class="e4">
        <label for="s4">Gmail</label>
        <input style="margin-left: 96px;" type="email" name="email" id="s4" placeholder="" size="30px" >
        </div>
        <br><br>
       
        <div class="e5">
            <input type="submit" name="login" value="REGISTER" > 
        </div>
    </form>
    
</div>
</body>
</html>