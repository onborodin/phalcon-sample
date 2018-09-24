<?php
#
# $Id$
#
use Phalcon\Mvc\View;
use Phalcon\Mvc\Controller;

class ProductController extends BaseJSONController {

    public function listAction() {
        $product = new Product;
        $list = $product->find();
        $count = $product->count();
        return $this->sendJson([
                        'count' => $count,
                        'product' => $list
        ]);
    }

    public function addAction() {
        $name = $this->request->get('name');
        $factory_id = $this->request->get('factory_id', null, 0);

        $product = new Product;

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

        $product = new Product;
        $productList = $product->findFirst($id);

        if ($productList) {
            if ($productList->delete()) {
                return $this->sendSuccess($id);
            }
            return $this->sendError();
        }
        return $this->sendNotFound($id);
    }

    public function dropallAction() {

        $product = new Product;
        $productList = $product->find();

        if ($productList) {
            if ($productList->delete()) {
                return $this->sendSuccess();
            }
            return $this->sendError();
        }
        return $this->sendNotFound();
    }
}
#EOF
