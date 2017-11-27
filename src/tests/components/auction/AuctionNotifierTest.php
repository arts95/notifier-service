<?php
/**
 * @author: Arsenii Andrieiev
 * Date: 27.11.17
 */

namespace app\tests\components\auction;

use app\components\auction\AuctionNotifier;
use app\entity\auction\AuctionEntity;
use app\entity\base\AwardEntity;
use app\entity\base\ContractEntity;
use app\tests\components\base\BaseTestCase;

/**
 * @covers AuctionNotifier
 */
final class AuctionNotifierTest extends BaseTestCase
{
    /**
     * @test
     */
    public function testGetActivatedContract(): void
    {
        $old = file_get_contents(__DIR__ . '/data/contract/old.json');
        $new = file_get_contents(__DIR__ . '/data/contract/new.json');
        $oAuction = new AuctionEntity(json_decode($old, 1), 'data');
        $nAuction = new AuctionEntity(json_decode($new, 1), 'data');
        $auctionNotifier = new AuctionNotifier($oAuction, $nAuction);
        /** @var ContractEntity|null $contract */
        $contract = $this->invokeMethod($auctionNotifier, 'getActivatedContract');
        $this->assertNotEmpty($contract);
        $this->assertNotEmpty($nAuction->getContractById($contract->getId()));
        $this->assertEquals('active', $contract->getStatus());
    }

    /**
     * @test
     */
    public function testQualificationResultEA(): void
    {
        $old = file_get_contents(__DIR__ . '/data/award/old.json');
        $new = file_get_contents(__DIR__ . '/data/award/new.json');
        $oAuction = new AuctionEntity(json_decode($old, 1), 'data');
        $nAuction = new AuctionEntity(json_decode($new, 1), 'data');
        $auctionNotifier = new AuctionNotifier($oAuction, $nAuction);
        /** @var AwardEntity[] $awards */
        $awards = $this->invokeMethod($auctionNotifier, 'getAwardsByQualificationResultEA');
        $this->assertNotEmpty($awards);
        foreach ($awards as $award) {
            $this->assertNotEmpty($nAuction->getAwardById($award->getId()));
        }
    }

    /**
     * @test
     */
    public function testChangeStatusOfAwardOnQualificationEA(): void
    {
        $old = file_get_contents(__DIR__ . '/data/award/status-changes/old.json');
        $new = file_get_contents(__DIR__ . '/data/award/status-changes/new.json');
        $oAuction = new AuctionEntity(json_decode($old, 1), 'data');
        $nAuction = new AuctionEntity(json_decode($new, 1), 'data');
        $auctionNotifier = new AuctionNotifier($oAuction, $nAuction);
        /** @var AwardEntity[] $awards */
        $awards = $this->invokeMethod($auctionNotifier, 'getAwardsByQualificationResultEA');
        $this->assertNotEmpty($awards);
        $this->assertEquals('pending.payment', $awards[0]->getStatus());
    }

    /**
     * @test
     */
    public function testGetQuestionsNewQuestion(): void
    {
        $old = file_get_contents(__DIR__ . '/data/question/question/old.json');
        $new = file_get_contents(__DIR__ . '/data/question/question/new.json');
        $oAuction = new AuctionEntity(json_decode($old, 1), 'data');
        $nAuction = new AuctionEntity(json_decode($new, 1), 'data');
        $auctionNotifier = new AuctionNotifier($oAuction, $nAuction);
        $data = $this->invokeMethod($auctionNotifier, 'getQuestions');
        $this->assertNotEmpty($data['newQuestions']);
        $this->assertCount(1, $data['newQuestions']);
    }

    /**
     * @test
     */
    public function testGetQuestionsNewQuestions(): void
    {
        $old = file_get_contents(__DIR__ . '/data/question/questions/old.json');
        $new = file_get_contents(__DIR__ . '/data/question/questions/new.json');
        $oAuction = new AuctionEntity(json_decode($old, 1), 'data');
        $nAuction = new AuctionEntity(json_decode($new, 1), 'data');
        $auctionNotifier = new AuctionNotifier($oAuction, $nAuction);
        $data = $this->invokeMethod($auctionNotifier, 'getQuestions');
        $this->assertNotEmpty($data['newQuestions']);
        $this->assertCount(2, $data['newQuestions']);
    }

    /**
     * @test
     */
    public function testGetQuestionsNewAnswer(): void
    {
        $old = file_get_contents(__DIR__ . '/data/question/answer/old.json');
        $new = file_get_contents(__DIR__ . '/data/question/answer/new.json');
        $oAuction = new AuctionEntity(json_decode($old, 1), 'data');
        $nAuction = new AuctionEntity(json_decode($new, 1), 'data');
        $auctionNotifier = new AuctionNotifier($oAuction, $nAuction);
        $data = $this->invokeMethod($auctionNotifier, 'getQuestions');
        $this->assertNotEmpty($data['newAnswerOnQuestions']);
        $this->assertCount(1, $data['newAnswerOnQuestions']);
    }

    /**
     * @test
     */
    public function testGetQuestionsNewAnswers(): void
    {
        $old = file_get_contents(__DIR__ . '/data/question/answers/old.json');
        $new = file_get_contents(__DIR__ . '/data/question/answers/new.json');
        $oAuction = new AuctionEntity(json_decode($old, 1), 'data');
        $nAuction = new AuctionEntity(json_decode($new, 1), 'data');
        $auctionNotifier = new AuctionNotifier($oAuction, $nAuction);
        $data = $this->invokeMethod($auctionNotifier, 'getQuestions');
        $this->assertNotEmpty($data['newAnswerOnQuestions']);
        $this->assertCount(2, $data['newAnswerOnQuestions']);
    }
}