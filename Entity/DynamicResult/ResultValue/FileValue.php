<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\EntityListeners({
 *     "DynamicFormBundle\EventListener\Values\FileListener"
 * })
 *
 * @ORM\Table(name="dynamic_form_result_file_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class FileValue extends BaseValue
{
    /**
     * @var string
     *
     * @ORM\Column(name="file_content", type="string", nullable=true)
     */
    private $fileUri;

    /**
     * @var boolean
     *
     * @ORM\Column(name="file_updated", type="boolean")
     */
    private $updated;

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

        if ($file instanceof UploadedFile) {
            $this->updated = true;
        }
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
     * @return boolean
     */
    public function isUpdated()
    {
        return $this->updated;
    }

    /**
     * @param boolean $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
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

    /**
     * @return void
     */
    public function removeContent()
    {
        $this->uploadedFile = null;
        $this->updated = true;
    }
}
