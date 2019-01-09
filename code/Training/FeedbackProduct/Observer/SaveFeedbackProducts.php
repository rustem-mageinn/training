<?php

namespace Training\FeedbackProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class SaveFeedbackProducts implements ObserverInterface
{
    private $feedbackProducts;

    public function __construct(
        \Training\FeedbackProduct\Model\FeedbackProduct $feedbackProducts
    ) {
        $this->feedbackProducts = $feedbackProducts;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $feedback = $observer->getFeedback();
        $this->feedbackProducts->saveProductRelations($feedback);
    }
}