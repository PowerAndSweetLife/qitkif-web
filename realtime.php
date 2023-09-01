<?php
session_write_close();
ignore_user_abort(false);

require_once 'application/core/DB.php'; 

function getUserMessageCount($userType) {
    if($userType === 'user')
    {
        $idUser = (int)$_GET['idUser'];
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM messages WHERE id_user=?",[$idUser], false);
    }
    else
    {
        $res = DB::customQuery("SELECT COUNT(id) AS count FROM messages",[], false);
    }
    return (int)$res->count;
}
function getLastMessage($userType) {
    if($userType === 'user')
    {
        $idUser = (int)$_GET['idUser'];
        return DB::customQuery("SELECT * FROM messages WHERE id_user=? ORDER BY id DESC LIMIT 1", [$idUser],false);
    }
    else
    {
        return DB::customQuery("SELECT * FROM messages ORDER BY id DESC LIMIT 1", [],false);
    }
}
function getUser($msg) {
    if($msg->sender === 'user')
    {
        $idUser = $msg->id_user;
        return DB::customQuery("SELECT * FROM user WHERE id=? ORDER BY id DESC LIMIT 1", [$idUser],false);
    }
    else
    {
        return DB::customQuery("SELECT * FROM `admin` ORDER BY id DESC LIMIT 1", [],false);
    }
}

//$timeout = 1;
$userType = trim($_GET['usertype']);
$messageCount = getUserMessageCount($userType);
$updated = false;
$last = null;
$oldCount = isset($_GET['count']) ? (int)$_GET['count'] : -1;
$currentCount = getUserMessageCount($userType);

if($oldCount !== -1 && $oldCount !== $currentCount) {
    $updated = true;
    $last = getLastMessage($userType);
    $last->user = getUser($last);
}

// for($i=0; $i<$timeout; $i++)
// {
//     $count = getUserMessageCount($userType);
//     if($messageCount !== $count)
//     {
//         $updated = true;
//         $last = getLastMessage($userType);
//         $last->user = getUser($userType);
//         break;
//     }
//     sleep(1);
// }
sleep(1);
echo json_encode([
    "updated" => $updated,
    "last" => $last,
    "count" => $currentCount
]);


// header('Content-Type: text/event-stream');
// header('Cache-Control: no-cache');

// require_once 'application/core/DB.php';
// $userType = trim($_GET['usertype']);
// $messageCount = getUserMessageCount($userType);

// while (true) {
//     // Chaque seconde, on envoie un évènement "ping".
//     //echo "event: ping\n";
//     //$curDate = date('d/m/Y H:i:s');
//     //echo 'data: {"time": "' . $curDate . '"}';
//     // Envoi d'un message simple à fréquence aléatoire.
//     //echo "\n\n";
  
//     $count = getUserMessageCount($userType);

//     if($messageCount !== $count)
//     {
//         $last = getLastMessage($userType);
//         $last->user = getUser($userType);
//         echo 'data: ' . json_encode(["last" => $last]) . "\n\n";
//         $messageCount = $count;
//     }
  
//     // if (!$counter) {
//     //   $curDate = date('d/m/Y H:i:s');
//     //   echo 'data: ' . json_encode(["time" => $curDate]) . "\n\n";
//     //   $counter = rand(1, 10);
//     // }
  
//     ob_end_flush();
//     flush();
  
//     // On ferme la boucle si le client a interrompu la connexion
//     // (par exemple en fermant la page)
  
//     if ( connection_aborted() ) break;
  
//     sleep(1);
// }

// function getUserMessageCount($userType) {
//     if($userType === 'user')
//     {
//         $idUser = (int)$_GET['idUser'];
//         $res = DB::customQuery("SELECT COUNT(id) AS count FROM messages WHERE id_user=?",[$idUser], false);
//     }
//     else
//     {
//         $res = DB::customQuery("SELECT COUNT(id) AS count FROM messages",[], false);
//     }
//     return (int)$res->count;
// }
// function getLastMessage($userType) {
//     if($userType === 'user')
//     {
//         $idUser = (int)$_GET['idUser'];
//         return DB::customQuery("SELECT * FROM messages WHERE id_user=? ORDER BY id DESC LIMIT 1", [$idUser],false);
//     }
//     else
//     {
//         return DB::customQuery("SELECT * FROM messages ORDER BY id DESC LIMIT 1", [],false);
//     }
// }
// function getUser($userType) {
//     if($userType === 'user')
//     {
//         $idUser = (int)$_GET['idUser'];
//         return DB::customQuery("SELECT * FROM user WHERE id=? ORDER BY id DESC LIMIT 1", [$idUser],false);
//     }
//     else
//     {
//         return DB::customQuery("SELECT * FROM `admin` ORDER BY id DESC LIMIT 1", [],false);
//     }
// }