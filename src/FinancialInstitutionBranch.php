<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class FinancialInstitutionBranch implements XmlSerializable
{
    protected ?string $id = null;
    protected ?string $name = null;

    /**
     * @return string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param string $id
     * @return FinancialInstitutionBranch
     */
    public function setId(?string $id): FinancialInstitutionBranch
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
     * @return FinancialInstitutionBranch
     */
    public function setName(?string $name): FinancialInstitutionBranch
    {
        $this->name = $name;
        return $this;
    }

    public function xmlSerialize(Writer $writer)
    {
        if ($this->id !== null) {
            $writer->write([
                Schema::CBC . 'ID' => $this->id
            ]);
        }
        if ($this->name !== null) {
            $writer->write([
                Schema::CBC . 'Name' => $this->name
            ]);
        }
    }
}
