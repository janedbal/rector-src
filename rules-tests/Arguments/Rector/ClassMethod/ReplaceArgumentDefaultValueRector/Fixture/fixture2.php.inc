<?php

namespace Rector\Tests\Arguments\Rector\ClassMethod\ReplaceArgumentDefaultValueRector\Fixture;

use Symfony\Component\Yaml\Yaml;

class Fixture2 {
    function argumentDefaultValue2()
    {
        Yaml::parse('...', true);
        Yaml::parse('...', false);
        Yaml::parse('...', false, true);
        Yaml::parse('...', false, false, true);
    }
}

?>
-----
<?php

namespace Rector\Tests\Arguments\Rector\ClassMethod\ReplaceArgumentDefaultValueRector\Fixture;

use Symfony\Component\Yaml\Yaml;

class Fixture2 {
    function argumentDefaultValue2()
    {
        Yaml::parse('...', \Symfony\Component\Yaml\Yaml::PARSE_EXCEPTION_ON_INVALID_TYPE);
        Yaml::parse('...', 0);
        Yaml::parse('...', \Symfony\Component\Yaml\Yaml::PARSE_OBJECT);
        Yaml::parse('...', \Symfony\Component\Yaml\Yaml::PARSE_OBJECT_FOR_MAP);
    }
}

?>
