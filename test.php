<?php 

echo password_hash('secretDiscret', PASSWORD_BCRYPT, array('cost'=> 12 ) );

?>