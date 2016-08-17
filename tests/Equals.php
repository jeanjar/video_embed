<?php


namespace VideoEmbed\Tests;

use VideoEmbed\VideoEmbed;

$loader = include dirname(__DIR__) . '/vendor/autoload.php';

class VimeoGetIdTeste extends \PHPUnit_Framework_TestCase
{
    public function testeGetIdEquals()
    {
        $id = VideoEmbed::render('https://www.youtube.com/watch?v=bLLxXZoqq_Y', ['return_id' => true]);
        $this->assertEquals('bLLxXZoqq_Y', $id);

        $id = VideoEmbed::render('https://vimeo.com/18758609', ['return_id' => true]);
        $this->assertEquals('18758609', $id);
    }

    public function testeEmbedEquals()
    {
        $video = VideoEmbed::render('https://www.youtube.com/watch?v=bLLxXZoqq_Y', ['width' => 300, 'height' => 250]);
        $this->assertEquals('<iframe width="300" height="250" src="//www.youtube.com/embed/bLLxXZoqq_Y" frameborder="0" allowfullscreen></iframe>', $video);

        $video = VideoEmbed::render('https://vimeo.com/18758609');
        $this->assertEquals('<iframe src="//player.vimeo.com/video/18758609"></iframe>', $video);
    }
}