<?php

namespace Tests;
use PHPUnit\Framework\TestCase;

class AdminTest extends TestCase {
    public function testAdminIsTrue() {
        $admin = true;
        $this->assertTrue($admin);
    }
}
