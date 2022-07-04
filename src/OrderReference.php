<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class OrderReference implements XmlSerializable
{
    protected string $id;
    protected ?string $salesOrderId = null;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id ?? null;
    }

    /**
     * @param string $id
     * @return OrderReference
     */
    public function setId(string $id): OrderReference
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getSalesOrderId(): string
    {
        return $this->salesOrderId;
    }

    /**
     * @param string $salesOrderId
     * @return OrderReference
     */
    public function setSalesOrderId(string $salesOrderId): OrderReference
    {
        $this->salesOrderId = $salesOrderId;
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
            throw new InvalidArgumentException('Missing invoice id');
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

        if ($this->salesOrderId !== null) {
            $writer->write([ Schema::CBC . 'SalesOrderID' => $this->salesOrderId ]);
        }
    }
}
