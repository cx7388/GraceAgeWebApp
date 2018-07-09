    <!doctype html>
    <html lang="en">

    <head>
      <title class="title">Homepage</title>
      <!-- Required meta tags -->
      <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="shortcut icon" href="">
      <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/homepageCareGiver.less" /> 
      <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js"></script>
      <!-- Bootstrap CSS -->
      <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
      <!-- Optional JavaScript -->
<!--      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">-->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
      <script type="text/javascript" src="<?=base_url()?>assets/js/changeLanguage.js"></script>
    </head>
    <body id = "main">
      <?php $this->load->view('templates/header_homeCare.php');?>
        <main style="padding-top: 50px">
        <div id="mySidenav" class="sidenav">
          <!-- Close button is rendered as a block-level element, click will use the function closeNav -->
          <a href="javascript:void(0)" class="closebtn1" id = "closebtn1" onclick="closeNav()">&times;</a>
          <!-- To show the different department by passing data from controller -->
          <!-- for loop to open all the department-->
          <?php foreach ($departmentList as $department):?>
            <!-- click department will open room menu-->
            <span class = "level1" onclick="openSecNav()"><?php echo $department;?></span>
          <?php endforeach;?>
          <a  href ="<?=base_url()?>/index.php/DisplayResultsController/displayResultsOverview"><?php echo $this->lang->line('overview_questions') ;?></a>
        </div>
        <div id = "mySecSidenav" class = "secSidenav">
          <!-- close button for second level menu -->
          <a href="javascript:void(0)" class="closebtn2" id = "closebtn2" onclick="closeNav()">&times;</a>
          <?php foreach ($roomList as $room):?>
            <span class = "level2"><?php echo $room;?></span>
          <?php endforeach;?>
        </div>
        <!-- click current room will open the slide navigation bar -->
        <span id = "box2" onclick="openNav()" >
          <div id = "overlay2" >
            <?php echo $this->lang->line('current_room').": ".$curentRoom;?>
          </div>
        </span>
        <div class="container">
          <div class="row">
            <div class="container1">
              <span href="javascript:void(0)" class="close1" id = "closebtn3" >&times;</span>
              <img src="https://www.1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" alt="Avatar" class="image1" >

              <div class="middle1">
                <div class="text1"><?php echo $older1;?></div>
              </div>
            </div>
            <div class="container2">
              <a href="javascript:void(0)" class="close2" id = "closebtn4" >&times;</a>
              <img src="https://www.1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" alt="Avatar" class="image2" >
              <div class="middle2">
                <div class="text2"><?php echo $older2;?></div>
              </div>
            </div>
            <!-- click div to open the addNewUser view -->
            <div class="container3"><a href = "<?=base_url()?>/index.php/EditInformationController/addNewUser">
              <img src="<?=base_url()?>/assets/image/ic_add_white_48dp_2x.png" alt="Avatar" class="image3" ></a>
            </div>
          </div>
        </div> 
      </main>
      <script >
        /* Open the sidenav */
        function openNav() {
          document.getElementById("mySidenav").style.width = "20%";
          document.getElementById("mySidenav").style.transition = "0.5s";
          document.getElementById("overlay2").style.width = "0";
          document.getElementById("overlay2").style.opacity = "0";
          document.getElementById("closebtn1").style.opacity = "1";
        }

        /* Open the sidenav */
        function openSecNav() {
          document.getElementById("mySecSidenav").style.width = "13%";
          document.getElementById("mySecSidenav").style.transition = "0.5s";
          document.getElementById("overlay2").style.opacity = "0";
          document.getElementById("closebtn1").style.width = "0";
          document.getElementById("closebtn1").style.opacity = "0";
        }

        /* Close/hide the sidenav */
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("mySecSidenav").style.width = "0";
          document.getElementById("mySecSidenav").style.transition = "0s";
          document.getElementById("mySidenav").style.transition = "0s";
          document.getElementById("overlay2").style.width = " 25%";
          document.getElementById("overlay2").style.opacity = "1";
        }
      </script>
    </body>
    </html>