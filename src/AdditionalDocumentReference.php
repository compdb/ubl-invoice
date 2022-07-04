<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class AdditionalDocumentReference implements XmlSerializable
{
    protected string $id;
    protected ?string $documentType = null;
    protected ?Attachment $attachment = null;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id ?? null;
    }

    /**
     * @param string $id
     * @return AdditionalDocumentReference
     */
    public function setId(string $id): AdditionalDocumentReference
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getDocumentType(): ?string
    {
        return $this->documentType;
    }

    /**
     * @param string $documentType
     * @return AdditionalDocumentReference
     */
    public function setDocumentType(string $documentType): AdditionalDocumentReference
    {
        $this->documentType = $documentType;
        return $this;
    }

    /**
     * @return Attachment
     */
    public function getAttachment(): ?Attachment
    {
        return $this->attachment;
    }

    /**
     * @param Attachment $attachment
     * @return AdditionalDocumentReference
     */
    public function setAttachment(Attachment $attachment): AdditionalDocumentReference
    {
        $this->attachment = $attachment;
        return $this;
    }

    /**
     * The validate function that is called during xml writing to valid the data of the object.
     *
     * @return void
     * @throws InvalidArgumentException An error with information about required data that is missing to write the XML
     */
    public function validate()
    {
        if (($this->id ?? null) === null) {
            throw new InvalidArgumentException('Missing document id');
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

        $writer->write([ Schema::CBC . 'ID' => $this->id ]);
        if ($this->documentType !== null) {
            $writer->write([
                Schema::CAC . 'DocumentType' => $this->documentType
            ]);
        }
        $writer->write([ Schema::CAC . 'Attachment' => $this->attachment ]);
    }
}
