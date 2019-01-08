<?php

namespace Training\Feedback\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface FeedbackSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Feedback List
     *
     * @return \Training\Feedback\Api\Data\FeedbackInterface[]
     */
    public function getItems();

    /**
     * Set Feedback List
     *
     * @param \Training\Feedback\Api\Data\FeedbackInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}