<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
    <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <meta charset="UTF-8">
        <title>Your Album</title>
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
        <link href="<?=base_url()?>assets/css/album_elderly.css" rel="stylesheet" type="text/css">
         <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/js/bootstrap.js"></script>  
        <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
    </head>
    <body>
        <?php $data['title']= $this->lang->line('personal_album')?>
        <?php $this->load->view('templates/header_homeElder',$data);?>
        <main style="height:100%"> 
                
        <div class="vertical_line">
        <ul class="timeline" id="album">
      
        </ul>
        </div>       
        <script>
                $(document).ready(function () {
                $('#album').css('height',screen.height);
                  $.ajax({
                      url:"<?php echo base_url();?>index.php/AlbumController/photoAlbum",
                      method:"GET",
                      dataType:"json",
                      success:function(data)
                      {
                          $('#album').html(data.photo);
                          console.log(data.photo);
                      }
                      });

        });  
        </script>

       
        </main>  
        

    </body>
</html>
