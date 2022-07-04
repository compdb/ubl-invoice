<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class AllowanceCharge implements XmlSerializable
{
    protected bool $chargeIndicator;
    protected ?string $allowanceChargeReasonCode = null;
    protected ?array $allowanceChargeReasons = null;
    protected ?float $multiplierFactorNumeric = null;
    protected ?float $baseAmount = null;
    protected float $amount;
    protected ?float $taxTotal = null;
    protected ?array $taxCategories = null;

    /**
     * @return bool
     */
    public function isChargeIndicator(): bool
    {
        return $this->chargeIndicator ?? null;
    }

    /**
     * @param bool $chargeIndicator
     * @return AllowanceCharge
     */
    public function setChargeIndicator(bool $chargeIndicator): AllowanceCharge
    {
        $this->chargeIndicator = $chargeIndicator;
        return $this;
    }

    /**
     * @return int
     */
    public function getAllowanceChargeReasonCode(): ?string
    {
        return $this->allowanceChargeReasonCode;
    }

    /**
     * @param int $allowanceChargeReasonCode
     * @return AllowanceCharge
     */
    public function setAllowanceChargeReasonCode(?string $allowanceChargeReasonCode): AllowanceCharge
    {
        $this->allowanceChargeReasonCode = $allowanceChargeReasonCode;
        return $this;
    }

    /**
     * @return array
     */
    public function getAllowanceChargeReasons(): ?array
    {
        return $this->allowanceChargeReasons;
    }

    /**
     * @param string $allowanceChargeReason
     * @return AllowanceCharge
     */
    public function setAllowanceChargeReason(?string $allowanceChargeReason): AllowanceCharge
    {
        $this->allowanceChargeReasons []= $allowanceChargeReason;
        return $this;
    }

    /**
     * @return int
     */
    public function getMultiplierFactorNumeric(): ?float
    {
        return $this->multiplierFactorNumeric;
    }

    /**
     * @param int $multiplierFactorNumeric
     * @return AllowanceCharge
     */
    public function setMultiplierFactorNumeric(?float $multiplierFactorNumeric): AllowanceCharge
    {
        $this->multiplierFactorNumeric = $multiplierFactorNumeric;
        return $this;
    }

    /**
     * @return float
     */
    public function getBaseAmount(): ?float
    {
        return $this->baseAmount ?? null;
    }

    /**
     * @param float $baseAmount
     * @return AllowanceCharge
     */
    public function setBaseAmount(?float $baseAmount): AllowanceCharge
    {
        $this->baseAmount = $baseAmount;
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     * @return AllowanceCharge
     */
    public function setAmount(?float $amount): AllowanceCharge
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return TaxCategory []
     */
    public function getTaxCategories(): ?array
    {
        return $this->taxCategories;
    }

    /**
     * @param TaxCategory $taxCategory
     * @return AllowanceCharge
     */
    public function setTaxCategory(?TaxCategory $taxCategory): AllowanceCharge
    {
        $this->taxCategories []= $taxCategory;
        return $this;
    }

    /**
     * @return TaxTotal
     */
    public function getTaxtotal(): ?TaxTotal
    {
        return $this->taxTotal;
    }

    /**
     * @param TaxTotal $taxTotal
     * @return AllowanceCharge
     */
    public function setTaxtotal(?TaxTotal $taxTotal): AllowanceCharge
    {
        $this->taxTotal = $taxTotal;
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
        if (($this->chargeIndicator ?? null) === null) {
            throw new InvalidArgumentException('Missing charge indicator');
        }

        if (($this->amount ?? null) === null) {
            throw new InvalidArgumentException('Missing amount');
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
            Schema::CBC . 'ChargeIndicator' => $this->chargeIndicator ? 'true' : 'false',
        ]);

        if ($this->allowanceChargeReasonCode !== null) {
            $writer->write([
                Schema::CBC . 'AllowanceChargeReasonCode' => $this->allowanceChargeReasonCode
            ]);
        }

        if ($this->allowanceChargeReasons !== null) {
            foreach ($this->allowanceChargeReasons as $allowanceChargeReason) {
                $writer->write([
                    Schema::CAC . 'AllowanceChargeReason' => $allowanceChargeReason
                ]);
            }
        }

        if ($this->multiplierFactorNumeric !== null) {
            $writer->write([
                Schema::CBC . 'MultiplierFactorNumeric' => $this->multiplierFactorNumeric
            ]);
        }

        $writer->write([
            [
                'name' => Schema::CBC . 'Amount',
                'value' => $this->amount,
                'attributes' => [
                    'currencyID' => Generator::$currencyID
                ]
            ],
        ]);

        if ($this->taxCategories !== null) {
            foreach ($this->taxCategories as $taxCategory) {
                $writer->write([
                    Schema::CAC . 'TaxCategory' => $taxCategory
                ]);
            }
        }

        if ($this->taxTotal !== null) {
            $writer->write([
                Schema::CAC . 'TaxTotal' => $this->taxTotal
            ]);
        }

        if ($this->baseAmount !== null) {
            $writer->write([
                [
                    'name' => Schema::CBC . 'BaseAmount',
                    'value' => $this->baseAmount,
                    'attributes' => [
                        'currencyID' => Generator::$currencyID
                    ]
                ]
            ]);
        }
    }
}
