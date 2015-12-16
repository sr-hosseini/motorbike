<?php
namespace MotorBike\Auth;

use Phalcon\Mvc\User\Component;
use MotorBike\Models\Users;

/**
 * MotorBike\Auth\Auth
 * Manages Authentication/Identity Management in MotorBike
 */
class Auth extends Component
{

    /**
     * Checks the user credentials
     *
     * @param array $credentials
     * @return boolan
     */
    public function check($credentials)
    {

        // Check if the user exist
        $user = Users::findFirstByEmail($credentials['email']);
        if ($user == false) {
            throw new Exception('Wrong email/password combination');
        }

        // Check the password
        if (!$this->security->checkHash($credentials['password'], $user->password)) {
            throw new Exception('Wrong email/password combination');
        }

        $this->session->set('auth-identity', array(
            'id' => $user->id,
            'name' => $user->name
        ));
    }

    /**
     * Returns the current identity
     *
     * @return array
     */
    public function getIdentity()
    {
        return $this->session->get('auth-identity');
    }
    
    public function hasIdentity()
    {
        return is_array($this->getIdentity());
    }

    /**
     * Returns the current identity
     *
     * @return string
     */
    public function getName()
    {
        $identity = $this->session->get('auth-identity');
        return $identity['name'];
    }

    /**
     * Removes the user identity information from session
     */
    public function remove()
    {
        if ($this->cookies->has('RMU')) {
            $this->cookies->get('RMU')->delete();
        }
        if ($this->cookies->has('RMT')) {
            $this->cookies->get('RMT')->delete();
        }

        $this->session->remove('auth-identity');
    }

    /**
     * Auths the user by his/her id
     *
     * @param int $id
     */
    public function authUserById($id)
    {
        $user = Users::findFirstById($id);
        if ($user == false) {
            throw new Exception('The user does not exist');
        }

        $this->session->set('auth-identity', array(
            'id' => $user->id,
            'name' => $user->name,
        ));
    }

    /**
     * Get the entity related to user in the active identity
     *
     * @return \MotorBike\Models\Users
     */
    public function getUser()
    {
        $identity = $this->session->get('auth-identity');
        if (isset($identity['id'])) {

            $user = Users::findFirstById($identity['id']);
            if ($user == false) {
                throw new Exception('The user does not exist');
            }

            return $user;
        }

        return false;
    }
}
