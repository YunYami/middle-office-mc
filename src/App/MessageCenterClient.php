<?php

namespace Gupo\MiddleOfficeMc\App;

use Gupo\MiddleOffice\Utils\Utils;
use Gupo\MiddleOffice\Config\Config;
use Gupo\MiddleOffice\Clients\Client;
use Gupo\MiddleOffice\VO\RequestHeader;
use Gupo\MiddleOfficeMc\Error\CenterErrorInfo;
use Gupo\MiddleOffice\Exception\ClientException;
use Gupo\MiddleOfficeMc\Exception\CenterException;

/**
 * Class MessageCenter
 *
 * @author: Wumeng - wumeng@gupo.onaliyun.com
 * @since: 2023-06-15 16:42
 */
class MessageCenterClient extends Client
{
    /**
     * @param  Config  $config
     * @throws ClientException
     */
    public function __construct(Config $config)
    {
        parent::__construct($config);
    }

    /**
     * 发送消息
     *
     * @param $body
     * @param $appId
     * @param $endpoint
     * @return mixed
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-28 16:58
     */
    public function sendMsg($body, $appId, $endpoint)
    {
        $header = new RequestHeader($this->config, $body, $appId);

        return $this->callApiPost($header->getHeader(), $body, $endpoint . 'openapi/v1/message/send');
    }

    /**
     * 查询消息发送状态
     *
     * @param $messageUUID
     * @param $appId
     * @param $endpoint
     * @param $extra
     * @return mixed
     * @throws CenterException
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-28 17:33
     */
    public function queryMessageResult($messageUUID, $appId, $endpoint, $extra = [])
    {
        if (Utils::isUnset($messageUUID) || Utils::empty_($messageUUID)) {
            throw new CenterException(CenterErrorInfo::MISSING_MESSAGE_UUID);
        }
        $body = array_merge(['uuid' => $messageUUID], $extra);
        $header = new RequestHeader($this->config, $body, $appId);

        return $this->callApiPost($header->getHeader(), $body, $endpoint . 'openapi/v1/message/sendStatus');
    }

    /**
     * 获取站内信列表
     *
     * @param $channelUserSign
     * @param $appId
     * @param $endpoint
     * @param $extra
     * @return mixed
     * @throws CenterException
     * @throws ClientException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-28 17:37
     */
    public function getInternalMsgList($channelUserSign, $appId, $endpoint, $extra = [])
    {
        if (Utils::isUnset($channelUserSign) || Utils::empty_($channelUserSign)) {
            throw new CenterException(CenterErrorInfo::MISSING_CHANNEL_USER_SIGN);
        }
        $body = array_merge(['channel_user_sign' => $channelUserSign], $extra);
        $header = new RequestHeader($this->config, $body, $appId);

        return $this->callApiPost($header->getHeader(), $body, $endpoint . 'openapi/v1/message/list');
    }
}
