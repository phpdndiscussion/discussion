<?php

namespace Discussion\Tests\Features;

use Discussion\Tests\WebTestCase;

class BarebonesTest extends WebTestCase
{
    /** @test */
    public function confirm_initial_app_setup_works()
    {
        $browser = $this->createClient();
        $crawler = $browser->request('GET', '/');

        $this->assertTrue($browser->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter("h1:contains('Hello')"));
    }
}
