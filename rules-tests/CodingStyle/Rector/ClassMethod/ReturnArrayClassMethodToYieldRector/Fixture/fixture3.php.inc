<?php

namespace Rector\Tests\CodingStyle\Rector\ClassMethod\ReturnArrayClassMethodToYieldRector\Fixture;

use Rector\Tests\CodingStyle\Rector\ClassMethod\ReturnArrayClassMethodToYieldRector\Source\ParentTestCase;

final class MyTestCase3 extends ParentTestCase
{
    public function dataProvider(): array
    {
        return [[__DIR__ . '/Fixture/class_extending_array_access.php.inc', __DIR__ . '/Correct/correct.php.inc']];
    }
}

?>
-----
<?php

namespace Rector\Tests\CodingStyle\Rector\ClassMethod\ReturnArrayClassMethodToYieldRector\Fixture;

use Rector\Tests\CodingStyle\Rector\ClassMethod\ReturnArrayClassMethodToYieldRector\Source\ParentTestCase;

final class MyTestCase3 extends ParentTestCase
{
    public function dataProvider(): \Iterator
    {
        yield [__DIR__ . '/Fixture/class_extending_array_access.php.inc', __DIR__ . '/Correct/correct.php.inc'];
    }
}

?>
