<?php

Trait Foz {
    public $foo;

}

trait Baz {
    public $baz;

}

class Bar {

    use Foz;

    use Baz;
}
