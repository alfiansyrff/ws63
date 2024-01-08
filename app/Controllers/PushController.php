<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PushController extends BaseController
{
    function sentMessage($fields)
    {
        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Basic ' . env(REST_API_KEY)));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    function prepareDummyMessage($nim)
    {

        $fields = array(
            'app_id' => env(ONE_SIGNAL_APP_ID),
            'filters' => array(array("field" => "tag", "key" => "nim", "relation" => "=", "value" => "$nim")),
            "template_id" => "42e6434d-4e55-4ac9-8272-5de13d219498"
        );

        return $this->sentMessage($fields);
    }

    function prepareMessageToNim($nim, $title, $message, $data = null)
    {
        $content = array(
            "en" => "$message"
        );

        $heading = array(
            "en" => "$title"
        );

        $group_message = array(
            "en" => "$[notif_count] $title"
        );

        $fields = array(
            'app_id' => env(ONE_SIGNAL_APP_ID),
            'filters' => array(array("field" => "tag", "key" => "nim", "relation" => "=", "value" => "$nim")),
            'contents' => $content,
            'headings' => $heading,

             // Icon disesuaikan
            'small_icon' => 'capifix',
            'large_icon' => 'capifix',


            // Deprecated, max cuma sampe andoroid 8
            'android_sound' => 'capinurul',
            'android_group' => $title,
            'android_group_message' => $group_message,
            'data' => $data
        );

        if ($title = "Location Tracking Request") {
            $fields['ttl'] = 15;
        }

        return $this->sentMessage($fields);
    }

    function prepareMessageToSegment($segment, $title, $message, $data = null)
    {
        $content = array(
            "en" => "$message"
        );

        $heading = array(
            "en" => "$title"
        );

        $group_message = array(
            "en" => "$[notif_count] $title"
        );

        $fields = array(
            'app_id' => env(ONE_SIGNAL_APP_ID),
            'included_segments' => array("$segment"),
            'excluded_segments' => array("AVOID"),
            'contents' => $content,
            'headings' => $heading,
            // Icon disesuaikan
            'small_icon' => 'capifix', 
            'large_icon' => 'capifix',
            // Deprecated, max cuma sampe andoroid 8
            'android_sound' => 'capinurul',

            'android_group' => $title,
            'android_group_message' => $group_message,
            'data' => $data,
        );

        return $this->sentMessage($fields);
    }
}
