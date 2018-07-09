<!DOCTYPE html>
<html lang="en">
  <head>
  <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Departments</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">

    <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>assets/css/navigation.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/navigation.css" />
    <script type="text/javascript" src="<?=base_url()?>assets/js/changeLanguage.js"></script>
  </head>
 
  
  <body>
    <?php $this->load->view('templates/header_homeCare.php')?>
    <div class="container-fluid">
	<div class="row">
            <div class="col-md-3">
</div>
            <div class="col-md-6">
                
                <div class="page-header header1">
                    <?php echo $this->lang->line('departments') ;?>
                </div>
                
                <!-- Load a checkbox for each department in the facility -->
                <?php foreach ($departments->result() as $department):?>
                    <div class="btn-group">
                        <button class="btn-default btn-lg departmentBox" onclick="displayDepartment(<?php echo $department->name;?>)" >
                            <?php echo $this->lang->line('department')." " . $department->name;?>
                        </button>                            
                    </div>
                <?php endforeach;?>
                
            </div>
            <div class="col-md-3">               
            </div>
	</div>
	<div class="row">
            <div class="col-md-2">
            </div>
            <div class="col-md-7" id = "rooms" class="dynamic-content">
                <!-- all the rooms that need to be shown -->
                <?php 
                if(isset($rooms)):?>
                    <h2><?php echo $this->lang->line('rooms') ;?></h2><br>
                    <?php foreach ($rooms->result() as $room):?>
                        <div class="row roomRow">
                            <div class="col-md-12 roomCol">
                                <!-- Load an image for each elder in the room-->
                                <h4><?php echo $room->number.":<br>";?></h4>

                                <?php foreach ($elders as $elder):?>
                                    <?php if ($elder['roomNumber'] === $room->number):?>
                                    <div class="col-md-6">
                                        <a href="<?php echo base_url()."index.php/PersonOverviewController/personInfo/".$elder['ProfileID'] ?>">
                                            <img style = "object-fit: cover;"src="<?=base_url()?>upload/<?php echo $elder['pictureURL'];?>" onerror = "this.src='<?=base_url()?>upload/default.png';"class="img-circle image img-responsive">
                                            <div style="margin-left: 50px; font-size:2vw; font-family: 'Optima', sans-serif; color:#000000;"><?php echo $elder['firstName'];?></div>
                                        </a>
                                        </div>
                                    <?php endif;?>
                                <?php endforeach;?>

                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>
                    
                    
                <!-- set a standard view (department 2 for example -->    
                <?php 
                if(!isset($rooms)):?>  
                <div class="row">
                    
                </div>
                <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4 alt-display">
                        <h2 class="alt-text">KEEP</h2>
                        <h2 class="alt-text">CALM</h2>
                        <h5 class="alt-text">AND</h5>
                        <h2 class="alt-text">SELECT</h2>
                        <h5 class="alt-text">AN</h5>
                        <h2 class="alt-text">AFDELING</h2>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <?php endif;?>
                    
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-1">
                <a class="addElderButton" role="button" href="<?=base_url()?>/index.php/EditInformationController/addNewUser">
                    <div style = "background: rgba(190, 190, 190, 0.7);">
                    <img id="add"src="<?=base_url()?>/assets/image/ic_add_white_48dp_2x.png" alt="Avatar" class="img-rounded img-responsive">
                    
            </div> <label for="add" style="color:#028bca;text-align:center;font-size:1.2vw; font-family:'Optima', sans-serif;"><?php echo $this->lang->line('add_elderly') ;?></label></a>                
            </div>
            <div class="col-md-1">
            </div>           
	</div>
    </div>

    <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script>var base_url = '<?php echo base_url() ?>';</script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/navigation.js"></script>
  </body>
  
  
    
</html>
