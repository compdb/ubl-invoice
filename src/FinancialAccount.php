<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class FinancialAccount implements XmlSerializable
{
    protected ?string $id = null;
    protected ?string $name = null;
    protected ?FinancialInstitutionBranch $financialInstitutionBranch = null;


    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return FinancialAccount
     */
    public function setId(?string $id): FinancialAccount
    {
        $this->id = $id;
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
     * @return FinancialAccount
     */
    public function setName(?string $name): FinancialAccount
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return FinancialInstitutionBranch
     */
    public function getFinancialInstitutionBranch(): ?FinancialInstitutionBranch
    {
        return $this->financialInstitutionBranch;
    }

    /**
     * @param FinancialInstitutionBranch $financialInstitutionBranch
     * @return FinancialAccount
     */
    public function setFinancialInstitutionBranch(?FinancialInstitutionBranch $financialInstitutionBranch): FinancialAccount
    {
        $this->financialInstitutionBranch = $financialInstitutionBranch;
        return $this;
    }

    public function xmlSerialize(Writer $writer)
    {
        $writer->write([
            'name' => Schema::CBC . 'ID',
            'value' => $this->id,
            'attributes' => [
                //'schemeID' => 'IBAN'
            ]
        ]);

        if ($this->getName() !== null) {
            $writer->write([
                Schema::CBC . 'Name' => $this->getName()
            ]);
        }

        if ($this->getFinancialInstitutionBranch() !== null) {
            $writer->write([
                Schema::CAC . 'FinancialInstitutionBranch' => $this->getFinancialInstitutionBranch()
            ]);
        }
    }
}
