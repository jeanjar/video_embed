<?php


namespace VideoEmbed\Tests;

use VideoEmbed\VideoEmbed;

$loader = include dirname(__DIR__) . '/vendor/autoload.php';

class VimeoGetIdTeste extends \PHPUnit_Framework_TestCase
{
    public function testeGetIdEquals()
    {
        $protocol = getProtocol();
        $id = VideoEmbed::render($protocol . '://www.youtube.com/watch?v=bLLxXZoqq_Y', ['return_id' => true]);
        $this->assertEquals('bLLxXZoqq_Y', $id);

        $id = VideoEmbed::render($protocol . '://vimeo.com/18758609', ['return_id' => true]);
        $this->assertEquals('18758609', $id);
    }

    public function testeEmbedEquals()
    {
        $protocol = getProtocol();
        $video = VideoEmbed::render($protocol . '://www.youtube.com/watch?v=bLLxXZoqq_Y', ['width' => 300, 'height' => 250]);
        $this->assertEquals('<iframe width="300" height="250" src="//www.youtube.com/embed/bLLxXZoqq_Y" frameborder="0" allowfullscreen></iframe>', $video);

        $video = VideoEmbed::render($protocol . '://vimeo.com/18758609');
        $this->assertEquals('<iframe src="' . $protocol . '://player.vimeo.com/video/18758609"></iframe>', $video);
    }

    public function testeThumbNail()
    {
        $protocol = getProtocol();
        $id = VideoEmbed::render($protocol . '://www.youtube.com/watch?v=bLLxXZoqq_Y', ['return_thumbnail' => true]);
        $this->assertEquals($protocol . '://img.youtube.com/vi/bLLxXZoqq_Y/hqdefault.jpg', $id);

        //ainda não sei como testar o video...
        //$id = VideoEmbed::render('https://vimeo.com/18758609', ['return_thumbnail' => true]);
        //$this->assertEquals('18758609', $id);
    }
}