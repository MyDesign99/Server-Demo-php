<?php 
/**
 *  Copyright (c) 2025 MyDesign99 LLC
 */

namespace App;

class Controller
{
	public static function buildFormattedRoute ()
	{
		$route = urldecode ($_SERVER['REQUEST_URI']);
		$pathParts = explode ("/", $route);
		$strippedPath = array();
		foreach ($pathParts as $onePart) {
			if (strlen ($onePart) > 0)
				$strippedPath[] = $onePart;
		}
		return $strippedPath;
	}

	public static function parseSingleImageUrl ($urlPathParts)
	{
		if (count ($urlPathParts) != 3)
			return null;

		if (strtolower($urlPathParts[0]) != "get"  ||  strtolower($urlPathParts[1]) != "imageurl")
			return null;

		// read 'value' from route

		$value = intval($urlPathParts[2]);
		if ($value == 0)
			return null;
		
		return $value;
	}


	public static function parsePersonalImageUrl ($urlPathParts)
	{
		if (count ($urlPathParts) != 3)
			return null;

		if (strtolower($urlPathParts[0]) != "customer"  ||  strtolower($urlPathParts[1]) != "imageurl")
			return null;

		// read 'username' from route

		$userName = strtolower ($urlPathParts[2]);
		
		return Data::getPersonalScore ($userName);
	}


	public static function parseStudentImagesUrl ($urlPathParts)
	{
		if (count ($urlPathParts) != 3)
			return null;

		if (strtolower($urlPathParts[0]) != "student"  ||  strtolower($urlPathParts[1]) != "images")
			return null;

		// read 'studentID' from route

		$studentID = intval($urlPathParts[2]);
		if ($studentID == 0)
			return null;
		
		return $studentID;
	}


	public static function getStudentScoreImages ($publicKey, $secretKey, $assetName, $studentID)
	{
		$tokenObj = \MD99_SDK\AuthImages::getMD99AuthToken ($publicKey, $secretKey);
		if ($tokenObj['success'] != "1") {
			$errorAr = array ("image_data" => array ());
			return json_encode ($errorAr);
		}
		
		$allImages = Data::getFullStudentInfo ($studentID, $publicKey, $tokenObj['token'], $assetName);
		
		$fullAr = array ("image_data" => $allImages);
		return json_encode ($fullAr);
	}
}