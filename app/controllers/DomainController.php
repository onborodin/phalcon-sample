<?php

use Phalcon\Mvc\Controller;

class DomainController extends BaseController {

    public function listAction() {
        return $this->view->pick("domain/list");
    }

    public function addFormAction() {
        return $this->view->pick("domain/add-form");
    }
    public function addHandlerAction() {
        return $this->view->pick("domain/add-handler");
    }

    public function updateFormAction() {
        return $this->view->pick("domain/update-form");
    }
    public function updateHandlerAction() {
        return $this->view->pick("domain/update-handler");
    }

    public function deleteFormAction() {
        return $this->view->pick("domain/delete-form");
    }
    public function deleteHandlerAction() {
        return $this->view->pick("domain/delete-handler");
    }

}
#EOF


