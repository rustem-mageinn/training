<?php

namespace Training\Feedback\Model;

use Training\Feedback\Api\Data;
use Training\Feedback\Api\Data\FeedbackInterface;
use Training\Feedback\Api\FeedbackRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Training\Feedback\Model\ResourceModel\Feedback as FeedbackResource;
use Training\Feedback\Api\Data\FeedbackInterfaceFactory as FeedbackFactory;
use Training\Feedback\Model\ResourceModel\Feedback\CollectionFactory as FeedbackCollectionFactory;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    /**
     * @var FeedbackResource
     */
    private $resource;

    /**
     * @var FeedbackFactory
     */
    private $feedbackFactory;

    /**
     * @var FeedbackCollectionFactory
     */
    private $feedbackCollectionFactory;

    /**
     * @var Data\FeedbackSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * FeedbackRepository constructor.
     * @param FeedbackResource $resource
     * @param FeedbackFactory $feedbackFactory
     * @param FeedbackCollectionFactory $feedbackCollectionFactory
     * @param Data\FeedbackSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        FeedbackResource $resource,
        FeedbackFactory $feedbackFactory,
        FeedbackCollectionFactory $feedbackCollectionFactory,
        Data\FeedbackSearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackCollectionFactory = $feedbackCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * Save feedback
     *
     * @param FeedbackInterface $feedback
     * @return FeedbackInterface
     * @throws CouldNotSaveException
     */
    public function save(FeedbackInterface $feedback)
    {
        try {
            $this->resource->save($feedback);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the feedback: %1', $exception->getMessage()),
                $exception
            );
        }
        return $feedback;
    }

    /**
     * Get Feedback by ID
     *
     * @param $feedbackId
     * @return FeedbackInterface
     * @throws NoSuchEntityException
     */
    public function getById($feedbackId)
    {
        $feedback = $this->feedbackFactory->create();
        $this->resource->load($feedback, $feedbackId);
        if (!$feedback->getId()) {
            throw new NoSuchEntityException(__('Feedback with id "%1" does not exists', $feedbackId));
        }
        return $feedback;
    }

    /**
     * Retrieve feedbacks matching the specified criteria
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Training\Feedback\Api\Data\FeedbackSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria)
    {
        /** @var $collection \Training\Feedback\Model\ResourceModel\Feedback\Collection */
        $collection = $this->feedbackCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        /** @var $searchResults Data\FeedbackSearchResultsInterface */
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);
        $searchResults->setItems($collection->getItems());
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * Delete feedback
     *
     * @param FeedbackInterface $feedback
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(FeedbackInterface $feedback)
    {
        try {
            $this->resource->delete($feedback);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(
                __('Could not delete feedback: %1', $exception->getMessage())
            );
        }
        return true;
    }

    /**
     * Delete feedback by ID
     *
     * @param int $feedbackId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($feedbackId)
    {
        return $this->delete($this->getById($feedbackId));
    }
}