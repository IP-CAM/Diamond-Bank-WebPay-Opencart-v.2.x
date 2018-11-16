<?php
class ControllerPaymentDiamondWebpay extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('payment/diamond_webpay');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
			$this->model_setting_setting->editSetting('diamond_webpay', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
		}

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_webpay_url'] = $this->language->get('text_webpay_url');
		$data['text_merchant_id'] = $this->language->get('text_merchant_id');
                
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
//		$data['text_all_zones'] = $this->language->get('text_all_zones');

		$data['entry_webpay_url'] = $this->language->get('entry_webpay_url');
		$data['entry_merchant_id'] = $this->language->get('entry_merchant_id');
                
		$data['entry_order_status'] = $this->language->get('entry_order_status');
//		$data['entry_total'] = $this->language->get('entry_total');
//		$data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');

//		$data['help_total'] = $this->language->get('help_total');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_payment'),
			'href' => $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('payment/cod', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['action'] = $this->url->link('payment/diamond_webpay', 'token=' . $this->session->data['token'], 'SSL');

		$data['cancel'] = $this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL');

//		if (isset($this->request->post['custom_total'])) {
//			$data['custom_total'] = $this->request->post['custom_total'];
//		} else {
//			$data['custom_total'] = $this->config->get('custom_total');
//		}
                
//		if (isset($this->request->post['mygiftarena_webpay_url'])) {
//			$data['mygiftarena_webpay_url'] = $this->request->post['mygiftarena_webpay_url'];
//		} else {
//			$data['mygiftarena_webpay_url'] = $this->config->get('mygiftarena_webpay_url');
//		}
                
		if (isset($this->request->post['diamond_webpay_merchant_id'])) {
			$data['diamond_webpay_merchant_id'] = $this->request->post['diamond_webpay_merchant_id'];
		} else {
			$data['diamond_webpay_merchant_id'] = $this->config->get('diamond_webpay_merchant_id');
		}

		if (isset($this->request->post['diamond_webpay_order_status_id'])) {
			$data['diamond_webpay_order_status_id'] = $this->request->post['diamond_webpay_order_status_id'];
		} else {
			$data['diamond_webpay_order_status_id'] = $this->config->get('diamond_webpay_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

//		if (isset($this->request->post['custom_geo_zone_id'])) {
//			$data['custom_geo_zone_id'] = $this->request->post['custom_geo_zone_id'];
//		} else {
//			$data['custom_geo_zone_id'] = $this->config->get('custom_geo_zone_id');
//		}

//		$this->load->model('localisation/geo_zone');

//		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['diamond_webpay_status'])) {
			$data['diamond_webpay_status'] = $this->request->post['diamond_webpay_status'];
		} else {
			$data['diamond_webpay_status'] = $this->config->get('diamond_webpay_status');
		}

		if (isset($this->request->post['diamond_webpay_sort_order'])) {
			$data['diamond_webpay_sort_order'] = $this->request->post['diamond_webpay_sort_order'];
		} else {
			$data['diamond_webpay_sort_order'] = $this->config->get('diamond_webpay_sort_order');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('payment/diamond_webpay.tpl', $data));
	}
}