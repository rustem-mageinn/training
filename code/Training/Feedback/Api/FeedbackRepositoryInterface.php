<?php

namespace Training\Feedback\Api;

use Training\Feedback\Api\Data\FeedbackInterface;

interface FeedbackRepositoryInterface
{
    /**
     * Save feedback
     *
     * @param FeedbackInterface $feedback
     * @return FeedbackInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(FeedbackInterface $feedback);

    /**
     * Get Feedback by ID
     *
     * @param $feedbackId
     * @return FeedbackInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($feedbackId);

    /**
     * Retrieve feedbacks matching the specified criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Feedback\Api\Data\FeedbackSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete feedback
     *
     * @param FeedbackInterface $feedback
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(FeedbackInterface $feedback);

    /**
     * Delete feedback by ID
     *
     * @param int $feedbackId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($feedbackId);
}