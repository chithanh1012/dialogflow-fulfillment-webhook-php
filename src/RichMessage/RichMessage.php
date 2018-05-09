<?php

namespace Dialogflow\RichMessage;

use RuntimeException;

abstract class RichMessage
{
    const API_V1 = 1;
    const API_V2 = 2;

    protected $agentVersion;
    protected $requestSource;

    protected $v2PlatformMap = [
        'unspecified' => 'PLATFORM_UNSPECIFIED',
        'facebook' => 'FACEBOOK',
        'slack' => 'SLACK',
        'telegram' => 'TELEGRAM',
        'kik' => 'KIK',
        'skype' => 'SKYPE',
        'line' => 'LINE',
        'viber' => 'VIBER',
        'google' => 'ACTIONS_ON_GOOGLE'
    ];

    protected $supportedRichMessagePlatforms = [
        'facebook', 'slack', 'telegram', 'kik', 'skype', 'line', 'viber', 'google'
    ];

    /** @var array */
    protected $payload;

    public function doesSupportRichMessage()
    {
        return in_array($this->requestSource, $this->supportedRichMessagePlatforms);
    }

    protected function setAgentVersion($agentVersion)
    {
        if($agentVersion!=self::API_V1 && $agentVersion!=self::API_V2){
            throw new RuntimeException('Invalid agent version');
        }

        $this->agentVersion = $agentVersion;

        return $this;
    }

    protected function setRequestSource($requestSource)
    {
        if($requestSource==null){
            $requestSource = 'unspecified';
        }

        $this->requestSource = $requestSource;

        return $this;
    }

    /**
     * Render response as array
     *
     * @return array
     */
    public function render()
    {
        if($this->agentVersion==self::API_V1){
            return $this->renderV1();
        }elseif($this->agentVersion==self::API_V2){
            return $this->renderV2();
        }else{
            throw new RuntimeException('Invalid agent version');
        }
    }

    /**
     * Render response as array for API V1
     *
     * @return array
     */
    protected function renderV1()
    {
    }

    /**
     * Render response as array for API V2
     *
     * @return array
     */
    protected function renderV2()
    {
    }
}