<?php

namespace unapi\rosreestr\online_request;

class RosreestrOnlineRequestCadastreLinkDto
{
    /** @var string */
    protected $url;
    /** @var string */
    protected $address;
    /** @var string */
    protected $number;

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     * @return RosreestrOnlineRequestCadastreLinkDto
     */
    public function setUrl(string $url): RosreestrOnlineRequestCadastreLinkDto
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return RosreestrOnlineRequestCadastreLinkDto
     */
    public function setAddress(string $address): RosreestrOnlineRequestCadastreLinkDto
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return RosreestrOnlineRequestCadastreLinkDto
     */
    public function setNumber(string $number): RosreestrOnlineRequestCadastreLinkDto
    {
        $this->number = $number;
        return $this;
    }
}