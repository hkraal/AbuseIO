<?php

namespace tests\Console\Commands\Domain;

use Illuminate\Support\Facades\Artisan;
use \TestCase;

class ShowCommandTest extends TestCase
{
    public function testWithValidNameFilter()
    {
        $exitCode = Artisan::call('domain:show', [
            "--name" => "domain1.com"
        ]);

        $this->assertEquals($exitCode, 0);
        $this->assertContains("Customer 1", Artisan::output());
    }

    public function testWithValidIdFilter()
    {
        $exitCode = Artisan::call('domain:show', [
            "--id" => "1"
        ]);

        $this->assertEquals($exitCode, 0);
        $this->assertContains("Customer 1", Artisan::output());
    }

    public function testWithInvalidIdFilter()
    {
        $exitCode = Artisan::call('domain:show', [
            "--id" => "1000"
        ]);

        $this->assertEquals($exitCode, 0);
        $this->assertContains("No matching domain where found.", Artisan::output());
    }
}
