<?php

namespace App\Tests\Service\Helper;

use App\Service\Helper\StringHelper;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{

    public function testSnakeCaseToCamelCase()
    {
        self::assertEquals('   ', StringHelper::snakeCaseToCamelCase('   '));
        self::assertEquals('snake', StringHelper::snakeCaseToCamelCase('snake'));
        self::assertEquals('snakeCase', StringHelper::snakeCaseToCamelCase('snake_case'));
        self::assertEquals('snake Case', StringHelper::snakeCaseToCamelCase('snake _case'));
    }
}
