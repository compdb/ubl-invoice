<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use DateTime;
use InvalidArgumentException;

class Invoice implements XmlSerializable
{
    protected ?string $UBLVersionID = null;
    protected ?string $customizationID = null;
    protected string $id;
    protected ?bool $copyIndicator = null;
    protected DateTime $issueDate;
    protected ?string $invoiceTypeCode = null;
    protected ?array $notes = null;
    protected ?DateTime $taxPointDate = null;
    protected ?DateTime $dueDate = null;
    protected ?PaymentTerms $paymentTerms = null;
    protected Party $accountingSupplierParty;
    protected Party $accountingCustomerParty;
    protected ?string $supplierAssignedAccountID = null;
    protected ?PaymentMeans $paymentMeans = null;
    protected ?TaxTotal $taxTotal = null;
    protected LegalMonetaryTotal $legalMonetaryTotal;
    protected array $invoiceLines;
    protected ?array $allowanceCharges = null;
    protected ?array $additionalDocumentReferences = null;
    protected ?string $documentCurrencyCode = null;
    protected ?string $buyerReference = null;
    protected ?string $accountingCostCode = null;
    protected ?array $invoicePeriods = null;
    protected ?array $deliveries = null;
    protected ?OrderReference $orderReference = null;
    protected ?ContractDocumentReference $contractDocumentReference = null;

    /**
     * @return string
     */
    public function getUBLVersionID(): ?string
    {
        return $this->UBLVersionID;
    }

