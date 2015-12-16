<?php
namespace MotorBike\Models\Behavior;

use Phalcon\Mvc\Model\Behavior;
use Phalcon\Mvc\Model\BehaviorInterface;
use Phalcon\Mvc\ModelInterface;
use Phalcon\Mvc\Model\Exception;
//use Phalcon\Logger;

/**
 * Handling file upload and store its relative path in db
 */
class Imageable extends Behavior implements BehaviorInterface
{
    /**
     * Upload image path
     * @var string
     */
    protected $uploadPath = null;

    /**
     * Model field
     * @var null
     */
    protected $imageField = null;

    /**
     * Old model image
     * @var string
     */
    protected $oldFile = null;

    /**
     * Application logger
     * @var \Phalcon\Logger\Adapter\File
     */
    protected $logger = null;

    /**
     * Allowed types
     * @var array
     */
    protected $allowedFormats = ['image/jpeg', 'image/png', 'image/gif'];

    public function notify($eventType, ModelInterface $model)
    {
        if (!is_string($eventType)) {
            throw new Exception('Invalid parameter type.');
        }

        // Check if the developer decided to take action here
        if (!$this->mustTakeAction($eventType)) {
            return;
        }
        
        $options = $this->getOptions($eventType);

        if (is_array($options)) {
            $this->setImageField($options, $model)
                 ->setAllowedFormats($options)
                 ->setUploadPath($options)
                 ->processUpload($model);
        }
    }

    protected function setImageField(array $options,  ModelInterface $model)
    {
        if (!isset($options['field']) || !is_string($options['field'])) {
            throw new Exception("The option 'field' is required and it must be string.");
        }

        $this->imageField = $options['field'];
        $this->oldFile = $model->{$this->imageField};

        return $this;
    }

    protected function setAllowedFormats(array $options)
    {
        if (isset($options['allowedFormats']) && is_array($options['allowedFormats'])) {
            $this->allowedFormats = $options['allowedFormats'];
        }

        return $this;
    }

    protected function setUploadPath(array $options)
    {
        if (!isset($options['uploadPath']) || !is_string($options['uploadPath'])) {
            throw new Exception("The option 'uploadPath' is required and it must be string.");
        }

        $path = $options['uploadPath'];

        $this->uploadPath = $path;

        return $this;
    }

    protected function processUpload(ModelInterface $model)
    {
        /* @var $request \Phalcon\Http\Request */
        $request = $model->getDI()->getRequest();
        if ($request->hasFiles(true)) {
            foreach ($request->getUploadedFiles() as $file) {
                
                if ($file->getKey() != $this->imageField || !in_array($file->getType(), $this->allowedFormats)) {
                    continue;
                }
                
                $uniqueFileName = time() . '-' . uniqid() . '.' . strtolower($file->getExtension());

                if (!file_exists($this->uploadPath))
                    mkdir($this->uploadPath, 0755, true);

                $file_name = rtrim($this->uploadPath, '/\\') . DIRECTORY_SEPARATOR . $uniqueFileName;
                if (!$file->moveTo($file_name)) {
                    if (!(file_exists($file->getTempName()) && copy($file->getTempName(), $file_name))) {
                        return $this;
                    }
                }

                $model->writeAttribute($this->imageField, $uniqueFileName);
                // Delete old file
                $this->processDelete();
            }
        }
    }

    // Symfony\Component\Filesystem\Filesystem uses here, you can do it otherwise
    protected function processDelete()
    {
        if ($this->oldFile) {
            $fullPath = rtrim($this->uploadPath, '/\\') . DIRECTORY_SEPARATOR . $this->oldFile;

            try {
                unlink($fullPath);
            } catch(\Exception $e) {
                /**
                 * @todo log error or failure object save
                 */
            }
        }
    }
}
