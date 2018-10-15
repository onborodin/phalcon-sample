<?php

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class BaseController extends Controller {

    public function initialize() {
        $this->view->setLayout('basic');
    }
}
