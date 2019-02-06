<?php
/**
 * Created by PhpStorm.
 * User: Ivailo
 * Date: 17.2.2018 г.
 * Time: 15:15 ч.
 */

require "Game.php";

$p=16;
$r=5;
$katan=new Game();
$katan->initGame($p);
$katan->printGame();
$tables=$katan->getCountTables();
print "<br />";
$katan->distribution($p,$r);







