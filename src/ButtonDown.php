<?php

namespace Travis;

class ButtonDown
{
    /**
     * Make an API request.
     *
     * @param   string  $token
     * @param   string  $method
    * @param   string  $type
     * @param   array   $arguments
     * @param   int     $timeout
     * @return  array
     */
    public static function run($token, $method, $type, $arguments = [], $timeout = 30)
    {
        // set endpoint
        $url = 'https://api.buttondown.email/v1/'.$method.'?'.http_build_query($arguments);

        // set headers
        $headers = [
            'Authorization: Token '.$token,
        ];

        // make curl request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        if (in_array(strtoupper($type), ['POST', 'PUT']))
        {
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arguments));
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($type));
        $response = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // catch errors...
        if (curl_errno($ch))
        {
            #$errors = curl_error($ch);

            $result = false;
        }

        // else if NO errors...
        else
        {
            // decode
            $result = json_decode($response);
        }

        // close
        curl_close($ch);

        // return
        return $result;
    }
}