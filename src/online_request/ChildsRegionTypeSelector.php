<?php

namespace unapi\rosreestr\online_request;

use GuzzleHttp\ClientInterface;

class ChildsRegionTypeSelector
{
    protected $client;
    protected $parentId;
    protected $_list;

    public function __construct(ClientInterface $client, string $parentId)
    {
        $this->client = $client;
        $this->parentId = $parentId;
    }

    public function getList(): array
    {
        if (null === $this->_list) {
            $this->_list = [];
            $response = $this->client->request('GET', '/wps/PA_RRORSrviceExtended/Servlet/ChildsRegionTypesController', [
                'query' => [
                    'parentId' => $this->parentId,
                ]
            ]);

            foreach (explode("\n", $response->getBody()->getContents()) as $line)
                if (strpos($line, ';')) {
                    list($value, $name) = explode(';', $line, 2);
                    $this->_list[$value] = $name;
                }
        }
        
        return $this->_list;
    }
}