    /**
     * @param string $UBLVersionID
     * eg. '2.0', '2.1', '2.2', ...
     * @return Invoice
     */
    public function setUBLVersionID(?string $UBLVersionID): Invoice
    {
        $this->UBLVersionID = $UBLVersionID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId(): ?string
    {
        return $this->id ?? null;
    }

    /**
     * @param mixed $id
     * @return Invoice
     */
    public function setId(?string $id): Invoice
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $customizationID
     * @return Invoice
     */
    public function setCustomizationID(?string $id): Invoice
    {
        $this->customizationID = $id;
        return $this;
    }

    /**
     * @return bool
     */
    public function isCopyIndicator(): bool
    {
        return $this->copyIndicator;
    }

    /**
     * @param bool $copyIndicator
     * @return Invoice
     */
    public function setCopyIndicator(bool $copyIndicator): Invoice
    {
        $this->copyIndicator = $copyIndicator;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getIssueDate(): ?DateTime
    {
        return $this->issueDate ?? null;
    }

    /**
     * @param DateTime $issueDate
     * @return Invoice
     */
    public function setIssueDate(DateTime $issueDate): Invoice
    {
        $this->issueDate = $issueDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDueDate(): ?DateTime
    {
        return $this->dueDate;
    }

    /**
     * @param DateTime $dueDate
     * @return Invoice
     */
    public function setDueDate(DateTime $dueDate): Invoice
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    /**
     * @param mixed $currencyCode
     * @return Invoice
     */
    public function setDocumentCurrencyCode(string $currencyCode): Invoice
    {
        $this->documentCurrencyCode = $currencyCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getInvoiceTypeCode(): ?string
    {
        return $this->invoiceTypeCode;
    }

    /**
     * @param string $invoiceTypeCode
     * See also: src/InvoiceTypeCode.php
     * @return Invoice
     */
    public function setInvoiceTypeCode(string $invoiceTypeCode): Invoice
    {
        $this->invoiceTypeCode = $invoiceTypeCode;
        return $this;
    }

    /**
     * @return array
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $note
     * @return Invoice
     */
    public function addNote(string $note)
    {
        $this->notes []= $note;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getTaxPointDate(): ?DateTime
    {
        return $this->taxPointDate;
    }

    /**
     * @param DateTime $taxPointDate
     * @return Invoice
     */
    public function setTaxPointDate(DateTime $taxPointDate): Invoice
    {
        $this->taxPointDate = $taxPointDate;
        return $this;
    }

    /**
     * @return PaymentTerms
     */
    public function getPaymentTerms(): ?PaymentTerms
    {
        return $this->paymentTerms;
    }

    /**
     * @param PaymentTerms $paymentTerms
     * @return Invoice
     */
    public function setPaymentTerms(PaymentTerms $paymentTerms): Invoice
    {
        $this->paymentTerms = $paymentTerms;
        return $this;
    }

    /**
     * @return Party
     */
    public function getAccountingSupplierParty(): ?Party
    {
        return $this->accountingSupplierParty ?? null;
    }

    /**
     * @param Party $accountingSupplierParty
     * @return Invoice
     */
    public function setAccountingSupplierParty(Party $accountingSupplierParty): Invoice
    {
        $this->accountingSupplierParty = $accountingSupplierParty;
        return $this;
    }

    /**
     * @return Party
     */
    public function getSupplierAssignedAccountID(): ?string
    {
        return $this->supplierAssignedAccountID;
    }

    /**
     * @param string $supplierAssignedAccountID
     * @return Invoice
     */
    public function setSupplierAssignedAccountID(string $supplierAssignedAccountID): Invoice
    {
        $this->supplierAssignedAccountID = $supplierAssignedAccountID;
        return $this;
    }

    /**
     * @return Party
     */
    public function getAccountingCustomerParty(): ?Party
    {
        return $this->accountingCustomerParty ?? null;
    }

    /**
     * @param Party $accountingCustomerParty
     * @return Invoice
     */
    public function setAccountingCustomerParty(Party $accountingCustomerParty): Invoice
    {
        $this->accountingCustomerParty = $accountingCustomerParty;
        return $this;
    }

    /**
     * @return PaymentMeans
     */
    public function getPaymentMeans(): ?PaymentMeans
    {
        return $this->paymentMeans;
    }

    /**
     * @param PaymentMeans $paymentMeans
     * @return Invoice
     */
    public function setPaymentMeans(PaymentMeans $paymentMeans): Invoice
    {
        $this->paymentMeans = $paymentMeans;
        return $this;
    }

    /**
     * @return TaxTotal
     */
    public function getTaxTotal(): ?TaxTotal
    {
        return $this->taxTotal;
    }

    /**
     * @param TaxTotal $taxTotal
     * @return Invoice
     */
    public function setTaxTotal(TaxTotal $taxTotal): Invoice
    {
        $this->taxTotal = $taxTotal;
        return $this;
    }

    /**
     * @return LegalMonetaryTotal
     */
    public function getLegalMonetaryTotal(): ?LegalMonetaryTotal
    {
        return $this->legalMonetaryTotal ?? null;
    }

    /**
     * @param LegalMonetaryTotal $legalMonetaryTotal
     * @return Invoice
     */
    public function setLegalMonetaryTotal(LegalMonetaryTotal $legalMonetaryTotal): Invoice
    {
        $this->legalMonetaryTotal = $legalMonetaryTotal;
        return $this;
    }

    /**
     * @return InvoiceLine[]
     */
    public function getInvoiceLines(): ?array
    {
        return $this->invoiceLines ?? null;
    }

    /**
     * @param InvoiceLine $invoiceLine
     * @return Invoice
     */
    public function addInvoiceLine(InvoiceLine $invoiceLine): Invoice
    {
        $this->invoiceLines []= $invoiceLine;
        return $this;
    }

    /**
     * @param InvoiceLines $invoiceLine []
     * @return Invoice
     */
    public function addInvoiceLines(array $invoiceLines): Invoice
    {
        foreach ($invoiceLines as $invoiceLine) {
            $this->addInvoiceLine($invoiceLine);
        }
        return $this;
    }

    /**
     * @return AllowanceCharge[]
     */
    public function getAllowanceCharges(): ?array
    {
        return $this->allowanceCharges;
    }

    /**
     * @param AllowanceCharge $allowanceCharge
     * @return Invoice
     */
    public function addAllowanceCharge(AllowanceCharge $allowanceCharge): Invoice
    {
        $this->allowanceCharges []= $allowanceCharges;
        return $this;
    }

    /**
     * @return array
     */
    public function getAdditionalDocumentReferences(): ?array
    {
        return $this->additionalDocumentReferences;
    }

    /**
     * @param AdditionalDocumentReference $additionalDocumentReference
     * @return Invoice
     */
    public function addAdditionalDocumentReference(AdditionalDocumentReference $additionalDocumentReference): Invoice
    {
        $this->additionalDocumentReferences []= $additionalDocumentReference;
        return $this;
    }

    /**
     * @param string $buyerReference
     * @return Invoice
     */
    public function setBuyerReference(string $buyerReference): Invoice
    {
        $this->buyerReference = $buyerReference;
        return $this;
    }

      /**
     * @return string buyerReference
     */
    public function getBuyerReference(): ?string
    {
        return $this->buyerReference;
    }

    /**
     * @return mixed
     */
    public function getAccountingCostCode(): ?string
    {
        return $this->accountingCostCode;
    }

    /**
     * @param mixed $accountingCostCode
     * @return Invoice
     */
    public function setAccountingCostCode(string $accountingCostCode): Invoice
    {
        $this->accountingCostCode = $accountingCostCode;
        return $this;
    }

    /**
     * @return InvoicePeriods
     */
    public function getInvoicePeriods(): ?array
    {
        return $this->invoicePeriods;
    }

    /**
     * @param InvoicePeriod $invoicePeriod
     * @return Invoice
     */
    public function addInvoicePeriod(InvoicePeriod $invoicePeriod): Invoice
    {
        $this->invoicePeriods []= $invoicePeriod;
        return $this;
    }

    /**
     * @return Delivery
     */
    public function getDeliveries(): ?array
    {
        return $this->deliveries;
    }

    /**
     * @param Delivery $delivery
     * @return Invoice
     */
    public function addDelivery(Delivery $delivery): Invoice
    {
        $this->deliveries []= $delivery;
        return $this;
    }

    /**
     * @return OrderReference
     */
    public function getOrderReference(): ?OrderReference
    {
        return $this->orderReference;
    }

    /**
     * @param OrderReference $orderReference
     * @return OrderReference
     */
    public function setOrderReference(OrderReference $orderReference): Invoice
    {
        $this->orderReference = $orderReference;
        return $this;
    }

    /**
     * @return ContractDocumentReference
     */
    public function getContractDocumentReference(): ?ContractDocumentReference
    {
        return $this->contractDocumentReference;
    }

    /**
     * @param string $ContractDocumentReference
     * @return Invoice
     */
    public function setContractDocumentReference(ContractDocumentReference $contractDocumentReference): Invoice
    {
        $this->contractDocumentReference = $contractDocumentReference;
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

        if (($this->issueDate ?? null) === null) {
            throw new InvalidArgumentException('Invalid invoice issueDate');
        }

        if (($this->accountingSupplierParty ?? null) === null) {
            throw new InvalidArgumentException('Missing invoice accountingSupplierParty');
        }

        if (($this->accountingCustomerParty ?? null) === null) {
            throw new InvalidArgumentException('Missing invoice accountingCustomerParty');
        }

        if (($this->invoiceLines ?? null) === null || !count($this->invoiceLines)) {
            throw new InvalidArgumentException('Missing invoice lines');
        }

        if (($this->legalMonetaryTotal ?? null) === null) {
            throw new InvalidArgumentException('Missing invoice LegalMonetaryTotal');
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

        if ($this->UBLVersionID !== null) {
            $writer->write([
                Schema::CBC . 'UBLVersionID' => $this->UBLVersionID
            ]);
        }

        if ($this->customizationID !== null) {
            $writer->write([
                Schema::CBC . 'CustomizationID' => $this->customizationID
            ]);
        }

        $writer->write([
            Schema::CBC . 'ID' => $this->id
        ]);

        if ($this->copyIndicator !== null) {
            $writer->write([
                Schema::CBC . 'CopyIndicator' => $this->copyIndicator ? 'true' : 'false'
            ]);
        }

        $writer->write([
            Schema::CBC . 'IssueDate' => $this->issueDate->format('Y-m-d'),
        ]);

        if ($this->dueDate !== null) {
            $writer->write([
                Schema::CBC . 'DueDate' => $this->dueDate->format('Y-m-d')
            ]);
        }

        if ($this->invoiceTypeCode !== null) {
            $writer->write([
                Schema::CBC . 'InvoiceTypeCode' => $this->invoiceTypeCode
            ]);
        }

        if ($this->notes !== null) {
            foreach ($this->notes as $note) {
                $writer->write([
                    Schema::CBC . 'Note' => $note
                ]);
            }
        }

        if ($this->taxPointDate !== null) {
            $writer->write([
                Schema::CBC . 'TaxPointDate' => $this->taxPointDate->format('Y-m-d')
            ]);
        }

        $writer->write([
            Schema::CBC . 'DocumentCurrencyCode' => $this->documentCurrencyCode,
        ]);

        if ($this->accountingCostCode !== null) {
            $writer->write([
                Schema::CBC . 'AccountingCostCode' => $this->accountingCostCode
            ]);
        }

        if ($this->buyerReference !== null) {
            $writer->write([
                Schema::CBC . 'BuyerReference' => $this->buyerReference
            ]);
        }

        if ($this->contractDocumentReference !== null) {
            $writer->write([
                Schema::CAC . 'ContractDocumentReference' => $this->contractDocumentReference,
            ]);
        }

        if ($this->invoicePeriods !== null) {
            foreach ($this->invoicePeriods as $invoicePeriod) {
                $writer->write([
                    Schema::CAC . 'InvoicePeriod' => $invoicePeriod
                ]);
            }
        }

        if ($this->orderReference !== null) {
            $writer->write([
                Schema::CAC . 'OrderReference' => $this->orderReference
            ]);
        }

        if ($this->additionalDocumentReferences !== null) {
            foreach ($this->additionalDocumentReferences as $additionalDocumentReference) {
                $writer->write([
                    Schema::CAC . 'AdditionalDocumentReference' => $additionalDocumentReference
                ]);
            }
        }

        if ($this->supplierAssignedAccountID !== null) {
            $customerParty = [
                Schema::CBC . 'SupplierAssignedAccountID' => $this->supplierAssignedAccountID,
                Schema::CAC . "Party" => $this->accountingCustomerParty
            ];
        } else {
            $customerParty = [
                Schema::CAC . "Party" => $this->accountingCustomerParty
            ];
        }

        $writer->write([
            Schema::CAC . 'AccountingSupplierParty' => [Schema::CAC . "Party" => $this->accountingSupplierParty],
            Schema::CAC . 'AccountingCustomerParty' => $customerParty,
        ]);

        if ($this->deliveries !== null) {
            foreach ($this->deliveries as $delivery) {
                $writer->write([
                    Schema::CAC . 'Delivery' => $delivery
                ]);
            }
        }

        if ($this->paymentMeans !== null) {
            $writer->write([
                Schema::CAC . 'PaymentMeans' => $this->paymentMeans
            ]);
        }

        if ($this->paymentTerms !== null) {
            $writer->write([
                Schema::CAC . 'PaymentTerms' => $this->paymentTerms
            ]);
        }

        if ($this->allowanceCharges !== null) {
            foreach ($this->allowanceCharges as $allowanceCharge) {
                $writer->write([
                    Schema::CAC . 'AllowanceCharge' => $allowanceCharge
                ]);
            }
        }

        if ($this->taxTotal !== null) {
            $writer->write([
                Schema::CAC . 'TaxTotal' => $this->taxTotal
            ]);
        }

        $writer->write([
            Schema::CAC . 'LegalMonetaryTotal' => $this->legalMonetaryTotal
        ]);

        foreach ($this->invoiceLines as $invoiceLine) {
            $writer->write([
                Schema::CAC . 'InvoiceLine' => $invoiceLine
            ]);
        }
    }
}
