<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 23.11.17
 */

namespace app\components\base;


use app\entity\auction\AuctionEntity;
use app\entity\service\EventEntity;
use app\entity\tender\TenderEntity;
use app\services\AuctionService;
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
    /**
     * @var EventEntity[]
     */
    protected $events;

    public function notify(object $object): bool
    {
        /** @todo make email, cabinet, phone notify */
        return true;
    }

    /**
     * @return EventEntity[]
     */
    protected function questions(): array
    {
        $data = $this->getQuestions();
        $events = [];
        $events += $this->newQuestions($data['newQuestions']);
        $events += $this->newAnswerOnQuestions($data['newAnswerOnQuestions']);
        return $events;
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

    /**
     * @param array $questions
     * @return EventEntity[]
     */
    protected function newQuestions($questions): array
    {
        if (empty($questions)) return null;
        $events = [];
        /** @todo set event id */
        $events[] = new EventEntity('', $this->service->getOwnerOfPurchase(), [
            'purchase' => $this->nPurchase,
        ]);
        return $events;
    }

    /**
     * @param array $questions
     * @return EventEntity[]
     */
    protected function newAnswerOnQuestions($questions): array
    {
        if (empty($questions)) return [];
        $requesters = $this->service->getRequesters();
        if (empty($requesters)) return [];
        $events = [];
        foreach ($requesters as $requester) {
            /** @todo set event id */
            /** @todo grab answers for one requester */
            $events[] = new EventEntity('', $requester, [
                'purchase' => $this->nPurchase,
            ]);
        }
        return $events;
    }
}