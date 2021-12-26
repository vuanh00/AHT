<?php
 
namespace AHT\Ui\Model\Post;
 
use Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\File\Uploader;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Directory\WriteInterface;
use Magento\Framework\UrlInterface;
use Magento\MediaStorage\Helper\File\Storage\Database;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
 
 /**
 * Class ImageUploader
 *  <strong> @package  </strong> AHT\Ui\Model
 */
 class ImageUploader
{
    const  IMAGE_TMP_PATH  = 'aht/tmp/post';
 
    const  IMAGE_PATH  = 'aht/post';
 
     /**
     * Core file storage database
     *
     *  <strong> @var  </strong> Database
     */
     protected $coreFileStorageDatabase;
 
     /**
     * Media directory object (writable).
     *
     *  <strong> @var  </strong> WriteInterface
     */
     protected $mediaDirectory;
 
     /**
     * Uploader factory
     *
     *  <strong> @var  </strong> UploaderFactory
     */
     protected $uploaderFactory;
 
     /**
     * Store manager
     *
     *  <strong> @var  </strong> StoreManagerInterface
     */
     protected $storeManager;
 
     /**
     *  <strong> @var  </strong> LoggerInterface
     */
     protected $logger;
 
     /**
     * Base tmp path
     *
     *  <strong> @var  </strong> string
     */
     protected $baseTmpPath;
 
     /**
     * Base path
     *
     *  <strong> @var  </strong> string
     */
     protected $basePath;
 
     /**
     * Allowed extensions
     *
     *  <strong> @var  </strong> string
     */
     protected $allowedExtensions;
 
     /**
     * List of allowed image mime types
     *
     *  <strong> @var  </strong> string[]
     */
     protected $allowedMimeTypes;
 
