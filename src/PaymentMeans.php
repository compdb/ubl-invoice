<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;
use DateTime;

class PaymentMeans implements XmlSerializable
{
    protected string $paymentMeansCode;
    protected ?string $paymentDueDate = null;
    protected ?string $instructionId = null;
    protected ?string $instructionNote = null;
    protected ?string $paymentId = null;
    protected ?FinancialAccount $payeeFinancialAccount = null;

    /**
     * @return string
     */
    public function getPaymentMeansCode(): ?int
    {
        return $this->paymentMeansCode;
    }

    /**
     * @param string $paymentMeansCode
     * @return PaymentMeans
     */
    public function setPaymentMeansCode(?int $paymentMeansCode, $attributes = null): PaymentMeans
    {
        $this->paymentMeansCode = $paymentMeansCode;
        if (isset($attributes)) {
            $this->paymentMeansCodeAttributes = $attributes;
        }
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getPaymentDueDate(): ?DateTime
    {
        return $this->paymentDueDate;
    }

    /**
     * @param DateTime $paymentDueDate
     * @return PaymentMeans
     */
    public function setPaymentDueDate(?DateTime $paymentDueDate): PaymentMeans
    {
        $this->paymentDueDate = $paymentDueDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstructionId(): ?string
    {
        return $this->instructionId;
    }

    /**
     * @param string $instructionId
     * @return PaymentMeans
     */
    public function setInstructionId(?string $instructionId): PaymentMeans
    {
        $this->instructionId = $instructionId;
        return $this;
    }

    /**
     * @return string
     */
    public function getInstructionNote(): ?string
    {
        return $this->instructionNote;
    }

    /**
     * @param string $instructionNote
     * @return PaymentMeans
     */
    public function setInstructionNote(?string $instructionNote): PaymentMeans
    {
        $this->instructionNote = $instructionNote;
        return $this;
    }

    /**
     * @return string
     */
    public function getPaymentId(): ?string
    {
        return $this->paymentId;
    }

    /**
     * @param string $paymentId
     * @return PaymentMeans
     */
    public function setPaymentId(?string $paymentId): PaymentMeans
    {
        $this->paymentId = $paymentId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayeeFinancialAccount(): ?FinancialAccount
    {
        return $this->payeeFinancialAccount;
    }

    /**
     * @param mixed $payeeFinancialAccount
     * @return PaymentMeans
     */
    public function setPayeeFinancialAccount(?FinancialAccount $payeeFinancialAccount): PaymentMeans
    {
        $this->payeeFinancialAccount = $payeeFinancialAccount;
        return $this;
    }

    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            Schema::CBC . 'PaymentMeansCode' => $this->paymentMeansCode
        ]);

        if ($this->getPaymentDueDate() !== null) {
            $writer->write([
                Schema::CBC . 'PaymentDueDate' => $this->getPaymentDueDate()->format('Y-m-d')
            ]);
        }

        if ($this->getInstructionId() !== null) {
            $writer->write([
                Schema::CBC . 'InstructionID' => $this->getInstructionId()
            ]);
        }

        if ($this->getInstructionNote() !== null) {
            $writer->write([
                Schema::CBC . 'InstructionNote' => $this->getInstructionNote()
            ]);
        }

        if ($this->getPaymentId() !== null) {
            $writer->write([
                Schema::CBC . 'PaymentID' => $this->getPaymentId()
            ]);
        }

        if ($this->getPayeeFinancialAccount() !== null) {
            $writer->write([
                Schema::CAC . 'PayeeFinancialAccount' => $this->getPayeeFinancialAccount()
            ]);
        }
    }
}
