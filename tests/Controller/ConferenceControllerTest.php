<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConferenceControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h2', 'Give your feedback');
    }

    public function testConferencePage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertCount(2, $crawler->filter('h4'));

//        $client->clickLink('View');

        $client->click($crawler->filter('h4 + p a')->link());

        $this->assertPageTitleContains('London 2018');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextNotContains('h2', 'Add your own feedback');
        $this->assertSelectorExists('div:contains("No comments have been posted yet for this conference.")');
    }

    public function testCommentSubmission()
    {
        $client = static::createClient();
        $client->request('GET', '/conference/london-2018');
        $client->submitForm('Submit', [
                'comment_form[author]' => 'Galiya',
                'comment_form[text]' => 'Some feedback from an automated functional test',
                'comment_form[email]' => 'me@automat.ed',
                'comment_form[photo]' => dirname(__DIR__, 2).'/public/images/unnamed.jpg'
            ]);

        $this->assertResponseRedirects();
        $client->followRedirect();
        $this->assertSelectorExists('div:contains("There are 1 comments")');
    }
}
