<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif"> 
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>   
    
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/Chart.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/personOverview.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
    
  </head>
  <body>
  <?php $this->load->view('templates/header_homeCare')?>
    <main>
    <div class="container-fluid" id = "personOverview" style="padding-top: 50px;">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="row" style="margin-top: 60px">
                     <img alt="Profile Picture" src="<?php echo base_url()."upload/".$person->pictureURL; ?>" style="max-height: 150px;object-fit: cover" />
                </div>
                <h5 class="row"style="margin-top: 60px">
                    <b><?php echo $this->lang->line('personal_info');?></b>
                </h5>
                <div class="row infoBox"style="padding-top: 15px; margin-right: 50px">
                        <?php echo($this->lang->line('name').' :'."\t".$person->firstName." ".$person->LastName); ?><br>
                        <?php echo ($this->lang->line('room').' :'."\t".$person->roomNumber); ?><br>
                        <?php echo ($this->lang->line('birthdate').' :'."\t".date_create($person->birthDate)->format('d/m/Y')); ?><br>
                        <?php echo ($this->lang->line('last_survey').' :'."\t".$date->format('l, F dS')); ?><br>

                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-6">    
                <div class="selectBox">
                    <canvas id="myChart"></canvas>
                <?php 
                        foreach ($surveys as $s) {
                            ?>
                                <div class="surveyElement">
                                    Vragenlijst met <strong>betrouwbaarheid</strong> : <?php 
                                            $rel = $s->Reliability;
                            if ($rel === null) {
                                echo "betrouwbaar";
                            } elseif ($rel< (-20)) {
                                echo "niet betrouwbaar";
                            } elseif ($rel< (-10)) {
                                echo "twijfelachtig";
                            } else {
                                echo "betrouwbaar";
                            } ?><br>
                                    Ingevuld op: <?php
                                    //converting timestamp to dateformat
                                    $ts = $s->timestamp;
                                    $dateTime = date_create($ts);
                                    echo $dateTime->format('d-m-y');
                                    ?> <br>
                                    toont een <strong>zelfredzaamheid</strong> van : <b><?php echo($s->SelfReliance)."%"; ?></b>
                                    <a href="<?php echo base_url()."index.php/DisplayResultsController/displaySurveyOfElder/".$person->ProfileID."/".$s->ID ?>" class="noteButton">
                                        bekijk volledige vragenlijst
                                    </a>
                                    </div>
                                    <?php
                        }
                                    ?>
                                
		</div>
                              
                <h5 class ="row" style="margin-top:88px"><b><?php echo $this->lang->line('notes');?></b></h5>
                <div class="noteBox" style="overflow-x:hidden">
                    <div style="margin-top:10px;">
                        <form method="post"class="noteGrid">
                            <input type="text" name="newNote" placeholder="<?php echo $this->lang->line('new_note');?>" style="width:300px; color:grey; border-style:none">
                            <input type="submit" value="<?php echo $this->lang->line('confirm');?>" class ="noteButton">
                        </form>
                    </div>
                    <?php 
                        foreach($notes as $row)
                        {               
                        ?>
                            <div class="noteGrid">
                                <?php echo (date_create($row->timestamp)->format('d/m/y G:i')."\t".$row->description); ?>
                                <form method = "post">
                                    <input type = "hidden" name = "noteID" value = "<?php echo $row->id; ?>">
                                    <input type = "submit" class ="noteButton" value = "<?php echo $this->lang->line('delete_note'); ?>">
                                </form>
                            </div>
                        <?php                                        
                        }                                
                    ?>
                        
                </div>
            </div>     
                    
            <div class="col-md-1"></div>
         </div>
        </div>
      </main>
         <script>
                    $.ajax({
                                url:"<?php echo base_url();?>index.php/DisplayResultsController/displayPersonScores/"+<?php echo $person->ProfileID?>,
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
                    function scores_callback(data){
       
        var scores = data.scores_items;
        var timestamp = data.scores_timestamps;
        var labelname = data.label;
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [timestamp[4], timestamp[3], timestamp[2],timestamp[1], timestamp[0]],
                datasets: [{
                    label: labelname,
                    data: [scores[4],scores[3], scores[2],scores[1],scores[0]],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            defaultFontFamily: "'PT sans', sans-serif"
                        }
                    }]
                },
                maintainAspectRatio: false,               
                responsive: true            
                
            }
        });       
    }
                    </script>
  </body>
</html>
