<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BenificiariesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BenificiariesTable Test Case
 */
class BenificiariesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BenificiariesTable
     */
    public $Benificiaries;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Benificiaries'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Benificiaries') ? [] : ['className' => BenificiariesTable::class];
        $this->Benificiaries = TableRegistry::getTableLocator()->get('Benificiaries', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Benificiaries);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
