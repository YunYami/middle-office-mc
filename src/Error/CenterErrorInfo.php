<?php

namespace Gupo\MiddleOfficeMc\Error;

use Gupo\MiddleOffice\Error\ErrorInfo;

/**
 * Class CenterErrorInfo
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 * @since: 2023-06-28 17:31
 */
class CenterErrorInfo extends ErrorInfo
{
    public const MISSING_MESSAGE_UUID = 'missing message uuid';

    public const MISSING_CHANNEL_USER_SIGN = 'missing channel user sign';
}
