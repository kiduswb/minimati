<?php 

    require_once 'tables.php';

    if(isset($_POST['install'])) {
        
        try {
            $sql = new mysqli($_POST['host'], $_POST['username'], $_POST['password'], $_POST['db']);
        } catch(Exception $e) {
            header("Location: ./?e=1");
        }   

        $db = addslashes($_POST['db']);
        $host = addslashes($_POST['host']);
        $username = addslashes($_POST['username']);
        $password = addslashes($_POST['password']);

        if($sql) { 

            // Write database connection data to Database.php

            $db_info = <<<_DBI
<?php
    const DB_HOST = "$host"; // Database Host
    const DB_USER = "$username"; // Database Username
    const DB_PASS = "$password"; // Database Password
    const DB_NAME = "$db"; // Database Name
?>
_DBI;  

            file_put_contents('../Database.php', $db_info);
            session_start();
            $_SESSION['db_info'] = array(
                'DB_HOST' => $host,
                'DB_USER' => $username,
                'DB_PASS' => $password,
                'DB_NAME' => $db
            );
            header("Location: tables.php");
        }
        else header("Location: ./?e=1");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	<link rel="stylesheet" href="../assets/css/style.css">
	<link rel="icon" href="../assets/img/icon.png">
    <title>Install Minimati</title>
</head>
<body>

    <div class="container py-4">
        <div class="row">
            <div class="col-8 mx-auto">
                <h3 class="text-center py-3">Minimati Installation</h3>
                <div class="col-8 mx-auto card shadow">
                    <div class="card-body">
                        <form action="." method="POST">
                            <?php 
                                if(isset($_GET['e'])) {
                                    echo <<<_END
                                    <div class="form-group">
                                        <div class="alert alert-danger">
                                            <i class="fa fa-warning"></i>
                                            Incorrect MySQL info, please try again.
                                        </div>
                                    </div>
_END;
                                }
                            ?>  
                            <div class="form-group">
                                <input required name="host" type="text" class="form-control" placeholder="MySQL Hostname">
                            </div>
                            <div class="form-group">
                                <input required name="username" type="text" class="form-control" placeholder="MySQL Username">
                            </div>
                            <div class="form-group">
                                <input name="password" type="password" class="form-control" placeholder="MySQL Password">
                            </div>
                            <div class="form-group">
                                <input required name="db" type="text" class="form-control" placeholder="MySQL Database">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-outline-success btn-block" type="submit" name="install">Install Minimati &nbsp;<i class="fa fa-download"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
      	<div class="container">
       		<span class="text-muted">
				<a href="https://github.com/kiduswb/minimati">Minimati</a> - 
				Open-source built with <i class="fa fa-heart text-danger"></i>
			</span>
      	</div>
    </footer>
    
</body>
</html>