<?php

namespace Training\FeedbackProduct\Model\ResourceModel\FeedbackProduct;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_eventPrefix = 'training_feedbackproduct_collection';
    protected $_eventObject = 'feedbackproduct_collection';

    protected function _construct()
    {
        $this->_init(
            \Training\FeedbackProduct\Model\FeedbackProduct::class,
            \Training\FeedbackProduct\Model\ResourceModel\FeedbackProduct::class
        );
    }
}