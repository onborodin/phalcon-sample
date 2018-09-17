<?php
#
# $Id$
#
use Phalcon\Mvc\Controller;

class FactoryController extends BaseJSONController {

    public function listAction() {
        $factory = new Factory;
        $list = $factory->find();
        $count = $factory->count();
        return $this->sendJson([
                    'count' => $count,
                    'factory' => $list
        ]);
    }

    //public function indexAction() {
    //    return $this->listAction();
    //}

    public function addAction() {
        $name = $this->request->get('name');

        $factory = new Factory;
        $result = $factory->create([ 'name' => $name ]);

        if ($result) {
            $id = $factory->id;
            return $this->sendSuccess($id);
        }
        return $this->sendError();
    }

    public function dropAction() {
        $id = $this->request->get('id', null, 0);

        $factory = new Factory;
        $factory = $factory->findFirst($id);

        if ($factory) {
            if ($factory->delete()) {
                return $this->sendSuccess($id);
            }
            return $this->sendError();
        }
        return $this->sendNotFound($id);
    }

    public function dropallAction() {

        $factory = new Factory;
        $factoryList = $factory->find();

        if ($factoryList) {
            if ($factoryList->delete()) {
                return $this->sendSuccess();
            }
            return $this->sendError();
        }
        return $this->sendNotFound();
    }
}
#EOF


