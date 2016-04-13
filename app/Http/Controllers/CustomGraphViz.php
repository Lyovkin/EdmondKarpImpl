<?php

namespace App\Http\Controllers;

use Fhaculty\Graph\Graph;
use Graphp\GraphViz\GraphViz;

class CustomGraphViz extends GraphViz
{
    private $format = 'png';

    /**
     * @param Graph $graph
     * @param null|string $style_css
     * @return string
     */
    public function createImageHtml(Graph $graph, $style_css = null)
    {
        if ($this->format === 'svg' || $this->format === 'svgz') {
            return '<object type="image/svg+xml" data="' . $this->createImageSrc($graph) . '"></object>';
        }

        return "<img src=" . $this->createImageSrc($graph) . " , style=$style_css  />";
    }

}