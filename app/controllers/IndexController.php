<?php
#
# $Id$
#
use Phalcon\Mvc\Controller;

class IndexController extends BaseHTMLController {

    public function helloAction() {
        return $this->view->pick("index/hello");
    }

    public function indexAction() {
        return $this->helloAction();
    }

    public function notfoundAction() {
        return $this->view->pick("index/notfound");
    }

}
#EOF
