<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

class Item implements XmlSerializable
{
    protected ?array $descriptions = null;
    protected ?string $name = null;
    protected ?string $buyersItemIdentification = null;
    protected ?string $sellersItemIdentification = null;
    protected ?array $commodityClassifications = null;
    protected ?array $classifiedTaxCategories = null;

    /**
     * @return string
     */
    public function getDescriptions(): ?string
    {
        return $this->descriptions;
    }

    /**
     * @param string $description
     * @return Item
     */
    public function addDescription(?string $description): Item
    {
        $this->descriptions []= $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return Item
     */
    public function setName(?string $name): Item
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSellersItemIdentification(): ?string
    {
        return $this->sellersItemIdentification;
    }

    /**
     * @param mixed $sellersItemIdentification
     * @return Item
     */
    public function setSellersItemIdentification(?string $sellersItemIdentification): Item
    {
        $this->sellersItemIdentification = $sellersItemIdentification;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBuyersItemIdentification(): ?string
    {
        return $this->buyersItemIdentification;
    }

    /**
     * @param mixed $buyersItemIdentification
     * @return Item
     */
    public function setBuyersItemIdentification(?string $buyersItemIdentification): Item
    {
        $this->buyersItemIdentification = $buyersItemIdentification;
        return $this;
    }

    /**
     * @return CommodityClassification
     */
    public function getCommodityClassifications(): ?array
    {
        return $this->commodityClassifications;
    }

    /**
     * @param CommodityClassification $commodityClassification
     * @return Item
     */
    public function addCommodityClassification(?CommodityClassification $commodityClassification): Item
    {
        $this->commodityClassifications []= $commodityClassification;
        return $this;
    }

    /**
     * @return ClassifiedTaxCategory
     */
    public function getClassifiedTaxCategories(): ?array
    {
        return $this->classifiedTaxCategories;
    }

    /**
     * @param ClassifiedTaxCategory $classifiedTaxCategory
     * @return Item
     */
    public function addClassifiedTaxCategory(?ClassifiedTaxCategory $classifiedTaxCategory): Item
    {
        $this->classifiedTaxCategories []= $classifiedTaxCategory;
        return $this;
    }

    /**
     * The xmlSerialize method is called during xml writing.
     *
     * @param Writer $writer
     * @return void
     */
    public function xmlSerialize(Writer $writer)
    {
        if ($this->descriptions !== null) {
            foreach ($this->descriptions as $description) {
                $writer->write([
                    Schema::CBC . 'Description' => $description
                ]);
            }
        }

        $writer->write([
            Schema::CBC . 'Name' => $this->name
        ]);

        if ($this->buyersItemIdentification !== null) {
            $writer->write([
                Schema::CAC . 'BuyersItemIdentification' => [
                    Schema::CBC . 'ID' => $this->buyersItemIdentification
                ],
            ]);
        }

        if ($this->sellersItemIdentification !== null) {
            $writer->write([
                Schema::CAC . 'SellersItemIdentification' => [
                    Schema::CBC . 'ID' => $this->sellersItemIdentification
                ],
            ]);
        }

        if ($this->commodityClassifications !== null) {
            foreach ($this->commodityClassifications as $commodityClassification) {
                $writer->write([
                    Schema::CAC . 'CommodityClassification' => $commodityClassification
                ]);
            }
        }

        if ($this->classifiedTaxCategories !== null) {
            foreach ($this->classifiedTaxCategories as $classifiedTaxCategory) {
                $writer->write([
                    Schema::CAC . 'ClassifiedTaxCategory' => $classifiedTaxCategory
                ]);
            }
        }
    }
}
