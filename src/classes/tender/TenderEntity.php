<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 16.11.17
 */

namespace app\entity\tender;

use app\entity\base\BaseEntity;
use app\entity\base\item\ItemEntity;
use app\entity\tender\lot\LotEntity;

class TenderEntity extends BaseEntity
{
    protected $id;
    protected $title;
    protected $items;
    protected $lots;
    protected $contracts;

    /**
     * @return mixed
     */
    public function getContracts()
    {
        return $this->contracts;
    }

    /**
     * @return mixed
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return ItemEntity[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return LotEntity[]
     */
    public function getLots(): array
    {
        return $this->lots;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'items' => 'app\entity\base\item\ItemEntity',
            'lots' => 'app\entity\tender\lot\LotEntity',
            'questions' => 'app\entity\base\QuestionEntity',
            'contracts' => 'app\entity\tender\ContractEntity',
            'qualifications' => 'app\entity\tender\QualificationEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }

}