<?php
namespace PenPaper\Delivery\Twig;

use DebugBar\JavascriptRenderer;
use Twig_Extension;
use Twig_SimpleFunction;

class DebugBarTwigExtension extends Twig_Extension
{
    private $debugBarRenderer;

    public function __construct(JavascriptRenderer $debugBarRenderer)
    {
        $this->debugBarRenderer = $debugBarRenderer;
    }

    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction('debug_bar_render_head', function () {
                return $this->debugBarRenderer->renderHead();
            }, array('is_safe' => array('html'))),
            new Twig_SimpleFunction('debug_bar_render', function () {
                return $this->debugBarRenderer->render();
            }, array('is_safe' => array('html'))),
        );
    }

    public function getName()
    {
        return 'debug_bar';
    }
}
