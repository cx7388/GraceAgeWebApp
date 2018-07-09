<DOCTYPE HTML>
 <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link rel="stylesheet" href="header.css">-->
        <a href="<?=base_url()?>/assets/css/QuestionStyle.css" rel="stylesheet"></a>
        <title>Health Survey: Elderly</title>
    </head>
    <body>
        <div class="container">
            <div class="col-12">
                <div class="GABar">
                    <div class="col-1"><h4>graceage</h4></div>
                    <div class="col-10"></div>
                    <div class="col-1"><a href="index.php" rel="returnToIndex"><img src="images/exit_app.png" alt="Exit APP" class="exitIcon"></a></div>
                </div>
            </div><br>
            <div class="col-12">
                <div class="col-3"><img src="images/logo.png" alt="Grace Age Logo" class="logo"></div>
                <div class="col-6"><H3 class="Question">
                    <?php //echo $Question; ?>
                    Did you recently experience difficulties to breathe?
                    </H3></div>
            </div>
            <ul class="possibleAnswers">
                <?php
                    /**
                     * foreach($answers as $a)
                        {
                            echo '<div class="col-12"><li><a><button class="anAnswer"> $a </button></a> </li></div>';
                        }
                    */
                ?>
                <div class="col-12"><li><a><button class="anAnswer"> No, not at all </button></a> </li></div>
                <div class="col-12"><li><a><button class="anAnswer"> Yes, sometimes </button></a> </li></div>
                <div class="col-12"><li><a><button class="anAnswer"> Yes, a lot </button></a> </li></div>
                
            </ul>
            <div class="col-12">
                <div class="col-2"><a href="index.php" rel="jumpToPrevious"><button class="prevQuestion">Previous Question</button></a></div>
                <div class="col-8"><div class="progressBarStriped">
                                   <div class="progressBarSuccess"></div>
                                   </div>
                    <div class="col-2"><a href="index.php" rel="pauseSurvey"><button class="pauseSurvey">Pause Survey</button></a></div>
                </div>
            </div>
        </div>
    </body>
</DOCTYPE>


