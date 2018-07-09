<!DOCTYPE html>
<html lang="en">
     <head>
        <meta charset="UTF-8">
        <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <link href="<?=base_url()?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/navigation.css" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/surveyOneElderStyle.css" />
        <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
        <title><?php echo ($elder->firstName);?>'s last survey</title>
     </head>
    
     <body>
        <?php $this->load->view('templates/header_homeCare')?>
        
         <div class="container-fluid">
             <div class="row">
                 <div class="col-4">
                 </div>
                 <div class="col-5">
                     <div class="page-header header1"><?php echo $this->lang->line('questionnaire').": ".$elder->firstName." om ".$survey->timestamp."<br>";?></div>
                 </div>
                 <div class="col-3">
                 </div>
             </div>
             
             <div class="row">
                 <div class="col-2">
                 </div>
                 <div class="col-8">
                    <?php $i = 1 ;?>
                    <?php foreach($QnAs->result() as $QnA):?>
                        <a class="questionButton" role="button" onclick="displayOneQuestion(<?php echo($QnA->questionID.",".$elder->ProfileID.",".$i);?>)">  
                            <?php echo $i . ". " . $QnA->question;?>
                            <br>
                        </a>

                        <a class="answerButton" role="button" onclick="displayOneQuestion(<?php echo($QnA->questionID.",".$elder->ProfileID.",".$i);?>)">  
                            <span class="answerText"><?php echo $QnA->answer;?></span>
                            <br>
                            <br>
                        </a>
                        
                        <canvas id="myChart<?php echo $i;?>" style="display:none;"></canvas>
                        
                        <?php $i = $i+1 ;?>
                    <?php endforeach;?>
                     
                 </div>
                 <div class="col-2">
                 </div>
             </div>
         </div>
         
        
             
         
         
        <script>var base_url = '<?php echo base_url() ?>';</script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/Chart.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/oneQuestionChart.js"></script>        
    </body>
     
</html>
