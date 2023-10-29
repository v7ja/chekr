<?php
date_default_timezone_set("Asia/Baghdad");
error_reporting(0);
if (!file_exists("ID")) {
$g = readline("id >>>: ");
file_put_contents("ID", $g);
}
if (!file_exists("ch")) {
file_put_contents("ch", "check team");
}
if (!file_exists("token")) {
$g = readline("Token >>>: ");
file_put_contents("token", $g);
}
if (!file_exists("type")) {
file_put_contents("type", "a");
}
if (!file_exists("type2")) {
file_put_contents("type2", "a");
}
if (!file_exists("type3")) {
file_put_contents("type3", "a");
}
file_put_contents("type1", "a");
file_put_contents("xba", "0");
file_put_contents("type2", "a");
file_put_contents("type4", "a");
file_put_contents("step", "");
file_put_contents("step2", "");
file_put_contents("step3", "");
file_put_contents("step4", "");
file_put_contents("phone1", "-No number");
file_put_contents("phone2", "-No number");
file_put_contents("phone3", "-No number");
file_put_contents("phone4", "-No number");
if (!file_exists("in.json")) {
file_put_contents("in.json", "");
}
if (!file_exists("info.json")) {
file_put_contents("info.json", "");
}
$info = json_decode(file_get_contents('info.json'),true);
$info["number1"] = "-No number";
file_put_contents('info.json', json_encode($info));
$info["number2"] = "-No number";
file_put_contents('info.json', json_encode($info));
$info["number3"] = "-No number";
file_put_contents('info.json', json_encode($info));
$info["number4"] = "-No number";
file_put_contents('info.json', json_encode($info));
$info = json_decode(file_get_contents('info.json'),true);
$info["num1"] = "off";
file_put_contents('info.json', json_encode($info));
$info["num2"] = "off";
file_put_contents('info.json', json_encode($info));
$info["num3"] = "off";
file_put_contents('info.json', json_encode($info));
$info["num4"] = "off";
file_put_contents('info.json', json_encode($info));
echo "Running Bot...\n";
shell_exec("screen -dmS bot php7.4 bot.php");
echo "Account Bot...\n";
echo "Done\n\n\n\n";