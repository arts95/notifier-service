<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


/**
 * Class ContactPoint
 *
 * @package app\entity\base
 */
class ContactPoint extends BaseEntity
{
    protected $fio;
    protected $name;
    protected $name_en;
    protected $availableLanguage;
    protected $userSurname;
    protected $userPatronymic;
    protected $email;
    protected $telephone;
    protected $faxNumber;
    protected $url;

    /**
     * @return mixed
     */
    public function getFio()
    {
        return $this->fio;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getNameEn()
    {
        return $this->name_en;
    }

    /**
     * @return mixed
     */
    public function getAvailableLanguage()
    {
        return $this->availableLanguage;
    }

    /**
     * @return mixed
     */
    public function getUserSurname()
    {
        return $this->userSurname;
    }

    /**
     * @return mixed
     */
    public function getUserPatronymic()
    {
        return $this->userPatronymic;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @return mixed
     */
    public function getFaxNumber()
    {
        return $this->faxNumber;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }
}