<?php

/**
 * SMS.php
 *
 * @category Class
 * @package  YusufTheDragon\CAIH
 *
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace YusufTheDragon\CAIH;

/**
 * Class SMS
 *
 * @category Class
 * @package  YusufTheDragon\CAIH
 *
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class SMS
{
    /**
     * The Token obtained from CAIH.
     *
     * @var string
     */
    public static $token;

    /**
     * The Channel Key obtained from CAIH.
     *
     * @var string
     */
    public static $channelKey;

    /**
     * The base URL for API endpoint.
     *
     * @var string
     */
    public static $baseUrl = 'http://sms.caihcom.com';

    /**
     * Instantiate required parameters for Send SMS.
     *
     * @var array
     */
    private static $sendRequiredParameters = [
        'toNumber',
        'message',
        'requestId'
    ];

    /**
     * Instantiate required parameter types for Send SMS.
     *
     * @var array
     */
    private static $sendTypeParameters = [
        'toNumber' => 'string',
        'message' => 'string',
        'requestId' => 'string',
        'sendType' => 'string',
        'from' => 'string'
    ];

    /**
     * Instantiate required parameters for Query Status.
     *
     * @var array
     */
    private static $queryStatusRequiredParameters = [
        'messageId',
        'toNumber'
    ];

    /**
     * Instantiate required parameter types for Query Status.
     *
     * @var array
     */
    private static $queryStatusTypeParameters = [
        'messageId' => 'string',
        'toNumber' => 'string'
    ];

    /**
     * Instantiate required parameters for Batch Send SMS.
     *
     * @var array
     */
    private static $batchSendRequiredParameters = [
        'requestId',
        'batchToNumber',
        'batchMessage'
    ];

    /**
     * Instantiate required parameter types for Batch Send SMS.
     *
     * @var array
     */
    private static $batchSendTypeParameters = [
        'requestId' => 'string',
        'batchToNumber' => 'array',
        'batchMessage' => 'array'
    ];

    /**
     * Instantiate required parameters for Batch Query Status.
     *
     * @var array
     */
    private static $batchQueryStatusRequiredParameters = [
        'requestId',
        'batchToNumber',
        'batchMessageId'
    ];

    /**
     * Instantiate required parameter types for Batch Query Status.
     *
     * @var array
     */
    private static $batchQueryStatusTypeParameters = [
        'requestId' => 'string',
        'batchToNumber' => 'array',
        'batchMessageId' => 'array'
    ];

    /**
     * Set the Token.
     *
     * @param  string  $token
     *
     * @return self
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function setToken(string $token) : self
    {
        self::$token = $token;

        return new self();
    }

    /**
     * Set the Channel Key.
     *
     * @param  string  $channelKey
     *
     * @return self
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function setChannelKey(string $channelKey) : self
    {
        self::$channelKey = $channelKey;

        return new self();
    }

    /**
     * Send a single SMS request to specific number.
     *
     * @param  array  $parameters
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function send(array $parameters) : object
    {
        Validator::validateRequirement($parameters, self::$sendRequiredParameters)->validateType($parameters, self::$sendTypeParameters);

        $apiEndpoint = self::$baseUrl . '/sms/send';
        $httpRequest = RequestClient::sendRequest('POST', $apiEndpoint, $parameters);
        $response = json_decode($httpRequest);

        Validator::validateResponse($response);

        return $response;
    }

    /**
     * Check the sending status of SMS messages.
     *
     * @param  array  $parameters
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function queryStatus(array $parameters) : object
    {
        Validator::validateRequirement($parameters, self::$queryStatusRequiredParameters)->validateType($parameters, self::$queryStatusTypeParameters);

        $apiEndpoint = self::$baseUrl . '/sms/queryStatus';
        $httpRequest = RequestClient::sendRequest('POST', $apiEndpoint, $parameters);
        $response = json_decode($httpRequest);

        Validator::validateResponse($response);

        return json_decode($httpRequest);
    }

    /**
     * Send SMS messages in batches.
     *
     * @param  array  $parameters
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function batchSend(array $parameters) : object
    {
        Validator::validateRequirement($parameters, self::$batchSendRequiredParameters)->validateType($parameters, self::$batchSendTypeParameters);

        $apiEndpoint = self::$baseUrl . '/sms/batchSend';
        $httpRequest = RequestClient::sendRequest('POST', $apiEndpoint, $parameters);
        $response = json_decode($httpRequest);

        Validator::validateResponse($response);

        return json_decode($httpRequest);
    }

    /**
     * Check the sending status of SMS messages in batches.
     *
     * @param  array  $parameters
     *
     * @return object
     *
     * @throws \TypeError
     * @throws \ArgumentCountError
     */
    public static function batchQueryStatus(array $parameters) : object
    {
        Validator::validateRequirement($parameters, self::$batchQueryStatusRequiredParameters)->validateType($parameters, self::$batchQueryStatusTypeParameters);

        $apiEndpoint = self::$baseUrl . '/sms/batchQueryStatus';
        $httpRequest = RequestClient::sendRequest('POST', $apiEndpoint, $parameters);
        $response = json_decode($httpRequest);

        Validator::validateResponse($response);

        return json_decode($httpRequest);
    }
}
