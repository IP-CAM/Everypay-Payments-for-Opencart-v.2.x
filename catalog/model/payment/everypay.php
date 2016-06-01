<?php
class ModelPaymentEverypay extends Model {
    public function getMethod($address, $total) {
        $this->load->language('payment/everypay');

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('everypay_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

        if ($this->config->get('everypay_total') > 0 && $this->config->get('everypay_total') > $total) {
            $status = false;
        } elseif (!$this->config->get('everypay_geo_zone_id')) {
            $status = true;
        } elseif ($query->num_rows) {
            $status = true;
        } else {
            $status = false;
        }

        $method_data = array();

        if ($status) {
            $logolink = '&nbsp;<img src="catalog/view/theme/default/image/visa-mastercard.jpg" alt="every-pay.com" title="every-pay.com" style="width: 90px; border: 1px solid #EEEEEE;" />';
            $method_data = array(
                'code'       => 'everypay',
                //'title'      => $this->language->get('text_title'),
                //if checkout title is set in backend for that language use that, if not use default
                //'title'      => $this->config->get('everypay_title_' . $this->config->get('config_language_id')) ?$this->config->get('everypay_title_' . $this->config->get('config_language_id')) . $imglink :$this->language->get('text_title') ,
                'title'      => $this->getPaymentTitle() . $logolink,
                'terms'      => '',
                'sort_order' => $this->config->get('everypay_sort_order')
            );
        }

        return $method_data;
    }


     public function getPaymentTitle(){
        //if custom checkout title is set for current language use that, if not use default from language file
       return $this->config->get('everypay_title_' . $this->config->get('config_language_id')) ? $this->config->get('everypay_title_' . $this->config->get('config_language_id')) : $this->language->get('text_title');
    }

    public function updatePaymentTitle($order_id){
        //overwrite payment method name to get rid of logo in title
        $query = $this->db->query("UPDATE `" . DB_PREFIX . "order` SET payment_method = '" . $this->getPaymentTitle() . "' WHERE order_id = '" . (int)$order_id . "' ");
    }
}