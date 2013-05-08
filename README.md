#PHP Terminal

##What is it?

It's a really simple unix/linux style terminal application which can be accessed through a web browser. It runs on a lamp stack webserver. It's created using html, css, jQuery and PHP. It's visual style is green text on a black background to mimic the style of a terminal as much as possible.
  
##What is the point of it?

It allows you to use the command line from a web browser, well kind of. It uses php's shell exec to execute the commands so it's bound by the limitations of shell exec. You can perform simple tasks such as ps, traceroute, nslookup, wget, cat, unlink, ls, mkdir, unlink, uname, curl, date, cal, help, man, etc... basically anything you can run on the server using shell exec. The output is then returned to the page as per a terminal. The commands clear and exit do what you would expect them to do in a terminal. It's meant as a fun terminal emulation rather than a serious project however I have found having it on my server has been useful on occasion.
  
##Installation

Installation is really simple, just copy the files onto a webserver running php and change the username and password at the top of the index.php file. Default is username 'root' and password is 'password'. You may need to enable shell exec in your php ini.

##Bugs
*Login usually takes two attempts for some reason.
*It's probably not the most secure application in the world as the logged in status is set in a cookie and the login and passwords are stored in the index.php file so be careful about leaving it exposed to the public as potentially it could allow people to run commands on your server if it got into mischievous hands.
*The output when running the man command seems to have a bit of a stammer.

##Licensing

Please feel free to use and modify how you see fit. This is my first time submitting code to github and I would love to see people improve upon this project.