# CAIH SMS API PHP Client

Unofficial library for send SMS messages with [China-ASEAN Information Harbor](http://www.caih.com) SMS API from applications written with PHP.

- [Installation](#installation)
  - [Install the Package](#install-the-package)
  - [Set the Token](#set-the-token)
  - [Set the Channel Key](#set-the-channel-key)
- [Usages](#usages)
  - [Send a SMS Message](#send-a-sms-message)
  - [Check the Status of SMS Message](#check-the-status-of-sms-message)
  - [Batch Send SMS Message](#batch-send-sms-message)
  - [Batch Check SMS Message](#batch-check-sms-message)
- [Contributing](#contributing)

---

## Installation

### Install the Package

Install caih-sms-php with composer by following command:

```bash
composer require yusufthedragon/caih-sms-php
```

or add it manually in your `composer.json` file.

### Set the Token

Configure package with your token obtained from CAIH.

```php
\YusufTheDragon\CAIH\SMS::setToken('token');
```

### Set the Channel Key

Configure package with your channel key obtained from CAIH.

```php
\YusufTheDragon\CAIH\SMS::setChannelKey('channelKey');
// or chain it with setToken method
\YusufTheDragon\CAIH\SMS::setToken('token')->setChannelKey('channelKey');
```

## Usages

### Send a SMS Message

Send a single SMS request to specific number.

```php
\YusufTheDragon\CAIH\SMS::send(array $parameters);
```

Usage example:

```php
$sendSMS = \YusufTheDragon\CAIH\SMS::send([
    'toNumber' => '6282147218942',
    'message' => 'Test Message',
    'requestId' => time()
]);
var_dump($sendSMS);
```

### Check the Status of SMS Message

Check the sending status of SMS message.

```php
\YusufTheDragon\CAIH\SMS::queryStatus(array $parameters);
```

Usage example:

```php
$checkSMS = \YusufTheDragon\CAIH\SMS::queryStatus([
    'messageId' => '1329851774301548544',
    'toNumber' => '6282147218942'
]);
var_dump($checkSMS);
```

### Batch Send SMS Messages

Send SMS messages in batches.

```php
\YusufTheDragon\CAIH\SMS::batchSend(array $parameters);
```

Usage example:

```php
$batchSendSMS = \YusufTheDragon\CAIH\SMS::batchSend([
    'requestId' => time(),
    'batchToNumber' => [
        '6282147218942',
        '6282147218943',
        '6282147218944'
    ],
    'batchMessage' => [
        'Test SMS 1',
        'Test SMS 2',
        'Test SMS 3'
    ]
]);
var_dump($batchSendSMS);
```

### Batch Check SMS Messages

Check the sending status of SMS messages in batches.

```php
\YusufTheDragon\CAIH\SMS::batchQueryStatus(array $parameters);
```

Usage example:

```php
$batchQueryStatus = \YusufTheDragon\CAIH\SMS::batchQueryStatus([
    'requestId' => '160595797880071',
    'batchToNumber' => [
        '6282147218942',
        '6282147218943',
        '6282147218944'
    ],
    'batchMessageId' => [
        '910471603446566431',
        '910471603446566432',
        '910471603446566433'
    ]
]);
var_dump($batchQueryStatus);
```

## Contributing

For any requests, bugs, or comments, please open an [issue](https://github.com/yusufthedragon/caih-sms-php/issues) or [submit a pull request](https://github.com/yusufthedragon/caih-sms-php/pulls).
