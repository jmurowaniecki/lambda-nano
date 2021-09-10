<?php

namespace CORE;

/**
 * λ.µ.API
 * Interface simples.
 *
 * @category Package
 * @package  API
 * @author   John Murowaniecki <john@compilou.com.br>
 * @license  Creative Commons 4.0 - Some rights reserved
 * @link     https://github.com/jmurowaniecki/lambda-nano
 */
class λ
{

    /**
     * Routes
     *
     * @var array
     */
    private $r = [];

    /**
     * Views
     *
     * @var array
     */
    private $v = [];

    /**
     * Query
     *
     * @var string
     */
    private $q = '';

    /**
     * Initialize class with query string.
     *
     * @param String $q Query string.
     */
    public function __construct(String $q)
    {
        $f = explode('/', $q);
        array_shift($f);

        $this->q = '/'.array_shift($f);
        $this->r = [];
        $this->v = [];
        $this->a = $f;
    }

    /**
     * Process request and output results.
     */
    public function __destruct()
    {
        $x = $this;
        $k = $x->r[$x->q] ?? false;
        $f = $k?[ call_user_func_array($k, $this->a),0]:[$x->q,1];
        \CORE\λ::print($f[0],$f[1]);
    }

    /**
     * Declare a new route.
     *
     * @param string   $r Route name.
     * @param function $f Callback function.
     * @return  λ         Self class.
     */
    public function route(String $r = '', $f = __FUNCTION__): λ
    {
        $this->r[$r] = $f;
        return $this;
    }

    /**
     * Prints output.
     *
     * @param String $m Message/content.
     * @param Int    $c Response code.
     * @param array  $d Standart responses.
     * @return void
     */
    public static function print(String $m, Int $c, Array $d = [
        '200 OK',
        '404 Page not found']
    )
    {
        header("HTTP/1.1 {$d[$c]}");
        die($m);
    }
}
