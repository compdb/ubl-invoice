<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class InvoiceLine implements XmlSerializable
{
    protected string $id;
    protected ?float $invoicedQuantity = null;
    protected float $lineExtensionAmount;
    protected ?string $unitCode = null;
    protected ?array $taxTotals = null;
    protected ?array $invoicePeriods = null;
    protected ?array $notes = null;
    protected Item $item;
    protected ?Price $price = null;
    protected ?string $accountingCostCode = null;
    protected ?string $accountingCost = null;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id ?? null;
    }

    /**
     * @param string $id
     * @return InvoiceLine
     */
    public function setId(?string $id): InvoiceLine
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return float
     */
    public function getInvoicedQuantity(): ?float
    {
        return $this->invoicedQuantity;
    }

    /**
     * @param float $invoicedQuantity
     * @return InvoiceLine
     */
    public function setInvoicedQuantity(?float $invoicedQuantity): InvoiceLine
    {
        $this->invoicedQuantity = $invoicedQuantity;
        return $this;
    }

    /**
     * @return float
     */
    public function getLineExtensionAmount(): ?float
    {
        return $this->lineExtensionAmount ?? null;
    }

    /**
     * @param float $lineExtensionAmount
     * @return InvoiceLine
     */
    public function setLineExtensionAmount(?float $lineExtensionAmount): InvoiceLine
    {
        $this->lineExtensionAmount = $lineExtensionAmount;
        return $this;
    }

    /**
     * @return TaxTotal []
     */
    public function getTaxTotals(): ?array
    {
        return $this->taxTotals;
    }

    /**
     * @param TaxTotal $taxTotal
     * @return InvoiceLine
     */
    public function addTaxTotal(?TaxTotal $taxTotal): InvoiceLine
    {
        $this->taxTotals []= $taxTotal;
        return $this;
    }

    /**
     * @return array
     */
    public function getNotes(): ?array
    {
        return $this->notes;
    }

    /**
     * @param string $note
     * @return InvoiceLine
     */
    public function addNote(?string $note): InvoiceLine
    {
        $this->notes []= $note;
        return $this;
    }

    /**
     * @return InvoicePeriod []
     */
    public function getInvoicePeriods(): ?array
    {
        return $this->invoicePeriods;
    }

    /**
     * @param InvoicePeriod $invoicePeriod
     * @return InvoiceLine
     */
    public function addInvoicePeriod(?InvoicePeriod $invoicePeriod)
    {
        $this->invoicePeriods []= $invoicePeriod;
        return $this;
    }

    /**
     * @return Item
     */
    public function getItem(): ?Item
    {
        return $this->item ?? null;
    }

    /**
     * @param Item $item
     * @return InvoiceLine
     */
    public function setItem(Item $item): InvoiceLine
    {
        $this->item = $item;
        return $this;
    }

    /**
     * @return Price
     */
    public function getPrice(): ?Price
    {
        return $this->price;
    }

    /**
     * @param Price $price
     * @return InvoiceLine
     */
    public function setPrice(?Price $price): InvoiceLine
    {
        $this->price = $price;
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
     * @return InvoiceLine
     */
    public function setUnitCode(?string $unitCode): InvoiceLine
    {
        $this->unitCode = $unitCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountingCostCode(): ?string
    {
        return $this->accountingCostCode;
    }

    /**
     * @param string $accountingCostCode
     * @return InvoiceLine
     */
    public function setAccountingCostCode(?string $accountingCostCode): InvoiceLine
    {
        $this->accountingCostCode = $accountingCostCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccountingCost(): ?string
    {
        return $this->accountingCost;
    }

    /**
     * @param string $accountingCost
     * @return InvoiceLine
     */
    public function setAccountingCost(?string $accountingCost): InvoiceLine
    {
        $this->accountingCost = $accountingCost;
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
            throw new InvalidArgumentException('Missing invoice line id');
        }

        if (($this->lineExtensionAmount ?? null) === null) {
            throw new InvalidArgumentException('Missing invoice line extension amount');
        }

        if (($this->item ?? null) === null) {
            throw new InvalidArgumentException('Missing invoice line item');
        }

        if (($this->invoicedQuantity ?? null) === null) {
            throw new InvalidArgumentException('Missing invoice line quantity');
        }

        if (($this->unitCode ?? null) === null) {
            throw new InvalidArgumentException('Missing invoice line unitCode');
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
            Schema::CBC . 'ID' => $this->id
        ]);

        if ($this->notes !== null) {
            foreach ($this->notes as $note) {
                $writer->write([
                    Schema::CBC . 'Note' => $note
                ]);
            }
        }

        $writer->write([
            [
                'name' => Schema::CBC . 'InvoicedQuantity',
                'value' => Generator::format_quantity($this->invoicedQuantity),
                'attributes' => [
                    'unitCode' => $this->unitCode
                ]
            ],
            [
                'name' => Schema::CBC . 'LineExtensionAmount',
                'value' => Generator::format_money($this->lineExtensionAmount),
                'attributes' => [
                    'currencyID' => Generator::$currencyID
                ]
            ]
        ]);
        if ($this->accountingCostCode !== null) {
            $writer->write([
                Schema::CBC . 'AccountingCostCode' => $this->accountingCostCode
            ]);
        }
        if ($this->accountingCost !== null) {
            $writer->write([
                Schema::CBC . 'AccountingCost' => $this->accountingCost
            ]);
        }
        if ($this->invoicePeriods !== null) {
            foreach ($this->invoicePeriods as $invoicePeriod) {
                $writer->write([
                    Schema::CAC . 'InvoicePeriod' => $invoicePeriod
                ]);
            }
        }
        if ($this->taxTotals !== null) {
            foreach ($this->taxTotals as $taxTotal) {
                $writer->write([
                    Schema::CAC . 'TaxTotal' => $taxTotal
                ]);
            }
        }
        $writer->write([
            Schema::CAC . 'Item' => $this->item,
        ]);

        if ($this->price !== null) {
            $writer->write([
                Schema::CAC . 'Price' => $this->price
            ]);
        }
    }
}
