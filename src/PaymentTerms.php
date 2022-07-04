<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class PaymentTerms implements XmlSerializable
{
    protected ?array $notes = null;
    protected ?float $settlementDiscountPercent = null;
    protected ?float $amount = null;
    protected ?SettlementPeriod $settlementPeriod = null;

    /**
     * @return string
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * @param string $note
     * @return PaymentTerms
     */
    public function addNote(?string $note): PaymentTerms
    {
        $this->notes = $note;
        return $this;
    }

    /**
     * @return float
     */
    public function getSettlementDiscountPercent(): ?float
    {
        return $this->settlementDiscountPercent;
    }

    /**
     * @param float $settlementDiscountPercent
     * @return PaymentTerms
     */
    public function setSettlementDiscountPercent(?float $settlementDiscountPercent): PaymentTerms
    {
        $this->settlementDiscountPercent = $settlementDiscountPercent;
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
     * @return PaymentTerms
     */
    public function setAmount(?float $amount): PaymentTerms
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return SettlementPeriod
     */
    public function getSettlementPeriod(): ?SettlementPeriod
    {
        return $this->settlementPeriod;
    }

    /**
     * @param SettlementPeriod $settlementPeriod
     * @return PaymentTerms
     */
    public function setSettlementPeriod(?SettlementPeriod $settlementPeriod): PaymentTerms
    {
        $this->settlementPeriod = $settlementPeriod;
        return $this;
    }

    public function xmlSerialize(Writer $writer)
    {
        if ($this->notes !== null) {
            foreach ($this->notes as $note) {
                $writer->write([
                    Schema::CBC . 'Note' => $note
                ]);
            }
        }

        if ($this->settlementDiscountPercent !== null) {
            $writer->write([ Schema::CBC . 'SettlementDiscountPercent' => $this->settlementDiscountPercent ]);
        }

        if ($this->amount !== null) {
            $writer->write([
                [
                    'name' => Schema::CBC . 'Amount',
                    'value' => Generator::format_money($this->amount),
                    'attributes' => [
                        'currencyID' => Generator::$currencyID
                    ]
                ]
            ]);
        }

        if ($this->settlementPeriod !== null) {
            $writer->write([ Schema::CAC . 'SettlementPeriod' => $this->settlementPeriod ]);
        }
    }
}
