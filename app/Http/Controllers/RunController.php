<?php

namespace App\Http\Controllers;

use App\Algorithms\CustomEdmondsKarp;
use Fhaculty\Graph\Graph;
use Graphp\Algorithms\MaxFlow\EdmondsKarp;
use Illuminate\Http\Request;

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
    public function run(Graph $graph, Request $request)
    {
        $names = ['$a' =>'A', '$b'=>'B', '$c'=>'C', '$d'=>'D', '$e'=>'E', '$f'=>'F', '$g'=>'G', '$h'=>'H', '$i'=>'I'];

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
        if($request->input('start'))
        $algorithm = new CustomEdmondsKarp($graph->getVertex($request->input('start')),
            $graph->getVertex($request->input('end')));

        $out = $request->input('start');
        $in = $request->input('end');

        /**
         * Выводим максимальный поток (стоимость)
         */
        if(isset($algorithm))
        $max = $algorithm->getFlowMax();

        $graphviz = new CustomGraphViz();

        $startGraph =  $graphviz->createImageSrc($graph);


        /**
         * Рисуем конечный граф
         */
        if(isset($algorithm))
        $graphics = $algorithm->createGraph();
        if(isset($graphics))
        $endGraph = $graphviz->createImageSrc($graphics);

       // $graphics->


        return view('index', compact('startGraph', 'residualGraph','endGraph', 'names', 'max', 'in', 'out'));
    }

}