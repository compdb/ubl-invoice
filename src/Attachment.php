<?php

namespace Compdb\UBL;

use Exception;
use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class Attachment implements XmlSerializable
{
    protected string $filePath;

    /**
     * @throws Exception exception when the mime type cannot be determined
     * @return string
     */
    public function getFileMimeType(): string
    {
        if (($mime_type = mime_content_type($this->getFilePath())) !== false) {
            return $mime_type;
        }

        throw new Exception('Could not determine mime_type of '.$this->getFilePath());
    }

    /**
     * @return string
     */
    public function getFilePath(): ?string
    {
        if (($this->filePath ?? null) === null) {
            throw new InvalidArgumentException('Missing filePath');
        }
        return $this->filePath;
    }

    /**
     * @param string $filePath
     * @return Attachment
     */
    public function setFilePath(string $filePath): Attachment
    {
        $this->filePath = $filePath;
        return $this;
    }

    /**
     * The validate function that is called during xml writing to valid the data of the object.
     *
     * @throws InvalidArgumentException An error with information about required data that is missing to write the XML
     * @return void
     */
    public function validate()
    {
        if (file_exists($this->getFilePath()) === false) {
            throw new InvalidArgumentException('Attachment at filePath does not exist');
        }
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        $this->validate();

        $fileContents = base64_encode(file_get_contents($this->getFilePath()));
        $mimeType = $this->getFileMimeType();

        $this->validate();

        $writer->write([
            'name' => Schema::CBC . 'EmbeddedDocumentBinaryObject',
            'value' => $fileContents,
            'attributes' => [
                'mimeCode' => $mimeType,
                'filename' => basename($this->getFilePath())
            ]
        ]);
    }
}
