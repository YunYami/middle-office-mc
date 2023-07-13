<?php

namespace Gupo\MiddleOfficeMc\App;

use Gupo\MiddleOffice\Utils\Utils;
use Gupo\MiddleOffice\Config\Config;
use Gupo\MiddleOffice\Clients\Client;
use Gupo\MiddleOffice\VO\RequestHeader;
use GuzzleHttp\Exception\GuzzleException;
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
     * @throws ClientException
     */
    public function __construct()
    {
        parent::__construct(new Config());
    }

    /**
     * 发送消息
     *
     * @param $body
     * @param $endpoint
     * @param  array  $headerExtra
     * @return mixed
     * @throws ClientException
     * @throws GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-28 16:58
     */
    public function sendMsg($body, $endpoint, array $headerExtra = [])
    {
        $header = new RequestHeader($this->config, $body, $this->config->appId);

        return $this->callApiPost($header->getHeader($headerExtra), $body, $endpoint . 'openapi/v1/message/send');
    }

    /**
     * 查询消息发送状态
     *
     * @param $messageUUID
     * @param $endpoint
     * @param  array  $extra
     * @param  array  $headerExtra
     * @return mixed
     * @throws CenterException
     * @throws ClientException
     * @throws GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-28 17:33
     */
    public function queryMessageResult($messageUUID, $endpoint, array $extra = [], array $headerExtra = [])
    {
        if (Utils::isUnset($messageUUID) || Utils::empty_($messageUUID)) {
            throw new CenterException(CenterErrorInfo::MISSING_MESSAGE_UUID);
        }
        $body = array_merge(['uuid' => $messageUUID], $extra);
        $header = new RequestHeader($this->config, $body, $this->config->appId);

        return $this->callApiPost($header->getHeader($headerExtra), $body, $endpoint . 'openapi/v1/message/sendStatus');
    }

    /**
     * 获取站内信列表
     *
     * @param $channelUserSign
     * @param $endpoint
     * @param  array  $extra
     * @param  array  $headerExtra
     * @return mixed
     * @throws CenterException
     * @throws ClientException
     * @throws GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-06-28 17:37
     */
    public function getInternalMsgList($channelUserSign, $endpoint, array $extra = [], array $headerExtra = [])
    {
        if (Utils::isUnset($channelUserSign) || Utils::empty_($channelUserSign)) {
            throw new CenterException(CenterErrorInfo::MISSING_CHANNEL_USER_SIGN);
        }
        $body = array_merge(['channel_user_sign' => $channelUserSign], $extra);
        $header = new RequestHeader($this->config, $body, $this->config->appId);

        return $this->callApiPost($header->getHeader($headerExtra), $body, $endpoint . 'openapi/v1/message/list');
    }

    /**
     * 批量发送同一模板不同消息
     *
     * @param $body
     * @param $endpoint
     * @param  array  $headerExtra
     * @return mixed
     * @throws ClientException
     * @throws GuzzleException
     * @author Wumeng wumeng@gupo.onaliyun.com
     * @since 2023-07-13 14:06
     */
    public function sendBatchDiffMsg($body, $endpoint, array $headerExtra = [])
    {
        $header = new RequestHeader($this->config, $body, $this->config->appId);

        return $this->callApiPost($header->getHeader($headerExtra), $body, $endpoint . 'openapi/v1/message/send-batch-diff');
    }
}
