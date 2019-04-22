<?php
if ($_GET['module']=='member'){
include "modul/mod_member/member.php";
}else if ($_GET['module']=='meditasi'){
include "modul/mod_meditasi/meditasi.php";
}elseif ($_GET['module']=='pengumuman'){
include "modul/mod_pengumuman/pengumuman.php";
}elseif ($_GET['module']=='slider'){
include "modul/mod_slider/slider.php";
}
?>



