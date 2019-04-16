<?php
/**
 * @author Santosh
 * @Quintus Labs
 */
session_start();
if(isset($_SESSION["response"]) && isset($_SESSION["json"])){
    $response=$_SESSION["response"] ;
    $json=$_SESSION["json"] ;
}else{
    $response="" ;
    $json="";
}

?>

<html>
    <head>
        <title>Firebase Notification</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
       
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
       
        <style type="text/css">
            
            legend{
                font-size: 30px;
                color: #555;
            }
            .btn_send{
                background: #00bcd4;
            }
            label{
                margin:10px 0px !important;
            }
            textarea{
                resize: none !important;
            }
            .fl_window{
                width: 400px;
                position: absolute;
                right: 0;
                top:100px;
            }
            pre, code {
                padding:10px 0px;
                box-sizing:border-box;
                -moz-box-sizing:border-box;
                webkit-box-sizing:border-box;
                display:block; 
                white-space: pre-wrap;  
                white-space: -moz-pre-wrap; 
                white-space: -pre-wrap; 
                white-space: -o-pre-wrap; 
                word-wrap: break-word; 
                width:100%; overflow-x:auto;
            }



        </style>
    </head>
    <body>
 
        <div class="container">
            <div class="row">
             <div class="col-md-6">
             <form action="server.php" method="post" enctype="multipart/form-data">
               
                    <h2>Send to topic to all device</h2>

                    <label for="title1">Title</label>
                    <input type="text" id="title1" name="title" class="form-control" placeholder="Enter title" required>

                    <label for="message1">Message</label>
                    <textarea class="form-control" name="message" id="message1" rows="5" placeholder="Notification message!"></textarea>
                   <br/>
                    <label for="message1">Image</label>
                      
                         <input type="file" id="imgInp" name="image" accept="image/jpg,image/png" />
                         
                       <br/><br/>
     
                    <input type="hidden" name="push_type" value="topic"/>
                    
              
                <button type="submit" class="btn btn-primary" name="submit">Send Notification</button>
                    
            </form>
             </div>
             <div class="col-md-6">
           
                <br/>
              
                <?php if ($json != '') { ?>
                    <label><b>Request:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($json) ?></pre>
                    </div>
                <?php } ?>
                <br/>
                <?php if ($response != '') { ?>
                    <label><b>Response:</b></label>
                    <div class="json_preview">
                        <pre><?php echo json_encode($response) ?></pre>
                    </div>
                <?php } ?>

            </div>

             
            </div>
        
           
        </div>

        <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });

    </body>
</html>
<?php
session_unset();
?>
