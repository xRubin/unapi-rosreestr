<?php

namespace unapi\rosreestr\online_request;

use GuzzleHttp\ClientInterface;

class SubjectSelector
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
            $doc = new \DOMDocument('1.0', 'UTF-8');
            $doc->loadHTML(
                mb_convert_encoding(
                    $response->getBody()->getContents(),
                    'HTML-ENTITIES',
                    'UTF-8'
                )
            );

            $xpath = new \DOMXPath($doc);
            $options = $xpath->query("*/select[@name='o_subject_id']/option");
            foreach ($options as $option) {
                $this->_list[$option->getAttribute('value')] = $option->nodeValue;
            }
        }

        return $this->_list;
    }
}