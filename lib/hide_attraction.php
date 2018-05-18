<?php
require realpath(__DIR__) . '/../database/dbconnect.php';
require_once 'constants.inc.php';
require_once 'library.inc.php';

if (isset($_GET['attr_id']) && isset($_GET['type']))
{
	$attr_id = strip_tags(trim($_GET['attr_id']));
	$user_type = strip_tags(trim($_GET['type']));

	hide_attraction($user_type, $attr_id);
}


/**
 * Delete attraction
 */
function hide_attraction($user_type, $attr_id)
{
	global $con;
	
	if ($user_type == USER_ADMIN)
	{
		$sql = "UPDATE attraction_data
				SET attr_type = " . ATRRACTION_HIDDEN . "
				WHERE attr_id = $attr_id";

		if (mysqli_query($con, $sql))
		{
			show_message("Attraction is set as hidden successfuly", 'success');
		}
		else
		{
			show_message("Fail to hide attraction", 'danger');
		}
	}
}


include_once 'header.inc.php';
?>
				</div>
	    	</div>
	    </div>
	    <div class="panel-body">
				<strong><a href="../index.php">Go back</a></strong>		
		</div>
<?php include_once 'footer.inc.php'; ?>