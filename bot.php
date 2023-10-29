<?php
date_default_timezone_set("Asia/Baghdad");
error_reporting(0);
function bot($method, $datas = []) {
$token = file_get_contents("token");
$url = "https://api.telegram.org/bot$token/" . $method;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$res = curl_exec($ch);
curl_close($ch);
return json_decode($res, true);
}
function getupdates($up_id) {
$get = bot('getupdates', ['offset' => $up_id]);
return end($get['result']);
}
$botuser = "@" . bot('getme', ['bot']) ["result"]["username"];
file_put_contents("_ad.txt", $botuser);
function stats($nn) {
$st = "";
$x = shell_exec("pm2 show $nn");
if (preg_match("/online/", $x)) {
$st = "run";
}
else {
$st = "stop";
}
return $st;
}
function states($g) {
$st = "";
$x = shell_exec("pm2 show $g");
if(preg_match("/online/", $x)) {
$st = "run";
}else{
$st = "stop";
}
return $st;
}
function countUsers($u = "2", $t = "2") {
if ($t == "2") {
$users = explode("\n", file_get_contents("users"));
$list = "";
$i = 1;
foreach ($users as $user) {
if ($user != "") {
$list = $list . "\n$i  ➧ @$user";
$i++;
}
}
if ($list == "") {
return "There is no username in the list";
}
else {
return $list;
}
}
if ($t == "1") {
$users = explode("\n", $u);
$list = "";
$i = 1;
foreach ($users as $user) {
if ($user != "") {
$list = $list . "\n$i  ➧ @$user";
$i++;
}
}
if ($list == "") {
return "There is no username in the list";
}
else {
return $list;
}
}
}
$step = "";
function run($update) {
global $step;
$nn = bot('getme', ['bot']) ["result"]["username"];
$message = $update['message'];
$userID = $message['from']['id'];
$chat_id = $message['chat']['id'];
$name = $message['from']['first_name'];
$text = $message['text'];
$date = $update['callback_query']['data'];
$cq = $update['callback_query'];
$data = $cq['data'];
$message_id = $cq['message']['message_id'];
$chat_id2 = $cq['message']['chat']['id'];
$group = file_get_contents("ID");

if ($chat_id == $group) {
if ($text) {
if($text == '/start' or $text == '->' or $text == "Back"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text' => "@ClimersTeam اهلا بك في الوحه تحكم",
'parse_mode' => "MarkDown", 
'disable_web_page_preview' => true,
'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [
[["text" =>"᥀ ᴀᴅᴅ ᴅᴇʟᴇᴛ ~ ɴᴜᴍʙʀ ᥀"],["text" =>"᥀ ᴀᴅᴅ ᴅᴇʟᴇᴛ ~ ᴜѕᴇʀ ᥀"]],
[["text" =>"᥀ ʀᴜɴ ~ ѕᴛᴏᴘ ᥀"]],
[["text" =>"᥀ ᴄʟᴇᴀʀ ʟɪѕᴛ ᥀"],["text" =>"᥀ ѕʜᴏᴡ ʟɪѕᴛ ᥀"]],
[["text" =>"᥀ ᴄʟɪᴄᴋѕ ᥀"]],] ]) ]);
}
}
##اضف رقم او حذف###
if ($chat_id == $group) {
if ($text == "᥀ ᴀᴅᴅ ᴅᴇʟᴇᴛ ~ ɴᴜᴍʙʀ ᥀") {
bot('sendMessage', ['chat_id' => $chat_id, 'text' => "Select button",
'reply_markup' => json_encode(['resize_keyboard' => true, 'keyboard' => [
[["text" =>"->"]],
[["text" =>"Login1"],["text" =>"Delete number1"]],
[["text" =>"Login2"],["text" =>"Delete number2"]],
[["text" =>"Login3"],["text" =>"Delete number3"]],
[["text" =>"Login4"],["text" =>"Delete number4"]]],]) ]);
}}
if (preg_match('/Login\d+/',$text)){
$ex = explode('Login',$text);
bot('sendMessage',['chat_id' => $chat_id, 'text' => "• تشيكر رقم ".$ex[1].".\n• ارسل رقم الحساب الان .\n•مثال \n+3387287822"]);
file_put_contents("TheN",$ex[1]);
unlink($ex[1].".madeline");
unlink($ex[1].".madeline.lock");
file_put_contents("step","2");
system('php Login.php');
}
if (preg_match('/Delete number\d+/',$text)){
$ex = explode('Delete number',$text);
bot('sendMessage',['chat_id' => $chat_id, 'text' => "• التشيكر رقم ".$ex[1]." - \n• تم حذفه بنجاح ."]);
unlink("TheN");
unlink($ex[1].".madeline"); 
unlink($ex[1].".madeline.lock");
unlink($ex[1].".madeline.lightState.php");
unlink($ex[1].".madeline.lightState.php.lock");
unlink($ex[1].".madeline.safe.php");
unlink($ex[1].".madeline.safe.php.lock");
system('rm -rf '.$ex[1].'.madeline && rm -rf '.$ex[1].'.madeline.lock && rm -rf '.$ex[1].'.madeline.lightState.php && rm -rf '.$ex[1].'.madeline.lightState.php.lock && rm -rf '.$ex[1].'.madeline.safe.php && rm -rf '.$ex[1].'.madeline.safe.php.lock');
}

