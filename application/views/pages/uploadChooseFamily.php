<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?=base_url()?>/favicon.png" type="image/gif">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.2/less.min.js" ></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href='https://fonts.googleapis.com/css?family=PT Sans' rel='stylesheet'>
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="<?=base_url()?>assets/js/uploadPhotos.js"></script>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link href="<?=base_url()?>assets/css/homepage_elder.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/header.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/uploadPhotos.css" />
        <link rel="stylesheet" type="text/css" href="<?=base_url()?>assets/css/uploadChooseFamily.css" />
        <script type="text/javascript" src="<?=base_url()?>assets/js/header.js"></script>
    </head>

    <body>
        <?php $data['title']=$this->lang->line('welcome');?>
        <?php $this->load->view('templates/header_homeElder',$data)?>
        <main style="height:100%;">
            <script>
                $('main').css('height',screen.height*0.8);
            </script>
            
            
            
            <div class="container-fluid" style="padding-top: 1%">
        
        
            <div class="row" style="height:100%">
             <div class="col-md-1" ><img class="logo-upload" src="https://png.icons8.com/ios/30/03A9F4/friends-filled.png"> </div>    
            <div class="col-md-10 family" style="padding-left:0px;margin-left:0px;" >
                   
                <div class="dropdown" style="height:40%">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Please choose who you are
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                  <button class="dropdown-item" type="button">Action</button>
                  <button class="dropdown-item" type="button">Another action</button>
                  <button class="dropdown-item" type="button">Something else here</button>
                </div>
                </div>       
                <h3>Or</h3> 
                
                <button class="btn btn-secondary choose" data-toggle="modal" data-target="#myModal">
                    <img class = "img img-responsive" id="new-family" src="https://png.icons8.com/add-new/ios7/80/ffffff">
                    <h3 style="color:white">Add new</h3>
                </button>         
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Adding a new family or friend</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                        
                        <div class="form-group">
                        <div class="row">    
                        <label for="firstName" class="col-sm-3 control-label">Last Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="firstName" placeholder="Full Name" class="form-control" autofocus>
                            <span class="help-block">Last Name</span>
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="row">    
                        <label for="firstName" class="col-sm-3 control-label">First Name</label>
                        <div class="col-sm-9">
                            <input type="text" id="firstName" placeholder="Full Name" class="form-control" autofocus>
                            <span class="help-block">First Name</span>
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="row">    
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" placeholder="Email" class="form-control">
                            </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">    
                            <label for="email" class="col-sm-3 control-label">Relation</label>
                            <div class="col-sm-9">
                                <input type="email" id="email" placeholder="Email" class="form-control">
                            </div>
                            </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>  
            </div>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                    <div class="col-md-4">    
                        <p><button class="btn btn-warning" onclick="chooseFamily()" style="width:100%;background-color: #03A9F4;border: none; color:white">Send</button><span></span></p>
                    </div>
                <script>
                    function chooseFamily(){
                        
                    }
                </script>
                <div class="col-md-4"></div>
            </div>
        </div>
        
        </main>
    </body>
</html>