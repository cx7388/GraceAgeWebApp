<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
        <script src="<?=base_url()?>assets/js/jquery.min.js"></script>
        <script src="<?=base_url()?>assets/js/bootstrap.js"></script>
        <script src="<?=base_url()?>assets/js/bootstrap-confirmation.min.js"></script>
        <link href="<?=base_url()?>assets/css/keypad.css" rel="stylesheet">
        <link href="<?=base_url()?>assets/css/question.css" rel="stylesheet" type="text/css">
  
        <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
        <script type="text/javascript" src="<?=base_url()?>assets/js/changeLanguage.js"></script>
    </head>
    <body>
        <?php $data['title']= $this->lang->line('present_survey');?>
        <?php $this->load->view('templates/header_homeElder',$data)?>
    <main>
        <div class="container-fluid " id = "question" >
	<div class="row sticky-top"  >
            <div class="col-md-1"></div>
            <div class="col-md-10">
                    <h3 class="question_description" style="background-color:#FFFFFF;" >
                            <?php $index?><?php
                            $description = $this->lang->line('description');
                            $result_q = $question->result();
                            foreach($result_q as $row_q)
                            { echo $row_q->$description ; }
                            ?>
                           
                    </h3>
            </div>
            <div class="col-md-1"></div>
		</div>
	
	<div class="row" id="lowerPart">
            <!--<script>
                $("#lowerPart").css("padding-top", $(".question_description").height()+10);
            </script>-->
		<div class="col-md-2">
		</div>
		<div class="col-md-8"  >
			<ul id="questions">
                                <?php 
                                $result = $answer->result();
                                $size = $answer->num_rows();
                                $i = 1;
                                
                                
                                foreach($result as $row)
                                {
                                    
                                    if($i<=$size)
                                    { 
                                        ?>
                                        <script>
                                            
                                        </script>
                                        <li class="question_item">
                                                <?php $attributes = array('id' => 'myform'.$i);?>
                                                <?php echo form_open('AnswerController/getAnswer', $attributes);?> 
                                                <input type="hidden" name="QuestionID" value=<?php echo $index;?> />    
                                                <input type="hidden" name="AnswerID" value="<?php echo $row->id;?>" />  
                                                <?php 
                                                    if($row->id==='100')
                                                    { 
                                                        ?>
                                                <!--<input type="tel"  onclick="getELementById('numpad').style.display='block'" id = "telephone" class="keyboard form-control" data-original-title="" name="inputName"  placeholder="I want to enter on my self"/>-->
                                                    
                                                <input name = "userInput" id="inputText" type="text" class="form-control anAnswer" placeholder="<?php $this->lang->line('input_answer');?>"/>

                                                <div class="keypadContainer" >
                                               
                                                </div>
                                                <?php
                                                    }
                                                    else
                                                    {?>
                                                    <button type="submit" form="myform<?php echo $i?>"  onclick="setColor(this)" class="anAnswer"><?php echo $row->$description ;?></button>
                                                    <?php
                                                     
                                                    }
                                                    echo form_close();
                                                    $i++;
                                    }?>
                                        </li>
                                       
                                <?php }
                                
                                ?>

                             
			</ul>
		</div>
		<div class="col-md-2">
		</div>
	</div>
                    <!-- control of progress bar -->
                    <?php  $width =  $index*2.5."%";?>

                    <script>
                    function move() {
                      var elem = document.getElementById("myBar");   
                      var width = 1;
                      var id = setInterval(frame, 10);
                      function frame() {
                        if (width >= 100) {
                          clearInterval(id);
                        } else {
                          width++; 
                          elem.style.width = width + '%'; 
                        }
                      }
                    }
                    </script>
              
                    
        <div class="row" id = "bottom_part">
          <!-- <script>
               if(($('#questions').height()+$('#lowerPart').height()+150)>screen.height)
               {
                   $('#bottom_part').css('top',$('#questions').height()+$('#lowerPart').height());
               }
               else{
                   $('#bottom_part').css('bottom',10);
               }
           </script> -->
           

            <div class="col-md-2"></div>
           <div class="col-md-2">
            <?php if(($index-1)==0)
            {
                $url = "index.php/AnswerController/question/0"; 
            }
            else{
                $goto = $index-1;
                $url = "index.php/AnswerController/question/".$goto;
            }?>
            <a href="<?php echo base_url().$url; ?>">
            <button type="button" class="btn btn-lg back" id="previous" onclick="goPrevious()">
                 <?php echo $this->lang->line('previous_question');?>
            </button>
            </a>
            </div>
            <div class="col-md-4">
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="40" style="width:<?php echo $width;?>">
                        <?php echo $index . "/40";?>
                    </div>
                </div>
            </div>
                <!--<div class="w3-light-grey" >
                 <div id="myBar" class="w3-blue" style="height:24px;width:<?php echo $width;?>; margin-top:5%;">
                 </div>
                </div>
            </div>-->
            <div class="col-md-2">
                <a href="<?php echo base_url() ?>index.php/AnswerController/pauseSurvey/<?php echo $index-1?>">
                <button type="button" class="btn btn-lg back" id="pause" >
			<?php echo $this->lang->line('pause_survey');?>
                </button>
                    <!-- <script>
                        $('#pause').css('height',$('#previous').height());
                    </script>
                    -->
                </a>    
            </div>
                <div class="col-md-2"></div>
	</div>
        </div>
    </main>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="<?=base_url();?>assets/js/scripts.js" type="text/javascript"></script>
     <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="<?=base_url()?>assets/js/keypad.js"></script>
    <script type="text/javascript">
        function setColor(object){
            object.id = "selectedAnswer"; 
            var height = object.offsetHeight;
            bject.style.height = height*1.5+"px";
        }
          
        function sleep(ms) {
            var date = new Date();
            var curDate = null;
            do { curDate = new Date(); }
            while(curDate-date < ms);
        }
        
        $(document).ready(function () {
            $('#inputText').keyPad({
                template : '#tpl-keypad',
                isRandom : false,
                
        },1);
           
        });
        
    </script>
    <script id="tpl-keypad" type="script/template">
        
        <div class="keypad" >
            <table style="background-color:white">
                <colgroup>
                    <col width="33.33%">
                    <col width="33.33%">
                    <col width="33.33%">
                </colgroup>
                <tbody>
                    <tr>
                        <td><button type="button" class="1">1</button></td>
                        <td><button type="button" class="2">2</button></td>
                        <td><button type="button" class="3">3</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="4">4</button></td>
                        <td><button type="button" class="5">5</button></td>
                        <td><button type="button" class="6">6</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="7">7</button></td>
                        <td><button type="button" class="8">8</button></td>
                        <td><button type="button" class="9">9</button></td>
                    </tr>
                    <tr>
                        <td><button type="button" class="text-sm" cmd="clear"><?php echo $this->lang->line('clear');?></button></td>
                        <td><button type="button" class="0">0</button></td>
                        <td><button onclick="setColor(this)" type="button" class="text-sm" cmd="send"><?php echo $this->lang->line('confirm');?></button></td>
                            
                            
                    </tr>
                </tbody>

            </table>
        </div>
    </script>
    <script>
        if ($('#pause').visible(false)) {
            // The element is visible, do something
        } else {
            // The element is NOT visible, do something else
        }
    </script>
  </body>
</html>

