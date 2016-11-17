<?php

namespace DynamicFormBundle\EventListener\Values;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\Value\FileValue;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @package DynamicFormBundle\EventListener\Values
 */
class FileListener
{
    /**
     * @var string
     */
    private $webPath;

    /**
     * @param string $kernelPath
     * @param string $webPath
     */
    public function __construct($kernelPath, $webPath)
    {
        $this->kernelPath = $kernelPath;
        $this->webPath = $webPath;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @ORM\PostLoad
     *
     *
     * @param FileValue          $fileValue
     * @param LifecycleEventArgs $event
     */
    public function convertContent(FileValue $fileValue, LifecycleEventArgs $event)
    {
        if (null === $fileValue->getFileUri()) {
            return;
        }

        $absolutePath = sprintf('%s/../web/%s', $this->kernelPath, ltrim($fileValue->getFileUri(), '/'));
        $file = new File($absolutePath);

        $fileValue->setFile($file);
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @param FileValue          $fileValue
     * @param LifecycleEventArgs $event
     */
    public function uploadFile(FileValue $fileValue, LifecycleEventArgs $event)
    {
        if (null !== $fileValue->getContent()) {
            $this->deleteFile($fileValue->getContent());
        }

        $this->saveFile($fileValue);
    }

    /**
     * @param FileValue $fileValue
     */
    protected function saveFile(FileValue $fileValue)
    {
        $uploadedFile = $fileValue->getUploadedFile();

        if (null === $uploadedFile) {
            return;
        }

        $absolutePath = sprintf('%s/../web/%s', $this->kernelPath, ltrim($this->webPath, '/'));
        $filename = sprintf('%s_%s', uniqid(), $uploadedFile->getClientOriginalName());
        $file = $uploadedFile->move($absolutePath, $filename);

        $fileValue->setFileUri(sprintf('%s/%s', ltrim($this->webPath, '/'), $file->getFilename()));
    }

    /**
     * @param File $file
     */
    protected function deleteFile(File $file)
    {
        unlink($file->getRealPath());
    }
}