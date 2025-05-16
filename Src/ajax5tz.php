<?php
$user1="bbb@bb.ru;ske3@gmail.com;formozafiti@gmail.com";//Довжик Виктор, Сергей,Роман Муруев
$user2="newcontainergarbage@gmail.com;aleshak97@mail.ru;test2@inrovert.bz";//Евгений,Olegov Lap,test2@inrovert.bz: Евгений,Нагорный Роман,Кирилл
if($_REQUEST["action"]==1)
    $_POST["intr_group"]=$user1;
else
    $_POST["intr_group"]=$user2;
require_once($_SERVER['DOCUMENT_ROOT'].'/introvert_save.php');
echo "OK";