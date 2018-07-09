<!doctype html>
<html lang="en">
    <head>
    <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Add new profile</title>

        <link href="css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="<?= base_url(); ?>assets/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css"/>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/moment.js"></script>
        <script src="<?= base_url(); ?>assets/js/combodate.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
        <link href="<?= base_url() ?>assets/css/header.css" rel="stylesheet" type="text/css"/>
        <link href="<?= base_url() ?>assets/css/addNewProfile.css" rel="stylesheet" type="text/css">  
    </head>
    <body>
        <?php $this->load->view('templates/header_homeCare.php') ?>
<main>
<div style="width:100%;margin:auto;padding:auto">
    <div class="row" style="width:100%">
        <div class="col-md-1">
        </div>

        <div class="col-md-10">

            <?php echo form_open_multipart('EditInformationController/upload'); ?>

            <div class="container-fluid" id="addInfo">
                <br>
                <br>
                <div class="row">



                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-4" style="padding:0px;">
                                <div class="form-group" id="photo">
                                    <label for="camera" class="btn" id="pictureBorder">
                                        <?php echo $this->lang->line('add_photo');?>
                                        <img class="img-responsive" id="picture" src="https://png.icons8.com/compact-camera/ios7/100/003A9F4">
                                    </label>

                                    <input type="file" style="visibility:hidden" accept="image/*" capture="camera" id="camera" class="form-control-file" name="userfile"
                                        placeholder="<?php echo $this->lang->line('select_picture');?>">

                                    <script>
                                        var camera = document.getElementById('camera');
                                        var frame = document.getElementById('picture');
                                        camera.addEventListener('change', function (e) {
                                            var file = e.target.files[0];
                                            console.log(file);

                                            frame.src = URL.createObjectURL(file);
                                            camera.value = "file";
                                        });
                                    </script>
                                </div>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                        <!--<form class="form-horizontal" role="form" action="addNewUser" method="post">-->

                        <div class="form-group">
                            <div class="row">
                                <label for="inputLastName" class="col-sm-4 control-label">
                                    <?php echo $this->lang->line('last_name');?>
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="inputLastName" placeholder="<?php echo $this->lang->line('input_last_name');?>">
                                </div>
                            </div>
                            <br>
                            <div class="form-group">
                                <div class="row">
                                    <label for="inputFirstName" class="col-sm-4 control-label">
                                        <?php echo $this->lang->line('first_name');?>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="inputFirstName" placeholder="<?php echo $this->lang->line('input_first_name');?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="row">
                                <label for="inputPassword" class="col-sm-4 control-label">
                                    <?php echo $this->lang->line('pincode');?>
                                </label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="inputPassword" placeholder="<?php echo $this->lang->line('input_pincode');?>">
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group">
                            <div class="row">
                                <label for="gender" class="col-sm-4 control-label">
                                    <?php echo $this->lang->line('gender');?>
                                </label>

                                <div class="radio col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-4 sex" style="padding-left: 0px;">
                                            <label class="control-label">
                                                <input type="radio" name="inputGender">
                                                <?php echo $this->lang->line('male');?>
                                            </label>
                                        </div>
                                        <div class="col-sm-4 sex" style="padding-left: 0px;">
                                            <label class="control-label">
                                                <input type="radio" name="inputGender">
                                                <?php echo $this->lang->line('female');?>
                                            </label>
                                        </div>
                                        <div class="col-sm-4 sex" style="padding-left: 0px;">
                                            <label class="control-label">
                                                <input type="radio" name="inputGender">
                                                <?php echo $this->lang->line('other');?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--</form>-->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="row">
                                <label for="inputRoomNumber" class="col-sm-4 control-label">
                                    <?php echo $this->lang->line('room');?>
                                </label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="inputRoomNumber">
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group">
                            <div class="row">
                                <label for="inputNotes" class="col-sm-4 control-label">
                                    <?php echo $this->lang->line('notes');?>
                                </label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" rows="5" name="inputNotes" placeholder="<?php echo $this->lang->line('first_note');?>"></textarea>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="form-group">
                            <div class="row">
                                <label for="inputBirthday" class="col-sm-4 control-label">
                                    <?php echo $this->lang->line('birthdate');?>
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" id="date" data-format="YYYY-MM-DD" data-template="D MMM YYYY" name="inputBirthday" value="09-01-2013">
                                    <script>
                                        $(function () {
                                            $('#date').combodate();
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="form-group" style="font-family: " Optima ", sans-serif;font-size: 1.2em;">
                        <div class="row">
                            <label for="facebookPage[]"style="font-size: 1.2em;"class="col-sm-4 control-label">FaceBook</label>
                            <div class="col-sm-8" style="padding-right:0;-webkit-column-count: 2;-moz-column-count: 2;column-count: 2;">
                                <?php foreach($pageData as $page):?>
                                <div>
                                    <input type="checkbox" name="facebookPage[]" id="<?php echo $page->idFaceBook;?>" value="<?php echo $page->idFaceBook;?>">
                                    <label for="<?php echo $page->idFaceBook;?>">
                                        <?php echo $page->PageName;?>
                                    </label>
                                </div>
                                <?php endforeach;?>
                            </div>
                        </div>
</div>
                    </div>


                </div>
                <div class="col-md-1">
                </div>
            </div>
            <br>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn " style="font-family:'PT sans',sans-serif;background-color:#03A9F4; width:100%">
                        <?php echo $this->lang->line('submit');?>
                    </button>
                </div>
                <div class="col-md-4"></div>

            </div>
        </div>
        <?php echo form_close(); ?>
</main>
    </body>
</html>
