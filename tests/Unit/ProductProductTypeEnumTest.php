<?php

namespace Tests\Unit;

use App\Enums\ProductTypeEnum;
use PHPUnit\Framework\TestCase;

class ProductProductTypeEnumTest extends TestCase
{
    /**
     * Test that product type will be filtered as expected
     */
    public function test_enums_product_type_when_all_is_used_as_param_successfully(): void
    {
        $filterValue = ProductTypeEnum::ALL->value;

        $filtered = ProductTypeEnum::getFilterableTypesAsArray($filterValue);

        $this->assertEqualsCanonicalizing(
            $filtered,
            [
                ProductTypeEnum::ACCOUNT->value,
                ProductTypeEnum::PHYSICAL_GOODS->value,
                ProductTypeEnum::INGAME_GOODS->value,
            ]
        );
    }

    /**
     * Test that product type will be filtered as expected
     */
    public function test_enums_product_type_when_specific_status_is_used_as_param_successfully(): void
    {
        $filterValue = ProductTypeEnum::ACCOUNT->value;

        $filtered = ProductTypeEnum::getFilterableTypesAsArray($filterValue);

        $this->assertEqualsCanonicalizing($filtered, [ProductTypeEnum::ACCOUNT->value]);
    }
}
