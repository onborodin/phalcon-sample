<?php
#
# $Id$
#
use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class ProductsController extends BaseJSONController {

    public function sendJson($data) {
        $this->view->disable();
        $this->response->setJsonContent($data);
        return $this->response;
    }

    public function listAction() {
        $products = new Products;
        $list = $products->find();
        $count = $products->count();
        return $this->sendJson([
                        'count' => $count,
                        'products' => $list
        ]);
    }

    public function indexAction() {
        return $this->listAction();
    }

    public function addAction() {
        $name = $this->request->get('name');
        $factory_id = $this->request->get('factory_id', null, 0);

        $product = new Products;

        $result = $product->create([
                    'name' => $name,
                    'factory_id' => $factory_id
        ]);

        if ($result) {
            return $this->sendSuccess($product->id);
        }
        return $this->sendError();
    }

    public function dropAction() {
        $id = $this->request->get('id', null, 0);

        $products = new Products;
        $product = $products->findFirst($id);

        if ($product) {
            if ($product->delete()) {
                return $this->sendSuccess($id);
            }
            return $this->sendError();
        }
        return $this->sendNotFound($id);
    }

    public function dropallAction() {

        $products = new Products;
        $product = $products->find();

        if ($product) {
            if ($product->delete()) {
                return $this->sendSuccess();
            }
            return $this->sendError();
        }
        return $this->sendNotFound();
    }
}
#EOF