     /**
     * ImageUploader constructor
     *
     *  <strong> @param  </strong> Database $coreFileStorageDatabase
     *  <strong> @param  </strong> Filesystem $filesystem
     *  <strong> @param  </strong> UploaderFactory $uploaderFactory
     *  <strong> @param  </strong> StoreManagerInterface $storeManager
     *  <strong> @param  </strong> LoggerInterface $logger
     *  <strong> @param  </strong> string $baseTmpPath
     *  <strong> @param  </strong> string $basePath
     *  <strong> @param  </strong> string[] $allowedExtensions
     *  <strong> @param  </strong> string[] $allowedMimeTypes
     *  <strong> @throws  </strong> FileSystemException
     */
     public function __construct(
        Database $coreFileStorageDatabase,
        Filesystem $filesystem,
        UploaderFactory $uploaderFactory,
        StoreManagerInterface $storeManager,
        LoggerInterface $logger,
        $baseTmpPath = self:: IMAGE_TMP_PATH ,
        $basePath = self:: IMAGE_PATH ,
        $allowedExtensions = [],
        $allowedMimeTypes = []
    ) {
        $this->coreFileStorageDatabase = $coreFileStorageDatabase;
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList:: MEDIA );
        $this->uploaderFactory = $uploaderFactory;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
        $this->baseTmpPath = $baseTmpPath;
        $this->basePath = $basePath;
        $this->allowedExtensions = $allowedExtensions;
        $this->allowedMimeTypes = $allowedMimeTypes;
    }
 
     /**
     * Set base tmp path
     *
     *  <strong> @param  </strong> string $baseTmpPath
     *
     *  <strong> @return  </strong> void
     */
     public function setBaseTmpPath($baseTmpPath)
    {
        $this->baseTmpPath = $baseTmpPath;
    }
 
     /**
     * Set base path
     *
     *  <strong> @param  </strong> string $basePath
     *
     *  <strong> @return  </strong> void
     */
     public function setBasePath($basePath)
    {
        $this->basePath = $basePath;
    }
 
     /**
     * Set allowed extensions
     *
     *  <strong> @param  </strong> string[] $allowedExtensions
     *
     *  <strong> @return  </strong> void
     */
     public function setAllowedExtensions($allowedExtensions)
    {
        $this->allowedExtensions = $allowedExtensions;
    }
 
     /**
     * Retrieve base tmp path
     *
     *  <strong> @return  </strong> string
     */
     public function getBaseTmpPath()
    {
        return $this->baseTmpPath;
    }
 
     /**
     * Retrieve base path
     *
     *  <strong> @return  </strong> string
     */
     public function getBasePath()
    {
        return $this->basePath;
    }
 
     /**
     * Retrieve allowed extensions
     *
     *  <strong> @return  </strong> string[]
     */
     public function getAllowedExtensions()
    {
        return $this->allowedExtensions;
    }
 
     /**
     * Retrieve path
     *
     *  <strong> @param  </strong> string $path
     *  <strong> @param  </strong> string $imageName
     *
     *  <strong> @return  </strong> string
     */
     public function getFilePath($path, $imageName)
    {
        return rtrim($path, '/') . '/' . ltrim($imageName, '/');
    }
 
     /**
     * Checking file for moving and move it
     *
     *  <strong> @param  </strong> string $imageName
     *
     *  <strong> @return  </strong> string
     *
     *  <strong> @throws  </strong> LocalizedException
     */
     public function moveFileFromTmp($imageName)
    {
        $baseTmpPath = $this->getBaseTmpPath();
        $basePath = $this->getBasePath();
 
        $baseImagePath = $this->getFilePath(
            $basePath,
            Uploader:: getNewFileName (
                $this->mediaDirectory->getAbsolutePath(
                    $this->getFilePath($basePath, $imageName)
                )
            )
        );
        $baseTmpImagePath = $this->getFilePath($baseTmpPath, $imageName);
 
        try {
            $this->coreFileStorageDatabase->copyFile(
                $baseTmpImagePath,
                $baseImagePath
            );
            $this->mediaDirectory->renameFile(
                $baseTmpImagePath,
                $baseImagePath
            );
        } catch (Exception $e) {
            throw new LocalizedException(
                __('Something went wrong while saving the file(s).')
            );
        }
 
        return $imageName;
    }
 
     /**
     * Checking file for save and save it to tmp dir
     *
     *  <strong> @param  </strong> string $fileId
     *
     *  <strong> @return  </strong> string[]
     *
     *  <strong> @throws  </strong> LocalizedException
     */
     public function saveFileToTmpDir($fileId)
    {
        $baseTmpPath = $this->getBaseTmpPath();
 
         /**  <strong> @var  </strong> \Magento\MediaStorage\Model\File\Uploader $uploader */
         $uploader = $this->uploaderFactory->create(['fileId' => $fileId]);
        $uploader->setAllowedExtensions($this->getAllowedExtensions());
        $uploader->setAllowRenameFiles(true);
        if (!$uploader->checkMimeType($this->allowedMimeTypes)) {
            throw new LocalizedException(__('File validation failed.'));
        }
        $result = $uploader->save($this->mediaDirectory->getAbsolutePath($baseTmpPath));
        unset($result['path']);
 
        if (!$result) {
            throw new LocalizedException(
                __('File can not be saved to the destination folder.')
            );
        }
 
         /**
         * Workaround for prototype 1.7 methods "isJSON", "evalJSON" on Windows OS
         */
         $result['tmp_name'] = str_replace('\\', '/', $result['tmp_name']);
        $result['url'] = $this->storeManager
                ->getStore()
                ->getBaseUrl(
                    UrlInterface:: URL_TYPE_MEDIA
                 ) . $this->getFilePath($baseTmpPath, $result['file']);
        $result['name'] = $result['file'];
 
        if (isset($result['file'])) {
            try {
                $relativePath = rtrim($baseTmpPath, '/') . '/' . ltrim($result['file'], '/');
                $this->coreFileStorageDatabase->saveFile($relativePath);
            } catch (Exception $e) {
                $this->logger->critical($e);
                throw new LocalizedException(
                    __('Something went wrong while saving the file(s).')
                );
            }
        }
 
        return $result;
    }
}