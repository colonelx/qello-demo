<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 6/17/17
 * Time: 10:10 AM
 */

namespace QKidsDemo\Model;


class Asset
{
    protected $id;
    protected $name;
    protected $thumbnail;
    protected $inFavorites;

    public function __construct($id, $name, $thumbnail, $inFavorites)
    {
        $this->id = $id;
        $this->name = $name;
        $this->thumbnail = $thumbnail;
        $this->inFavorites = $inFavorites;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    public function isInFavorites()
    {
        return $this->inFavorites;
    }
}