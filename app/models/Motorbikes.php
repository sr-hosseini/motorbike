<?php
namespace MotorBike\Models;

use Phalcon\Mvc\Model\Behavior\Timestampable;

class Motorbikes extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $brand;

    /**
     *
     * @var string
     */
    protected $model;

    /**
     *
     * @var integer
     */
    protected $cc;

    /**
     *
     * @var string
     */
    protected $color;

    /**
     *
     * @var double
     */
    protected $weight;

    /**
     *
     * @var double
     */
    protected $price;

    /**
     *
     * @var string
     */
    protected $image;

    /**
     *
     * @var string
     */
    protected $created_at;

    /**
     *
     * @var string
     */
    protected $modified_at;
    
    public $upload_path;
    
    public function initialize()
    {
        $this->upload_path = $this->getUploadPath();

        // validate image (file size, file format, etc.)
        $this->addBehavior(new Behavior\Imageable(array(
            'beforeValidation' => array(
                'field'      => 'image',
                'uploadPath' => $this->upload_path,
            )
        )));
        
        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeValidationOnCreate' => array(
                        'field'  => 'created_at',
                        'format' => 'Y-m-d'
                    )
                )
            )
        );

        $this->addBehavior(
            new Timestampable(
                array(
                    'beforeValidationOnCreate' => array(
                        'field'  => 'modified_at',
                        'format' => 'Y-m-d H:i:s'
                    ),
                    'beforeValidationOnUpdate' => array(
                        'field'  => 'modified_at',
                        'format' => 'Y-m-d H:i:s'
                    )
                )
            )
        );
    }

    /**
     * 
     * @param boolean $abs true for return absolute path and false for relative from public dir
     * @return string
     */
    private function getUploadPath($abs = true)
    {
        /** @var \Phalcon\Config $config */
        $config = $this->getDI()->get('config');

        $uploadPath = '';
        if ($abs)
            $uploadPath = $config->application->publicDir;
        $uploadPath .= $config->media->uploadDir;
        $upload_path = $uploadPath . DIRECTORY_SEPARATOR . $this->getSource();

        return $upload_path;
    }

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field brand
     *
     * @param string $brand
     * @return $this
     */
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Method to set the value of field model
     *
     * @param string $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Method to set the value of field cc
     *
     * @param integer $cc
     * @return $this
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Method to set the value of field color
     *
     * @param string $color
     * @return $this
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Method to set the value of field weight
     *
     * @param double $weight
     * @return $this
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param double $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field image
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Method to set the value of field created_at
     *
     * @param string $created_at
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Method to set the value of field modified_at
     *
     * @param string $modified_at
     * @return $this
     */
    public function setModifiedAt($modified_at)
    {
        $this->modified_at = $modified_at;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field brand
     *
     * @return string
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Returns the value of field model
     *
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Returns the value of field cc
     *
     * @return integer
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Returns the value of field color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Returns the value of field weight
     *
     * @return double
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Returns the value of field price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the value of field image
     *
     * @return string
     */
    public function getImageUri()
    {
        return $this->getUploadPath(false) . DIRECTORY_SEPARATOR . $this->image;
    }

    /**
     * Returns the value of field created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Returns the value of field modified_at
     *
     * @return string
     */
    public function getModifiedAt()
    {
        return $this->modified_at;
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'motorbikes';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Motorbikes[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Motorbikes
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
