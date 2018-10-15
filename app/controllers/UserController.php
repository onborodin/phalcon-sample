<?php

use Phalcon\Mvc\Controller;

class UserController extends BaseController {

    public function listAction() {
        return $this->view->pick("user/list");
    }

    public function addFormAction() {
        return $this->view->pick("user/add-form");
    }
    public function addHandlerAction() {
        return $this->view->pick("user/add-handler");
    }

    public function updateFormAction() {
        return $this->view->pick("user/update-form");
    }
    public function updateHandlerAction() {
        return $this->view->pick("user/update-handler");
    }

    public function deleteFormAction() {
        return $this->view->pick("user/delete-form");
    }
    public function deleteHandlerAction() {
        return $this->view->pick("user/delete-handler");
    }

}
#EOF


