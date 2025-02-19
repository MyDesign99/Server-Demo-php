<?php 

function config ($key = '')
{
	$optionsAr = [
		'sdk_path' => 'MD99_SDK',
		'public_key' => '63a49d2791c242a9d95c',
		'secret_key' => '667205e1c1da1d5d7177b1c50cf2d107',
		'asset_name' => 'first-asset',
	];

	if (! isset($optionsAr[$key]))
		return null;
	return $optionsAr[$key];
}