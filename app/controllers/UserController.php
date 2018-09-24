<?php
#
# $Id$
#
use Phalcon\Mvc\Controller;

class UserController extends Controller {

    public function initialize() {
        $this->view->setLayout('basic');
    }

    public function indexAction() {
        return $this->listAction();
    }

    public function listAction() {
        $user = new User;
        $list = $user->find();
        return $this->view->pick("user/list");
    }
}
#EOF

