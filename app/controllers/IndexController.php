<?php
namespace MotorBike\Controllers;

use MotorBike\Models\Motorbikes;

/**
 * Display the default index page.
 */
class IndexController extends ControllerBase
{

    /**
     * Default action. Set the public layout (layouts/default.volt)
     */
    public function indexAction()
    {
        
        $motorbikes = Motorbikes::find(array(
            'order' => 'created_at DESC',
            'limit' => 2
        ));

        $this->view->motorbikes = $motorbikes;
        $this->view->setTemplateBefore('default');
    }
}
