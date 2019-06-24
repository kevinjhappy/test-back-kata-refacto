<?php

final class Site
{
    private $id;
    private $url;

    public function __construct($id, $url)
    {
        $this->id = $id;
        $this->url = $url;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
}
