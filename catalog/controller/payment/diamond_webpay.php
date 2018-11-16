<?php
class ControllerPaymentDiamondWebpay extends Controller {
    
	public function index() {
            $this->language->load('payment/diamond_webpay');
            $data['button_confirm'] = $this->language->get('button_confirm');
//            $data['action'] = trim($this->config->get('diamond_webpay_webpay_url'));
            $data['merchant_id'] = trim($this->config->get('diamond_webpay_merchant_id'));
            
            $this->load->model('checkout/order');
            $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);

            if ($order_info) {
                
                $data['order_amount'] = $order_info['total'];
                $data['order_id'] = $this->session->data['order_id'];
                $data['order_email'] = $order_info['email'];
                
                if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/diamond_webpay.tpl')) {
                    return $this->load->view($this->config->get('config_template') . '/template/payment/diamond_webpay.tpl', $data);
                } else {
                        return $this->load->view('default/template/payment/diamond_webpay.tpl', $data);
                }
                
            }

//            $data['continue'] = $this->url->link('checkout/success');

            
	}
        
        public function success(){
            
            $validated = false;
            $orderId = FALSE; 
            $transactionRef = FALSE; 

            if (isset($this->request->get['OrderID']) && isset($this->request->get['TransactionReference'])) {
                $transactionRef = $this->request->post['TransactionReference'];
                $orderId = $this->request->post['OrderID'];
            } else {
                die('Illegal Access');
            }
            
            if($transactionRef && $orderId){                
                $validated = TRUE;
            }

            if($validated) {
                
                $this->load->model('checkout/order');
                $order_info = $this->model_checkout_order->getOrder($orderId);

                if ($order_info){
                    
                    $this->model_checkout_order->addOrderHistory($orderId, $this->config->get('diamond_webpay_order_status_id'), "", true);
                    $this->response->redirect($this->url->link('checkout/success', '', 'SSL'));
                }else{
                    //Invalid Order
                    $this->response->redirect($this->url->link('checkout/checkout', '', 'SSL'));
                }
                
            }else{
                //Failed
                $this->response->redirect($this->url->link('checkout/checkout', '', 'SSL'));
            }
            
        }
        
        public function failure(){
            $this->response->redirect($this->url->link('checkout/checkout', '', 'SSL'));
        }
}