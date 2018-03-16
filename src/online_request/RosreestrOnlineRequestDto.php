<?php

namespace unapi\rosreestr\online_request;

class RosreestrOnlineRequestDto
{
    /** @var string */
    protected $cadastre_number;
    /** @var string */
    protected $subject_id;
    /** @var string */
    protected $region_id;
    /** @var string */
    protected $settlement_type_id;
    /** @var string */
    protected $settlement_id;
    /** @var string */
    protected $street_type;
    /** @var string */
    protected $street;
    /** @var string */
    protected $house;
    /** @var string */
    protected $building;
    /** @var string */
    protected $structure;

    /**
     * @return string
     */
    public function getCadastreNumber(): ?string
    {
        return $this->cadastre_number;
    }

    /**
     * @param string $cadastre_number
     * @return RosreestrOnlineRequestDto
     */
    public function setCadastreNumber($cadastre_number): RosreestrOnlineRequestDto
    {
        $this->cadastre_number = $cadastre_number;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubjectId(): ?string
    {
        return $this->subject_id;
    }

    /**
     * @param string $subject_id
     * @return RosreestrOnlineRequestDto
     */
    public function setSubjectId($subject_id): RosreestrOnlineRequestDto
    {
        $this->subject_id = $subject_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegionId(): ?string
    {
        return $this->region_id;
    }

    /**
     * @param string $region_id
     * @return RosreestrOnlineRequestDto
     */
    public function setRegionId($region_id): RosreestrOnlineRequestDto
    {
        $this->region_id = $region_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSettlementTypeId(): ?string
    {
        return $this->settlement_type_id;
    }

    /**
     * @param string $settlement_type_id
     * @return RosreestrOnlineRequestDto
     */
    public function setSettlementTypeId($settlement_type_id): RosreestrOnlineRequestDto
    {
        $this->settlement_type_id = $settlement_type_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSettlementId(): ?string
    {
        return $this->settlement_id;
    }

    /**
     * @param string $settlement_id
     * @return RosreestrOnlineRequestDto
     */
    public function setSettlementId($settlement_id): RosreestrOnlineRequestDto
    {
        $this->settlement_id = $settlement_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetType(): ?string
    {
        return $this->street_type;
    }

    /**
     * @param string $street_type
     * @return RosreestrOnlineRequestDto
     */
    public function setStreetType($street_type): RosreestrOnlineRequestDto
    {
        $this->street_type = $street_type;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return RosreestrOnlineRequestDto
     */
    public function setStreet($street): RosreestrOnlineRequestDto
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getHouse(): ?string
    {
        return $this->house;
    }

    /**
     * @param string $house
     * @return RosreestrOnlineRequestDto
     */
    public function setHouse($house): RosreestrOnlineRequestDto
    {
        $this->house = $house;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuilding(): ?string
    {
        return $this->building;
    }

    /**
     * @param string $building
     * @return RosreestrOnlineRequestDto
     */
    public function setBuilding($building): RosreestrOnlineRequestDto
    {
        $this->building = $building;
        return $this;
    }

    /**
     * @return string
     */
    public function getStructure(): ?string
    {
        return $this->structure;
    }

    /**
     * @param string $structure
     * @return RosreestrOnlineRequestDto
     */
    public function setStructure($structure): RosreestrOnlineRequestDto
    {
        $this->structure = $structure;
        return $this;
    }
}