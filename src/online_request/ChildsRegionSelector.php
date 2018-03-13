<?php

namespace unapi\rosreestr\online_request;

use GuzzleHttp\ClientInterface;

class ChildsRegionSelector
{
    protected $client;
    protected $parentId;
    protected $settlement_type;
    protected $add_settlement_type;
    protected $_list;

    public function __construct(ClientInterface $client, string $parentId, $settlement_type = null, $add_settlement_type = 'true')
    {
        $this->client = $client;
        $this->parentId = $parentId;
        $this->settlement_type = $settlement_type;
        $this->add_settlement_type = $add_settlement_type;
    }

    public function getList(): array
    {
        if (null === $this->_list) {
            $this->_list = [];
            $response = $this->client->request('GET', '/wps/PA_RRORSrviceExtended/Servlet/ChildsRegionController', [
                'query' => [
                    'parentId' => $this->parentId,
                    'settlement_type' => $this->settlement_type,
                    'add_settlement_type' => $this->add_settlement_type,
                ]
            ]);

            foreach (explode('\r\n', $response->getBody()->getContents()) as $line)
            {
                list($value, $name) = explode(';', $line, 2);
                $this->_list[$value] = $name;
            }
        }
        
        return $this->_list;
    }
}