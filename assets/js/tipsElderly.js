             
                     
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
                           console.log(data)
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
    
   
   
  
    
 
 