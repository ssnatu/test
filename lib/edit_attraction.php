<?php

require realpath(__DIR__) . '/../database/dbconnect.php';
require_once 'constants.inc.php';
require_once 'library.inc.php';

$rating_values = [1, 2, 3, 4, 5];

if (isset($_GET['id']) && isset($_GET['attr_id']) && isset($_GET['type']))
{
	$user_id = strip_tags(trim($_GET['id']));
	$attr_id = strip_tags(trim($_GET['attr_id']));
	$user_type = strip_tags(trim($_GET['type']));

	// Retrieve attraction
	$sql = "SELECT name, description, rating 
			FROM attraction_data
			WHERE attr_id = '$attr_id'";
	$result = mysqli_query($con, $sql) or die(mysqli_error());
	$attraction = $result->fetch_assoc();

	if (isset($_POST['edit_attr']))
	{
		update_attraction($user_id, $user_type, $attr_id);
	}
}


/**
 * Update attraction
 */
function update_attraction($user_id, $user_type, $attr_id)
{
	global $con;
	$rating = 0;
	if ($user_type == USER_ADMIN)
	{
		if (!empty($_POST['attr_name']) && !empty($_POST['attr_desc']))
		{
			$name = stripslashes(strip_tags(trim($_POST['attr_name'])));
			$description = stripslashes(strip_tags(trim($_POST['attr_desc'])));
		}

		if (isset($_POST['rating_option']) && !empty($_POST['rating_option']))
		{
			$rating = (int)strip_tags(trim($_POST['rating_option']));
		}
		
		// Now update database
		$sql = "UPDATE attraction_data SET 
				name = '$name',
				description = '$description',
				rating = '$rating'
				WHERE attr_id = $attr_id";

		if (mysqli_query($con, $sql))
		{
			show_message("Attraction updated successfuly", 'success');
		}
		else
		{
			show_message("Fail to update attraction", 'danger');
		}
	}
}

include_once 'header.inc.php';
?>
		
					<h2>Edit Attraction</h2>
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
							<input type="text" name="attr_name" value="<?php echo $attraction['name']; ?>">
						</div>
					</div>
					<div class="row">
						<div class="col-xs-4 col-sm-4 col-lg-4">
							<label><strong>Description: </strong></label>
						</div>
						<div class="col-xs-8 col-sm-8 col-lg-8">
							<textarea rows="4" cols="50" name="attr_desc"><?php echo $attraction['description']; ?></textarea>
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
						<div class="col-xs-3 col-sm-3 col-lg-3">
							<input type="submit" class="btn btn-primary btn-sm" name="edit_attr" value="Update Attraction">
						</div>
					</div>	
				</form>
				<br>
				<strong><a href="../index.php">Go back</a></strong>		
			</div>
<?php include_once 'footer.inc.php'; ?>