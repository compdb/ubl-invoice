<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class ContractDocumentReference implements XmlSerializable
{
    protected string $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id ?? null;
    }

    /**
     * @param string $id
     * @return ContractDocumentReference
     */
    public function setId(string $id): ContractDocumentReference
    {
        $this->id = $id;
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
            throw new InvalidArgumentException('Missing contract document reference id');
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
    }
}
