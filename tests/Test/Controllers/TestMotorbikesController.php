<?php

namespace Test\MotorBike;

use Phalcon\Http\Request;
use Phalcon\Mvc\Application;
use MotorBike\Auth\Auth;
use Phalcon\Security;

/**
 * Class UnitTest
 *
 * @author sr_hosseini
 */
class TestMotorbikesController extends UnitTestCase {

    /**
     * Mocking authentication class methods to simulate authorized user
     */
    private function autheticate()
    {
        $mocked_auth = $this->getMock(
                '\\MotorBike\\Auth\\Auth',
                array('hasIdentity', 'getIdentity'),
                array(),'',false
        );

        $mocked_auth->expects($this->any())
                ->method('hasIdentity')
                ->willReturn(true);

        $mocked_auth->expects($this->any())
                ->method('getIdentity')
                ->willReturn(array(
                        'id' => 1,
                        'name' => "test-user"
                ));
        
        $this->di->set('auth', $mocked_auth);
    }

    /**
     * Mocking security class methods to pass form csrf
     */
    private function handleCsrf()
    {
        $token = 'somethings';

        $mocked_security = $this->getMock(
                '\\Phalcon\\Security',
                array('getToken', 'getSessionToken'),
                array(),'',false
        );

        $mocked_security->expects($this->any())
                ->method('getToken')
                ->willReturn($token);

        $mocked_security->expects($this->any())
                ->method('getSessionToken')
                ->willReturn($token);

        $this->di->set('security', $mocked_security);

        return $token;
    }
    
    public function testTestCase()
    {
        /**
         * ------ NOTE
         * Because i have no more time, only write one test for register motorbike
         * and do not test authentication and other parts
         */
        $this->autheticate();

        $_SERVER["REQUEST_METHOD"] = 'POST';
        
        $_POST["brand"] = "Honda";
        $_POST["model"] = "CB1100";
        $_POST["cc"] = 250;
        $_POST["color"] = "black";
        $_POST["weight"] = 750;
        $_POST["price"] = 78000000.0;
        $_POST["csrf"] = $this->handleCsrf();

        $fh = fopen($this->di->get('config')->application->testsDir . "tempdata/honda-motorcycle", 'r');
        $tmpfname = tempnam(sys_get_temp_dir(), "img");
        $handle = fopen($tmpfname, "w");
        fwrite($handle, fread($fh, 636958));
        fclose($handle);
        fclose($fh);
        
        $_FILES["image"] = array(
            "name" => "honda-motorcycles-cb1100.jpg",
            "type" => "image/jpeg",
            "tmp_name" => $tmpfname,
            "error" => "0",
            "size" => "636958"
        );
        
        $_SERVER["REQUEST_URI"] = "/motorbikes/create";
        $_GET["_url"] = "/motorbikes/create";
        $request = new Request();

        $this->di->set('request', $request);

        $application = new Application($this->di);
        $files = $request->getUploadedFiles();
        $result = $application->handle()->getContent();
        $this->assertNotFalse(strpos($result, 'motorbike was created successfully'), 'Error in creating motorbike');
    }

}
