<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Uw nieuwsoverzicht</title>
        <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <link href="<?=base_url()?>assets/css/homepage_elder.css" rel="stylesheet" type="text/css">
        <link href="<?=base_url()?>assets/css/newsletter_elderly.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
    </head>
    <body>
        <?php $data['title']=$this->lang->line('daily_messages');?>
        <?php $this->load->view('templates/header_caretaker', $data);?>
         <main> 
 
        </main>  
       
    </body>
</html>
