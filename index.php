<?php 
/**
 *  Copyright (c) 2025 MyDesign99 LLC
 */

require_once "\App\Controller.php";
require_once "\App\Config.php";
require_once "\App\Data.php";

// read keys from a config file
$publicKey = config("public_key");
$secretKey = config("secret_key");
$assetName = config("asset_name");
$sdkFolder = config("sdk_path");

// build the SDK class name
require_once $sdkFolder . "\AuthImages.php";

// parse the incoming Route
$formattedRoute = App\Controller::buildFormattedRoute ();

// test for API call #1: api/get/imageurl/{value}
$value = App\Controller::parseSingleImageUrl ($formattedRoute);
if ($value !== null) {
	echo MD99_SDK\AuthImages::processAll ($publicKey, $secretKey, $value, $assetName);
	return;
}

// test for API call #2: api/personal/imageurl/{user_name}
$value = App\Controller::parsePersonalImageUrl ($formattedRoute);
if ($value !== null) {
	echo MD99_SDK\AuthImages::processAll ($publicKey, $secretKey, $value, $assetName);
	return;
}

// test for API call #2: api/student/images/{student_id}
$studentID = App\Controller::parseStudentImagesUrl ($formattedRoute);
if ($studentID !== null) {
	echo App\Controller::getStudentScoreImages ($publicKey, $secretKey, $assetName, $studentID);
	return;
}

echo MD99_SDK\AuthImages::errorImageURL ();
