<?php

/**
 * RequestClient.php
 *
 * @category Class
 * @package  YusufTheDragon\CAIH
 *
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace YusufTheDragon\CAIH;

/**
 * Class RequestClient
 *
 * @category Class
 * @package  YusufTheDragon\CAIH
 *
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class RequestClient
{
    /**
     * Insert token to request parameters if it doesn't exist.
     *
     * @param  array  $parameters
     *
     * @return array
     */
    private static function insertToken(array $parameters) : array
    {
        if (!isset($parameters['token'])) {
            $parameters['token'] = SMS::$token;
        }

        return $parameters;
    }

    /**
     * Set request body and md5Sum before send a request to API.
     *
     * @param  array  $parameters
     *
     * @return array
     */
    private static function setRequestBody(array $parameters) : array
    {
        $requestBody = json_encode($parameters);
        $md5Sum = md5($requestBody . SMS::$channelKey);

        return [
            'md5Sum' => $md5Sum,
            'body' => $requestBody
        ];
    }

    /**
     * Send the request and process the response.
     *
     * @param  string  $httpMethod
     * @param  string  $apiEndpoint
     * @param  array  $parameters
     *
     * @return string
     */
    public static function sendRequest(string $httpMethod, string $apiEndpoint, array $parameters) : string
    {
        Validator::validateChannelKey()->validateToken();

        $parameters = self::insertToken($parameters);
        $requestBody = self::setRequestBody($parameters);

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $apiEndpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => $httpMethod,
            CURLOPT_POSTFIELDS => $requestBody['body'],
            CURLOPT_HTTPHEADER => [
                'Accept: application/json',
                'Content-Type: application/json',
                'md5Sum: ' . $requestBody['md5Sum']
            ]
        ]);

        $httpRequest = curl_exec($ch);

        curl_close($ch);

        return $httpRequest;
    }
}
