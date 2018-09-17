<?php
#
# $Id$
#
use Phalcon\Mvc\Controller;

class IndexController extends BaseController {

    public function indexAction() {
        //$this->view->cache(true);
        return $this->view->pick("index/hello");
    }

    public function notfoundAction() {
        //$this->view->cache(true);
        return $this->view->pick("index/notfound");
    }

    public function send404Action() {
        $this->view->disable();
        $this->response->setContentType('application/json', 'UTF-8');
        $this->response->setContent(json_encode(["result" => "notFound"]));
        $this->response->setStatusCode(404);
        return $this->response;
    }



}
#EOF
