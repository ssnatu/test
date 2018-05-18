<?php
/**
 * index page
 */

require_once 'lib/constants.inc.php';
require_once 'lib/library.inc.php';

include_once realpath(__DIR__) . '/lib/header.inc.php';
?>
	    			<h2>Display City Attractions</h2>
	    		</div>
	    		<?php
	    			$user = get_session_user(); //print_r($user);
	    			if (empty($user))
	    			{
						$html = '<div class="col-xs-2 col-sm-2 col-lg-2">';
						$html .= '<a href="login.php" class="links1">Login as admin</a>';
						$html .= '</div>';
						echo $html;
	    			}
	    			?>
	    	</div>
	    </div>
	    <div class="row">
	    	<div class="col-xs-2 col-sm-2 col-lg-2">
	    		<form method="post">
					<input type="submit" class="btn btn-default btn-sm" name="topFive" value="List Top 5 Attractions">
				</form>
	    	</div>
	    </div>
	    <table class="table table-responsive">
	      <tbody>
	        <?php
	        	// check if user click to see top 5 attractions
	        	$isTopFive = isset($_POST['topFive']);
	        
	        	// display attractions from database
	      		display_attractions($isTopFive, $user);
		      	
		    ?>
	      </tbody>		
	    </table>
<?php include_once 'lib/footer.inc.php'; ?>
