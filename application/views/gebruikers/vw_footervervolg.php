<?php
	$testurl = 'http://www.webrandit.nl/DataBeheer/';
	$liveurl = '';
	$test = true;
?>

<hr>

      <footer>
        <p>&copy; DataChecker</p>
      </footer>

    </div>


    <script src="http://code.jquery.com/jquery.js"></script>
    <?php
    	if($test == true) {
    		echo '<script src="'.$testurl.'/js/bootstrap.min.js"></script>';
    	} else {
    		echo '<script src="'.$liveurl.'/js/bootstrap.min.js"></script>';
    	}
    ?>
    
 </body>
</html>