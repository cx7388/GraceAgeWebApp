<header>
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark nav_custome">
        <ul class="navbar-nav">
            <a class="nav-link fontsize2" style="color:white;" href="<?=base_url()?>index.php/NavigationController/showDepartments">Home</a>
            <a class="nav-link fontsize2" style="color:white;" onclick="goBack()">
                <?php echo $this->lang->line('previous_page');?>
            </a>
            <a class="nav-link fontsize2" style="color:white;" href="<?=base_url()?>index.php/DisplayResultsController/displayResultsOverview">
                <?php echo $this->lang->line('overview_questions');?>
            </a>
        </ul>
        <span class="navbar-text" id="title" style=" position: absolute; color: white;left:35%; width:30%"></span>

        <ul class="navbar-nav ml-auto">

            <a class="nav-link fontsize2" style="color:white;" onclick="chooseDutch('<?php echo base_url();?>')">
                <?php echo $this->lang->line('dutch');?>
            </a>


            <a class="nav-link fontsize2" style="color:white;" onclick="chooseEnglish('<?php echo base_url();?>')">
                <?php echo $this->lang->line('english');?>
            </a>

            <a class="nav-link fontsize2" style="color:white;" href="<?=base_url()?>/index.php/LoginController/loginCareGiver">
                <?php echo $this->lang->line('logout');?>
            </a>

        </ul>
    </nav>
</header>