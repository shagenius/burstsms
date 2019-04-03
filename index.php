<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>BURST SMS API</title>
  </head>
  <body>
    <div class="container">
        <h1>Burst SMS API</h1>
        <p>To send your message, please enter a valid Australian mobile number only.</p>
        <div id="msg_placeholer" style="display: none;"> </div>
        <!-- form start here -->
        <form id="sendsms" name="sendsms" method="post" action="library/sendapi.php">
            <div class="form-group">
              <label for="mobileno">Mobile Number:</label>
              <input type="text" class="form-control" id="mobileno" name="mobileno">
            </div>
            <div class="form-group">
              <label for="message">Message:</label>
              <textarea class="form-control keepcount" id="message" name="message" rows="3"></textarea>
              <span class="small text-muted"> <label id="charcount">480</label> characters remaining</span>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="send" value="send" id="send">Send</button>
            </div>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/burstjs.js"></script>
  </body>
</html>
