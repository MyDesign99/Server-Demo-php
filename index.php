<?php 

require_once "\App\Controller.php";
require_once "\App\Config.php";
require_once "\App\Data.php";

// read keys from a config file
$publicKey = config("public_key");
$secretKey = config("secret_key");
$assetName = config("asset_name");
$sdkFolder = config("sdk_path");

// build the SDK class name
require_once $sdkFolder . "/AuthImages.php";

// parse the incoming Route
$formattedRoute = App\Controller::buildFormattedRoute ();

// test for API call #1: api/get/imageurl/{asset_name}
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

// http://jmc2.lakeshoresoftwareinc.com/get/63a49d2791c242a9d95c/c2dcd7a40ffb1dc054e679b0550ee7f5/75/first-asset.png
