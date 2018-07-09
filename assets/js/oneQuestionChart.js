
var QnA;
var ctx;
var dates = [];
var answerIDs = [];
var answers = [];

function displayOneQuestion(questionID, elderID, index){
    
    closeAllCharts();
    
    //read the data from the URL and pass it to the graph
    var url = base_url + "index.php/DisplayResultsController/displayOneQuestion/" + questionID +"/" + elderID;
    $.get(url, function(data){
        
        QnA = JSON.parse(data);
        console.log(QnA);
        ctx = document.getElementById("myChart" + index);
        
        //make the chart visible
        document.getElementById("myChart" + index).style.display = "block";
        
        //make x and y values
        for(var i = 0; i < QnA.length; i++){
            //timestamps from sql are not the same format as those in javascript
            // Split timestamp into [ Y, M, D, h, m, s ]
            var t = QnA[i].timestamp.split(/[- :]/);
            // Apply each element to the Date function
            var d = new Date(Date.UTC(t[0], t[1]-1, t[2], t[3], t[4], t[5]));
            QnA[i].timestamp = d;
        }
        
        //sort dates
        QnA.sort(function(x, y){
            return x.timestamp - y.timestamp;
        });
        //make the dates shorter to only dd-mm-yyyy and split up QnA in datasets.
        for(var i = 0; i < QnA.length; i++){
            QnA[i].timestamp = QnA[i].timestamp.toLocaleDateString();
            dates.push(QnA[i].timestamp);
            answerIDs.push(QnA[i].Answerid);
            //some labels are too long and need to be formatted into an array.
            var answer = formatLabel(QnA[i].answer, 25);
            answers.push(answer);
        }
        console.log("dates after shortening " + dates);
        
        
        chart();
    });
    
}

function closeAllCharts(){
    for(var i = 1; i < 37; i++){
        document.getElementById("myChart" + i).style.display = "none";
    }
    dates = [];
    answerIDs = [];
    answers = [];
}


function chart(){
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            xLabels: dates,
            yLabels: answers,
            datasets: [{
                label: QnA[0].question,
                backgroundColor: 'rgb(2, 136, 209)',
                borderColor: 'rgb(255, 193, 7)',
                data: answers
            }]
        },

        // Configuration options go here
        options: {
            scales: {
                yAxes: [{
                    type: 'category'
                },/*
                {
                    ticks:{
                        beginAtZero: true,
                        margin: 15
                    }
                }*/
                ]
            },
            legend:{
                display: false
            }
        }
    });
}


/* takes a string phrase and breaks it into separate phrases 
   no bigger than 'maxwidth', breaks are made at complete words.*/

function formatLabel(str, maxwidth){
    var sections = [];
    var words = str.split(" ");
    var temp = "";

    words.forEach(function(item, index){
        if(temp.length > 0)
        {
            var concat = temp + ' ' + item;

            if(concat.length > maxwidth){
                sections.push(temp);
                temp = "";
            }
            else{
                if(index === (words.length-1))
                {
                    sections.push(concat);
                    return;
                }
                else{
                    temp = concat;
                    return;
                }
            }
        }

        if(index === (words.length-1))
        {
            sections.push(item);
            return;
        }

        if(item.length < maxwidth) {
            temp = item;
        }
        else {
            sections.push(item);
        }

    });

    return sections;
}

