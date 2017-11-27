<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


/**
 * Class QuestionEntity
 *
 * @package app\entity\base
 */
class QuestionEntity extends BaseEntity
{
    protected $id;
    protected $author;
    protected $title;
    protected $description;
    protected $date;
    protected $answer;
    protected $questionOf;
    protected $relatedItem;
    protected $dateAnswered;

    /**
     * QuestionEntity constructor.
     *
     * @param array $data
     * @param null|string $key
     */
    public function __construct(array $data, ?string $key = null)
    {
        parent::__construct($data);
        $data = $this->getDataByKey($data, $key);
        $this->author = new OrganizationEntity($data, 'author');
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return OrganizationEntity
     */
    public function getAuthor(): OrganizationEntity
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @return mixed
     */
    public function getQuestionOf()
    {
        return $this->questionOf;
    }

    /**
     * @return mixed
     */
    public function getRelatedItem()
    {
        return $this->relatedItem;
    }

    /**
     * @return mixed
     */
    public function getDateAnswered()
    {
        return $this->dateAnswered;
    }


}