<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 21.11.17
 */

namespace app\entity\tender;


use app\entity\base\BaseEntity;

class QualificationEntity extends BaseEntity
{
    public $id;
    public $title;
    public $description;
    public $qualified;
    public $eligible;
    public $status;
    public $cause;
    public $bidID;
    public $lotID;
    public $complaints;
    public $documents;
    public $date;

    protected function getClassNameByKey(string $key): ?string
    {
        $mapper = [
            'complaints' => 'app\entity\tender\ComplaintEntity',
            'documents' => 'app\entity\base\DocumentEntity',
        ];
        if (isset($mapper[$key])) {
            return $mapper[$key];
        }
        return null;
    }


}