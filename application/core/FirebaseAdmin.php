<?php
use sngrl\PhpFirebaseCloudMessaging\Client;
use sngrl\PhpFirebaseCloudMessaging\Message;
use sngrl\PhpFirebaseCloudMessaging\Recipient\Device;
use sngrl\PhpFirebaseCloudMessaging\Notification;

class FirebaseAdmin {

    public function createCloudMessage($deviceToken,$title,$body)
    {
        $server_key = 'AAAA4EZVn24:APA91bHKTTo-o-r_LFnL9Xwcuc9PGDJFgVrPBdYqUW14IpayYbZ55gv_zYRiSSFnZJXKPYc7jULV-2eqpPz7s7wgzHayAXU3e0c4yJhUpEkyDnwFX7_DLKZcUqz9PZ-2Q3E2EW7FlNR1';
        $client = new Client();
        $client->setApiKey($server_key);

        $message = new Message();
        $message->setPriority('high');
        $message->addRecipient(new Device($deviceToken));
        $message
            ->setNotification(new Notification($title, $body))
            ->setData(['id' => 123])
        ;
        $client->send($message);
    }
}