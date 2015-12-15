<?php
namespace MotorBike\Controllers;

/**
 * Display the privacy page.
 */
class PrivacyController extends ControllerBase
{

    /**
     * Default action. Set the public layout (layouts/default.volt)
     */
    public function indexAction()
    {
        $this->view->setTemplateBefore('default');
    }
}
