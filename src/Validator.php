<?php

/**
 * Validator.php
 *
 * @category Class
 * @package  YusufTheDragon\CAIH
 *
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */

namespace YusufTheDragon\CAIH;

use YusufTheDragon\CAIH\Exceptions\InvalidChannelKeyException;
use YusufTheDragon\CAIH\Exceptions\InvalidResponseException;
use YusufTheDragon\CAIH\Exceptions\InvalidTokenException;

/**
 * Class Validator
 *
 * @category Class
 * @package  YusufTheDragon\CAIH
 *
 * @author   Yusuf Ardi <yusufardi96@gmail.com>
 * @license  https://opensource.org/licenses/GPL-3.0 GPL-3.0-only License
 */
class Validator
{
    /**
     * List of invalid API response codes.
     *
     * @var array
     */
    private static $invalidResponseCode = [
        '00001' => 'System Internal Error',
        '00002' => 'Invalid Request Parameter',
        '00003' => 'Unauthorized Information',
        '00004' => 'The API Exceeds the Access Frequency Limit',
        '00005' => 'The API Call Returns an Exception',
        '02001' => 'Number is Wrong',
        '02002' => 'Send Failure',
        '03001' => 'Query Failure',
        '99003' => 'SMS Send Failed'
    ];

    /**
     * Check if Channel Key is not null or empty.
     *
     * @return self
     *
     * @throws InvalidChannelKeyException
     */
    public static function validateChannelKey() : self
    {
        if (SMS::$channelKey === null || SMS::$channelKey === '') {
            throw new InvalidChannelKeyException('Channel Key is Invalid.', 403);
        }

        return new self();
    }

    /**
     * Check if required parameters are exist.
     *
     * @param  array  $parameters
     * @param  array  $requiredParameters
     *
     * @return self
     *
     * @throws \InvalidArgumentException
     */
    public static function validateRequirement(array $parameters, array $requiredParameters) : self
    {
        foreach ($requiredParameters as $requiredParameter) {
            if (!isset($parameters[$requiredParameter])) {
                throw new \InvalidArgumentException("${requiredParameter} is required.");
            }
        }

        return new self();
    }

    /**
     * Check if response code is invalid.
     *
     * @param  object  $parameters
     *
     * @return void
     *
     * @throws InvalidResponseException
     */
    public static function validateResponse(object $parameters) : void
    {
        $responseCode = $parameters->respCode;

        if (in_array($responseCode, array_flip(self::$invalidResponseCode))) {
            throw new InvalidResponseException(self::$invalidResponseCode[$responseCode], 500);
        }
    }

    /**
     * Check if Token is not null or empty.
     *
     * @return void
     */
    public static function validateToken() : void
    {
        if (SMS::$token === null || SMS::$token === '') {
            throw new InvalidTokenException('Token is Invalid.', 403);
        }
    }

    /**
     * Check if parameters have correct variable type.
     *
     * @param  array  $parameters
     * @param  array  $typeParameters
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public static function validateType(array $parameters, array $typeParameters) : void
    {
        foreach ($typeParameters as $key => $typeParameter) {
            if (isset($parameters[$key])) {
                if (gettype($parameters[$key]) !== $typeParameter) {
                    throw new \InvalidArgumentException("'{$key}' must be {$typeParameter}.");
                }
            }
        }
    }
}
