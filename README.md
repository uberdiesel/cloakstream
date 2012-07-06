#CloakStream

CloakStream is a php web frontend for an existing Sick-Beard installation for the purpose of video streaming.

##Requirements
* Apache with PHP and SQLite3 support
* [mod_auth_token](http://code.google.com/p/mod-auth-token/)
* [mod_h264_streaming](http://h264.code-shop.com/trac/wiki/Mod-H264-Streaming-Apache-Version2)
* an existing [Sick-Beard](https://github.com/midgetspy/Sick-Beard) installation (with at least one show in the db)
* A Directory With movies

##How it works
* CloakStream looks through your [Sick-Beard](https://github.com/midgetspy/Sick-Beard) database for any files with the .mp4 extension, and serves them up to you in the browser.
* You can use a video conversion tool such as HandBrake to convert your existing library to mp4 with h.x264 encoding `HandBrakeCLI -i file.avi -o 
file.mp4 -e x264`

##Installation
* once you have met the Requirements listed above, download CloakStream and put all the files somewhere under your apache DocumentRoot (visible to the web)
* run `sudo ./configure.sh` to install mod_auth_token and mod_h264_streaming automatically
* then go to your browser and navigate to the url of your installation and go to the install.php file and follow the prompts
* once you run install.php, and the config file is written, you should delete install.php so no one can use it to reconfigure your installation
