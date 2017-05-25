<?php

class ControllerPaymentEveryPay extends Controller {

    private $error = array();
    private $version = 'v1.6.1';

    public function index() {
        $this->language->load('payment/everypay');
        $this->document->setTitle($this->language->get('heading_title'));
        $this->load->model('setting/setting');
        $this->load->model('localisation/order_status');

        $this->load->model('localisation/language');  //frzn
        if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('everypay', $this->request->post);
            $this->session->data['success'] = $this->language->get('text_success');
            $this->response->redirect($this->url->link('extension/payment', 'token=' . $this->session->data['token'], 'SSL'));
        }
        // Setting Form entities
        $data['heading_title'] = $this->language->get('heading_title');
        $data['version'] = $this->version;
        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_all_zones'] = $this->language->get('text_all_zones');
        $data['text_test'] = $this->language->get('text_test');
        $data['text_live'] = $this->language->get('text_live');
        $data['text_authorization'] = $this->language->get('text_authorization');
        $data['text_capture'] = $this->language->get('text_capture');

        $data['entry_api_username'] = $this->language->get('entry_api_username');
        $data['entry_api_secret'] = $this->language->get('entry_api_secret');
        $data['entry_test_api_username'] = $this->language->get('entry_test_api_username');
        $data['entry_test_api_secret'] = $this->language->get('entry_test_api_secret');
        $data['entry_account_id'] = $this->language->get('entry_account_id');
        $data['entry_mode'] = $this->language->get('entry_mode');
        $data['entry_transaction_type'] = $this->language->get('entry_transaction_type');
        $data['entry_total'] = $this->language->get('entry_total');
        $data['entry_order_status'] = $this->language->get('entry_order_status');
        $data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();
        $data['entry_geo_zone'] = $this->language->get('entry_geo_zone');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $data['help_total'] = $this->language->get('help_total');
        $data['help_processing_account'] = $this->language->get('help_processing_account');
        $data['help_mode'] = $this->language->get('help_mode');
        $data['help_order_status'] = $this->language->get('help_order_status');
        $data['help_sort_order'] = $this->language->get('help_sort_order');
        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['action'] = $this->url->link('payment/everypay', 'token=' .
            $this->session->data['token'], 'SSL');
        $data['cancel'] = $this->url->link('extension/payment', 'token=' .
            $this->session->data['token'], 'SSL');

        // Errors and Warnings
        if(isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }
        if(isset($this->error['everypay_api_username'])) {
            $data['error_api_username'] = $this->error['everypay_api_username'];
        } else {
            $data['error_api_username'] = '';
        }
        if(isset($this->error['everypay_api_secret'])) {
            $data['error_api_secret'] = $this->error['everypay_api_secret'];
        } else {
            $data['error_api_secret'] = '';
        }
        if(isset($this->error['everypay_account_id'])) {
            $data['error_account_id'] = $this->error['everypay_account_id'];
        } else {
            $data['error_account_id'] = '';
        }

