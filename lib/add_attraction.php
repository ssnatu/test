<?php
/**
 * Add attraction
 */

require realpath(__DIR__) . '/../database/dbconnect.php';
require_once 'library.inc.php';
require_once 'constants.inc.php';

$rating_values = [1, 2, 3, 4, 5];

if (isset($_GET['id']) && isset($_GET['type']))
{
	$user_type = strip_tags(trim($_GET['type']));

	if (isset($_POST['add_attr']))
	{
		add_attraction($user_type);
	}
}


/**
 * Add attraction
 */
function add_attraction($user_type)
{
	global $con;
	if ($user_type == USER_ADMIN)
	{
		$rating = 0;
		$attr_type = ATRRACTION_APPROVE;
		if (!empty($_POST['attr_name']) && !empty($_POST['attr_desc']))
		{
			$name = stripslashes(strip_tags(trim($_POST['attr_name'])));
			$description = stripslashes(strip_tags(trim($_POST['attr_desc'])));
		}

		if (isset($_POST['rating_option']))
		{
			$rating = (int)strip_tags(trim($_POST['rating_option']));
		}

		if (isset($_POST['attraction_type']))
		{
			$attraction_type = stripslashes(strip_tags(trim($_POST['attraction_type'])));
			$attr_type = (strtolower($attraction_type) == "approve") ? ATRRACTION_APPROVE : ATRRACTION_HIDDEN;
		}
		
		// Now insert into database
		$sql = "INSERT INTO attraction_data (`name`, `description`, `rating`, `attr_type`) VALUES
			('$name', '$description', $rating, '$attr_type')";

		if (mysqli_query($con, $sql))
		{
			show_message("Attraction added successfuly", 'success');
		}
		else
		{
			show_message("Fail to add new attraction", 'danger');
		}
	}
}

include_once 'header.inc.php';
?>
					<h2>Add New Attraction</h2>
	    		</div>
	    	</div>
	    </div>
			<div class="panel-body">
				<form method="POST">
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-lg-4">
							<label><strong>Attraction Name: </strong></label>
						</div>
						<div class="col-xs-8 col-sm-8 col-lg-8">
							<input type="text" name="attr_name" placeholder="London Eye" required="required">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-lg-4">
							<label><strong>Description: </strong></label>
						</div>
						<div class="col-xs-8 col-sm-8 col-lg-8">
							<textarea rows="4" cols="50" name="attr_desc" required></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-lg-4">
							<label><strong>Rating: </strong></label>
						</div>
						<div class="col-xs-8 col-sm-8 col-lg-8">
							<select name="rating_option">
								<option value="">-</option>
								<?php
						            foreach($rating_values as $option)
						            {
						                echo '<option value="'. $option .'">' . $option . '</option>';
						            }
						        ?>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-lg-4">
							<label><strong>Set Attraction Type: </strong></label>
						</div>
						<div class="col-xs-8 col-sm-8 col-lg-8">
							<select name="attraction_type">
								<option value="Approve" selected>Approve</option>
								<option value="Hidden">Hidden</option>
							</select>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-3 col-sm-3 col-lg-3">
							<input type="submit" class="btn btn-primary btn-sm" name="add_attr" value="Add Attraction">
						</div>
					</div>	
				</form>
				<strong><a href="../index.php">Go back</a></strong>
<?php include_once 'footer.inc.php'; ?>
