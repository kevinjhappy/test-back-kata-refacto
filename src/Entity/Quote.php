<?php

final class Quote
{
    private $id;
    private $siteId;
    private $destinationId;
    private $dateQuoted;

    public function __construct($id, $siteId, $destinationId, $dateQuoted)
    {
        $this->id = $id;
        $this->siteId = $siteId;
        $this->destinationId = $destinationId;
        $this->dateQuoted = $dateQuoted;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getSiteId()
    {
        return $this->siteId;
    }

    /**
     * @return int
     */
    public function getDestinationId()
    {
        return $this->destinationId;
    }

    /**
     * @return int
     */
    public function getDateQuoted()
    {
        return $this->dateQuoted;
    }
}
