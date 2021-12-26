<?php
 
namespace AHT\Ui\Controller\Adminhtml\Image;
 
use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
use AHT\Ui\Model\Post\ImageUploader;
 
/**
 * Class Upload
 * </em><strong><em>@package </em></strong><em>AHT\Ui\Controller\Adminhtml\Image
 */
class Upload extends Action
{
   /**
     * Image uploader
     *
     * </em><strong><em>@var </em></strong><em>ImageUploader
     */
    protected $imageUploader;
 
    /**
     * Upload constructor.
     *
     * </em><strong><em>@param </em></strong><em>Action\Context $context
     * </em><strong><em>@param </em></strong><em>ImageUploader $imageUploader
     */
    public function __construct(
        Action\Context $context,
        ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
    }
    
    public function execute()
    {
        $imageId = $this->_request->getParam('param_name', 'image');
 
        try {
            $result = $this->imageUploader->saveFileToTmpDir($imageId);
        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }
        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }
}