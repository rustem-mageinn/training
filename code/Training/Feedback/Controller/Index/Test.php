<?php

namespace Training\Feedback\Controller\Index;

use \Magento\Framework\App\Action\Action;

class Test extends Action
{
    private $feedbackFactory;
    private $feedbackRepository;
    private $searchCriteriaBuilder;
    private $sortOrderBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;
        parent::__construct($context);
    }

    public function execute()
    {
        // create new item
        /** @var $newFeedback \Training\Feedback\Api\Data\FeedbackInterface */
        $newFeedback = $this->feedbackFactory->create();
        $newFeedback->setAuthorName('some name')
            ->setAuthorEmail('test@test.com')
            ->setMessage('test message lskdjflskdjf sdlfkjsldf')
            ->setIsActive(1);
        $this->feedbackRepository->save($newFeedback);

        // load item by id
        $feedback = $this->feedbackRepository->getById(1);
        $this->printFeedback($feedback);

        // update item
        $feedbackToUpdate = $this->feedbackRepository->getById(1);
        $feedbackToUpdate->setMessage('Custom ' . $feedbackToUpdate->getMessage());
        $this->feedbackRepository->save($feedbackToUpdate);

        // delete feedback
        $this->feedbackRepository->deleteById(1);

        // load multiple items
        $this->searchCriteriaBuilder->addFilter('is_active', 1);

        $sortOrder = $this->sortOrderBuilder->setField('author_name')->setAscendingDirection()->create();
        $this->searchCriteriaBuilder->addSortOrder($sortOrder);

        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->feedbackRepository->getList($searchCriteria);
        foreach ($searchResult->getItems() as $item) {
            $this->printFeedback($item);
        }
        exit();
    }

    private function printFeedback($feedback)
    {
        echo $feedback->getId() . ' : '
            . $feedback->getAuthorName()
            . ' (' . $feedback->getAuthorEmail() . ')';
        echo "<br/>\n";
    }
}