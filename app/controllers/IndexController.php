<?php
#
# $Id$
#
use Phalcon\Mvc\Controller;
use Phalcon\Http\Response;

class IndexController extends BaseController {

    public function initialize() {
        parent::initialize();
    }

    public function helloAction() {
        return $this->view->pick("index/hello");
    }

    public function indexAction() {
        return $this->response->redirect('/domain/list');

    }

    public function notfoundAction() {
        return $this->view->pick("index/notfound");
    }


}
#EOF
