#CloakStream

CloakStream is a php web frontend for an existing Sick-Beard installation for the purpose of video streaming.

##Requirements
* Apache
* [mod_auth_token](http://code.google.com/p/mod-auth-token/)
* [mod_h264_streaming](http://h264.code-shop.com/trac/wiki/Mod-H264-Streaming-Apache-Version2)
* an existing [Sick-Beard](https://github.com/midgetspy/Sick-Beard) installation

##How it works
* CloakStream looks through your [Sick-Beard](https://github.com/midgetspy/Sick-Beard) database for any files with the .mp4 extension, and serves them up to you in the browsser.

##Installation
* once you have met the Requirements listed above, download CloakStream and put all the files somewhere under your apache DocumentRoot (visible to the web)
* then go to your browser and navigate to the url of your installation and go to the install.php file and follow follow the prompts
* once you run install.php, and the config file is written, you should delete install.php so noone can use it to reconfigure your installation
