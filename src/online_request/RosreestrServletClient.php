<?php

namespace unapi\rosreestr\online_request;

class RosreestrServletClient extends \GuzzleHttp\Client
{
    /**
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $config['base_uri'] = 'https://rosreestr.ru';
        $config['cookies'] = true;
        $config['verify'] = false;

        parent::__construct($config);
    }
}