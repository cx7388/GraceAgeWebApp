<!doctype html>
<html lang="en">
<head>
  <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
  <title class="title">GraceAge</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="">

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="<?=base_url()?>assets/css/keypadLogin.css" rel="stylesheet">
  <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/loginOlderAdults.css" />
  <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
  <link href="<?=base_url()?>assets/css/bootstrap-pincode-input.css" rel="stylesheet">
  
  <!-- less js -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js" ></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/js/bootstrap-pincode-input.js"></script>
  <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
</head>
<body>
  <?php $this->load->view('templates/header_caregiver');?>
<main>
  <div id="box2" onclick="document.getElementById('id03').style.display = 'block'">
    <!-- echo the room which data passed from modal to controller -->
    <button id="overlay2">
      <?php echo $this->lang->line('choose_room');?>
      <?php echo $room;?>
    </button>
  </div>
  <br>
  <div class="container">
    <div class="row">
      <!-- make a loop to generate elderList in one room -->
      <?php if (empty($roomOlder)): ?>
      <!-- if there is no older, just print blank -->
      <br>
      <br>
      <br>
      <?php else: ?>
      <?php foreach ($roomOlder as $elder):?>
      <!-- click the container will open the modal for login -->

      <div class="older col-md-6" onclick="popup()">
        <form method="post">
          <label for="<?php echo $elder->ProfileID;?>">
            <img style="height:300px;width:300px;object-fit: cover;" src="<?=base_url()?>upload/<?php echo $elder->pictureURL;?>" onerror = "this.src='<?=base_url()?>upload/default.png';"alt="Avatar"
              class="image img-responsive">

            <div class="middle">
              <!-- echo the older name which data passed from modal to controller -->
              <div class="text">
                <?php echo $elder->firstName;?>
                <input type="radio" name="olderName" id="<?php echo $elder->ProfileID;?>" value="<?php echo $elder->ProfileID;?>" style="width:0px;">
              </div>
            </div>
          </label>
        </form>
      </div>

      <?php endforeach;?>
      <?php endif;?>
    </div>
  </div>
  <?php if (empty($error)):?>
  <?php else:?>
  <div class="col-md-4"></div>
  <div class="col-md-4" id="box1">

    <div id="overlay" style="color:crimson;">
      <?php echo $this->lang->line('login_fail');?>
    </div>
  </div>
  <div class="col-md-4"></div>
  <?php endif;?>

  <div id="id01" class="w3-modal">
    <div class="w3-modal-content">

      <div class="w3-container">
        <!-- close button, click will close modal -->
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <form id="login_form" method='post' class="login_form">
          <br>
          <a>
            <?php echo $this->lang->line('enter_password');?>
          </a>
          <br/>
          <br>
          <input type="password" style="text-align:center;" inputmode="numeric" size="4" id="inputText" name="password" type="text"
            class="form-control col-md-6 offset-md-3" placeholder="<?php echo $this->lang->line('enter_password');?>" autofocus>
          <!-- popup div will be put in specific profileID -->
          <div id="popup"></div>
          <br/>
          <br>
          <input type="submit" value='Login' class="popuplogin">
          <br>
          <br>
        </form>
      </div>
    </div>
  </div>
  <!-- modal to choose specific room -->
  <div id="id03" class="w3-modal">
    <div class="w3-modal-content modal-style">
      <div class="w3-container">
        <span onclick="document.getElementById('id03').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <form id="change room" method='post' class="login_form">
          <br>
          <a>
            <?php echo $this->lang->line('choose_room');?>
          </a>
          <br/>
          <br>
          <br>
          <!-- generate departmentList -->
          <div class="row">
            <div id="departmentList" class="col-sm-6 btn btn-lg ">
              <?php foreach ($departments as $department):?>
              <div class="departmentButton">
                <input style="visibility:hidden;" type="radio" name="departmentName" id="<?php echo $department->name;?>" value="<?php echo $department->name;?>">
                <label style="padding-right:10%;" for="<?php echo $department->name;?>" style="font-size: 2vw;">
                  <?php echo $this->lang->line('department');?>
                  <?php echo $department->name;?>
                </label>
              </div>
              <br>
              <br>
              <?php endforeach;?>
            </div>
            <!-- roomList will be put by ajax -->
            <div class="col-sm-6 btn btn-lg" id="roomList"></div>
          </div>
        </form>
      </div>
    </div>
</main>
<script src="<?=base_url()?>assets/js/keypad.js"></script>
<script type="text/javascript">
bindButton();
bindElder();
//run the two functions to generate listener for each radio button
function bindElder(){
  var x = document.getElementsByName("olderName");
  if(x)
  {
    Array.prototype.forEach.call(x,function(element){ //find every button named olderName
      element.addEventListener('click',function(event){ //add listener
        selectedElderly(this); //click will run the function
      });
    });
  }
}
function bindButton(){
  var x = document.getElementsByName("departmentName");
  if(x){
    Array.prototype.forEach.call(x,function(element){
      element.addEventListener('click',function(event){
        selectedDepartment(this);
      });
    });
  }
}
function selectedElderly(obj){
  //alert(obj.id);
  $.ajax({ //ajax syntax
    type: "POST",
    url: "<?= base_url() ?>index.php/LoginController/getLogin", //run this function in controller
    data: {ProfileID: obj.id}, //pass the data, data name is ProfileID, get from obj.id
    success: function (data)
    {
      document.getElementById("popup").innerHTML=data; 
      //load view, data is what return through function
    },
    error: function (data) {
        alert(data.status);
    }
});
}
function selectedDepartment(obj){
  //alert(obj.id);
  $.ajax({
    type: "POST",
    url: "<?= base_url() ?>index.php/LoginController/getRooms",
    data: {departmentName: obj.id},
    success: function (data)
    {
      document.getElementById("roomList").innerHTML=data;
    },
    error: function (data) {
        alert(data.status);
    }
}
);

}

// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


</script>
<script type="text/javascript">
function popup(){
  document.getElementById('id01').style.display = 'block';
  document.getElementById("inputText").focus();
}

function clicktext()
{
  document.getElementById("inputText").click(); // Click on the checkbox
}
        $(document).ready(function () {
            $('#inputText').keyPad({
                template : '#tpl-keypad',
                isRandom : false,       
        },1);
           
        });

</script>
 <script id="tpl-keypad" type="script/template">
        
        <div class="keypad" >
            <table style="background-color:white">
                <colgroup>
                    <col width="33.33%">
                    <col width="33.33%">
                    <col width="33.33%">
                </colgroup>
                <tbody>
                    <tr>
                        <td><button type="button" class="1">1</button></td>
                        <td><button type="button" class="2">2</button></td>
                        <td><button type="button" class="3">3</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="4">4</button></td>
                        <td><button type="button" class="5">5</button></td>
                        <td><button type="button" class="6">6</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="7">7</button></td>
                        <td><button type="button" class="8">8</button></td>
                        <td><button type="button" class="9">9</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="text-sm" cmd="back"><?php echo $this->lang->line('delete_last');?></button></td>
                        <td><button type="button" class="0">0</button></td>
                        <td><button type="button" class="text-sm" cmd="clear"><?php echo $this->lang->line('delete_all');?></button></td>
                            
                            
                    </tr>
                </tbody>

            </table>
        </div>
    </script>
</body>

</html>
