<?php

class Dataprovider {

    /* Version 0.1, based on Dataprovider API version 0.1 */
    /* Author: Peter Jaap Blaakmeer <peterjaap@elgentos.nl> */

    public function __construct($api_key) {
        $this->version = '0.1';
        $this->secure = true;
        $this->url = 'http' . ($this->secure ? 's' : null) . '://www.dataprovider.com/api/' . $this->version . '/lookup/';
        $this->api_key = $api_key;
    }

    /* These functions are code-wise the same, the only thing that differs is the function name itself and the parameters they take */
    public function hostname($name) {
        $args = get_defined_vars();
        $url = $this->url . __FUNCTION__ . '.json?api_key=' . $this->api_key;
        foreach($args as $key=>$value) {
            $url .= '&'.$key.'='.$value;
        }
        return $this->request($url);
    }
    
    public function zipcode($zipcode,$housenumber) {
        $args = get_defined_vars();
        $url = $this->url . __FUNCTION__ . '.json?api_key=' . $this->api_key;
        foreach($args as $key=>$value) {
            $url .= '&'.$key.'='.$value;
        }
        return $this->request($url);
    }
    
    public function phone($number,$country='nl',$all=true) {
        $args = get_defined_vars();
        $url = $this->url . __FUNCTION__ . '.json?api_key=' . $this->api_key;
        foreach($args as $key=>$value) {
            $url .= '&'.$key.'='.$value;
        }
        return $this->request($url);
    }
    
    public function chamberofcommerce($number) {
        $args = get_defined_vars();
        $url = $this->url . __FUNCTION__ . '.json?api_key=' . $this->api_key;
        foreach($args as $key=>$value) {
            $url .= '&'.$key.'='.$value;
        }
        return $this->request($url);
    }
    
    public function tax($number) {
        $args = get_defined_vars();
        $url = $this->url . __FUNCTION__ . '.json?api_key=' . $this->api_key;
        foreach($args as $key=>$value) {
            $url .= '&'.$key.'='.$value;
        }
        return $this->request($url);
    }

    /* Private request function */
    private function request($url) {
        $ch = curl_init($url);
        $headers = array(
            'Content-Type: application/json'
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $output = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if(!$output || strlen($output)==1 || $code!='200') {
            if($code!='200') {
                throw new Exception('Error (code '.$code.', URL '.$url.'). ' . curl_error($ch));
            } else {
                throw new Exception('Error (code '.$code.'). ' . curl_error($ch));
            }
        } else {
            $output = json_decode($output);
            return $output;
        }
        return false;
        curl_close($ch);
    }
    
}