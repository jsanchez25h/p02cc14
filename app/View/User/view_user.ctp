<?php 
echo debug($arr_obj_user);
foreach ($arr_obj_user as $obj_user){
	echo $obj_user['User']['id'].'<br>';
}
?>