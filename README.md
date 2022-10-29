# Project Job-Board for Epitech

This project was made by Lucas Redjaimia and Guillaume Jean both students of Epitech in Pre-MSc

The goal : 
The goal of this project was to do a web site which can display jobs advertisements like indeed. Anybody can create an account and choose the "mode" of using the web site
The customer can choose between "Candidate" or "Company" for his profile status.
  -The first one allow him to postulate for jobs
  -And the second one allow him to create jobs advertisements
Note : There is a third role but this one can only be granted by an administrator because this role allow administrations permissions like delete an user, modify an
already existing user or advertisements or delete user and advertisements he can also see every events.

The API working :
  The API works on url based treatment. In facts the API reads the parameters in the url thanks to a rewrite rule to simplify the address.
  We choosed to create 3 controllers for 3 tables in our database : 
    -The advertisements
    -The users
    -The events
   For exemple in you want to create and advertisements just type : {{APIurl}}/advertisements/new
  
 The datas are returned in json format which can be array, objects or var like for the register for exemple where the API returns a code which must be treated instead of
 a useless data
 
 
 The code of the API :
 
  The root folder contains 1 folder and 3 files :
    -controller/      //Where we store our controllers to treat the url request
    -.htaccess        //To allow the url rewrite engine
    -index.php        //To call the router controller which redirect the user on the good page based of the user url request
    -init.php         //Used to define 3 constants
    
   The controller folder is where we code the "engine" of the API
   So we have 3 controller and on lib.php file this file is where we code our useful function like sendJson which globaly works like a return
   we also have our connect function to create the link with our database.
   
If you have any question please contact us at contact@job-board.fun
