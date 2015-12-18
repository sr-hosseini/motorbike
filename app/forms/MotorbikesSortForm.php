<?php
namespace MotorBike\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\InclusionIn;
use Phalcon\Forms\Element\Submit;

class MotorbikesSortForm extends Form
{

    public function initialize($entity = null, $options = null)
    {
        $sortBy = new Select('sortBy',
            array(
                'created_at' => 'Creation Date',
                'price' => 'Price'
            ),
            array(
                'placeholder' => 'Sort By'
            )
        );

        $sortBy->addValidators(array(
            new PresenceOf(array(
                'message' => 'The Sort By is required'
            )),
            new InclusionIn(array(
                'message' => 'The sort by must be price or creation date',
                'domain' => array('price', 'created_at')
            ))
        ));

        $this->add($sortBy);

        $order = new Select('order',
            array(
                'ASC' => 'Asc',
                'DESC' => 'Desc'
            ),
            array(
                'placeholder' => 'Order'
            )
        );

        $order->addValidators(array(
            new PresenceOf(array(
                'message' => 'The order is required'
            )),
            new InclusionIn(array(
                'message' => 'The order must be asc or desc',
                'domain' => array('ASC', 'DESC')
            ))
        ));

        $this->add($order);
        
        // Add button
        $this->add(new Submit('sort', array(
            'class' => 'btn btn-success'
        )));
    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }
}
