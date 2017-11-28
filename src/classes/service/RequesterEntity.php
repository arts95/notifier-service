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
    /**
     * @var ComplaintEntity[]
     */
    protected $complaints;

    public function __construct(string $uid, string $email, array $questions, array $complaints)
    {
        parent::__construct($uid, $email);
        if (!empty($questions)) {
            foreach ($questions as $question) {
                $this->questions[] = new QuestionEntity($question['id'] ?? null);
            }
        }
        if (!empty($complaints)) {
            foreach ($complaints as $complaint) {
                $this->complaints[] = new ComplaintEntity($complaint['id'] ?? null, $complaint['status'] ?? null);
            }
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

    /**
     * @return QuestionEntity[]
     */
    public function getQuestions(): array
    {
        return $this->questions;
    }

    /**
     * @return ComplaintEntity[]
     */
    public function getComplaints(): array
    {
        return $this->complaints;
    }
}