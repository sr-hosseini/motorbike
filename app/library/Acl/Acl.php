<?php
namespace MotorBike\Acl;

use Phalcon\Mvc\User\Component;

/**
 * MotorBike\Acl\Acl
 */
class Acl extends Component
{
    /**
     * Define the resources that are considered "private". These controller => actions require authentication.
     *
     * @var array
     */
    private $privateResources = array(
        'users' => array(
            'index' => true,
            'search' => true,
            'create' => true,
        ),
        'motorbikes' => array(
            'new' => true,
            'create' => true,
            'edit' => true,
            'delete' => true
        )
    );

    /**
     * Checks if the anonymous user is allowed to access a resource
     *
     * @param string $controller
     * @param string $action
     * @return boolean
     */
    public function isPrivate($controller, $action)
    {
        return isset($this->privateResources[strtolower($controller)][strtolower($action)]);
    }

    /**
     * Returns the ACL list
     *
     * @return Phalcon\Acl\Adapter\Memory
     */
    public function getAcl()
    {
        // Check if the ACL is not already created
        if (!is_object($this->acl)) {
            $this->acl = new Acl();
        }
        
        return $this->acl;
    }

    /**
     * Returns all the resoruces and their actions available in the application
     *
     * @return array
     */
    public function getResources()
    {
        return $this->privateResources;
    }
}
