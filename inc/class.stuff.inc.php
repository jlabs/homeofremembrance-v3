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
class Stuff
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

	public function loadVaultItems()
	{
		$sql = "SELECT 
					VaultID,
					doctor_name,
					doctor_contact,
					funeral,
					resting,
					will,
					additional_info,
					file_name_wedding,
					file_directory_wedding,
					file_name_birth,
					file_directory_birth,
					file_name_insurance,
					file_directory_insurance				 
				FROM 
					user_vault 
				WHERE 
					UserID=:userid";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':userid', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch())
			{
				$VaultID = $row['VaultID'];
				$doctor_name = $row['doctor_name'];
				$doctor_contact = $row['doctor_contact'];
				$funeral = $row['funeral'];
				$resting = $row['resting'];
				$will = $row['will'];
				$additional_info = $row['additional_info'];
				$file_name_wedding = $row['file_name_wedding'];
				$file_directory_wedding = $row['file_directory_wedding'];
				$file_name_birth = $row['file_name_birth'];
				$file_directory_birth = $row['file_directory_birth'];
				$file_name_insurance = $row['file_name_insurance'];
				$file_directory_insurance = $row['file_directory_insurance'];
			}
			
			$stmt->closeCursor();
			
			return array(
				$VaultID,
				$doctor_name,
				$doctor_contact,
				$funeral,
				$resting,
				$will,
				$additional_info,
				$file_name_wedding,
				$file_directory_wedding,
				$file_name_birth,
				$file_directory_birth,
				$file_name_insurance,
				$file_directory_insurance
			);		
		}
	    catch(PDOException $e)
	    {
	    	return FALSE;
	    }
	}
	
	public function deleteVaultItem($type,$id)
	{
		//get the file location and delete
		switch($type)
		{
			case "birth":
				$sql = "SELECT file_directory_birth FROM user_vault WHERE VaultID=:id";
				break;
			case "wedding":
				$sql = "SELECT file_directory_wedding FROM user_vault WHERE VaultID=:id";
				break;
			case "insurance":
				$sql = "SELECT file_directory_insurance FROM user_vault WHERE VaultID=:id";
				break;
		}
		
		if ($stmt = $this->_db->prepare($sql))
		{				
			$stmt->bindParam(':id', $id, PDO::PARAM_STR);
			$stmt->execute();
			$file_dir = $stmt->fetchColumn();
			$stmt->closeCursor();			
			//$file_dir = "../".$file_dir;
			unlink($file_dir);
		}
		
		
		//delete from db
		switch ($type)
		{
			case "birth":
				$sql = "UPDATE user_vault SET file_name_birth='',file_directory_birth='',file_size_birth=''";	
				break;	
			case "wedding":
				$sql = "UPDATE user_vault SET file_name_wedding='',file_directory_wedding='',file_size_wedding=''";	
				break;	
			case "insurance":
				$sql = "UPDATE user_vault SET file_name_insurance='',file_directory_insurance='',file_size_insurance=''";	
				break;	
		}
		
		if ($stmt = $this->_db->prepare($sql))
		{
			$stmt->execute();
			$stmt->closeCursor();		
			
			return TRUE;
		}
	}
	
	public function loadTimeCapsules()
	{
		$sql = "SELECT file_name,CapsuleID FROM user_timecapsule WHERE UserID=:userid";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':userid', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->execute();
			$itemno = 1;
			while($row = $stmt->fetch())
			{
				echo "<div class='span2'>";
				echo "<h2>".$itemno."</h2>";
				echo "<p>".$row['file_name']."</p>";
				echo "<p><a class='btn btn-danger btn-large' href='time-capsule.php?delete=".$row['CapsuleID']."'>Delete</a></p>";
				echo "</div>";
				
				$itemno++;
			}
			
			$stmt->closeCursor();
			
			return array(null);
		} 
		catch (PDOException $e)
		{
			
		}
	}
	
	public function loadImages()
	{
		$sql = "SELECT id,path,gallerytitle FROM user_gallery WHERE userID=:userid";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':userid', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch())
			{
				echo "<li class='span3'>";
					echo "<div class='thumbnail'>";
						echo "<img src='".$row['path']."' />";
						echo "<h3>".$row['gallerytitle']."</h3>";
						echo "<p><a class='btn btn-danger btn-large' href='time-capsule.php?delete=".$row['id']."'>Delete</a></p>";
					echo "</div>";
				echo "</li>";
			}
			
			$stmt->closeCursor();
			
			return array(null);
		} 
		catch (PDOException $e)
		{
			
		}
	}

	public function loadHeaderThumbs()
	{
		$sql = "SELECT id,path,title FROM user_gallery WHERE userID=:userid ORDER BY id DESC LIMIT 4";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':userid', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch())
			{
				echo "<img class='header-thumbnail' width='45' height='45' src='".$row['path']."' />";
			}
			
			$stmt->closeCursor();
			
			return array(null);
		} 
		catch (PDOException $e)
		{
			
		}
	}
	
	public function uploadImageToGallery()
	{
		$sql = "INSERT INTO user_gallery 
					(id,userID,path,title,gallerytitle) 
				VALUES 
					(NULL,:user,:path,:title,:gallerytitle)";
		try
		{					
			//if ($_FILES["uploaded_file"]["error"] > 0)
			//{
			//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			//} else {
			//file details
			$file_name_wext = $_FILES["Image"]["name"];
			$file_size = intval($_FILES['Image']['size']);
			$file_tmp = $_FILES["Image"]["tmp_name"];
			
			$file_name = explode(".",$file_name_wext);
			$title = $file_name[0];
			
			//set var to the directory path
			$user_directory = "users/".md5($_SESSION['UserID'])."/gallery";
			//get the files directory path
			$file_directory = $user_directory."/".$file_name_wext;
			//check if folder exists for current user, if not, create it
			if (!is_dir($user_directory)) {
				//make folder with permissions
				mkdir($user_directory,755,true);
			}
			move_uploaded_file($file_tmp,$file_directory);
			
			$gallerytitle = substr($file_name[0],0,15);
			//$gallerytitle = $gallerytitle + "...";
			
			//check if the file exists
			//if (file_exists($user_directory."/". $upload))
			//{
			//say the file already exists
			//echo "<p>$upload already exists.</p>";
			//} else 	{
			//move the file to the perm directory
			//echo "file moved from temp.";
			//}	
			//}
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':user', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->bindParam(':path', $file_directory, PDO::PARAM_STR);
			$stmt->bindParam(':title', $title, PDO::PARAM_STR);
			$stmt->bindParam(':gallerytitle', $gallerytitle, PDO::PARAM_STR);
			
			$stmt->execute();
			$stmt->closeCursor();
			
			return TRUE;
		}
		catch (PDOException $e)
		{
			return FALSE;
		}
	}
	
	public function uploadTimeCapsule()
	{
		$sql = "INSERT INTO 
					user_timecapsule (CapsuleID,UserID,file_name,file_size,file_directory) 
				VALUES 
					(NULL,:user,:file_name,:file_size,:file_directory)";
		try
		{	
				
			//if ($_FILES["uploaded_file"]["error"] > 0)
			//{
			//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			//} else {
			//file details
			$file_name = $_FILES["TimeCapsule"]["name"];
			$file_size = intval($_FILES['TimeCapsule']['size']);;
			$file_tmp = $_FILES["TimeCapsule"]["tmp_name"];
			
			//set var to the directory path
			$user_directory = "users/".md5($_SESSION['id'])."/time_capsule";
			//get the files directory path
			$file_directory = $user_directory."/".$file_name;
			//check if folder exists for current user, if not, create it
			if (!is_dir($user_directory)) {
				//make folder with permissions
				mkdir($user_directory,755,true);
			}
			
			//check if the file exists
			//if (file_exists($user_directory."/". $upload))
			//{
			//say the file already exists
			//echo "<p>$upload already exists.</p>";
			//} else 	{
			//move the file to the perm directory
			//echo "file moved from temp.";
			move_uploaded_file($file_tmp,$file_directory);
			//}	
			//}
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':user', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
			$stmt->bindParam(':file_size', $file_size, PDO::PARAM_STR);
			$stmt->bindParam(':file_directory', $file_directory, PDO::PARAM_STR);
			
			$stmt->execute();
			$stmt->closeCursor();
			
			return TRUE;
		}
		catch (PDOException $e)
		{
			return FALSE;
		}
	}
	
	public function deleteTimeCapsule($id)
	{
		$sql = "SELECT file_directory FROM user_timecapsule WHERE UserID = :user AND CapsuleID = :id";
		try {
			$stmt = $this->_db->prepare($sql);
			
			$stmt->bindParam(':user', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, PDO::PARAM_STR);
			$stmt->execute();
			$file_dir = $stmt->fetchColumn();
			unlink($file_dir);
			
			$stmt->closeCursor();
			
			$sql = "DELETE FROM user_timecapsule WHERE CapsuleID = :id";
			try
			{
				$stmt = $this->_db->prepare($sql);
				$stmt->bindParam(':id', $id, PDO::PARAM_STR);
				$stmt->execute();
				$stmt->closeCursor();
				
				return TRUE;
			}
			catch (PDOException $e)
			{
				return FALSE;
			}
		}
		catch (PDOException $e)
		{
			return FALSE;
		}
	}
	
	public function uploadVault()
	{	
		//set found files to false as they have not been found yet.		
		$found_wedding_file = false;
		$found_birth_file = false;
		$found_insurance_file = false;
		
		//get the current file names if there are any
		$sql = "SELECT file_name_wedding,file_name_birth,file_name_insurance FROM user_vault WHERE UserID=:user";
		$stmt = $this->_db->prepare($sql);
		$stmt->bindParam(':user', $user, PDO::PARAM_STR);
		$stmt->execute();
				
		$sql = "UPDATE user_vault
				SET 
					doctor_name=:doctor_name,
					doctor_contact=:doctor_contact,
					funeral=:funeral,
					resting=:resting,
					will=:will,
					additional_info=:additional_info,
					file_name_wedding=:file_name_wedding,
					file_name_birth=:file_name_birth,
					file_name_insurance=:file_name_insurance,
					file_directory_wedding=:file_directory_wedding,
					file_directory_birth=:file_directory_birth,
					file_directory_insurance=:file_directory_insurance,
					file_size_wedding=:file_size_wedding,
					file_size_birth=:file_size_birth,
					file_size_insurance=:file_size_insurance
				WHERE
					UserID=:user";
		try
		{	
			$stmt = $this->_db->prepare($sql);
		
			$doctor_name = $_POST['doctor_name'];
			$doctor_contact = $_POST['doctor_contact'];
			$funeral = $_POST['funeral'];
			$resting = $_POST['resting'];
			$will = $_POST['will'];
			$additional_info = $_POST['additional_info'];
			$user = $_SESSION['UserID'];
			
			$stmt->bindParam(':user', $user, PDO::PARAM_STR);
			$stmt->bindParam(':doctor_name', $doctor_name, PDO::PARAM_STR);
			$stmt->bindParam(':doctor_contact', $doctor_contact, PDO::PARAM_STR);
			$stmt->bindParam(':funeral', $funeral, PDO::PARAM_STR);
			$stmt->bindParam(':resting', $resting, PDO::PARAM_STR);
			$stmt->bindParam(':will', $will, PDO::PARAM_STR);
			$stmt->bindParam(':additional_info', $additional_info, PDO::PARAM_STR);
				
			//if ($_FILES["uploaded_file"]["error"] > 0)
			//{
			//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			//} else {
			//file details
			
			$file_name_wedding = $_FILES["WeddingCertificate"]["name"];
			$file_size_wedding = intval($_FILES['WeddingCertificate']['size']);;
			$file_tmp_wedding = $_FILES["WeddingCertificate"]["tmp_name"];
			
			$file_name_birth = $_FILES["BirthCertificate"]["name"];
			$file_size_birth = intval($_FILES['BirthCertificate']['size']);;
			$file_tmp_birth = $_FILES["BirthCertificate"]["tmp_name"];
			
			$file_name_insurance = $_FILES["InsuranceDetails"]["name"];
			$file_size_insurance = intval($_FILES['InsuranceDetails']['size']);;
			$file_tmp_insurance = $_FILES["InsuranceDetails"]["tmp_name"];
			
			//set var to the directory path
			$user_directory_wedding = "users/".md5($_SESSION['id'])."/vault/wedding";
			$user_directory_birth = "users/".md5($_SESSION['id'])."/vault/birth";
			$user_directory_insurance = "users/".md5($_SESSION['id'])."/vault/insurance";
			//get the files directory path
			$file_directory_wedding = $user_directory_wedding."/".$file_name_wedding;
			$file_directory_birth = $user_directory_birth."/".$file_name_birth;
			$file_directory_insurance = $user_directory_insurance."/".$file_name_insurance;
			//check if folder exists for current user, if not, create it
			if (!is_dir($user_directory_wedding)) {
				//make folder with permissions
				mkdir($user_directory_wedding,755,true);
			}
			if (!is_dir($user_directory_birth)) {
				//make folder with permissions
				mkdir($user_directory_birth,755,true);
			}
			if (!is_dir($user_directory_insurance)) {
				//make folder with permissions
				mkdir($user_directory_insurance,755,true);
			}
			
			//check if the file exists
			//if (file_exists($user_directory."/". $upload))
			//{
			//say the file already exists
			//echo "<p>$upload already exists.</p>";
			//} else 	{
			//move the file to the perm directory
			//echo "file moved from temp.";
			move_uploaded_file($file_tmp_wedding,$file_directory_wedding);
			move_uploaded_file($file_tmp_birth,$file_directory_birth);
			move_uploaded_file($file_tmp_insurance,$file_directory_insurance);
			//}	
			//}

			$stmt->bindParam(':file_name_wedding', $file_name_wedding, PDO::PARAM_STR);
			$stmt->bindParam(':file_size_wedding', $file_size_wedding, PDO::PARAM_STR);
			$stmt->bindParam(':file_directory_wedding', $file_directory_wedding, PDO::PARAM_STR);
			
			$stmt->bindParam(':file_name_birth', $file_name_birth, PDO::PARAM_STR);
			$stmt->bindParam(':file_size_birth', $file_size_birth, PDO::PARAM_STR);
			$stmt->bindParam(':file_directory_birth', $file_directory_birth, PDO::PARAM_STR);
			
			$stmt->bindParam(':file_name_insurance', $file_name_insurance, PDO::PARAM_STR);
			$stmt->bindParam(':file_size_insurance', $file_size_insurance, PDO::PARAM_STR);
			$stmt->bindParam(':file_directory_insurance', $file_directory_insurance, PDO::PARAM_STR);
			
			$stmt->execute();
			$stmt->closeCursor();
			
			return TRUE;
		}
		catch (PDOException $e)
		{
			return FALSE;
		}
	}
	
	public function uploadTreasuredMemory()
	{
		$sql = "INSERT INTO 
					user_treasuredmemories (MemoryID,
											UserID,
											location,
											notes,
											memory_day,
											memory_month,
											memory_year,
											file_name,
											file_size,
											file_directory) 
				VALUES 
					(NULL,
					:user,
					:location,
					:notes,
					:memory_day,
					:memory_month,
					:memory_year,
					:file_name,
					:file_size,
					:file_directory
					)";
		try
		{	
				
			//if ($_FILES["uploaded_file"]["error"] > 0)
			//{
			//echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
			//} else {
			//file details
			if (isset($_FILES['TreasuredMemory']))
			{
				$file_name = $_FILES['TreasuredMemory']["name"];
				$file_size = intval($_FILES['TreasuredMemory']['size']);;
				$file_tmp = $_FILES['TreasuredMemory']["tmp_name"];
				
				//set var to the directory path
				$user_directory = "users/".md5($_SESSION['id'])."/treasured_memory";
				//get the files directory path
				$file_directory = $user_directory."/".$file_name;
				//check if folder exists for current user, if not, create it
				if (!is_dir($user_directory)) {
					//make folder with permissions
					mkdir($user_directory,755,true);
				}
				
				//check if the file exists
				//if (file_exists($user_directory."/". $upload))
				//{
				//say the file already exists
				//echo "<p>$upload already exists.</p>";
				//} else 	{
				//move the file to the perm directory
				//echo "file moved from temp.";
				move_uploaded_file($file_tmp,$file_directory);
			}
			
			if ($file_size == 0)
			{
				$file_directory = "";
			}
			
			//}	
			//}
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':user', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->bindParam(':location', $_POST['Location'], PDO::PARAM_STR);
			$stmt->bindParam(':notes', $_POST['Notes'], PDO::PARAM_STR);
			$stmt->bindParam(':memory_day', $_POST['memory_day'], PDO::PARAM_STR);
			$stmt->bindParam(':memory_month', $_POST['memory_month'], PDO::PARAM_STR);
			$stmt->bindParam(':memory_year', $_POST['memory_year'], PDO::PARAM_STR);
			$stmt->bindParam(':file_name', $file_name, PDO::PARAM_STR);
			$stmt->bindParam(':file_size', $file_size, PDO::PARAM_STR);
			$stmt->bindParam(':file_directory', $file_directory, PDO::PARAM_STR);
			
			$stmt->execute();
			$stmt->closeCursor();
			
			return TRUE;
		}
		catch (PDOException $e)
		{
			return FALSE;
		}
	}
	
	public function loadTreasuredMemories()
	{
		$sql = "SELECT MemoryID,location,notes FROM user_treasuredmemories WHERE UserID=:userid";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':userid', $_SESSION['UserID'], PDO::PARAM_STR);
			$stmt->execute();
			while($row = $stmt->fetch())
			{					
				echo "<div class='span2'>";
				echo "<h2>".$row['location']."</h2>";
				echo "<p>".$row['notes']."</p>";
				echo "<p><a class='btn btn-danger btn-large' href='treasured-memories.php?delete=".$row['MemoryID']."'>Delete</a></p>";
				echo "</div>";
			}
			
			$stmt->closeCursor();
			
			return array(null);
		} 
		catch (PDOException $e)
		{
			
		}
	}
	
	public function deleteTreasuredMemory($id)
	{
		//get the location of the file
		$sql = "SELECT file_directory FROM user_treasuredmemories WHERE MemoryID=:id ";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':id',$id, PDO::PARAM_STR);
			$stmt->execute();
			$file_dir = $stmt->fetchColumn();
			if ($file_dir != "")
			{
				unlink($file_dir);
			}
		}
		catch (PDOException $e)
		{
			return FALSE;
		}
		
		$sql = "DELETE FROM user_treasuredmemories WHERE MemoryID=:id";
		try 
		{
			$stmt = $this->_db->prepare($sql);
			$stmt->bindParam(':id',$id, PDO::PARAM_STR);
			$stmt->execute();
			$stmt->closeCursor();
			
			return TRUE;
		}
		catch (PDOException $e)
		{
			return FALSE;
		}
	}

	/**
	 * Removes javascript from the href attribute of a submitted link
	 * 
	 * @param string $input		The string to be cleansed
	 * @return string			The clean string
	 */
	private function cleanInput($data)
	{
		// http://svn.bitflux.ch/repos/public/popoon/trunk/classes/externalinput.php
		// +----------------------------------------------------------------------+
		// | Copyright (c) 2001-2006 Bitflux GmbH                                 |
		// +----------------------------------------------------------------------+
		// | Licensed under the Apache License, Version 2.0 (the "License");      |
		// | you may not use this file except in compliance with the License.     |
		// | You may obtain a copy of the License at                              |
		// | http://www.apache.org/licenses/LICENSE-2.0                           |
		// | Unless required by applicable law or agreed to in writing, software  |
		// | distributed under the License is distributed on an "AS IS" BASIS,    |
		// | WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or      |
		// | implied. See the License for the specific language governing         |
		// | permissions and limitations under the License.                       |
		// +----------------------------------------------------------------------+
		// | Author: Christian Stocker <chregu@bitflux.ch>                        |
		// +----------------------------------------------------------------------+
		//
		// Kohana Modifications:
		// * Changed double quotes to single quotes, changed indenting and spacing
		// * Removed magic_quotes stuff
		// * Increased regex readability:
		//   * Used delimeters that aren't found in the pattern
		//   * Removed all unneeded escapes
		//   * Deleted U modifiers and swapped greediness where needed
		// * Increased regex speed:
		//   * Made capturing parentheses non-capturing where possible
		//   * Removed parentheses where possible
		//   * Split up alternation alternatives
		//   * Made some quantifiers possessive

		// Fix &entity\n;
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

		// Remove any attribute starting with "on" or xmlns
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

		// Remove javascript: and vbscript: protocols
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

		// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

		do
		{
			// Remove really unwanted tags
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		}
		while ($old_data !== $data);

		return $data;
	}

}

?>