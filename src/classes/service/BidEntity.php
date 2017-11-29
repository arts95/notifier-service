<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 24.11.17
 */

namespace app\entity\service;


/**
 * Class BidEntity
 *
 * @package app\entity\service
 */
class BidEntity
{
    protected $id;
    protected $status;
    /**
     * @var LotValueEntity[]
     */
    protected $lotValues;

    /**
     * BidEntity constructor.
     *
     * @param string|null $id
     * @param string|null $status
     * @param array|null $lotValues
     */
    public function __construct(?string $id, ?string $status, ?array $lotValues = [])
    {
        $this->id = $id;
        $this->status = $status;
        if (!empty($lotValues)) {
            foreach ($lotValues as $lotValue) {
                $this->lotValues[] = new LotValueEntity($lotValue['lotID'] ?? null, $lotValue['status'] ?? null);
            }
        }
    }

    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return LotValueEntity[]
     */
    public function getLotValues(): array
    {
        return $this->lotValues;
    }

    /**
     * @return array
     */
    public function getLotIds(): array
    {
        if (empty($this->lotValues)) return [];
        $lotIDs = [];
        foreach ($this->getLotValues() as $lotValue) {
            if ($lotValue->getLotID()) {
                $lotIDs[] = $lotValue->getLotID();
            }
        }
        return $lotIDs;
    }
}