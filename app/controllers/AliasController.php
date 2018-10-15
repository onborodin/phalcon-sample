<?php

use Phalcon\Mvc\Controller;

class AliasController extends BaseController {

    public function listAction() {
        return $this->view->pick("alias/list");
    }

    public function addFormAction() {
        return $this->view->pick("alias/add-form");
    }
    public function addHandlerAction() {
        return $this->view->pick("alias/add-handler");
    }

    public function updateFormAction() {
        return $this->view->pick("alias/update-form");
    }
    public function updateHandlerAction() {
        return $this->view->pick("alias/update-handler");
    }

    public function deleteFormAction() {
        return $this->view->pick("alias/delete-form");
    }
    public function deleteHandlerAction() {
        return $this->view->pick("alias/delete-handler");
    }

}
#EOF


