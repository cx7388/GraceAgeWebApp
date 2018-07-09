<!doctype html>
<html lang="en">
<head>
  <title>GraceAge</title>
  <!-- Required meta tags -->
  <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="">
  <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/loginCareGivers.less" />  
  <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>

  <!-- less js -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
  <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
</head>
<body>
    
 <?php $this->load->view('templates/header_caregiver')?>      

  <main>
    <div class="box">
      <div class="login">
        <!-- login part of caregiver, add method post will pass the data which is input into the box -->
        <form id="login_form" method="post" >
          <!-- each input name will be recorded in the controller to check the passed data -->
          <input type="text" placeholder="<?php echo $this->lang->line('user_name');?>" name="username"><br>
          <input type="password" placeholder="<?php echo $this->lang->line('password');?>" name="password"><br>
          <input class = "check" type="<?php echo $validation ?>" name="validation" readonly value="<?php echo $this->lang->line('login_fail');?>">
          <!-- input type submit will make the controller react -->
          <input type="submit" value="Login">
        </form>
      </div>
    </div>
    
  </main>
  
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
</body>
</html>
