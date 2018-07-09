<header>
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark nav_custome">
        <ul class="navbar-nav">
            <a class="nav-link fontsize2" style="color:white;" href="<?=base_url()?>index.php/LocalController/elderHomepage">Home</a>
            <a class="nav-link fontsize2" style="color:white;" onclick="goBack()">
                <?php echo $this->lang->line('previous_page');?>
            </a>
        </ul>

        <span class="navbar-text" id="title" style=" position: absolute; color: white;left:35%; width:30%"></span>
        <h3 class="navbar-text" id="title" style="color:white;">
            <?php echo $title;?>
        </h3>
        <!-- <li class="nav-item li_custome ">
                <a class="nav-link fontsize" style="color:white;" href="<?=base_url()?>index.php/DisplayResultsController/displayResultsOverview">Overview</a>
            </li> -->

        <ul class="navbar-nav ml-auto">
            <li class="navbar-item li_custome">
                <a class="nav-link fontsize2" style="color:white;" onclick="chooseDutch('<?php echo base_url();?>')">
                    <?php echo $this->lang->line('dutch');?>
                </a>
            </li>
            <li class="navbar-item li_custome">
                <a class="nav-link fontsize2" style="color:white;" onclick="chooseEnglish('<?php echo base_url();?>')">
                    <?php echo $this->lang->line('english');?>
                </a>
            </li>
            <li class="navbar-item li_custome">
                <a class="nav-link fontsize2" style="color:white " href="<?=base_url()?>/index.php/LoginController/loginOlderAdults">
                    <?php echo $this->lang->line('logout');?>
                </a>
            </li>
        </ul>
    </nav>
</header>