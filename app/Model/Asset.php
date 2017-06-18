<?php

namespace QKidsDemo\Model;

/**
 * Class Asset
 * @package QKidsDemo\Model
 */
class Asset
{
    protected $id;
    protected $name;
    protected $thumbnail;
    protected $inFavorites;

    /**
     * Asset constructor.
     * @param $id int
     * @param $name string
     * @param $thumbnail string
     * @param $inFavorites bool
     */
    public function __construct($id, $name, $thumbnail, $inFavorites)
    {
        $this->id = $id;
        $this->name = $name;
        $this->thumbnail = $thumbnail;
        $this->inFavorites = $inFavorites;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @return bool
     */
    public function isInFavorites()
    {
        return $this->inFavorites;
    }
}