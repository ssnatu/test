<?php

require_once 'constants.inc.php';
require realpath(__DIR__) . '/../database/dbconnect.php';


/**
 * Display attractions
 *
 * @param bool $isTopFive - If true - List top 5 attractions
 * @param array $user
 * @return
 */
function display_attractions($isTopFive, $user)
{
	global $con;

	$user_type = (!empty($user) && is_array($user)) ? $user['user_type'] : USER_ALL;

	if ($isTopFive)
	{
		$sql = "SELECT attr_id, name, description, AVG(`rating`) AS `rating`, attr_type, 
			no_of_reviews AS reviews 
			FROM attraction_data 
			GROUP BY name
			LIMIT 5";
	}
	else
	{
		$sql = "SELECT attr_id, name, description, rating, attr_type, 
			no_of_reviews AS reviews 
			FROM attraction_data";
	}
		
	$attractions = mysqli_query($con, $sql) or die(mysqli_error());

	if ($user_type == USER_ADMIN)
    {
    	echo '<div class="add"><a href="lib/add_attraction.php?id=' . $user['user_id'] . '&amp;type=' . $user_type . '">Add Attraction</a>';
    }

	while($row = mysqli_fetch_array($attractions))
  	{
  		$html = "";
  		if ($row['attr_type'] == ATRRACTION_HIDDEN) // don't show hidden attraction
  		{
  			continue;
  		}
  		else
  		{
		    $html .= "<tr><td>";
		    $html .= "<h3>" . $row['name'] . "</h3>";
		    $html .= "<p>" . $row['description'] . "</p>";
		    $html .= "<b>Rating: " . $row['rating'] . "</b> ";
		    $html .= "(Reviews: " . $row['reviews'] . ")";
		    
		    if ($user_type == USER_ADMIN)
		    {
		    	$html .= "<td>";
		    	$html .= '<strong><a class="adminTask" href="lib/edit_attraction.php?id=' . $user['user_id'] . '&amp;attr_id=' . $row['attr_id'] . '&amp;type=' . $user['user_type'] . '">Edit</a></strong>';
		    	$html .= "</td>";
		    	$html .= "<td>";
		    	$html .= '<strong><a class="adminTask" href="lib/delete_attraction.php?id=' . $user['user_id'] . '&amp;attr_id=' . $row['attr_id'] . '&amp;type=' . $user['user_type'] . '" onClick="return confirm(\'Are you sure to delete this attraction?\')">Delete</a></strong>';
		    	$html .= "</td>";
		    	$html .= "<td>";
		    	$html .= '<strong><a class="adminTask" href="lib/hide_attraction.php?id=' . $user['user_id'] . '&amp;attr_id=' . $row['attr_id'] . '&amp;type=' . $user['user_type'] . '" onClick="return confirm(\'Are you sure to hide this attraction?\')">Hide</a></strong>';
		    	$html .= "</td>";
		    }

		    //$html .= "<a href='review.php?id=" . $row['attr_id'] . "'data-toggle='tooltip' class='icon-tip' title='Login to review'>";
		    //$html .= "Review</a>";
		    
		    $html .= "</td></tr>";
		}
	    echo $html;
	}
}


/**
 * Return logged in user details
 *
 * @param bool $loggedin
 * @param string $username
 * @return array
 */
function get_user($loggedin, $username)
{
	global $con;
	
	if (isset($loggedin) && $loggedin)
	{
		$sql = "SELECT user_id, user_type, review_status 
		FROM users
		WHERE username = '" . stripcslashes(trim($username)) ."'";

		$result = mysqli_query($con, $sql) or die(mysqli_error());
		$user = $result->fetch_assoc();
		return $user;
	}
}


/**
 * Return user
 * 
 * @return array $user
 */
function get_session_user()
{
	//$user_type = USER_ALL;
	$user = [];
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'])
	{
		$html = '<div class="col-xs-2 col-sm-2 col-lg-2">';
		$html .= '<a href="logout.php" class="links1">Logout</a>';
		$html .= '</div>';
		echo $html;
		$user = get_user($_SESSION['loggedin'], $_SESSION['username']);		
	}
	return $user;
}


function show_message($message, $type = 'info')
{
    $html = "<div class='alert alert-". $type . " fade-in'>";
    $html .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>";
    $html .= $message;
    $html .= "</div>";
    echo $html;
}
