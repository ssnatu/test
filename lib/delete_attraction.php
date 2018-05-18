<?php
require realpath(__DIR__) . '/../database/dbconnect.php';
require_once 'constants.inc.php';
require_once 'library.inc.php';

if (isset($_GET['attr_id']) && isset($_GET['type']))
{
	$attr_id = strip_tags(trim($_GET['attr_id']));
	$user_type = strip_tags(trim($_GET['type']));

	delete_attraction($user_type, $attr_id);
}


/**
 * Delete attraction
 */
function delete_attraction($user_type, $attr_id)
{
	global $con;
	
	if ($user_type == USER_ADMIN)
	{
		$sql = "DELETE FROM attraction_data
				WHERE attr_id = $attr_id";

		if (mysqli_query($con, $sql))
		{
			show_message("Attraction deleted successfuly", 'success');
		}
		else
		{
			show_message("Fail to delete attraction", 'danger');
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