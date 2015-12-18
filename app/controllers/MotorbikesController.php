<?php
namespace MotorBike\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

use MotorBike\Models\Motorbikes;
use MotorBike\Forms\MotorbikesForm;
use MotorBike\Forms\MotorbikesSortForm;

/**
 * Motorbikes controller
 */
class MotorbikesController extends ControllerBase
{

    public function initialize()
    {
        $this->view->setTemplateBefore('default');
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    public function sortAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("motorbikes/search");
        }

        $form = new MotorbikesSortForm;

        $data = $this->request->getPost();
        $sort = new \MotorBike\SortHelper();
        
        if (!$form->isValid($data, $sort)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('motorbikes/search');
        } else {

            if ($this->persistent->parameters) {
                $parameters = $this->persistent->parameters;
            } else {
                $parameters = array();
            }
            
            $parameters['order'] = $sort->toString();
            $this->persistent->parameters = $parameters;
        }
        
        return $this->listAction();        
    }
    
    /**
     * Searches for motorbikes
     */
    public function searchAction()
    {

        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "MotorBike\Models\Motorbikes", $this->request->getPost());
            $this->persistent->parameters = $query->getParams();
        }
        
        return $this->listAction();
    }
    
    private function listAction()
    {
        $numberPage = 1;
        if (!$this->request->isPost()) {
            $numberPage = $this->request->getQuery('page', 'int');
        }
        
        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }

        /**
         * @todo only fetch motors of this page
         */

        $motorbike = Motorbikes::find($parameters);
        if (count($motorbike) == 0) {
            $this->flash->notice('The search did not find any motorbike');

            return $this->forward('motorbikes/index');
        }

        $paginator = new Paginator(array(
            'data' => $motorbike,
            'limit' => $this->getDI()->get('config')->setting->itemsPerPage,
            'page' => $numberPage
        ));

        // Pick "motorbike/search" as view to render
        $this->view->pick("motorbikes/search");

        $this->view->page = $paginator->getPaginate();
        $this->view->sortForm = new MotorbikesSortForm();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {
        $this->view->form = new MotorbikesForm();
    }

    /**
     * Edits a motorbike
     *
     * @param string $id
     */
    public function editAction($id)
    {

        if (!$this->request->isPost()) {

            $motorbike = Motorbikes::findFirstByid($id);
            if (!$motorbike) {
                $this->flash->error("motorbike was not found");

                return $this->forward('motorbikesindex');
            }

            $this->view->id = $motorbike->id;

            $this->tag->setDefault("id", $motorbike->getId());
            $this->tag->setDefault("brand", $motorbike->getBrand());
            $this->tag->setDefault("model", $motorbike->getModel());
            $this->tag->setDefault("cc", $motorbike->getCc());
            $this->tag->setDefault("color", $motorbike->getColor());
            $this->tag->setDefault("weight", $motorbike->getWeight());
            $this->tag->setDefault("price", $motorbike->getPrice());
            $this->tag->setDefault("image", $motorbike->getImage());

        }
    }

    /**
     * Edits a motorbike
     *
     * @param string $id
     */
    public function showAction($id)
    {
        $motorbike = Motorbikes::findFirstByid($id);
        if (!$motorbike) {
            $this->flash->error("motorbike was not found");

            return $this->forward(array(
                "controller" => "motorbikes",
                "action" => "index"
            ));
        }

        $this->view->motorbike = $motorbike;
    }

    /**
     * Creates a new motorbike
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->forward("motorbikes/new");
        }

        $form = new MotorbikesForm;
        $motorbike = new Motorbikes();

        $data = $this->request->getPost();
        if (!$form->isValid($data, $motorbike)) {
            foreach ($form->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('motorbikes/new');
        }

        if (!$motorbike->create()) {
            foreach ($motorbike->getMessages() as $message) {
                $this->flash->error($message);
            }
            return $this->forward('motorbikes/new');
        }

        $form->clear();

        $this->flash->success('motorbike was created successfully');

        return $this->forward('motorbikes/show/' . $motorbike->getId());
    }

    /**
     * Saves a motorbike edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->forward('motorbikes/index');
        }

        $id = $this->request->getPost("id");

        $motorbike = Motorbikes::findFirstByid($id);
        if (!$motorbike) {
            $this->flash->error("motorbike does not exist " . $id);

            return $this->forward('motorbikes/index');
        }

        $motorbike->setBrand($this->request->getPost("brand"));
        $motorbike->setModel($this->request->getPost("model"));
        $motorbike->setCc($this->request->getPost("cc"));
        $motorbike->setColor($this->request->getPost("color"));
        $motorbike->setWeight($this->request->getPost("weight"));
        $motorbike->setPrice($this->request->getPost("price"));
        $motorbike->setImage($this->request->getPost("image"));


        if (!$motorbike->save()) {

            foreach ($motorbike->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward(array(
                "controller" => "motorbikes",
                "action" => "edit",
                "params" => array($motorbike->id)
            ));
        }

        $this->flash->success("motorbike was updated successfully");

        return $this->forward(array(
            "controller" => "motorbikes",
            "action" => "index"
        ));

    }

    /**
     * Deletes a motorbike
     *
     * @param string $id
     */
    public function deleteAction($id)
    {

        $motorbike = Motorbikes::findFirstByid($id);
        if (!$motorbike) {
            $this->flash->error("motorbike was not found");

            return $this->forward(array(
                "controller" => "motorbikes",
                "action" => "index"
            ));
        }

        if (!$motorbike->delete()) {

            foreach ($motorbike->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->forward(array(
                "controller" => "motorbikes",
                "action" => "search"
            ));
        }

        $this->flash->success("motorbike was deleted successfully");

        return $this->forward(array(
            "controller" => "motorbikes",
            "action" => "index"
        ));
    }

}
