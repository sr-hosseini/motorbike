<?php
namespace Test\MotorBike;

use Phalcon\Test\UnitTestCase as PhalconTestCase;
use Phalcon\Mvc\Model\Manager;
use Phalcon\Mvc\Model\Metadata\Files;

/**
 * Description of TestUnitTest
 *
 * @author sr_hosseini
 */
abstract class UnitTestCase extends PhalconTestCase
{
    /**
     *
     * @var \Phalcon\Di
     */
    protected $di;

    public function setUp()
    {
        $this->di = $this->getDI();
        $config = $this->di->get('config');
        
//        // Load any additional services that mock some methods to prevent database unwanted changes
//        $this->di->set('modelsManager', new Manager());
//        $this->di->set('modelsMetadata', new Files(array('metaDataDir' => $config->application->testsMetadataDir)));
//        $con = $this->getMock('\\Phalcon\\Db\\Adapter\\Pdo\\Mysql', array('getDialect', 'query', 'execute'), array(),'',false);
//        $this->dialect = $this->getMock('\\Phalcon\\Db\\Dialect\\Mysql', array('select'), array(), '', false);
//        $results = $this->getMock('\\Phalcon\\Db\\Result\\Pdo', array('numRows', 'setFetchMode', 'fetchall', 'create'), array(), '', false);
//        $results->expects($this->any())
//            ->method('numRows')
//            ->will($this->returnValue(10));
//
//        $results->expects($this->any())
//            ->method('create')
//            ->willReturn(true);
//
//        $results->expects($this->any())
//            ->method('fetchall')
//            ->will($this->returnValue(0));
//
//        $this->dialect->expects($this->any())
//            ->method('select');
//
//        $con->expects($this->any())
//            ->method('getDialect')
//            ->will($this->returnValue($this->dialect));
//
//        $con->expects($this->any())
//            ->method('query')
//            ->will($this->returnValue($results));
//
//        $con->expects($this->any())
//            ->method('execute');
//
//        $this->di->set('db', $con);

//        parent::setUp($this->di);

        $this->_loaded = true;
    }

    /**
     * Check if the test case is setup properly
     *
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct()
    {
        if (!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError('Please run parent::setUp().');
        }
    }
}
