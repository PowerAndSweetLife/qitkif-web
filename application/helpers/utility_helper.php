<?php

function nospace($str)
{
    return str_replace(" ","",$str);
}
function now()
{
    return date('Y-m-d H:i:s');
}
function generateConfirmCode()
{
    return rand(0,9) . rand(0,9) . rand(0,9) . rand(0,9);
}
function datetimeFormat(string $date)
{
    $dt = new DateTime($date);

    return $dt->format("d/m/Y") . " à " . $dt->format("H:i");
}
function price(float $prix)
{
    return number_format($prix, 0,'.',' ');
}
function format(float $number)
{
    return number_format($number, 0,'.',' ');
}

function getOffreReference(int $id) 
{
    return 'Réf_' . str_pad($id, 5, "0", STR_PAD_LEFT);
}

function nodeUrl($uri) {
    return NODE_URL . $uri;
}

function generateSmsToken()
{
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.orange.com/oauth/v3/token');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

    $headers = array();
    $headers[] = 'Authorization: ' . AUTH_HEADER_SMS;
    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    $headers[] = 'Accept: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return json_decode($result);
} 

function sendSms(string $recipient_number, string $message)
{
    $token = generateSmsToken();

    $ch = curl_init();
    
    $dev_number = "2250000";

    $curlopt_postfields = json_encode([
        "outboundSMSMessageRequest" => [
            "address" => "tel:+{$recipient_number}",
            "senderAddress" => "tel:+{$dev_number}",
            "senderName" => "Qitkif",
            "outboundSMSTextMessage" => ["message" => $message]
        ]
    ]);
    curl_setopt($ch, CURLOPT_URL, "https://api.orange.com/smsmessaging/v1/outbound/tel%3A%2B{$dev_number}/requests");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $curlopt_postfields);

    $headers = array();
    $headers[] = "Authorization: Bearer {$token->access_token}";
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    return json_decode($result);
}

function payIn($client, $montant)
{
    /**
     * Connexion aux API de paiement ici
     * 
     */
    $momo = new Momo();
    $momo->setApiKey(API_KEY);

    $transaction = $momo
    ->collect()
    ->amount($montant)
    ->currency("XOF")
    ->from(str_replace("+","",$client->phone)) // Sender phone number with country code préfix
    ->firstName($client->firstname) // First name of the sender
    ->lastName($client->lastname)
    ->create();
    
    $status = $transaction->getStatus();
    $response = null;

    if ($status != "pending") {
        return [
            "pending" => false,
            "error" => true,
            "success" => false,
            "transaction" => $transaction->getArray(),
            "nopending" => true,
        ];
    }

    do {
        $transaction = $momo->getStatus($transaction->getReference());
        $status = $transaction->getStatus();
        if ($status == "error") {
            $response = [
                "pending" => false,
                "error" => true,
                "success" => false,
                "transaction" => $transaction->getArray()
            ];
        } else if ($status == "success") {
            $response = [
                "pending" => false,
                "error" => false,
                "success" => true,
                "transaction" => $transaction->getArray(),
            ];
        } else {
            $response = [
                "pending" => true,
                "error" => false,
                "success" => false,
                "transaction" => $transaction->getArray(),
            ];
        }
    } while ($response["pending"] == true);

    return $response;
}

function payOut($client, $montant)
{
    /**
     * Connexion aux API de paiement ici
     * 
     */
    $momo = new Momo();
    $momo->setApiKey(API_KEY);

    $transaction = $momo
    ->deposit()
    ->amount($montant)
    ->currency("XOF")
    ->to(str_replace("+","",$client->phone)) // Sender phone number with country code préfix
    ->create();
    
    $status = $transaction->getStatus();
    $response = null;

    if ($status != "pending") {
        return [
            "pending" => false,
            "error" => true,
            "success" => false,
            "transaction" => $transaction->getArray(),
            "nopending" => true,
        ];
    }

    do {
        $transaction = $momo->getStatus($transaction->getReference());
        $status = $transaction->getStatus();
        if ($status == "error") {
            $response = [
                "pending" => false,
                "error" => true,
                "success" => false,
                "transaction" => $transaction->getArray()
            ];
        } else if ($status == "success") {
            $response = [
                "pending" => false,
                "error" => false,
                "success" => true,
                "transaction" => $transaction->getArray(),
            ];
        } else {
            $response = [
                "pending" => true,
                "error" => false,
                "success" => false,
                "transaction" => $transaction->getArray(),
            ];
        }
    } while ($response["pending"] == true);

    return $response;
}

function post(string $url, array $data = [])
{
    $ch = curl_init();
    try {
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
            
        if (curl_errno($ch)) {
            echo curl_error($ch);
            die();
        }

        return json_decode($response);
    }
    catch(Throwable $th) {
        throw $th;
    }
    finally {
        curl_close($ch);
    }
}