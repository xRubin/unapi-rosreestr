<?php

namespace unapi\rosreestr\online_request;

class RosreestrOnlineRequestClient extends \GuzzleHttp\Client
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $config['base_uri'] = 'https://rosreestr.ru/wps/portal/p/cc_ib_portal_services/online_request';
        $config['cookies'] = true;
        $config['verify'] = false;

        parent::__construct($config);
    }
}