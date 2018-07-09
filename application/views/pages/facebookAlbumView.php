<!doctype html>
<html lang="en">
<head>
  <title>Facebook Album</title>
  <!-- Required meta tags -->
  <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" href="">
  <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/loginCareGivers.less" />  
  <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/facebookAlbum.css" />  
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
    <div class="tz-gallery">

        <div class="row">

            <?php foreach($fbAlbumData as $data):?>
                <?php
                    $id = isset($data['id'])?$data['id']:'';
                    $name = isset($data['name'])?$data['name']:'';
                    $description = isset($data['description'])?$data['description']:'';
                    $link = isset($data['link'])?$data['link']:'';
                    $cover_photo_id = isset($data['cover_photo']['id'])?$data['cover_photo']['id']:'';
                    $count = isset($data['count'])?$data['count']:'';

                    $pictureLink = "index.php/FacebookController/facebookPhoto?album_id={$id}&album_name={$name}";

                    $photoCount = ($count > 1)?$count. 'Photos':$count. 'Photo';?>
            <div class="col-sm-6 col-md-4" style="margin-top:10px;margin-bottom:10px">
                <div class="thumbnail" style="height:50vh;width:80%;margin:auto;padding:auto" >
                <a href="<?=base_url()?><?php echo $pictureLink;?>">
                    <img class="img-responsive album-cover" style="height:80%;object-fit:cover"src='https://graph.facebook.com/v2.9///<?php echo $cover_photo_id?>/picture?access_token=<?php echo $_SESSION['facebook_access_token'];?>' alt=''>
                </a>
                <div class="caption" style="height:15vh;width:100%">
                    <h3><?php echo $name;?></h3>
                    <p><span style='color:#888;'>//<?php echo$photoCount?> </span></p>
                </div>
                </div>
            </div>

            <?php endforeach;?>
            
        </div>

    </div>
</main>
 
   
</body>
</html>