<header>
    <nav class="navbar fixed-top navbar-expand-sm navbar-dark nav_custome">
        <ul class="navbar-nav">
            <a class="navbar-brand fontsize2" href="<?=base_url()?>/index.php">GraceAge</a>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="navbar-item li_custome">
                <a class="nav-link fontsize2" style="color:white;" href="<?=base_url()?>/index.php/AlbumController/upload"><?php echo $this->lang->line('upload');?></a>
            </li>
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
                <a class="nav-link fontsize2" style="color:white; padding-right:5%;" href="<?=base_url()?>/index.php/LoginController/loginCareGiver"><?php echo $this->lang->line('caregiver');?></a>
            </li>

        </ul>
    </nav>
</header>