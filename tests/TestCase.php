<?php

namespace Shopi\Tests;

class TestCase extends \PHPUnit\Framework\TestCase
{
    protected function tearDown(): void
    {
        \Mockery::close();
    }
}