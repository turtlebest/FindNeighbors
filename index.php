<?php 
session_start();
// Unset all of the session variables.
$_SESSION = array();
$_SESSION['Login'] = FALSE;

$action = 'gallery.html';

$content = "    <p class='lead'>
      	          <input type='number' class='' name='phonenumber_input' placeholder='phonenumber'>
                </p>  
      	         <input type='text' class='' name='keyword_input' placeholder='keyword'></P>
                   <input type='submit' class='' value = 'find appliance/login'>
                </p>";

include 'index2.php';


?>
