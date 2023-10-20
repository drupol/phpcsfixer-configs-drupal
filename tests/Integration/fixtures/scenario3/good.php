<?php

trait Foz {

    public $foo;

}

trait Baz {

    public $baz;

}

class Bar {

    use Baz;
    use Foz;

}
