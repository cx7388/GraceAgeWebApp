<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js" ></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="<?=base_url()?>assets/js/uploadPhotos.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="<?=base_url()?>assets/css/homepage_elder.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/uploadPhotos.css" />
        <script type="text/javascript" src="<?=base_url()?>assets/js/changeLanguage.js"></script>
    </head>

    <body>
        <?php $data['title']=$this->lang->line('welcome');?>
        <?php $this->load->view('templates/header_homeElder',$data)?>
        <main style="height:100%;">
            <script>
                $('main').css('height',screen.height*0.8);
            </script>
            
             <?php echo form_open_multipart('AlbumController/savePhotos');?> 
            
<!--                    <h3 onclick="upload()">Tap your message to your grandpa/grandma ^_^</h3>-->
    <div class="container-fluid" style="padding-top: 1%">
        
        
            
        
            <div class="row upload-content"  >
                     
                <div class="col-md-1" ><img class="logo-upload" src="https://png.icons8.com/ios/30/03A9F4/compact-camera-filled.png"> </div>    
                    <div class="col-md-5 " style="padding-left:0px;margin-left:0px;" >
                       
                    <!--<form action="" enctype="multipart/form-data" method="post">-->
                       <?php $pictureNr = 0;?>
                         <div class="upload-zone">
                             <p class="title-left"><?php $this->lang->line('press_to_add');?></p>
                        
                        <div id = "pictures " >
                            <div class="row" id="line0" style="margin-top: 0px; padding-top: 0px;">
                                <div class="col-md-4">
                                <label for='upload0'>
                                    <img class = "img img-responsive picture" id="image0" src="https://png.icons8.com/add-new/ios7/1000/cccccc">
                                   
                                </label>
                                </div>
                            </div>
                           
                        <input id='upload0' class="upload-input" name="upload0[]" type="file" multiple="multiple"  />
                        <input id='upload1' class="upload-input" name="upload1[]" type="file" multiple="multiple"  />
                        <input id='upload2' class="upload-input" name="upload2[]" type="file" multiple="multiple"  />
                        <input id='upload3' class="upload-input" name="upload3[]" type="file" multiple="multiple"  />
                        <input id='upload4' class="upload-input" name="upload4[]" type="file" multiple="multiple"  />
                        <input id='upload5' class="upload-input" name="upload5[]" type="file" multiple="multiple"  />
                        <input id='upload6' class="upload-input" name="upload6[]" type="file" multiple="multiple"  />
                        <input id='upload7' class="upload-input" name="upload7[]" type="file" multiple="multiple"  />
                        <input id='upload8' class="upload-input" name="upload8[]" type="file" multiple="multiple"  />
                    </div> 
                         </div>
                             <script>
                                        var picture = document.getElementById('picture');
                                        var upload0 = document.getElementById('upload0');
                                        var upload1 = document.getElementById('upload1');
                                        var upload2 = document.getElementById('upload2');
                                        var upload3 = document.getElementById('upload3');
                                        var upload4 = document.getElementById('upload4');
                                        var upload5 = document.getElementById('upload5');
                                        var upload6 = document.getElementById('upload6');
                                        var upload7 = document.getElementById('upload7');
                                        var upload8 = document.getElementById('upload8');
                                        var pictureNr = 0;
                                        var times = 0;
                                        upload0.addEventListener('change', uploadFotos);
                                        upload1.addEventListener('change', uploadFotos);
                                        upload2.addEventListener('change', uploadFotos);
                                        upload3.addEventListener('change', uploadFotos);
                                        upload4.addEventListener('change', uploadFotos);
                                        upload5.addEventListener('change', uploadFotos);
                                        upload6.addEventListener('change', uploadFotos);
                                        upload7.addEventListener('change', uploadFotos);
                                        upload8.addEventListener('change', uploadFotos);
                                        
                                        function uploadFotos(e){
                                            console.log('here');
                                            
                                            var newCamera = document.getElementById('image'+pictureNr);
                                            var tr = newCamera.parentNode.parentNode;
                                            tr.remove();
                                            
                                            var length = e.target.files.length;
                                            var file = e.target.files[0];
                                            var url = URL.createObjectURL(file);
                                            var basicString = '<div  class ="col-md-4">\n\
                                                                    <img id="image'+pictureNr+'" class = "img-responsive img-thumbnail picture"  src="'+url+'">\n\
                                                               </div>';
                                            $('#line0').append(basicString); 
                                            console.log(upload.value);
                                           
                                            for(var i = 1; i<length; i++){
                                                
                                                var file = e.target.files[i];
                                                var url = URL.createObjectURL(file);
                                                pictureNr++;
                                                if(pictureNr<9){
                                                    
                                                 var basicString = '<div  class ="col-md-4">\n\
                                                                    <img id="image'+pictureNr+'" class = "img-responsive img-thumbnail picture"  src="'+url+'">\n\
                                                                    </div>';
                                                $('#line0').append(basicString); 
                                                }
                                                else{
                                                    break;
                                                }
                                                
                                            }
                                            times++;
                                            if(pictureNr<8){
                                                
                                                pictureNr++;
                                                basicString = '<div  class ="col-md-4">\n\
                                                                <label for="upload'+times+'"><img id="image'+(pictureNr)+'" class = "img-responsive picture"  src="https://png.icons8.com/add-new/ios7/1000/cccccc"></label>\n\
                                                              </div>';   
                                                $('#line0').append(basicString); 
                                            }
                                            else{
                                                alert($this->lang->line('max_pics'));
                                            }
                                            
                                        };
                            </script>
                            
                    </div>   
                        
                
                    <div class="col-md-5" style="padding-right:0px;margin-right:0px;">
                        <div style="height:100%;width:100%">
                             <textarea class="form-control title" style="width:100%;font-size: 1.75em"rows="1" name="title" placeholder="<?php echo $this->lang->line('title');?>"></textarea>
                            <textarea class="form-control message" style="width:100%;font-size: 1.5em"name="message" placeholder="<?php echo $this->lang->line('message');?>"></textarea>
                            <script>
                            </script>
                        </div>
                    </div>
                     <div class="col-md-1" style="padding-right:0px;margin-right:0px;">
                        <div >
                        <img class="logo-upload-2" src="https://png.icons8.com/ios/50/03A9F4/comments-filled.png">
                        </div>
                    </div>           
                          
                    </div>
                    <br>
                    <br>
                    <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">    
                        <p><button class="btn btn-warning" type="submit" name="submit" value="<?php echo $this->lang->line('submit');?>" style="width:100%;background-color: #03A9F4;border: none; color:white">Send</button><span></span></p>
                    </div>
                    <div class="col-md-4"></div>
                    </div>
                 <?php echo form_close(); ?>     
            
            </div>
           
          
        
        
    </main>
    </body>
</html>
