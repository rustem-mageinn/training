<?php

namespace Training\FeedbackProduct\Model\ResourceModel;

class FeedbackProduct extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('training_feedback_product', 'row_id');
    }

    public function loadProductRelations($feedbackId)
    {
        $select = $this->getConnection()->select()->from(
            $this->getTable('training_feedback_product'),
            ['product_id']
        )->where('feedback_id = ?', $feedbackId);

        $result = [];
        foreach ($this->getConnection()->fetchAll($select) as $row) {
            $result[] = $row['product_id'];
        }
        return $result;
    }

    public function saveProductRelations($feedbackId, $productIds)
    {
        $existingIds = $this->loadProductRelations($feedbackId);
        $toDelete = array_diff($existingIds, $productIds);
        if ($toDelete) {
            $this->getConnection()->delete($this->getTable('training_feedback_product'),
                ['feedback_id = ?' => $feedbackId, 'product_id in (?)' => $toDelete]);
        }
        $toInsert = array_diff($productIds, $existingIds);
        if ($toInsert) {
            $data = [];
            foreach ($toInsert as $prodId) {
                $data[] = [
                    'feedback_id' => $feedbackId,
                    'product_id' => $prodId
                ];
            }
            $this->getConnection()->insertMultiple($this->getTable('training_feedback_product'), $data);
        }
    }
}