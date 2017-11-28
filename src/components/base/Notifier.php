<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\components\base;


use app\entity\auction\AuctionEntity;
use app\entity\tender\TenderEntity;
use app\services\AuctionService;
use app\services\BaseService;
use app\services\TenderService;

abstract class Notifier
{
    /**
     * @var AuctionEntity|TenderEntity
     */
    protected $oPurchase;
    /**
     * @var AuctionEntity|TenderEntity
     */
    protected $nPurchase;
    /**
     * @var AuctionService|TenderService
     */
    protected $service;

    public function notify(object $object): bool
    {
        /** @todo make email, cabinet, phone notify */
        return true;
    }

    /**
     * @param array|null $data
     * @param string $id
     * @return Check
     */
    protected function getEntityInfo(?array $data, string $id): Check
    {
        if (empty($data)) return new Check(null, true);
        foreach ($data as $entity) {
            if ($entity->getId() == $id) {
                return new Check($entity, false);
            }
        }
        return new Check(null, true);
    }

    protected function questions(): void
    {
        $data = $this->getQuestions();
        $this->newQuestions($data['newQuestions']);
        $this->newAnswerOnQuestions($data['newAnswerOnQuestions']);
    }

    /**
     * @return array
     */
    protected function getQuestions(): array
    {
        $newQuestions = $answeredQuestions = [];
        if (empty($this->nPurchase->getQuestions())) {
            return [
                'newQuestions' => $newQuestions,
                'newAnswerOnQuestions' => $answeredQuestions,
            ];
        }

        foreach ($this->nPurchase->getQuestions() as $question) {
            $info = $this->getEntityInfo($this->oPurchase->getQuestions(), $question->getId());
            if ($info->new) {
                $newQuestions[$question->getId()] = $question;
            } else {
                if (empty($info->entity->getAnswer()) && !empty($question->getAnswer())) {
                    $answeredQuestions[$question->getId()] = $question;
                }
            }
        }
        return [
            'newQuestions' => $newQuestions,
            'newAnswerOnQuestions' => $answeredQuestions,
        ];
    }

    /**
     * @param $questions
     * @return bool
     */
    protected function newQuestions($questions): bool
    {
        if (empty($questions)) return false;
        $this->service->getOwnerOfPurchase();
        /** @todo notify */
        /** @todo return notify info */
    }

    protected function newAnswerOnQuestions($questions)
    {
        if (empty($questions)) return false;
        $requesters = $this->service->getRequesters();
        if (empty($requesters)) return false;
        foreach ($requesters as $requester) {
            /** @todo notify */
            /** @todo grab answers for one requester */
        }
        /** @todo return notify info */
    }
}