<?php
 
namespace AHT\Ui\Controller\Adminhtml\Post;
 
use AHT\Ui\Model\PostFactory;
use Magento\Backend\App\Action;
use AHT\Ui\Model\Post\ImageUploader;
 
/**
 * Class Save
 * @package AHT\Ui\Controller\Adminhtml\Post
 */
class Save extends Action
{
    /**
     * @var PostFactory
     */
    private $postFactory;
    protected $imageUploader;
    /**
     * Save constructor.
     * @param Action\Context $context
     * @param PostFactory $postFactory
     */
    public function __construct(
        Action\Context $context,
        PostFactory $postFactory,
        ImageUploader $imageUploader
    ) {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->imageUploader = $imageUploader;
    }
 
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $id = !empty($data['ui_id']) ? $data['ui_id'] : null;

        $newData = [
            'name' => $data['name'],
            'content' => $data['content'],
        ];
 
        $post = $this->postFactory->create();
 
        if ($id) {
            $post->load($id);
        }
        $data2 = $data;
        if (isset($data2['image'][0]['name'])) {
            $data2['image'] = $data['image'][0]['name'];
            $imageName = $data2['image'];
        }else{
            $imageName = '';
        }
        $newData['image'] = $imageName;
        try {
            
            $post->addData($newData);
            $post->save();
            $this->messageManager->addSuccessMessage(__('You saved the post.'));
            if ($imageName){
                $this->imageUploader->moveFileFromTmp($imageName);
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
 
        return $this->resultRedirectFactory->create()->setPath('ui/post/index');
    }
}