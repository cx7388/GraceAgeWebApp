<!doctype html>
<html lang="en">
<head>
<link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
  <title>Kies een pagina</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="">
  <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/loginCareGivers.less" />  
  <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
  <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/choosePageView.css">
  <!-- less js -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js" ></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
  <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
</head>
<body>
    
 <?php $this->load->view('templates/header_homeElder')?>      
<main>
<br>
<br>
<div class="container">
    <div class="row col-list" style="width:100%">
    <?php foreach($fbAlbumData as $data):?>
    <?php
      $id = isset($data['id'])?$data['id']:'';
      $name = isset($data['name'])?$data['name']:'';
      $description = isset($data['description'])?$data['description']:'';
      $link = isset($data['link'])?$data['link']:'';
      $cover_photo_id = isset($data['cover_photo']['id'])?$data['cover_photo']['id']:'';
      $count = isset($data['count'])?$data['count']:'';

      $pictureLink = "index.php/FacebookController/facebook?fb_page_id={$id}";

      $photoCount = ($count > 1)?$count. 'Photos':$count. 'Photo';?>
       
            
            
        <div class="col-md-6" >
            <a href="<?=base_url()?><?php echo $pictureLink;?>" style="text-decoration:none">
                <div style="margin:10px;">
                <div class="row" style="border-top-right-radius: 5px;border-top-right-radius: 5px;background-color: #B3E5FC; opacity: 0.8; margin:0;padding:0">
                    <img style="padding:5px;width:100%; height:30vh;object-fit: cover" src='https://graph.facebook.com/v2.9/<?php echo $cover_photo_id?>/picture?access_token=<?php echo $_SESSION['facebook_access_token'];?>' alt=''   class="image img-responsive img-thumbnail">
                </div>
                <div class = "row" style="border-bottom-left-radius: 5px;border-bottom-left-radius: 5px;background-color: #03A9F4; margin:0;padding:0">
                    <h2 style="text-align: center;color:white; font-family: 'PT sans',sans-serif"><?php echo $name;?></h2>
                
                </div>
                </div>
            </a>
        </div>
        
        
        <?php endforeach;?>
       
        </div>
</div>
</main>
</body>
</html>
