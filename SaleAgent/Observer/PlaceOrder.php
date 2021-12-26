<?php
namespace AHT\SaleAgent\Observer;

class PlaceOrder implements \Magento\Framework\Event\ObserverInterface
{
    /**
     * @param \AHT\SaleAgent\Model\PostFactory
     */
    private $postFactory;

    /**
     * @param \AHT\SaleAgent\Model\PostRepository
     */
    private $postRepository;

    public function __construct(
        \AHT\SaleAgent\Model\PostFactory $postFactory,
        \AHT\SaleAgent\Model\PostRepository $postRepository
    )
    {
        $this->postFactory = $postFactory;
        $this->postRepository = $postRepository;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $orderId = $observer->getData('order_ids');
        $order = $observer->getData('order');
        $orderItemCollection = $order->getItemsCollection();

       
        // $data = 
        // [
        //     'entity_id' => $order->getData('entity'),
        //     'order_id' => $observer->getData('order_ids'),
            
        // ];
        foreach ($orderItemCollection as $item) {
            $post = $this->postFactory->create();
            $post->setId($order->getData('entity'));
            $post->setOrderId($orderId);
            # code...
            // $test = [
            // 'order_id' => $data['order_id'],
            // 'order_item_id' => $item->getItemId(),
            // 'order_item_sku' => $item->getSku(),
            // 'order_ite_price' => $item->getOriginalPrice(),
            // 'commission_type' => $item->getProduct()->getData('commission_type'),
            // 'commission_value' => $item->getProduct()->getData('commission_value')
            // ];
            // $post = $this->postFactory->create();
            $post->setItemId($item->getItemId());
            $post->setSku($item->getSku());
            $post->setPrice($item->getOriginalPrice());
            $post->setType($item->getProduct()->getData('commission_type'));
            $post->setValue($item->getProduct()->getData('commission_value'));
            $abc = $post->getData();
            $this->postRepository->save($post);
        }
        

    }
}