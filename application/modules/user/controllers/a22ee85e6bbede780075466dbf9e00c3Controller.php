<?php
class User_a22ee85e6bbede780075466dbf9e00c3Controller extends Zend_Controller_Action {
	public function indexAction() {
		//$this->_helper->layout->disableLayout();
		$this->view->title = "Login User";

		if ($this->_request->isPost()) {
			$dataform = $this->_request->getPost();
			$user = $dataform['email'];
			$pwd = $dataform['password'];
      $akses = $dataform['akses'];
			$model = new User_Model_EditorModel();

      if($akses == 1) {
          $data = $model->getAccount($user);
          $passencrypt = md5($user.$pwd);
          $password = $data[0]['password'];
  				if($password==$passencrypt && count($data)!=0) {
  					$sessionuser = Zend_Registry::get('session_user');
  					$sessionuser->user_id = $data[0]['nama_lengkap'];
  					$sessionuser->noreg = $data[0]['nip'];
  					$sessionuser->status = 'Guru';
  					$sessionuser->tingkat = $data[0]['tingkat_sekolah'];
  					$this->_helper->redirector('index','3e72758f0fc77cdad787f58b41e9985f','user');
  				} else {
  					$this->view->message = '<div class="alert alert-danger saved">Email atau Password salah, Coba lagi..</div>';
  				}
      } elseif ($akses == 2) {
          $datasiswa= $model->getAccountSiswa($user);
          $passencrypt = md5($user.$pwd);
          $passwordsiswa = $datasiswa[0]['password'];
          // Zend_Debug::dump($datasiswa);die();
  				if($passwordsiswa==$passencrypt && count($datasiswa)!=0) {
  					// Zend_Debug::dump($datasiswa);die();
  					$sessionuser = Zend_Registry::get('session_user');
  					$sessionuser->user_id = $datasiswa[0]['nama_lengkap'];
  					$sessionuser->noreg = $datasiswa[0]['id_siswa'];
  					$sessionuser->status = 'Siswa';
  					$sessionuser->tingkat = $datasiswa[0]['tingkat_sekolah'];
  					$this->_helper->redirector('index','5ba558debcf53a3582648898037e76e6','user');
  				} else {
  					$this->view->message = '<div class="alert alert-danger saved">Email atau Password salah, Coba lagi..</div>';
  				}
      }

		}
	}

	public function logoutAction() {
	  Zend_Session::destroy(true);
      $this->_helper->redirector('index','a22ee85e6bbede780075466dbf9e00c3','user');
	}
}
