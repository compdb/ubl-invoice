<?php

namespace Compdb\UBL;

use Sabre\Xml\Service;

use InvalidArgumentException;

class Generator
{
    public static $currencyID;

    public static function invoice(Invoice $invoice, $currencyId = null)
    {

        if ($currencyId === null) {
            throw new InvalidArgumentException('Missing currency id');
        }

        self::$currencyID = $currencyId;

        $xmlService = new Service();

        $xmlService->namespaceMap = [
            'urn:oasis:names:specification:ubl:schema:xsd:Invoice-2' => '',
            'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2' => 'cbc',
            'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2' => 'cac'
        ];

        return $xmlService->write('Invoice', [
            $invoice
        ]);
    }

    public static function format_money(float $value) {

        return number_format($value, 2, '.', '');
    }

    public static function format_quantity(float $value) {

        return number_format($value, 3, '.', '');
    }

    public static function format_percent(float $value) {

        return number_format($value, 2, '.', '');
    }
}
