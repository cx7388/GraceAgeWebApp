<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
    <title>Bootstrap 3, from LayoutIt!</title>

    <meta name="description" content="Source code generated using layoutit.com">
    <meta name="author" content="LayoutIt!">
    <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
    <link href="css/bootstrap.min.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
     <script type="text/javascript" src="<?=base_url()?>assets/js/changeLanguage.js"></script>
  </head>
  <body>
    <?php $this->load->view('templates/header_homeCare.php');?>
    <div class="container-fluid">
	<div class="row">
            <div class="col-md-1">
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-1">
            </div>
            <div class="col-md-5">
                <h1>
                    <?php echo $this->lang->line('people');?>
                </h1>
                <form class="form-horizontal" role="form" action="test" method="post">
                    <div class="form-group">
                        <!-- Load a checkbox for each department in the facility -->
                        <?php foreach ($departmentList as $department):?>
                            <div class="checkbox-inline"> 
                                <label>
                                    <input type="checkbox"  name="departmentCheckbox" value="<?php echo $department;?>"> <?php echo $department;?>
                                </label>
                            </div>
                        <?php endforeach;?>
                    </div>
                    <div class="form-group">	 
                        <button type="submit" class="btn btn-default">
                                <?php echo $this->lang->line('select');?>
                        </button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
            </div>
	</div>
	<div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <!-- all the rooms that need to be shown -->
                <?php foreach ($roomList as $room):?>
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Load an image for each elder in the room -->
                            <?php foreach ($elderList as $elder):?>
                                <img src="https://www.1plusx.com/app/mu-plugins/all-in-one-seo-pack-pro/images/default-user-image.png" alt="Avatar" class="image2" >
                            <?php endforeach;?>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="col-md-3">
            </div>
	</div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
  </body>
</html>
