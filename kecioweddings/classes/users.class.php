<?php

namespace NsUsers;

class Users{

function logout(){
            
	$_SESSION = "";
	if (ini_get("session.use_cookies")) {
	$params = session_get_cookie_params();	
        setcookie(session_name(), '', time() - 42000,
	$params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
                );

	}

	session_destroy();

	if (!isset($_SESSION['CREATED'])) {
	// invalidate old session data and ID
	session_regenerate_id(true);
	$_SESSION['CREATED'] = time();

	}

	}

}