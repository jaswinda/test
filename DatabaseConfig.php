<?php
 //Define your Server host name here.
 $HostName = "localhost";
 
 //Define your MySQL Database Name here.
 $DatabaseName = "doctor_appointment_system_database";
 
 //Define your Database User Name here.
 $HostUser = "root";
 
 //Define your Database Password here.
 $HostPass = ""; 
 $con = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

 //cors configurations
   