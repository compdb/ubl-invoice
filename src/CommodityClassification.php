<?php

namespace Compdb\UBL;

use Sabre\Xml\Writer;
use Sabre\Xml\XmlSerializable;

use InvalidArgumentException;

class CommodityClassification implements XmlSerializable
{
    protected ?string $natureCode = null;
    protected ?string $cargoTypeCode = null;
    protected ?string $commodityCode = null;
    protected ?string $itemClassificationCode = null;
    protected array $attributes = [
        'itemClassificationCode' => [
            "listID" => null,
            "listAgencyID" => null,
            "listAgencyName" => null,
            "listName" => null,
            "listVersionID" => null,
            "name" => null,
            "languageID" => null,
            "listURI" => null,
            "listSchemeURI" => null,
        ]
    ];

    protected function setAttributes(string $parent, array $attributes): Void
    {
        if (!array_key_exists($parent, $this->attributes)) {
            throw new InvalidArgumentException("${parent} does not support attributes");
        }
        foreach ($attributes as $key => $value) {
            if (!array_key_exists($key, $this->attributes[$parent])) {
                throw new InvalidArgumentException("Attribute ${key} not supported for ${parent}");
            }
            $this->attributes[$parent][$key] = $value;
        }
    }

    protected function getAttributes(string $parent): array
    {
        if (!array_key_exists($parent, $this->attributes)) {
            return [];
        }
        return array_filter($this->attributes[$parent], function ($value, $key) {
            return $value !== null;
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * @return mixed
     */
    public function getNatureCode(): ?string
    {
        return $this->natureCode;
    }

    /**
     * @param mixed $natureCode
     * @return CommodityClassification
     */
    public function setNatureCode(?string $natureCode): CommodityClassification
    {
        $this->natureCode = $natureCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCargoTypeCode(): ?string
    {
        return $this->cargoTypeCode;
    }

    /**
     * @param mixed $cargoTypeCode
     * @return CommodityClassification
     */
    public function setCargoTypeCode(?string $cargoTypeCode): CommodityClassification
    {
        $this->cargoTypeCode = $cargoTypeCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCommodityCode(): ?string
    {
        return $this->commodityCode;
    }

    /**
     * @param mixed $commodityCode
     * @return CommodityClassification
     */
    public function setCommodityCode(?string $commodityCode): CommodityClassification
    {
        $this->commodityCode = $commodityCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemClassificationCode(): ?string
    {
        return $this->itemClassificationCode;
    }

    /**
     * @param mixed $itemClassificationCode
     * @return CommodityClassification
     */
    public function setItemClassificationCode(?string $itemClassificationCode, array $attributes = []): CommodityClassification
    {
        $this->itemClassificationCode = $itemClassificationCode;
        $this->setAttributes('itemClassificationCode', $attributes);
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
        if ($this->natureCode !== null) {
            $writer->write([
                Schema::CBC . 'NatureCode' => $this->natureCode,
            ]);
        }
        if ($this->cargoTypeCode !== null) {
            $writer->write([
                Schema::CBC . 'CargoTypeCode' => $this->CargoTypeCode,
            ]);
        }
        if ($this->commodityCode !== null) {
            $writer->write([
                Schema::CBC . 'CommodityCode' => $this->commodityCode,
            ]);
        }
        if ($this->itemClassificationCode !== null) {
            $writer->write([
                [
                    'name' => Schema::CBC . 'ItemClassificationCode',
                    'value' => $this->itemClassificationCode,
                    'attributes' => $this->getAttributes('itemClassificationCode')
                ]
            ]);
        }
    }
}
