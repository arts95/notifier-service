<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 20.11.17
 */

namespace app\entity\base;


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

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->author = new OrganizationEntity($data, 'author');
    }


}