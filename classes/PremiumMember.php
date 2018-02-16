<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 2/15/2018
 * Time: 5:10 PM
 */

/**
 * Class Premium Member represents a premium member of the dating site that extends member
 */
class PremiumMember extends Member
{
    private $_inDoorActivities= array();
    private $_outDoorActivities = array();

    /**
     * @return array of indoor activities
     */
    function getIndoorActivities()
    {
        return $this->_inDoorActivities;
    }

    /**
     * Sets the indoor activities of premium member
     * @param $inDoorActivities
     */
    function  setIndoorActivities($inDoorActivities)
    {
        $this->_inDoorActivities = $inDoorActivities;
    }

    /**
     * @return array of outdoor activities
     */
    function getOutDoorActivities()
    {
        return $this->_outDoorActivities;
    }

    /**
     * Sets the outdoor activities of premium member
     * @param $outDoorActivities
     */
    function setOutDoorActivities($outDoorActivities)
    {
        $this->_outDoorActivities = $outDoorActivities;
    }
}