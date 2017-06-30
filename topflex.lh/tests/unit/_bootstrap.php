<?php

// add unit testing specific bootstrap code here

use tests\models\UserTest;
use tests\unit\entities\Employee\ArchiveTest;
use tests\unit\entities\Employee\RenameTest;


require('entities/Employee/RenameTest.php');
(new RenameTest())->testSuccess();
