<!doctype html>
<html lang="en">
<head>
<link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
  <title>Album Photos</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="">
  <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/loginCareGivers.less" />  
  <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/facebookPhotos.css" />  
  <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
  <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
  <!-- less js -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <!-- Bootstrap CSS -->
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/thumbnail-gallery.css" />
</head>
<body>
    
<?php $this->load->view('templates/header_homeElder')?>       
<main>
     <script>
        jQuery(document).ready(function($) {
        var totalNr =  <?php echo count($fbPhotoData)?>;
        console.log(totalNr);
 
        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        var id_selector = $(this).attr("id");
        try {
            var id = /-(\d+)$/.exec(id_selector)[1];
            console.log(id_selector, id);
            for(var i = 0; i<totalNr; i++){
                $('#content_'+i).removeClass('active');
                $('#li_'+i).removeClass('active');
            }
            $('#content_'+id).addClass('active');
            $('#li_'+id).addClass('active');
        } catch (e) {
            console.log('Regex failed!', e);
        }
    });
    });
   
    </script>
    <div style="height:80vh;width:98vw">
        <div class="row" style="margin:auto;padding-top: 1vh;height:56vh">
            <div class="col-sm-2"></div>
            <div class="col-md-8" >
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php $i = 0;?>
                <?php foreach($fbPhotoData as $data):?>
                    <?php
                        // Render all photos
                    $imageData = reset($data['images']); //get most clear photo
                    $imgSource = isset($imageData['source'])?$imageData['source']:''; 
                    $name = isset($data['name'])?$data['name']:'';
                    if($i===0){?>
                    <li id="li_<?php echo $i;?>" data-target="#myCarousel" data-slide-to="0" class="active"></li>
                      <?php }else{?>
                    <li id="li_<?php echo $i;?>" data-target="#myCarousel" data-slide-to="<?php echo $i;?>" ></li>
                      <?php }?>
                    <?php $i++;?>
                    <?php endforeach;?>    
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">

                    <?php $i = 0;?>
                    <?php foreach($fbPhotoData as $data):?>
                    <?php
                        // Render all photos
                        $imageData = reset($data['images']); //get most clear photo
                        $imgSource = isset($imageData['source'])?$imageData['source']:''; 
                        $name = isset($data['name'])?$data['name']:'';
                    ?>
                    <?php if($i==0){?>
                    <div class="item active" id="content_<?php echo $i;?>">
                        <img class="big" style="object-fit: cover;" src="<?php echo $imgSource?>" alt="Los Angeles" style="width:100%;">
                    <div class="carousel-caption">
                       <h3><?php echo $name;?></h3>
                    </div>
                    </div>
                    <?php }else{?>
                    <div class="item" id="content_<?php echo $i;?>">
                        <img class="big"  style="object-fit: cover;" src="<?php echo $imgSource?>" alt="Los Angeles" style="width:100%;">
                     <div class="carousel-caption">
                       <h3><?php echo $name;?></h3>
                     </div>
                   </div>
                    <?php }?>
                    <?php $i++;?>
                    <?php endforeach;?>       
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right"></span>
              <span class="sr-only">Next</span>
            </a>
            </div>
            </div>    
            <div class="col-sm-2"></div>
        </div>
        <div class="row" style="height:24vh;margin-top: 13vh">
            
            <div class="col-sm-12" id="slider-thumbs">
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                    
                    <?php $i = 0;?>
                    <?php foreach($fbPhotoData as $data):?>
                    <?php
                        // Render all photos
                        $imageData = reset($data['images']); //get most clear photo
                        $imgSource = isset($imageData['source'])?$imageData['source']:''; 
                        $name = isset($data['name'])?$data['name']:'';
                    ?>
                    <li class="small-li" >
                        <a class="thumbnail" style="margin-bottom:0; margin-top: 5vh" data-slide-to="<?php echo $i?>" class="active" id="carousel-selector-<?php echo $i;?>">
                        <img class="small img-responsive"  style="object-fit: cover;" src="<?php echo $imgSource?>">
                        </a>
                    </li>
                    <?php $i++;?>
                    <?php endforeach;?>  
                </ul>
                 <!-- Left and right controls -->
            </div>
        </div>
    </div>

</main>
  
</body>

</html>