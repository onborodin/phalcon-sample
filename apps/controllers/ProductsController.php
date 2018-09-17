<?php
#
# $Id$
#

use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class ProductsController extends BaseController {

    public function sendJson($data) {
        $this->view->disable();
        //$this->response->setContentType('application/json', 'UTF-8');
        //$this->response->setContent(json_encode($data));
        //$this->response->setStatusCode(200);
        $this->response->setJsonContent($data);
        return $this->response;
    }

    public function listAction() {
        $products = new Products;
        $list = $products->find();
        $count = $products->count();
        return $this->sendJson(['count' => $count, 'products' => $list]);
    }

    public function indexAction() {
        return $this->listAction();
    }

    public function addAction() {
        $name = $this->request->get('name');

        $product = new Products;
        if ($product->save(['name' => $name])) {
            return $this->sendJson(['result' => 'success', 'id' => $product->id, 'name' => $name]);
        }
        return $this->sendJson(['result' => 'error']);
    }

    public function dropAction() {
        $id = $this->request->get('id', null, 0);

        $products = new Products;
        $product = $products->findFirst($id);

        if ($product) {
            if ($product->delete()) {
                return $this->sendJson(['result' => 'success']);
            }
            return $this->sendJson(['result' => 'error']);
        }
        return $this->sendJson(['result' => 'notfound']);
    }

    public function dropallAction() {

        $products = new Products;
        $product = $products->find();

        if ($product) {
            if ($product->delete()) {
                return $this->sendJson(['result' => 'success']);
            }
            return $this->sendJson(['result' => 'error']);
        }
        return $this->sendJson(['result' => 'notfound']);
    }


}
#EOF