if(file_exists('mode')){
$mode = file_get_contents('mode');
$users = explode("\n", file_get_contents('users'));
if(preg_match("/@+/", $text)){
if($mode == 'pinall'){
$user = explode("@", $text) [1];
if (!in_array($user, $users)) {
file_put_contents("users", "\n" . $user, FILE_APPEND);
file_put_contents("u2", "\n" . $user, FILE_APPEND);
file_put_contents("u3", "\n" . $user, FILE_APPEND);
file_put_contents("u4", "\n" . $user, FILE_APPEND);
bot('sendMessage', ['chat_id' => $chat_id, 'text'=>"@$user : ⌁ Done Pin All.🚀",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
shell_exec("pm2 start 1.php");
} else {
reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}
unlink('mode');
} elseif($mode == 'Unpin'){
echo 'unpin';
$user = explode("@", $text) [1];
$data = str_replace("\n" . $user, "", file_get_contents("users"));
file_put_contents("users", $data);
file_put_contents("users",preg_replace('~[\r\n]+~',"\n",trim(file_get_contents("users"))));
bot('sendMessage', ['chat_id' => $chat_id,  'text' => "⌁ Done Delet User List 1 :@$user",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
unlink('mode');
} elseif($mode == 'addL'){
echo $mode;
$ex = explode("\n", $text);
$userT = "";
$userN = "";
foreach ($ex as $u) {
$users = explode("\n", file_get_contents("users"));
 $user = explode("@", $u) [1];
if (!in_array($user, $users)) {
$userT = $userT . "\n" . $user;
}
else {
$userN = $userN . "\n" . $user;
}
}
file_put_contents("users", $userT, FILE_APPEND);
bot('sendMessage', ['chat_id' => $chat_id,  'text' => "⌁ Done Added Users To List 1 :\n" . countUsers($userT, "1") ,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
unlink('mode');
}
}}
if(file_exists('mode')){
$mode = file_get_contents('mode');
$users = explode("\n", file_get_contents('u2'));
if(preg_match("/@+/", $text)){
if($mode == 'Pi0n'){
$user = explode("@", $text) [1];
if (!in_array($user, $users)) {
file_put_contents("u2", "\n" . $user, FILE_APPEND);
$EzTG->sendMessage(['chat_id'=>$cha,'text'=>"⌁ Done Delet User List 2 : @$user",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
} else {
bot('sendMessage', ['chat_id' => $chat_id, 'text'=>"@$user : Already Exists.",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}
unlink('mode');
} elseif($mode == 'Unpin2'){
echo 'Unpin2';
$user = explode("@", $text) [1];
$data = str_replace("\n" . $user, "", file_get_contents("u2"));
file_put_contents("u2", $data);
file_put_contents("u2",preg_replace('~[\r\n]+~',"\n",trim(file_get_contents("u2"))));
bot('sendMessage', ['chat_id' => $chat_id,  'text' => "⌁ Done Delet User List 2 : @$user",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
unlink('mode');
}elseif($mode == 'ad2'){
echo $mode;
$ex = explode("\n", $text);
$userT = "";
$userN = "";
foreach ($ex as $u) {
$addL = explode("\n", file_get_contents("u2"));
$user = explode("@", $u) [1];
if (!in_array($user, $users)) {
$userT = $userT . "\n" . $user;
}
else {
$userN = $userN . "\n" . $user;
}
}
file_put_contents("u2", $userT, FILE_APPEND);
bot('sendMessage', ['chat_id' => $chat_id,  'text' => "⌁ Done Added Users To List 2 :\n" . countUsers($userT, "1") ,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
unlink('mode');
}
}}
if(file_exists('mode')){
$mode = file_get_contents('mode');
$users = explode("\n", file_get_contents('u3'));
if(preg_match("/@+/", $text)){
if($mode == 'P0in'){
$user = explode("@", $text) [1];
if (!in_array($user, $users)) {
file_put_contents("u3", "\n" . $user, FILE_APPEND);
$EzTG->sendMessage(['chat_id'=>$cha,'text'=>"@$user : ⌁ Done Pin.",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
} else {
bot('sendMessage', ['chat_id' => $chat_id, 'text'=>"@$user : Already Exists.",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);}
unlink('mode');
}elseif($mode == 'Unpin3'){
echo 'Unpin3';
$user = explode("@", $text) [1];
$data = str_replace("\n" . $user, "", file_get_contents("u3"));
file_put_contents("u3", $data);
file_put_contents("u3",preg_replace('~[\r\n]+~',"\n",trim(file_get_contents("u3"))));
bot('sendMessage', ['chat_id' => $chat_id,  'text' => "⌁ Done Delet User List 3 : @$user",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
unlink('mode');
}elseif($mode == 'ad3'){
echo $mode;
$ex = explode("\n", $text);
$userT = "";
$userN = "";
foreach ($ex as $u) {
$addL = explode("\n", file_get_contents("u3"));
$user = explode("@", $u) [1];
if (!in_array($user, $users)) {
$userT = $userT . "\n" . $user;
}
else {
$userN = $userN . "\n" . $user;
}
}
file_put_contents("u3", $userT, FILE_APPEND);
bot('sendMessage', ['chat_id' => $chat_id,  'text' => "⌁ Done Added Users To List 3 :\n" . countUsers($userT, "1") ,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
unlink('mode');
}
}}
if(file_exists('mode')){
$mode = file_get_contents('mode');
$users = explode("\n", file_get_contents('u4'));
if(preg_match("/@+/", $text)){
if($mode == 'P0in'){
$user = explode("@", $text) [1];
if (!in_array($user, $users)) {
file_put_contents("u4", "\n" . $user, FILE_APPEND);
$EzTG->sendMessage(['chat_id'=>$cha,'text'=>"@$user : ⌁ Done Pin.",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
} else {
bot('sendMessage', ['chat_id' => $chat_id, 'text'=>"@$user : Already Exists.",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}
unlink('mode');
} elseif($mode == 'Unpin4'){
echo 'Unpin4';
$user = explode("@", $text) [1];
$data = str_replace("\n" . $user, "", file_get_contents("u4"));
file_put_contents("u4", $data);
file_put_contents("u4",preg_replace('~[\r\n]+~',"\n",trim(file_get_contents("u4"))));
bot('sendMessage', ['chat_id' => $chat_id,  'text' => "⌁ Done Delet User List 4 : @$user",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
unlink('mode');
}elseif($mode == 'ad4'){
echo $mode;
$ex = explode("\n", $text);
$userT = "";
$userN = "";
foreach ($ex as $u) {
$addL = explode("\n", file_get_contents("u4"));
$user = explode("@", $u) [1];
if (!in_array($user, $users)) {
$userT = $userT . "\n" . $user;
}
else {
$userN = $userN . "\n" . $user;
}
}
file_put_contents("u4", $userT, FILE_APPEND);
bot('sendMessage', ['chat_id' => $chat_id,  'text' => "⌁ Done Added Users To List 4 :\n" . countUsers($userT, "1") ,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
unlink('mode');
}
}}}
if ($chat_id == $group) {
if($text == "᥀ ᴄʟᴇᴀʀ ʟɪѕᴛ ᥀"){
bot('sendMessage', ['chat_id' => $chat_id,
'text'=>"⌁ Choose button ",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text' => "⌁ List 📜 1",'callback_data' => "CLEAR1"]],
[['text' => "⌁ List 📜 2",'callback_data' => "CLEAR2"]],
[['text' => "⌁ List 📜 3",'callback_data' => "CLEAR3"]],
[['text' => "⌁ List 📜 4",'callback_data' => "CLEAR4"]],
]])]);
}}
if($data == "CLEAR1"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"- Done Delete all Usernames List 1 🗑️",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
file_put_contents("users", "");
}
if($data == "CLEAR2"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"- Done Delete all Usernames List 2 🗑️",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
file_put_contents("u2", "");
}
if($data == "CLEAR3"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"- Done Delete all Usernames List 3 🗑️",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
file_put_contents("u3", "");
}
if($data == "CLEAR4"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"- Done Delete all Usernames List 4 🗑️",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
file_put_contents("u4", "");
}
if ($chat_id == $group) {
if($text == "᥀ ѕʜᴏᴡ ʟɪѕᴛ ᥀"){
bot('sendMessage', ['chat_id' => $chat_id,
'text'=>"⌁ Select button ",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text' => " Show All ~ 1",'callback_data' => "1Show"]],
[['text' => " Show All ~ 2",'callback_data' => "2Show"]],
[['text' => " Show All ~ 3",'callback_data' => "3Show"]],
[['text' => " Show All ~ 4",'callback_data' => "4Show"]],
[['text'=>"->",'callback_data'=>"#Back"]],
]])]);
 
}}
if($data == "1Show"){
if(file_exists("users")){
$users = explode("\n", file_get_contents("users"));
$list = "";
$i = 1;
foreach ($users as $user) {
if ($user != "") {
$list = $list . "\n$i  ➧ @$user";
$i++;}}
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>" ⌁ The All Users List 1 !  \n".$list,'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"Back",'callback_data'=>"#Back"]],
]])]);
$list = "";
}else{
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>" ⌁ No users in list 1",'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"Back",'callback_data'=>"#Back"]],
]])]);
}}
if($data == "2Show"){
if(file_exists("u2")){
$users = explode("\n", file_get_contents("u2"));
$list2 = "";
$i = 1;
foreach ($users as $user) {
if ($user != "") {
$list2 = $list2 . "\n$i  ➧ @$user";
$i++;}}
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>" ⌁ The All Users List 2  \n".$list2,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
$list2 = "";
}else{
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>" ⌁ No users in list 2",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}}
if($data == "3Show"){
if(file_exists("u3")){
$users = explode("\n", file_get_contents("u3"));
$list3 = "";
$i = 1;
foreach ($users as $user) {
if ($user != "") {
$list3 = $list3 . "\n$i  ➧ @$user";
$i++;}}
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>" ⌁ The All Users List 3   \n".$list3,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
$list3 = "";
}else{
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>" ⌁ No users in list 3",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}}
if($data == "4Show"){
if(file_exists("u4")){
$users = explode("\n", file_get_contents("u4"));
$list4 = "";
$i = 1;
foreach ($users as $user) {
if ($user != "") {
$list4 = $list4 . "\n$i  ➧ @$user";
$i++;}}
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>" ⌁ The All Users List 4 \n".$list4,'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
$list4 = "";
}else{
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>" ⌁ No users in list 4",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}}
if($data == "STOP1"){
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Done Stoped Checker \n⌁ Checker Stoped List 1 . ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
shell_exec("pm2 stop 1.php");
}
if($data == "STOP2"){
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Done Stoped Checker  \n⌁ Checker Stoped List  2 . ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
shell_exec("pm2 stop 2.php");
}
if($data == "STOP3"){
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Done Stoped Checker  \n⌁ Checker Stoped List  3 . ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
shell_exec("pm2 stop 3.php");
}
if($data == "STOP4"){
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Done Stoped Checker \n⌁ Checker Stoped List  4 . ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
shell_exec("pm2 stop 4.php");
}
if ($chat_id == $group) {
if($text == "᥀ ʀᴜɴ ~ ѕᴛᴏᴘ ᥀"){
bot('sendMessage', ['chat_id' => $chat_id,
'text'=>"⌁ Select button",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text' => "⌁ Run  1",'callback_data' => "1Run"],['text' => "⌁ Stop  1",'callback_data' => "STOP1"]],
[['text' => "⌁ Run  2",'callback_data' => "2Run"],['text' => "⌁ Stop  2",'callback_data' => "STOP2"]],
[['text' => "⌁ Run  3",'callback_data' => "3Run"],['text' => "⌁ Stop  3",'callback_data' => "STOP3"]],
[['text' => "⌁ Run  4",'callback_data' => "4Run"],['text' => "⌁ Stop  4",'callback_data' => "STOP4"]],
]])]);
}}
if($data == "1Run"){
	unlink('xa');
	shell_exec("pm2 stop 1.php");
shell_exec("pm2 start 1.php");
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Run Checker 1 . ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}
if($data == "2Run"){
	unlink('xb');
shell_exec("pm2 stop 2.php");
shell_exec("pm2 start 2.php");
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Run Checker 2 . ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}
if($data == "3Run"){
	unlink('xc');
shell_exec("pm2 stop 3.php");
shell_exec("pm2 start 3.php");
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Run Checker 3 . ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}
if($data == "4Run"){
	unlink('xd');
shell_exec("pm2 stop 4.php");
shell_exec("pm2 start 4.php");
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Run Checker 4 . ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
}
if ($chat_id == $group) {
if($text == "᥀ ᴀᴅᴅ ᴅᴇʟᴇᴛ ~ ᴜѕᴇʀ ᥀"){
bot('sendMessage', ['chat_id' => $chat_id,
'text'=>"Select button",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text' => "⌁ List 📜 1",'callback_data' => "#1"],['text' => "⌁ List 🗑 1",'callback_data' => "1#"]],
[['text' => "⌁ List 📜 2",'callback_data' => "#2"],['text' => "⌁ List 🗑 2",'callback_data' => "2#"]],
[['text' => "⌁ List 📜 3",'callback_data' => "#3"],['text' => "⌁ List 🗑 3",'callback_data' => "3#"]],
[['text' => "⌁ List 📜 4",'callback_data' => "#4"],['text' => "⌁ List 🗑 4",'callback_data' => "4#"]],
]])]);
}}if ($chat_id == $group) {
if($text == "/Delet"){
bot('sendMessage', ['chat_id' => $chat_id,
'text'=>"⌁ Done Delet all Lists",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"->",'callback_data'=>"#Back"]],
]])]);
unlink('type');
unlink('type2');
unlink('type3');
unlink('type4');
unlink('users');
unlink('u2');
unlink('u3');
unlink('u4');

}}
if($data == "#1"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Send List 1 ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
file_put_contents('mode', 'addL');
}
if($data == "#2"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Send List 2 ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
file_put_contents('mode', 'ad2');
}
if($data == "#3"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Send List 3 ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
file_put_contents('mode', 'ad3');
}
if($data == "#4"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Send List 4 ",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#Back"]],]])]);
file_put_contents('mode', 'ad4');
}
$info = json_decode(file_get_contents('info.json'),true);
$S1 = explode("\n",file_get_contents("users"));
$S2 = explode("\n",file_get_contents("u2"));
$S3 = explode("\n",file_get_contents("u3"));
$S4 = explode("\n",file_get_contents("u4"));
$Sum1 = count($S1)-1;
$Sum2 = count($S2)-1;
$Sum3 = count($S3)-1;
$Sum4 = count($S4)-1;
$F = $Sum1+$Sum2+$Sum3+$Sum4;
$info["USERS"] = "$F";
file_put_contents('info.json', json_encode($info));
$sum = $info["USERS"];
$num1 = $info["num1"];
$num2 = $info["num2"];
$num3 = $info["num3"];
$num4 = $info["num4"];
////////
if($data == "1#"){
bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Send List 1.",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#CH1"]],]])]);
file_put_contents('mode', 'Unpin');
}
if($data == "2#"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Send List 2 .",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#CH2"]],]])]);
file_put_contents('mode', 'Unpin2');
}
if($data == "3#"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Send List  3 .",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#CH3"]],]])]);
file_put_contents('mode', 'Unpin3');
}
if($data == "4#"){
 bot('editMessagetext',['chat_id'=>$chat_id2,'message_id'=>$message_id,'text'=>"⌁ Send List  4 .",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"->",'callback_data'=>"#CH4"]],]])]);
file_put_contents('mode', 'Unpin4');
}
$in = json_decode(file_get_contents('in.json'),true);
$loop1 = $in["loop1"];
$loop2 = $in["loop2"];
$loop3 = $in["loop3"];
$loop4 = $in["loop4"];
if ($chat_id == $group) {
if($text == '᥀ ᴄʟɪᴄᴋѕ ᥀'){
bot('sendMessage', ['chat_id' => $chat_id,
'text'=>"~ All Clicks ~",
'reply_markup'=>json_encode(['inline_keyboard'=>[
[['text'=>"1  { $loop1 }",'callback_data'=>"U"],['text'=>"2  { $loop2 }",'callback_data'=>"U"]],
[['text'=>"3  { $loop3 }",'callback_data'=>"U"],['text'=>"4  { $loop4 }",'callback_data'=>"U"]],
]])]);
}}
$lastupdid = $update['result'][0]['update_id'] + 1; 
}
while (true) {
global $last_up;
$get_up = getupdates($last_up + 1);
$last_up = $get_up['update_id'];
if ($get_up) {
run($get_up);
}
}
?>