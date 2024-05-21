<?php
@include 'connec.php';
$user = null; 
$users = null;
    if(isset($_POST['submit']))
    {
        $email = $_POST['email'];
        $sql = "SELECT * FROM user1_name WHERE email=?";//kiểm tra xem có phải gmail đã đăng kí trên database không
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            echo "Preparation failed: (" . $conn->errno . ") " . $conn->error;
        }
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
        
            if($user){
                $sql = "SELECT password FROM user1_name WHERE email=?";//chon pass ở email đăng nhâp
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $users = $result->fetch_assoc();
            
            }
            if($users)
            {
                $password = $users['password'];//lấy cột pass ở biến users ra
                require 'PHPMailer-master/src/PHPMailer.php';// cần tải thư viên phpmailer(lên youtu xem)
                require 'PHPMailer-master/src/SMTP.php';
                require 'PHPMailer-master/src/Exception.php';
                // require 'vendor/autoload.php';

                $mail = new PHPMailer\PHPMailer\PHPMailer();//từ đây đến phần dưới là quá trình giử pass về mail đăng nhâp
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'vuvanhaibk2001@gmail.com';
                $mail->Password = 'nisj hjfg xnhk kimc';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('vuvanhaibk2001@gmail.com', 'mailler');
                $mail->addAddress($email);
                // $mail->addAddress('haivv195001@gmail.com');
                $mail->addAddress('ttungcw@gmail.com');
                $mail->isHTML(true);

                $mail->Subject = 'Your Password Recovery';
                $mail->Body    = 'Your password is: ' . $password;
                if(!$mail->send()) {
                    echo 'Email could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else 
                {
                    echo 'Email has been sent';
                } 
            } else 
                {
                echo 'Email not found in the database';
                }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
        }
        .hai{
            position: relative;
            background-image: .;
            background-size: cover;
            background-position: center;
            height: 100%; 
        }
        .t1{
            position: absolute;
            top: 210px;
            left: 42%;
            
        }
        .t2{
            position: absolute;
            width: 100%;
            text-align: center;
            top: 130px;
            color: black;
        }
        .t4{
            position: absolute;
            top: 210px;
            left: 37%;
        }
        .t3{
            
            position: absolute;
            height: 30px;
            width: 80px;
            top: 270px;
            left: 48%;
            background-color: darkgreen;
            color: aliceblue;
            border-radius: 5px;
        }
        .t5{
            position: absolute;
            top: 240px;
            left: 42%;
            text-decoration: none;
            color: #0084a8;
        }
        .t6{
            margin-left: auto;
            margin-right: auto;
            position: absolute;
            top: 20%;
            left: 0;
            right: 0;
            width: 450px;
            height: 200px;
            border: 2px solid black;
            background-color: white;
            border-radius: 7px;
        }
    </style>
</head>
<body>
<div class="hai">
<div class="t6"></div>
    <h2 class="t2">PASSWORD RECOVERY</h2>
    <form method="post" action="forgot.php">
        <label class="t4" for="email">Gmail </label>
        <input type="email" class="t1" name="email" size="27px" required>
        <a class="t5" href="./resiger.php">Creat Admin account </a>
        <button type="submit" class="t3" name="submit" >Submit</button>
    </form>
</div>
</body>
</html>
