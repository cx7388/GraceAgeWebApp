<!DOCTYPE html>
<html>
    
    <head>
    <title>Home Page</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js" ></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <!-- Optional JavaScript -->

        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
       <script type="text/javascript" src="<?=base_url()?>assets/js/changeLanguage.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="<?=base_url()?>assets/css/homepage_elder.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
        
    </head>

    <body>
        <?php $data['title']=$this->lang->line('welcome').', '.$name;?>
         <?php $this->load->view('templates/header_homeElder',$data)?>
    <main>
              
        <div class="container">
                <div class="row" style="width:80%; height:100%; margin:auto">
                   <div class="col-md-6 item" >
                            <img  onclick="navigate('<?php echo $item1['link'];?>','<?php echo $unfinished;?>')" class = "icon img-responsive" src="<?php echo $item1['image'];?>">                         
                            <p class = "<?php echo $item1['name']?>"><?php echo $item1['name'];?></p>
                    </div>
                    <div class="col-md-6 item">
                            <img onclick="navigate('<?php echo $item2['link'];?>','<?php echo $unfinished;?>')"   class = "icon img-responsive" src="<?php echo $item2['image'];?>">                      
                            <p class = "<?php echo $item2['name']?>"><?php echo $item2['name'];?></p>
                    
                     </div>
                   <div class="col-md-6 item">
                       <img onclick="navigate('<?php echo $item3['link'];?>','<?php echo $unfinished;?>')" class = "icon img-responsive" src="<?php echo $item3['image'];?>" >
                            <p class = "<?php echo $item1['name']?>" ><?php echo $item3['name'];?></p>
                    </div>
                   
                    <div class="col-md-6 item">
                            <img onclick="navigate('<?php echo $item4['link'];?>','<?php echo $unfinished;?>')" class = "icon img-responsive" src="<?php echo $item4['image'];?>">                          
                            <p class = "<?php echo $item4['name']?>" ><?php echo $item4['name'];?></p>
                   
                    </div>
               </div>
        </div>
        <div id="popup" class="w3-modal">
            <div class="w3-modal-content">

                <div class="w3-container" style="text-align: center">
                <!-- close button, click will close modal -->
                <span onclick="document.getElementById('popup').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                <br>
                <h3><?php echo $this->lang->line('survey_no_finish');?></h3>
                <h3><?php echo $this->lang->line('survey_continue');?></h3>
                <br>
                <div class="row">
                <div class="col-md-6">
                    <button id = "startnew"class="btn btn-primary" style="background-color: #03A9F4" onclick="startnew()"><?php echo $this->lang->line('start_again');?></button>
                </div>
                    
                <div class="col-md-6">
                <button id = "getold" class="btn btn-primary" style="background-color: #03A9F4" onclick="getold()"><?php echo $this->lang->line('continue');?></button>
              
                </div>
                </div>
                <br>
                <br>
              </div>
            </div>
          </div>
        </main>  
      
<!--           <div class = "item">
                    {item}
                        <div class = "{className}"> 
                            <button  onclick="navigate('{link}','<?php echo $unfinished;?>')" style="border-radius:8px; " ><img class = "icon" src="{image}" ></img></button>
                            <p class = "{name}" style="font-family: 'PT sans',sans-serif;">{name}</p>
                        </div>
                    {/item}
    
                </div> -->
        
        
<script type="text/javascript">
    function startnew(){
        var url = '<?php echo base_url(); ?>';
        redirect = url.concat('index.php/LocalController/new_questionair/false'); 
        window.location.href = redirect;
    }
    function getold(){
        
        
        var url = '<?php echo base_url(); ?>';
        redirect = url.concat('index.php/LocalController/old_questionair');
        window.location.href = redirect;
        
    }
function navigate(link,unfinish) {
    var url = '<?php echo base_url(); ?>';
    console.log(link);
    var redirect;
    if(link==='newsletter'){
        var redirect = url.concat('index.php/FacebookController/choosepage');
        console.log(link);
       window.location.href = redirect;
    }
    else
    if(link==='questionair'){
       console.log(unfinish);
        if(unfinish==='1')
        {
           document.getElementById('popup').style.display = "block";
//         if (confirm("Do you want to continue the previous questionnair?") === true) {
//             console.log('There is some previously paused questionnair that user wants to continue this one');
//             redirect = url.concat('index.php/LocalController/old_questionair');
//               
//         } else{
//             console.log('There is some previouslt paused questionnair but user does not want to continue that one');
//             redirect = url.concat('index.php/LocalController/new_questionair/false');  
//         }
        }
        else if(unfinish==='0'){
            console.log('There is no unfinished questionnaire');
            //true means there is no unfinished survey before, so a new survey will be generated
            redirect = url.concat('index.php/LocalController/new_questionair/true');
            window.location.href = redirect;
        }
     
    }
    else
    {
        var redirect = url.concat('index.php/LocalController/',link);
        console.log(link);
        window.location.href = redirect;
    }
    

}
</script>
    </body>
    
</html>
