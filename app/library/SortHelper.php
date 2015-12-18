<?php
namespace MotorBike;

/**
 * Description of SortHelper
 *
 * @author sr_hosseini
 */
class SortHelper
{
    /**
     * property name to sort
     * 
     * @var string
     */
    public $sortBy;

    /**
     * Order of sorting, ascending or descending
     *
     * @var string
     */
    public $order;

    public function __toString()
    {
        return $this->toString();
    }

    public function toString()
    {
        return $this->sortBy . ' ' . $this->order;
    }
}
