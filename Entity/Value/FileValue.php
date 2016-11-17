<?php

namespace DynamicFormBundle\Entity\Value;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\EntityListeners({
 *     "DynamicFormBundle\EventListener\Values\FileListener"
 * })
 *
 * @package DynamicFormBundle\Entity\Value
 */
class FileValue extends BaseValue
{
    /**
     * @var string
     *
     * @ORM\Column(name="file_content", type="string")
     */
    private $fileUri;

    /**
     * @var File
     *
     */
    private $file;

    /**
     * @var UploadedFile
     *
     */
    private $uploadedFile;

    /**
     * @return File
     */
    public function getContent()
    {
        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setContent(UploadedFile $file = null)
    {
        $this->uploadedFile = $file;
    }

    /**
     * @return string
     */
    public function getFileUri()
    {
        return $this->fileUri;
    }

    /**
     * @param string $fileUri
     */
    public function setFileUri($fileUri)
    {
        $this->fileUri = $fileUri;
    }

    /**
     * @param File $file
     */
    public function setFile($file)
    {
        $this->file = $file;
    }

    /**
     * @return UploadedFile
     */
    public function getUploadedFile()
    {
        return $this->uploadedFile;
    }
}
