<?php

class NamespaceLessClassNoDeclareStrictTypes
{
    public function someMethod()
    {
        $parentClass = parent::someMethod();

        $someClass = new Rector\Tests\PSR4\Rector\FileWithoutNamespace\NormalizeNamespaceByPSR4ComposerAutoloadRector\Source\SomeClass();
    }
}

?>
-----
<?php

namespace Rector\Tests\PSR4\Rector\FileWithoutNamespace\NormalizeNamespaceByPSR4ComposerAutoloadRector\Fixture;

class NamespaceLessClassNoDeclareStrictTypes
{
    public function someMethod()
    {
        $parentClass = parent::someMethod();

        $someClass = new \Rector\Tests\PSR4\Rector\FileWithoutNamespace\NormalizeNamespaceByPSR4ComposerAutoloadRector\Source\SomeClass();
    }
}

?>
