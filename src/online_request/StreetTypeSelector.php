<?php

namespace unapi\rosreestr\online_request;

use GuzzleHttp\ClientInterface;

class StreetTypeSelector
{
    protected $client;
    protected $_list;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getList(): array
    {
        if (null === $this->_list) {
            $this->_list = [];
            $response = $this->client->request('GET', '/wps/portal/p/cc_ib_portal_services/online_request');

            preg_match_all('/<select[^>]+?\"street_type\"[^>]+?>(.*?)<\/select>/ims', $response->getBody()->getContents(), $matches);
            foreach ($matches[1] as $select) {
                preg_match_all('/<option value="([^"]+)"[^>]*>(.*?)<\/option>/ims', $select, $matches2);
                foreach ($matches2[1] as $id => $key)
                    $this->_list[$key] = $matches2[2][$id];
            }
        }

        return $this->_list;
    }
}