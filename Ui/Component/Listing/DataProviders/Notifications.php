<?php
namespace Magecrafts\WebApp\Ui\Component\Listing\DataProviders;

class Notifications extends \Magento\Ui\DataProvider\AbstractDataProvider
{    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Magecrafts\WebApp\Model\ResourceModel\Notification\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
