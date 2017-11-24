<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

namespace app\entity\service;

/**
 * Class RequesterEntity
 *
 * @package app\entity\service
 */
class RequesterEntity extends UserEntity
{
    /**
     * @var QuestionEntity[]
     */
    protected $questions;

    public function __construct(string $uid, string $email, array $questions)
    {
        parent::__construct($uid, $email);
        foreach ($questions as $question) {
            $this->questions[] = new QuestionEntity($question['id'] ?? null);
        }
    }

    public function getQuestionsId(): array
    {
        if (empty($this->questions)) return [];
        $qIDs = [];
        foreach ($this->questions as $question) {
            if (!$question->getId()) continue;
            $qIDs[] = $question->getId();
        }
        return $qIDs;
    }

}