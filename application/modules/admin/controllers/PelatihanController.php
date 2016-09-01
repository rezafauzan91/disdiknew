<?php
class Admin_PelatihanController extends Zend_Controller_Action {
  public function indexAction() {
    $this->_helper->layout->setLayout('layoutadmin');
    $model = new Admin_Model_PelatihanModel();
    $data = $model->getAllPelatihan();
    $this->view->data = $data;

  }
  public function addAction() {
    $this->_helper->layout->setLayout('layoutadmin');
    if ($this->_request->isPost()) {
      $model = new Admin_Model_PelatihanModel();
      $Dataform = $this->_request->getPost();

      if($Dataform['nama']==null) {
        $this->view->message = 'Please Fill out The Form First!';
      } else {
        $insert = $model->insertPelatihan($Dataform);
        if($insert===true) {
          $this->view->msg = 'Insert Success';
        } else {
          $this->view->message = 'Insert Failed';
        }
      }
    }
  }

  public function pesertaAction() {
    $this->_helper->layout->setLayout('layoutadmin');
    $model = new Admin_Model_PelatihanModel();
    $req = $this->getRequest();
		$id = $req->getParam('p');
    $data = $model->getAllPeserta($id);
    $this->view->data = $data;
    $this->view->id = $id;

  }

  public function deletepesertaAction() {
		$model = new Admin_Model_PelatihanModel();
		$req = $this->getRequest();
		$id = $req->getParam('key');

		$delete = $model->delPeserta($id);

		return $this->_helper->json(
				array(
						'edit' => $delete,
				)
		);


	}

}