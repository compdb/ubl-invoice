<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Price implements XmlSerializable
{
    protected float $priceAmount;
    protected ?float $baseQuantity = null;
    protected ?string $unitCode = null;

    /**
     * @return float
     */
    public function getPriceAmount(): ?float
    {
        return $this->priceAmount ?? null;
    }

    /**
     * @param float $priceAmount
     * @return Price
     */
    public function setPriceAmount(?float $priceAmount): Price
    {
        $this->priceAmount = $priceAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getBaseQuantity(): ?float
    {
        return $this->baseQuantity;
    }

    /**
     * @param float $baseQuantity
     * @return Price
     */
    public function setBaseQuantity(?float $baseQuantity): Price
    {
        $this->baseQuantity = $baseQuantity;
        return $this;
    }

    /**
     * @param float $baseQuantityAttributes
     * @return Price
     */
    public function setBaseQuantityAttributes(?array $baseQuantityAttributes): Price
    {
        $this->baseQuantityAttributes = $baseQuantityAttributes;
        return $this;
    }

    /**
     * @return string
     */
    public function getUnitCode(): ?string
    {
        return $this->unitCode;
    }

    /**
     * @param string $unitCode
     * See also: src/UnitCode.php
     * @return Price
     */
    public function setUnitCode(?string $unitCode): Price
    {
        $this->unitCode = $unitCode;
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
        if (($this->priceAmount ?? null) === null) {
            throw new InvalidArgumentException('Missing price amount');
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

        $writer->write([
            [
                'name' => Schema::CBC . 'PriceAmount',
                'value' => Generator::format_money($this->priceAmount),
                'attributes' => [
                    'currencyID' => Generator::$currencyID
                ]
            ]
        ]);

        if ($this->baseQuantity !== null) {
            $writer->write([
                [
                    'name' => Schema::CBC . 'BaseQuantity',
                    'value' => Generator::format_quantity($this->baseQuantity),
                    'attributes' => [
                        'unitCode' => $this->unitCode
                    ]
                ]
            ]);
        }
    }
}
