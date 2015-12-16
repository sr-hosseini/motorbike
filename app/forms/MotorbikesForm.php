<?php
namespace MotorBike\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\File;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Forms\Element\Submit;

class MotorbikesForm extends Form
{
    
    public function getCsrf()
    {
        return $this->security->getToken();
    }

    public function initialize($entity = null, $options = null)
    {

        // In edition the id is hidden
        if (isset($options['edit']) && $options['edit']) {
            $id = new Hidden('id');
        } else {
            $id = new Text('id');
        }

        $this->add($id);

        $brand = new Text('brand', array(
            'placeholder' => 'Brand'
        ));

        $brand->addValidators(array(
            new PresenceOf(array(
                'message' => 'The brand is required'
            ))
        ));

        $this->add($brand);

        $model = new Text('model', array(
            'placeholder' => 'Model'
        ));

        $model->addValidators(array(
            new PresenceOf(array(
                'message' => 'The model is required'
            ))
        ));

        $this->add($model);
        
        $cc = new Text('cc', array(
            'placeholder' => 'CC'
        ));
        
        $this->add($cc);
        
        $color = new Text('color', array(
            'placeholder' => 'Color'
        ));
        
        $color->addValidators(array(
            new StringLength(array(
                'max' => 50,
                'messageMaximum' => 'Color is too long. Miximum 50 characters'
            )),
        ));

        $this->add($color);
        
        $weight = new Text('weight', array(
            'placeholder' => 'Weight'
        ));
        
        $this->add($weight);
        
        $price = new Text('price', array(
            'placeholder' => 'Price'
        ));
        
        $price->addValidators(array(
            new PresenceOf(array(
                'message' => 'The price is required'
            ))
        ));

        $this->add($price);
        
        $image = new File('image', array(
            'placeholder' => 'Image'
        ));

        $this->add($image);
        
        // CSRF
        $csrf = new Hidden('csrf');

        $csrf->addValidator(new Identical(array(
            'value' => $this->security->getSessionToken(),
            'message' => 'CSRF validation failed'
        )));

        $this->add($csrf);

        // Add button
        $this->add(new Submit('Add', array(
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
