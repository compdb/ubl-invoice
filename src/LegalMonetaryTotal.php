<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class LegalMonetaryTotal implements XmlSerializable
{
    protected ?float $lineExtensionAmount = null;
    protected ?float $taxExclusiveAmount = null;
    protected ?float $taxInclusiveAmount = null;
    protected ?float $allowanceTotalAmount = null;
    protected float $payableAmount;

    /**
     * @return float
     */
    public function getLineExtensionAmount(): ?float
    {
        return $this->lineExtensionAmount;
    }

    /**
     * @param float $lineExtensionAmount
     * @return LegalMonetaryTotal
     */
    public function setLineExtensionAmount(?float $lineExtensionAmount): LegalMonetaryTotal
    {
        $this->lineExtensionAmount = $lineExtensionAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxExclusiveAmount(): ?float
    {
        return $this->taxExclusiveAmount;
    }

    /**
     * @param float $taxExclusiveAmount
     * @return LegalMonetaryTotal
     */
    public function setTaxExclusiveAmount(?float $taxExclusiveAmount): LegalMonetaryTotal
    {
        $this->taxExclusiveAmount = $taxExclusiveAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getTaxInclusiveAmount(): ?float
    {
        return $this->taxInclusiveAmount;
    }

    /**
     * @param float $taxInclusiveAmount
     * @return LegalMonetaryTotal
     */
    public function setTaxInclusiveAmount(?float $taxInclusiveAmount): LegalMonetaryTotal
    {
        $this->taxInclusiveAmount = $taxInclusiveAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAllowanceTotalAmount(): ?float
    {
        return $this->allowanceTotalAmount;
    }

    /**
     * @param float $allowanceTotalAmount
     * @return LegalMonetaryTotal
     */
    public function setAllowanceTotalAmount(?float $allowanceTotalAmount): LegalMonetaryTotal
    {
        $this->allowanceTotalAmount = $allowanceTotalAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getPayableAmount(): ?float
    {
        return $this->payableAmount ?? null;
    }

    /**
     * @param float $payableAmount
     * @return LegalMonetaryTotal
     */
    public function setPayableAmount(?float $payableAmount): LegalMonetaryTotal
    {
        $this->payableAmount = $payableAmount;
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
        if (($this->payableAmount ?? null) === null) {
            throw new InvalidArgumentException('Missing payable amount');
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

        if ($this->lineExtensionAmount !== null) {
            $writer->write([
                [
                    'name' => Schema::CBC . 'LineExtensionAmount',
                    'value' => Generator::format_money($this->lineExtensionAmount),
                    'attributes' => [
                        'currencyID' => Generator::$currencyID
                    ]
                ]
            ]);
        }

        if ($this->taxExclusiveAmount !== null) {
            $writer->write([
                [
                    'name' => Schema::CBC . 'TaxExclusiveAmount',
                    'value' => Generator::format_money($this->taxExclusiveAmount),
                    'attributes' => [
                        'currencyID' => Generator::$currencyID
                    ]
                ]
            ]);
        }

        if ($this->taxInclusiveAmount !== null) {
            $writer->write([
                [
                    'name' => Schema::CBC . 'TaxInclusiveAmount',
                    'value' => Generator::format_money($this->taxInclusiveAmount),
                    'attributes' => [
                        'currencyID' => Generator::$currencyID
                    ]
                ]
            ]);
        }

        if ($this->allowanceTotalAmount !== null) {
            $writer->write([
                [
                    'name' => Schema::CBC . 'AllowanceTotalAmount',
                    'value' => Generator::format_money($this->allowanceTotalAmount),
                    'attributes' => [
                        'currencyID' => Generator::$currencyID
                    ]
                ]
            ]);
        }

        $writer->write([
            [
                'name' => Schema::CBC . 'PayableAmount',
                'value' => Generator::format_money($this->payableAmount),
                'attributes' => [
                    'currencyID' => Generator::$currencyID
                ]
            ],
        ]);
    }
}
