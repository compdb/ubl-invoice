<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class TaxTotal implements XmlSerializable
{
    protected float $taxAmount;
    protected ?array $taxSubTotals = null;

    /**
     * @return mixed
     */
    public function getTaxAmount(): ?float
    {
        return $this->taxAmount ?? null;
    }

    /**
     * @param mixed $taxAmount
     * @return TaxTotal
     */
    public function setTaxAmount(?float $taxAmount): TaxTotal
    {
        $this->taxAmount = $taxAmount;
        return $this;
    }

    /**
     * @return array
     */
    public function getTaxSubTotals(): array
    {
        return $this->taxSubTotals;
    }

    /**
     * @param TaxSubTotal $taxSubTotal
     * @return TaxTotal
     */
    public function addTaxSubTotal(TaxSubTotal $taxSubTotal): TaxTotal
    {
        $this->taxSubTotals[] = $taxSubTotal;
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
        if (($this->taxAmount ?? null) === null) {
            throw new InvalidArgumentException('Missing taxtotal taxamount');
        }
    }

    /**
     * The xmlSerialize method is called during xml writing.
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer): void
    {
        $this->validate();

        $writer->write([
            [
                'name' => Schema::CBC . 'TaxAmount',
                'value' => Generator::format_money($this->taxAmount),
                'attributes' => [
                    'currencyID' => Generator::$currencyID
                ]
            ],
        ]);

        foreach ($this->taxSubTotals as $taxSubTotal) {
            $writer->write([Schema::CAC . 'TaxSubtotal' => $taxSubTotal]);
        }
    }
}
