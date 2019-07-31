<?php

/**
 * Handles list interactions within the app
 * 
 * PHP version 5
 * 
 * @author Jason Lengstorf
 * @author Chris Coyier
 * @copyright 2009 Chris Coyier and Jason Lengstorf
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 *
 */
class People
{
	/**
	 * The database object
	 * 
	 * @var object
	 */
	private $_db;

	/**
	 * Checks for a database object and creates one if none is found
	 * 
	 * @param object $db
	 * @return void
	 */
	public function __construct($db=NULL)
	{
		if(is_object($db))
		{
			$this->_db = $db;
		}
		else
		{
			$dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
			$this->_db = new PDO($dsn, DB_USER, DB_PASS);
		}
	}
	
	public function saveAboutMe()
	{
		$sql = "UPDATE 
					user_about 
				SET 
					Born=:born,
					Parents=:parents,
					Lived=:lived,
					Educated=:educated,
					Currently=:currently,
					About=:about,
					Likes=:likes,
					Dislikes=:dislikes
				WHERE 
					UserID=:user";
		if ($stmt = $this->_db->prepare($sql))
		{		
			$born = $_POST['Born'];
			$parents = $_POST['Parents'];
			$lived = $_POST['Lived'];
			$educated = $_POST['Educated'];
			$currently = $_POST['Currently'];
			$likes = $_POST['Likes'];
			$dislikes = $_POST['Dislikes'];
			$about = $_POST['About'];
		
			
			$stmt->bindParam(':user', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->bindParam(':born', $born, PDO::PARAM_STR);
			$stmt->bindParam(':parents', $parents, PDO::PARAM_STR);
			$stmt->bindParam(':lived', $lived, PDO::PARAM_STR);
			$stmt->bindParam(':educated', $educated, PDO::PARAM_STR);
			$stmt->bindParam(':currently', $currently, PDO::PARAM_STR);
			$stmt->bindParam(':likes', $likes, PDO::PARAM_STR);
			$stmt->bindParam(':dislikes', $dislikes, PDO::PARAM_STR);
			$stmt->bindParam(':about', $about, PDO::PARAM_STR);
			
			$stmt->execute();
			$stmt->closeCursor();
			
			return TRUE;
		} else {
			return FALSE;	
		}
	}
	
	public function saveMyDetails()
	{
		$sql = "UPDATE 
					users 
				SET 
					Firstname=:firstname,
					Surname=:surname,
					dob_day=:dob_day,
					dob_month=:dob_month,
					dob_year=:dob_year
				WHERE 
					UserID=:user";
		if ($stmt = $this->_db->prepare($sql))
		{				
			$stmt->bindParam(':user', $_SESSION['UserID'], PDO::PARAM_STR);
			
			$stmt->bindParam(':firstname', $_POST['Firstname'], PDO::PARAM_STR);
			$stmt->bindParam(':surname', $_POST['Surname'], PDO::PARAM_STR);
			$stmt->bindParam(':dob_day', $_POST['dob_day'], PDO::PARAM_STR);
			$stmt->bindParam(':dob_month', $_POST['dob_month'], PDO::PARAM_STR);
			$stmt->bindParam(':dob_year', $_POST['dob_year'], PDO::PARAM_STR);
			
			$stmt->execute();
			$stmt->closeCursor();
			
			$_SESSION['Surname'] = $_POST['Surname'];
			
			return TRUE;
		} else {
			return FALSE;	
		}
	}
	
	public function loadMyDetails()
	{
		$sql = "SELECT Firstname,Surname,dob_day,dob_month,dob_year FROM users WHERE UserID=:userid";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':userid', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch())
			{
				$Firstname = $row['Firstname'];
				$Surname = $row['Surname'];
				$dob_day = $row['dob_day'];
				$dob_month = $row['dob_month'];
				$dob_year = $row['dob_year'];
			}
			
			$stmt->closeCursor();
			
			return array(
				$Firstname,
				$Surname,
				$dob_day,
				$dob_month,
				$dob_year
			);		
		}
	    catch(PDOException $e)
	    {
	    	return FALSE;
	    }
	}

	public function loadAboutMe()
	{
		$sql = "SELECT * FROM user_about WHERE UserID=:userid";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':userid', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch())
			{
				$about_born = $row['Born'];
				$about_parents = $row['Parents'];
				$about_lived = $row['Lived']; 
				$about_educated = $row['Educated'];
				$about_currently = $row['Currently'];
				$about_likes = $row['Likes'];
				$about_dislikes = $row['Dislikes'];
				$about_about = $row['About'];
				$about_visibility = $row['Visibility'];
			}
			
			$stmt->closeCursor();
			
			return array(
				$about_born,
				$about_parents,
				$about_lived,
				$about_educated,
				$about_currently,
				$about_likes,
				$about_dislikes,
				$about_about,
				$about_visibility
			);		
		}
	    catch(PDOException $e)
	    {
	    	return FALSE;
	    }
	}
	
	
	public function accountLogin()
	{
		$sql = "SELECT UserID,Username,Firstname,Surname 
	    		FROM users
	    		WHERE Username=:user
	    		AND Password=MD5(:pass)
	    		LIMIT 1";
	    try
	    {
	    	$stmt = $this->_db->prepare($sql);
	    	$stmt->bindParam(':user', $_POST['username'], PDO::PARAM_STR);
	    	$stmt->bindParam(':pass', $_POST['password'], PDO::PARAM_STR);
	    	$stmt->execute();
	    	if($stmt->rowCount()==1)
	    	{
	    		$_SESSION['Username'] = htmlentities($_POST['username'], ENT_QUOTES);
	    		$_SESSION['LoggedIn'] = 1;
				while($row = $stmt->fetch())
				{
					$_SESSION['UserID'] = $row['UserID'];
					$_SESSION['Firstname'] = $row['Firstname'];
					$_SESSION['Surname'] = $row['Surname'];	
				}
	    		return TRUE;
	    	}
	    	else
	    	{
	    		return FALSE;
	    	}
	    }
	    catch(PDOException $e)
	    {
	    	return FALSE;
	    }
	}
}

?>