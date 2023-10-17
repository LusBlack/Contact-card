<?php

//Message Vars
$msg = '';
$msgClass = '';
//check for sub
if(filter_has_var(INPUT_POST, 'submit')) {
    //Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars ($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    //check required fields
    if(!empty($email) && !empty($name) && !empty($message)) {
        //passed
        //check email
        if(filter_var($email, FILTER_VALIDATE_EMAIL)===false) {
            //failed
            $msg = 'please fill in all fields';
            $msgClass = 'alert-danger';
        } else {
            $toEmail = 'support@fuckoff.com';
            $subject = 'contact Request From '.$name;
            $body = '<h2>Contact Requests</h2>
                     <h24>Name</h4><p>'.$name.'</p>
                     <h24>Email</h4><p>'.$email.'</p>
                    <h24>message</h4><p>'.$message. '</p> 
                    ';

                    //Email Headers
                    $headers = "MIME-Version: 1.0" ."\r\n";
                    $headers .= "Content-Type:text/html; charset=UTF-8" . " \r\n";

                    //Additional Headers
                    $headers .= "From: " .$name. "<" .$email.">". "\r\n";

                    if(mail($toEmail, $subject, $body, $headers)) {
                    //Email sent
                    $msg = 'Your email has been sent';
                    $msgClass = 'alert-success';
                } else{

                    }
        }
    } else {
        //failed
        $msg = 'Your email hwas not sent';
        $msgClass = 'alert-success';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Me</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://bootswatch.com/cosmo/bootstrap.min.css"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
</head>

<body>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- <div class="navbar-header">
                <a class="navbar-brand" href="index.php">My web</a>
            </div> -->
        </div>
    </nav>
    <div class="container">
        <?php if($msg != ''): ?>
            <div class="alert <?php echo $msgClass; ?>"><?php echo $msg; ?></div>
            <?php endif; ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
    </div>
    <div class="form-group">
        <label>Message</label>
        <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
    </div>
    <br>
    <button type="sunmit" name="submit" class="btn btn-primary">
        Submit</button>
    </form>

</body>

</html>