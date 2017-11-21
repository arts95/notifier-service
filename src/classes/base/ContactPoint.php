<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


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
}