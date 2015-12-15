<?php
namespace MotorBike\Controllers;

/**
 * Display the "About" page.
 */
class AboutController extends ControllerBase
{

    /**
     * Default action. Set the public layout (layouts/default.volt)
     */
    public function indexAction()
    {
        $this->view->setTemplateBefore('default');
    }
}
