<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Your health tips</title>
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
    crossorigin="anonymous">
    <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <link href="<?=base_url()?>assets/css/tips_elderly.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" /> 
        <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <!--<script src="<?=base_url()?>assets/js/bootstrap.js"></script>-->  
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
       
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!--<script src="//raw.github.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>-->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/Chart.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/tipsElderly.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
 
    </head>
    <body>
        <?php $data['title']=$this->lang->line('present_tips');?>
        <?php $this->load->view('templates/header_homeElder',$data);?>
        
        <main> 
            <div style="width:100%;height:100%">  
                <?php $currentWeek = $tips_week;?>
            
                <div class="row" id="problem_div">   
                    
                </div>
             
                <div class="row">
                
                    <div class="col-md-6">
                    <div class = "tips_content">
                    <div class = "container" style="width: 100%;height:80%">
                    <div class="row" id="left-part" style="width: 100%;height:80%">
                    <div class="col-md-1">
                        <img id="button_prev" onclick="getTips(<?php echo --$currentWeek?>)" style="margin-top: 20px; padding-top: 20px;"src="https://png.icons8.com/chevron-left-filled/ios7/40/03a9f4">
                    </div>
                    <div class="col-md-10">
                    <div class = "tips" id="tips"> 
                    </div>
                    </div>
                    <div class="col-md-1">
                        <img id="button_next" onclick="getTips(<?php echo ++$currentWeek?>)" style="margin-top: 20px; padding-top: 20px;" src="https://png.icons8.com/chevron-right-filled/ios7/40/03a9f4">
                    </div>  
                        <button class="btn btn-primary this_week" onclick="getTips(<?php echo $tips_week?>)" ><?php echo $this->lang->line('jump_this_week');?></button>
                    </div>
                    </div>
                    </div>
                    </div>
                
                    <div class="col-md-6 " style="width: 100%;height:80%" >
                    <div class="jumbotron custom_jumbotron">
                    <canvas id="myChart"></canvas>
                    <div id="score" style="position:absolute;">
                        <img src="https://png.icons8.com/bookmark/ios7/52/03a9f4"><h1 id="current_scores" style="font-family: 'Optima', sans-serif;"></h1>
                    </div>
                    <script>

                            var p = $( ".jumbotron" );   
                            var position = p.position();
                            var scores;
                            $('#score').css('top',0);
                            $('#score').css('right',10);
                             $.ajax({
                                url:"<?php echo base_url();?>index.php/DisplayResultsController/displayScores",
                                method:"GET",
                                dataType:"json",
                                success:function(data)
                                {
                                    //$('#tips').html(data.tips_items);
                                    console.log('data');
                                    scores = data;
                                    $('#current_scores').text(data.mostRecent);
                                    scores_callback(data);
                                }
                            });

                              $.ajax({
                              url:"<?php echo base_url(); ?>index.php/DisplayResultsController/displaySelfReliance",
                              method:"GET",
                              dataType:"json",
                              success:function(data)
                              {
                               console.log(data);
                               $('#problem_div').append(data);
                              }
                             });

                              $.ajax({
                              url:"<?php echo base_url(); ?>index.php/DisplayResultsController/displayFalling",
                              method:"GET",
                              dataType:"json",
                              success:function(data)
                              {
                                console.log(data);
                                $('#problem_div').append(data);
                              }
                             });

                              $.ajax({
                              url:"<?php echo base_url(); ?>index.php/DisplayResultsController/displayPain",
                              method:"GET",
                              dataType:"json",
                              success:function(data)
                              {
                               $('#problem_div').append(data);
                               console.log(data);
                              }
                             });  

                             getTips(<?php echo $tips_week?>);   
                             function getTips (week){

                                  url = "<?php echo base_url(); ?>index.php/DisplayResultsController/displayTips/"+week,

                                $.ajax({
                                  url:url,
                                  method:"GET",
                                  dataType:"json",
                                  success:function(data)
                                  {
                                   $('#tips').html(data.tips_items);
                                   console.log(data);
                                  }
                                 });
                             };

                    </script>
                    </div>
                    </div>
                </div>
            </div>
        </main>  
    </body>
</html>
