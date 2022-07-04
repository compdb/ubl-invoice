<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class TaxSubTotal implements XmlSerializable
{
    protected ?float $taxableAmount = null;
    protected float $taxAmount;
    protected TaxCategory $taxCategory;
    protected ?float $percent = null;

    /**
     * @return mixed
     */
    public function getTaxableAmount(): ?float
    {
        return $this->taxableAmount;
    }

    /**
     * @param mixed $taxableAmount
     * @return TaxSubTotal
     */
    public function setTaxableAmount(?float $taxableAmount): TaxSubTotal
    {
        $this->taxableAmount = $taxableAmount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTaxAmount(): ?float
    {
        return $this->taxAmount ?? null;
    }

    /**
     * @param mixed $taxAmount
     * @return TaxSubTotal
     */
    public function setTaxAmount(?float $taxAmount): TaxSubTotal
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     * @return TaxCategory
     */
    public function getTaxCategory(): ?TaxCategory
    {
        return $this->taxCategory ?? null;
    }

    /**
     * @param TaxCategory $taxCategory
     * @return TaxSubTotal
     */
    public function setTaxCategory(TaxCategory $taxCategory): TaxSubTotal
    {
        $this->taxCategory = $taxCategory;
        return $this;
    }

    /**
     * @return float
     */
    public function getPercent(): ?float
    {
        return $this->percent;
    }

    /**
     * @param float $percent
     * @return TaxSubTotal
     */
    public function setPercent(?float $percent): TaxSubTotal
    {
        $this->percent = $percent;
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
        if (($this->taxableAmount ?? null) === null) {
            throw new InvalidArgumentException('Missing taxsubtotal taxableAmount');
        }

        if (($this->taxAmount ?? null) === null) {
            throw new InvalidArgumentException('Missing taxsubtotal taxamount');
        }

        if (($this->taxCategory ?? null) === null) {
            throw new InvalidArgumentException('Missing taxsubtotal taxcategory');
        }
    }

    /**
     * The xmlSerialize method is called during xml writing.
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        $this->validate();

        $writer->write([
            [
                'name' => Schema::CBC . 'TaxableAmount',
                'value' => Generator::format_money($this->taxableAmount),
                'attributes' => [
                    'currencyID' => Generator::$currencyID
                ]
            ],
            [
                'name' => Schema::CBC . 'TaxAmount',
                'value' => Generator::format_money($this->taxAmount),
                'attributes' => [
                    'currencyID' => Generator::$currencyID
                ]
            ]
        ]);

        if ($this->percent !== null) {
            $writer->write([
                Schema::CBC . 'Percent' => $this->percent
            ]);
        }

        $writer->write([
            Schema::CAC . 'TaxCategory' => $this->taxCategory
        ]);
    }
}
