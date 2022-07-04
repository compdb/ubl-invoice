<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class ClassifiedTaxCategory implements XmlSerializable
{
    protected ?string $id = null;
    protected ?array $idAttributes = null;
    protected ?string $name = null;
    protected ?float $percent = null;
    protected TaxScheme $taxScheme;
    protected ?array $taxExemptionReasons = null;
    protected ?string $taxExemptionReasonCode = null;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return ClassifiedTaxCategory
     */
    public function setId(?string $id): ClassifiedTaxCategory
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param array $attributes
     * @return TaxCategory
     */
    public function setIdAttributes(?array $attributes): TaxCategory
    {
        $this->idAttributes = $attributes;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return ClassifiedTaxCategory
     */
    public function setName(?string $name): ClassifiedTaxCategory
    {
        $this->name = $name;
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
     * @return ClassifiedTaxCategory
     */
    public function setPercent(?float $percent): ClassifiedTaxCategory
    {
        $this->percent = $percent;
        return $this;
    }

    /**
     * @return TaxScheme
     */
    public function getTaxScheme(): ?TaxScheme
    {
        return $this->taxScheme ?? null;
    }

    /**
     * @param TaxScheme $taxScheme
     * @return ClassifiedTaxCategory
     */
    public function setTaxScheme(?TaxScheme $taxScheme): ClassifiedTaxCategory
    {
        $this->taxScheme = $taxScheme;
        return $this;
    }

    /**
     * @return array
     */
    public function getTaxExemptionReasons(): ?array
    {
        return $this->taxExemptionReasons;
    }

    /**
     * @param string $taxExemptionReason
     * @return TaxCategory
     */
    public function addTaxExemptionReason(?string $taxExemptionReason): TaxCategory
    {
        $this->taxExemptionReasons []= $taxExemptionReason;
        return $this;
    }

    /**
     * @return string
     */
    public function getTaxExemptionReasonCode(): ?string
    {
        return $this->taxExemptionReasonCode;
    }

    /**
     * @param string $taxExemptionReason
     * @return TaxCategory
     */
    public function setTaxExemptionReasonCode(?string $taxExemptionReasonCode): TaxCategory
    {
        $this->taxExemptionReasonCode = $taxExemptionReasonCode;
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
        if ($this->getId() === null) {
            throw new InvalidArgumentException('Missing taxcategory id');
        }

        if ($this->getPercent() === null) {
            throw new InvalidArgumentException('Missing taxcategory percent');
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
                'name' => Schema::CBC . 'ID',
                'value' => $this->getId(),
                'attributes' => $this->idAttributes,
            ],
            Schema::CBC . 'Percent' => Generator::format_percent($this->percent),
        ]);

        if ($this->name !== null) {
            $writer->write([
                Schema::CBC . 'Name' => $this->name,
            ]);
        }

        if ($this->taxExemptionReasonCode !== null) {
            $writer->write([
                Schema::CBC . 'TaxExemptionReasonCode' => $this->taxExemptionReasonCode,
            ]);
        }

        if ($this->taxExemptionReasons !== null) {
            foreach ($this->taxExemptionReasons as $taxExemptionReason) {
                $writer->write([
                    Schema::CBC . 'TaxExemptionReason' => $taxExemptionReason,
                ]);
            }
        }

        if (($this->taxScheme ?? null) !== null) {
            $writer->write([Schema::CAC . 'TaxScheme' => $this->taxScheme]);
        } else {
            $writer->write([
                Schema::CAC . 'TaxScheme' => null,
            ]);
        }
    }
}
