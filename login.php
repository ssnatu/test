<?php
/**
 * Admin login page
 */

require_once 'lib/constants.inc.php';
require 'database/dbconnect.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if username is empty
    if (empty(trim($_POST["username"])))
    {
        $username_err = 'Please enter username.';
    }
    else
    {
        $username = strip_tags(trim($_POST["username"]));
    }
    
    // Check if password is empty
    if (empty(trim($_POST['password'])))
    {
        $password_err = 'Please enter your password.';
    }
    else
    {
        $password = strip_tags(trim($_POST['password']));
    }
    
    // Validate username and password
    if (empty($username_err) && empty($password_err))
    {
        // Prepare a select statement
        $sql = "SELECT username, password FROM users WHERE username = ?";
        
        if ($stmt = mysqli_prepare($con, $sql))
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;
 
            if (mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if( mysqli_stmt_num_rows($stmt) == 1)
                {                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $hashed_password);

                    if (mysqli_stmt_fetch($stmt))
                    {
                        if (password_verify($password, $hashed_password))
                        {
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['loggedin'] = true;
                            $_SESSION['username'] = $username;      
                            header("location: index.php");
                        }
                        else
                        {
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                }
                else
                {
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            }
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($con);
}

include_once realpath(__DIR__) . '/lib/header.inc.php';
?>         
                    <h2>Login as admin to add, edit or delete any attraction</h2>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="loginForm">
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-lg-4">
                        <label><strong>Username</strong></label>
                    </div>
                </div>
                <div class="row form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" placeholder="username" style="width: 100%;">
                        <span class="help-block"><?php echo $username_err; ?></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-lg-4">
                        <label><strong>Password</strong></label>
                    </div>
                </div>
                <div class="row form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <div class="col-xs-12 col-sm-12 col-lg-12">
                        <input type="password" name="password" class="form-control" placeholder="****" style="width: 100%;">
                        <span class="help-block"><?php echo $password_err; ?></span>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-xs-6 col-sm-6 col-lg-6">
                        <input type="submit" class="btn btn-primary" value="Login">
                    </div>
                </div>
            <p><a href="index.php">Home page</a></p>
        </form>
        </div>
<?php include_once 'lib/footer.inc.php'; ?>
