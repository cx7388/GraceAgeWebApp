<!doctype html>
<html>

<head>
    <title class="title">Overview</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet/less" type="text/css" href="<?=base_url()?>assets/css/questionOverview.css" />
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
    <script type="text/javascript" src="<?=base_url()?>assets/js/Chart.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
</head>

<body>
<?php $this->load->view('templates/header_homeCare.php')?>
    <main>
        <div id="myNav" class="overlay">
            <a href="javascript:void(0)" class="closebtn" style="color:black;"onclick="closeNav()">&times;</a>
        <div class="overlay-content">
            <?php $index = 0; $i=1;?>
            <?php foreach ($questions as $question):?>
            <?php if($i%2===1){ ?>
            <label for="<?php echo $question->id;?>" class="labelForAll" style="line-height:0.9em;">
            <span class="questionDescription" id="<?php echo $question->id;?>" onclick="drawChart('<?php echo $question->id?>','<?php echo $question->description;?>')">
              <?php echo $question->id.".".$question->description; ?>
            </span>
            </label>
            <?php } else {?>
            <label for="<?php echo $question->id;?>" class="labelForAll2" style="line-height:0.9em;">
            <span class="questionDescription" id="<?php echo $question->id;?>" onclick="drawChart('<?php echo $question->id?>','<?php echo $question->description;?>')">
              <?php echo $question->id.".".$question->description; ?>
            </span>
            </label>
            <?php }
            $i++;?>
            <?php endforeach;?>
        </div>
        </div>

        <span style="font-size:50px;cursor:pointer;background-color: #03A9F4;color:white;" onclick="openNav()">&#8250;</span>
        
        <div class="row" style="height:90%; width:95%;">
            <div class="col-sm-1"></div>
            <div class="col-sm-9 jumbotron" id="myCanvas" style="margin-top:10%; height:100%">
                <canvas id="chart" class="chart col-sm-11" style="height:100%;"></canvas>
            </div>
            <div class="col-sm-1"></div>
            <div class="col-sm-1" style="margin-top:10%; height:90%">
            <div class="second_menu">

              <label for="bar" onclick="barchart()" class="iconChart" style="background-color:#03A9F4;">
                <img class="iconImage" id = "bar"  src="https://png.icons8.com/bar-chart-filled/ios7/52/FFBF00">
              </label>
                <label for="line" onclick="linechart()" class="iconChart" style="background-color:#03A9F4; margin-top: 20%">
                <img class="iconImage" id = "line"  src="https://png.icons8.com/line-chart-filled/ios7/52/FFBF00">
                </label>
              <script>
                $('.iconChart').css('height', $('.iconChart').width());
              </script>
            </div>
            </div>
        </div>

  </main>

  

<script type="text/javascript">
    $('main').css('height',screen.height*0.7);
    
    var bar = 1;
    var index_question = 1;
    var description_question = '<?php echo $questions[0]->description?>';
    var myChart = null;
    drawChart(index_question,description_question);
    function openNav() {
        console.log('here');
    document.getElementById("myNav").style.width = "50%";
    }

    function closeNav() {
        console.log('here');
    document.getElementById("myNav").style.width = "0%";
    }
    
    function barchart(){
       if(bar === 0){
           bar = 1;
           drawChart(index_question, description_question);
       }
    }
    function linechart(){
       if(bar === 1){
           bar = 0;
           drawChart(index_question, description_question);
       }
    }
    function drawChart(index,question ){
        document.getElementById("myNav").style.width = "0%";
        index_question = index;
        if(bar === 1)
        {
            console.log('bar chart');
            description_question = question;
            url = "<?php echo base_url(); ?>index.php/DisplayResultsController/createDataSet/"+index;
            $.ajax({
                url:url,
                method:"GET",
                dataType:"json",
                success:function(data)
                {
                    console.log(data);
                    callback_drawBarChart(data);

                }
            });
        }
        if(bar === 0){
            console.log('line chart');
            description_question = question;
            url = "<?php echo base_url(); ?>index.php/DisplayResultsController/createDataSetForLine/"+index;
            $.ajax({
                url:url,
                method:"GET",
                dataType:"json",
                success:function(data)
                {
                    
                    callback_drawLineChart(data);

                }
            });
        }
        
    }
    
    function callback_drawLineChart(data){
        number = data.number;
        timeline = data.timeline;
        label = data.label;
        $('#chart').css('height','100%');
        var ctx = document.getElementById("chart").getContext('2d');
        if(myChart!==null){
            myChart.destroy();
        }
        var DatasetsArray = [];
        var GraphColourArray = ['rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'];
        for (var i=0; i < number.length; i++)
        {
            DatasetsArray[i] = 
            {
                label: label[i],
                fill: false,
                borderColor: GraphColourArray[i], 
                data: number[i]
            };   
        }
        console.log(DatasetsArray);
        myChart = new Chart(ctx, {
            type: 'line',
            data:{
                labels: timeline,
                datasets: DatasetsArray
            },
                options: {
                    legend: {
                        display: true
                    },

                    scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            defaultFontFamily: "'PT sans', sans-serif",
                            stepSize:1,
                            fontSize: 23
                        },
                        labels:{
                        defaultFontSize:30
                        }
                    }],
                    xAxes: [{
                           ticks: {
                               defaultFontFamily: "'PT sans', sans-serif",
                               fontSize: 18
                           }
                       }]
                   },
                maintainAspectRatio: false,               
                responsive: true
            }
        });
    }
    
    function callback_drawBarChart(data){
        var number = data.number;
        var description = data.description;
        $('#chart').css('height','100%');
        var ctx = document.getElementById("chart").getContext('2d');
        if(myChart!==null){
            myChart.destroy();
        }
        console.log(number);
        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: description,
                datasets: [{
                    
                    data: number,
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
                legend: {
                        display: false,
                    },
                title:{
                    display:true,
                    fontSize:20,
                    text: <?php $this->lang->line('question').' ';?>+index_question+'.'+description_question
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true,
                            defaultFontFamily: "'PT sans', sans-serif",
                            stepSize:1,
                            fontSize: 23
                        },
                        labels:{
                        defaultFontSize:30
                        }
                    }],
                    xAxes: [{
                           ticks: {
                               defaultFontFamily: "'PT sans', sans-serif",
                               fontSize: 18
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
