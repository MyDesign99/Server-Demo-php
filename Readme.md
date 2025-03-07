
# MyDesign99 Server Demo for PHP

Use the MyDesign99 Server Demo for PHP to test the MyDesign99 Image Authentication SDK

![MyDesign99 logo](logo.png "MyDesign99 logo")

> ** **
> **To be used on your PHP server**
> ** **

# Installation

There is a composer file in this repo that should install the SDK. But, depending on how you install this repository, you may need to also install the SDK manually. It can be found at 

[github.com/MyDesign99/AuthToken-SDK-php](https://github.com/MyDesign99/AuthToken-SDK-php)

## Simple Source Code

The MyDesign99 demo involves only 3 source code modules. The purpose is simply to see an example of the SDK in use.

```
index.php            - processes the incoming URL and returns the correct fully-formed image URL or and array of image URL's
App/Config.php       - contains system-wide settings (described below)
App/Controller.php   - used to parse incoming URL's and the entry point to build an array of student score images
App/Data.php         - contains sample datasets that would normally be replaced by your own database
```

## Configuration

The following 2 values need to entered in the Config.php file (in the App folder):

```
public_key      - use either:
                  1) the Public key from your existing MyDesign99 dashboard
                  2) request the public/secret keys for Demos from the 
                     MyDesign99 website
secret_key      - use either:
                  1) the Secret key from your existing MyDesign99 dashboard
                  2) request the public/secret keys for Demos from the 
                     MyDesign99 website
```

The following 2 values have already been entered in the Config.php file (in the App folder) and do NOT need to be changed:

```
sdk_path      - should be 'MD99_SDK'
asset_name    - should be 'radial-demo'
```

# USAGE EXAMPLES

## Sample GET URL #1
```
https://yourdomain.com/get/imageurl/{data_value}
```

An actual URL could be:
```
https://acme.com/get/imageurl/85
```
This returns a well formed image URL for a DEMO design called "radial-demo", showing the number "85" in that design.


## Sample GET URL #2 (get customer score image)
```
https://yourdomain.com/get/customer/{user_name}
```

An actual URL could be:
```
https://acme.com/get/customer/betty
```
This looks up the customer named "betty" and returns a well-formed image URL for her score and the asset name stored in the configuration file

### Valid customer names:

betty, billy, john, frank, karen


## Sample GET URL #3 (get array of student images)
```
https://yourdomain.com/student/images/{student_id}
```

An actual URL could be:
```
https://acme.com/student/images/3
```
The output is an array (in JSON format) containing the Student's name, each Course name and each image.

### Valid student ID's:

1 through 20

