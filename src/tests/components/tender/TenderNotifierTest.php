<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 29.11.17
 */

use app\components\tender\TenderNotifier;
use app\entity\tender\TenderEntity;

/**
 * Class TenderNotifierTest
 *
 * @covers TenderNotifier
 */
class TenderNotifierTest extends \app\tests\components\base\BaseTestCase
{
    /** @todo improve tests */

    /**
     * @test
     */
    public function testCheckTerminateStatusTenderStatusEqual(): void
    {
        $old = file_get_contents(__DIR__ . '/data/tender/cancel/status-equal/old.json');
        $new = file_get_contents(__DIR__ . '/data/tender/cancel/status-equal/new.json');
        $oTender = new TenderEntity(json_decode($old, 1), 'data');
        $nTender = new TenderEntity(json_decode($new, 1), 'data');
        $tenderNotifier = new TenderNotifier($oTender, $nTender);
        $data = $this->invokeMethod($tenderNotifier, 'checkTerminateStatus');
        $this->assertEmpty($data);
    }

    /**
     * @test
     */
    public function testCheckTerminateStatusLotStatusEqual(): void
    {
        $old = file_get_contents(__DIR__ . '/data/lot/cancel/status-equal/old.json');
        $new = file_get_contents(__DIR__ . '/data/lot/cancel/status-equal/new.json');
        $oTender = new TenderEntity(json_decode($old, 1), 'data');
        $nTender = new TenderEntity(json_decode($new, 1), 'data');
        $tenderNotifier = new TenderNotifier($oTender, $nTender);
        $data = $this->invokeMethod($tenderNotifier, 'checkTerminateStatus');
        $this->assertEmpty($data);
    }

    /**
     * @test
     */
    public function testCheckTerminateStatusTenderStatusChange(): void
    {
        $old = file_get_contents(__DIR__ . '/data/lot/cancel/status-change/old.json');
        $new = file_get_contents(__DIR__ . '/data/lot/cancel/status-change/new.json');
        $oTender = new TenderEntity(json_decode($old, 1), 'data');
        $nTender = new TenderEntity(json_decode($new, 1), 'data');
        $tenderNotifier = new TenderNotifier($oTender, $nTender);
        $data = $this->invokeMethod($tenderNotifier, 'checkTerminateStatus');
        var_dump($data);
        $this->assertNotEmpty($data);
    }

    /**
     * @test
     */
    public function testCheckTerminateStatusLotStatusChange(): void
    {
        $old = file_get_contents(__DIR__ . '/data/lot/cancel/status-change/old.json');
        $new = file_get_contents(__DIR__ . '/data/lot/cancel/status-change/new.json');
        $oTender = new TenderEntity(json_decode($old, 1), 'data');
        $nTender = new TenderEntity(json_decode($new, 1), 'data');
        $tenderNotifier = new TenderNotifier($oTender, $nTender);
        $data = $this->invokeMethod($tenderNotifier, 'checkTerminateStatus');
        $this->assertNotEmpty($data);
    }

}
