<?php
class ControllerExtensionModuleWhatsmaster extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/module/whatsmaster');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_whatsmaster', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}
		
		$data['version'] = $this->ver();
		$data['module_name'] = 'Whatsapp';

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_extension'] = $this->language->get('text_extension');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_left'] = $this->language->get('text_left');
		$data['text_right'] = $this->language->get('text_right');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_numero'] = $this->language->get('entry_numero');
		$data['entry_posicao'] = $this->language->get('entry_posicao');
		$data['entry_hor'] = $this->language->get('entry_hor');
		$data['entry_ver'] = $this->language->get('entry_ver');
		
		$data['text_terms'] = $this->language->get('text_terms');
		$data['text_support'] = $this->language->get('text_support');
		$data['text_m'] = $this->language->get('text_m');
		$data['text_v'] = $this->language->get('text_v');
		$data['text_t'] = $this->language->get('text_t');
		$data['text_h'] = $this->language->get('text_h');
		$data['text_l'] = $this->language->get('text_l');
		$data['text_pix'] = $this->language->get('text_pix');
		
		$data['tab_general'] = $this->language->get('tab_general');
		$data['tab_help'] = $this->language->get('tab_help');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['murl'] = 'https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=35775';
		$data['atual'] = $this->checkForUpdate();
				
		
		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/whatsmaster', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/whatsmaster', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
		
	    
		if (isset($this->request->post['module_whatsmaster_numero'])) {
			$data['module_whatsmaster_numero'] = $this->request->post['module_whatsmaster_numero'];
		} else {
			$data['module_whatsmaster_numero'] = $this->config->get('module_whatsmaster_numero');
		}
		
		if (isset($this->request->post['module_whatsmaster_posicao'])) {
			$data['module_whatsmaster_posicao'] = $this->request->post['module_whatsmaster_posicao'];
		} else {
			$data['module_whatsmaster_posicao'] = $this->config->get('module_whatsmaster_posicao');
		}
		
		if (isset($this->request->post['module_whatsmaster_horizontal'])) {
			$data['module_whatsmaster_horizontal'] = $this->request->post['module_whatsmaster_horizontal'];
		} elseif ($this->config->get('module_whatsmaster_horizontal')) {
			$data['module_whatsmaster_horizontal'] = $this->config->get('module_whatsmaster_horizontal');
		} else {
			$data['module_whatsmaster_horizontal'] = 0;
		}
		
		if (isset($this->request->post['module_whatsmaster_vertical'])) {
			$data['module_whatsmaster_vertical'] = $this->request->post['module_whatsmaster_vertical'];
		} elseif ($this->config->get('module_whatsmaster_vertical')) {
			$data['module_whatsmaster_vertical'] = $this->config->get('module_whatsmaster_vertical');
		} else {
			$data['module_whatsmaster_vertical'] = 0;
		}
		
		if (isset($this->request->post['module_whatsmaster_image'])) {
			$data['module_whatsmaster_image'] = $this->request->post['whatsmaster_image'];
		} else {
			$data['module_whatsmaster_image'] = $this->config->get('module_whatsmaster_image');
		}
		
		$this->load->model('tool/image');

		if (isset($this->request->post['module_whatsmaster_image']) && is_file(DIR_IMAGE . $this->request->post['module_whatsmaster_image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['module_whatsmaster_image'], 100, 100);
		} elseif ($this->config->get('module_whatsmaster_image') && is_file(DIR_IMAGE . $this->config->get('module_whatsmaster_image'))) {
			$data['thumb'] = $this->model_tool_image->resize($this->config->get('module_whatsmaster_image'), 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['module_whatsmaster_status'])) {
			$data['module_whatsmaster_status'] = $this->request->post['module_whatsmaster_status'];
		} else {
			$data['module_whatsmaster_status'] = $this->config->get('module_whatsmaster_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/whatsmaster', $data));
	}
	
	public function checkForUpdate() {
        $ver = 0;
		$url = base64_decode('aHR0cHM6Ly93d3cub3BlbmNhcnRtYXN0ZXIuY29tLmJyL21vZHVsZS92ZXJzaW9uLw==');
        $json_convert  = array('module' => 'whatsmaster');

        $soap_do = curl_init();
        curl_setopt($soap_do, CURLOPT_URL, $url);
        curl_setopt($soap_do, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($soap_do, CURLOPT_TIMEOUT,        10);
        curl_setopt($soap_do, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($soap_do, CURLOPT_RETURNTRANSFER, true );
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($soap_do, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($soap_do, CURLOPT_POST,           true );
        curl_setopt($soap_do, CURLOPT_POSTFIELDS,     $json_convert);

        $response = curl_exec($soap_do); 
        curl_close($soap_do);
        $resposta = json_decode($response, true);
		
		if (version_compare($resposta['mensagem'], $this->ver(), '>')) {
        $ver = 1;
        }
		return $ver;
	}
	
	public function ver() {
		$ver = '1.1.5.0';
		return $ver;
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/module/whatsmaster')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
	
		return !$this->error;
	}
}