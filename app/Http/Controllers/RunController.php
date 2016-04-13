<?php

namespace App\Http\Controllers;

use Fhaculty\Graph\Graph;
use Graphp\Algorithms\MaxFlow\EdmondsKarp;

/**
 * Class RunController
 * @package App\Http\Controllers
 */
class RunController extends Controller
{
    /**
     * Run graph
     * @param Graph $graph
     * @return string
     */
    public function run(Graph $graph)
    {
        /**
         * Создаем вершины
         */
        $a = $graph->createVertex('A');
        $b = $graph->createVertex('B');
        $c = $graph->createVertex('C');
        $d = $graph->createVertex('D');
        $e = $graph->createVertex('E');
        $f = $graph->createVertex('F');
        $g = $graph->createVertex('G');
        $h = $graph->createVertex('H');
        $i = $graph->createVertex('I');

        /**
         * Создаем ребра, добавляем к ним стоимость
         */
        $a->createEdgeTo($d)->setCapacity(3);
        $a->createEdgeTo($b)->setCapacity(3);
        $b->createEdgeTo($c)->setCapacity(4);
        $c->createEdgeTo($a)->setCapacity(3);
        $c->createEdgeTo($d)->setCapacity(1);
        $c->createEdgeTo($e)->setCapacity(2);
        $d->createEdgeTo($f)->setCapacity(6);
        $e->createEdgeTo($b)->setCapacity(1);
        $e->createEdgeTo($h)->setCapacity(3);
        $e->createEdgeTo($g)->setCapacity(1);
        $f->createEdgeTo($i)->setCapacity(5);
        $g->createEdgeTo($h)->setCapacity(2);
        $h->createEdgeTo($d)->setCapacity(2);
        $h->createEdgeTo($f)->setCapacity(3);
        $h->createEdgeTo($i)->setCapacity(4);
        $i->createEdgeTo($g)->setCapacity(3);


        /**
         * Применяем алгоритм Эдмондса - Карпа (вершина A со стоком в G)
         */
        $algorithm = new EdmondsKarp($a, $e);

        /**
         * Рисуем начальный граф
         */
        echo "<meta charset=UTF-8>";
        echo /** @lang text */
        "<h2 style='text-align:center;'> Алгоритм Эдмондса - Карпа</h2>";

        /**
         * Выводим максимальный поток (стоимость)
         */
        $data = $algorithm->getFlowMax();
        echo /** @lang text */
        "<span style='margin: auto; display: table'>Максимальная стоимость пути: $data</span>";

        $graphviz = new CustomGraphViz();
        echo /** @lang text */
        "<p style='margin-left: 645px; font-size: 18px;'>Начальный граф &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;
                                                            &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;Конечный граф</p>";
        echo $graphviz->createImageHtml($graph, 'padding-left:550px;');

        /**
         * Рисуем конечный граф
         */
        $graphics = $algorithm->createGraph();
        $endGraph = $graphviz->createImageHtml($graphics, 'margin-left:100px;');
        echo $endGraph;
        return null;
    }
}