        // breadcrumbs
        $data['breadcrumbs'] = array();
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard',
                'token=' . $this->session->data['token'],
                'SSL'));
        $data['breadcrumbs'][] = array('text' => $this->language->get('text_payment'),
            'href' => $this->url->link('extension/payment',
                'token=' . $this->session->data['token'],
                'SSL'));
        $data['breadcrumbs'][] = array('text' => $this->language->get('heading_title'),
            'href' => $this->url->link('payment/authorizenet_aim',
                'token=' . $this->session->data['token'],
                'SSL'));

        // Setting Fields data
        if(isset($this->request->post['everypay_api_username'])) {
            $data['everypay_api_username'] = $this->request->post['everypay_api_username'];
        } else {
            $data['everypay_api_username'] = $this->config->get('everypay_api_username');
        }
        if(isset($this->request->post['everypay_api_secret'])) {
            $data['everypay_api_secret'] = $this->request->post['everypay_api_secret'];
        } else {
            $data['everypay_api_secret'] = $this->config->get('everypay_api_secret');
        }
        if(isset($this->request->post['everypay_account_id'])) {
            $data['everypay_account_id'] = $this->request->post['everypay_account_id'];
        } else {
            $data['everypay_account_id'] = $this->config->get('everypay_account_id');
        }
        if(isset($this->request->post['everypay_mode'])) {
            $data['everypay_mode'] = $this->request->post['everypay_mode'];
        } else {
            $data['everypay_mode'] = $this->config->get('everypay_mode');
        }
        if(isset($this->request->post['everypay_test_api_username'])) {
            $data['everypay_test_api_username'] = $this->request->post['everypay_test_api_username'];
        } else {
            $data['everypay_test_api_username'] = $this->config->get('everypay_test_api_username');
        }
        if(isset($this->request->post['everypay_test_api_secret'])) {
            $data['everypay_test_api_secret'] = $this->request->post['everypay_test_api_secret'];
        } else {
            $data['everypay_test_api_secret'] = $this->config->get('everypay_test_api_secret');
        }
        if(isset($this->request->post['everypay_transaction_type'])) {
            $data['everypay_transaction_type'] = $this->request->post['everypay_transaction_type'];
        } else {
            $data['everypay_transaction_type'] = $this->config->get('everypay_transaction_type');
        }
        if(isset($this->request->post['everypay_total'])) {
            $data['everypay_total'] = $this->request->post['everypay_total'];
        } else {
            $data['everypay_total'] = $this->config->get('everypay_total');
        }
        if(isset($this->request->post['everypay_order_status_id'])) {
            $data['everypay_order_status_id'] = $this->request->post['everypay_order_status_id'];
        } else {
            $data['everypay_order_status_id'] = $this->config->get('everypay_order_status_id');
        }
        if(isset($this->request->post['everypay_geo_zone_id'])) {
            $data['everypay_geo_zone_id'] = $this->request->post['everypay_geo_zone_id'];
        } else {
            $data['everypay_geo_zone_id'] = $this->config->get('everypay_geo_zone_id');
        }
        if(isset($this->request->post['everypay_status'])) {
            $data['everypay_status'] = $this->request->post['everypay_status'];
        } else {
            $data['everypay_status'] = $this->config->get('everypay_status');
        }
        if(isset($this->request->post['everypay_sort_order'])) {
            $data['everypay_sort_order'] = $this->request->post['everypay_sort_order'];
        } else {
            $data['everypay_sort_order'] = $this->config->get('everypay_sort_order');
        }

        //pull in all geo zones the store has
        $this->load->model('localisation/geo_zone');
        $data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

        //allow setting different checking heading titles per language
        $languages = $this->model_localisation_language->getLanguages();

        $data['everypay_title'] = array(
            'type' => 'langtext',
            'name' => 'everypay_title',
            'label' => $this->language->get('entry_title'),
            'value' => $this->_getLangValue('everypay_title', $this->config, $this->request->post, $languages),
            'languages' => $languages,
        );




        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');
        $this->response->setOutput($this->load->view('payment/everypay.tpl', $data));
    }

    private function _getLangValue($field, $config, $request, $languages, $default = '') {
        $values = array();
        foreach ($languages as $language) {
            $values[$field . '_' . $language['language_id']] = $this->_getValue($field . '_' . $language['language_id'], $config, $request, $default);
            
        }
        return $values;
    }

    private function _getValue($field, $config, $request, $default = '') {
        $value = '';
        if (isset($request[$field])) {
            $value = $request[$field];
        } else {
            $value = $config->get($field);
        }
        if ($value === false || $value === null) {
            $value = $default;
        }
        return $value;
    }

    /**
     * Validates inputs
     *
     * @return bool
     */
    protected function validate() {

        if(!$this->user->hasPermission('modify', 'payment/everypay')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if(!$this->request->post['everypay_api_username']) {
            $this->error['everypay_api_username'] = $this->language->get('error_api_username');
        }

        if(!$this->request->post['everypay_api_secret']) {
            $this->error['everypay_api_secret'] = $this->language->get('error_api_secret');
        }

        if(!$this->request->post['everypay_account_id']) {
            $this->error['everypay_account_id'] = $this->language->get('error_account_id');
        }

        return !$this->error;
    }
}
