<?php

namespace SpotifyLib;

if (!class_exists('Curl')) {

    /**
     * @class Curl
     */
    class Curl
    {
        /**
         * @var $method
         *      String  should contain a method that is within the array of allow methods (self::allowed_methods)
         */
        private $method;

        /**
         * @var $allowed_methods
         *      Array   containing methods that we are allowed to use (PUT and DELETE are disabled on live)
         */
        private $allowed_methods = array('GET','POST');

        /**
         * @var $base_url
         *      String  should contain the base url to the Curl api (e.g. 'http://Curl.test.com/api/' )
         */
        private $base_url;

        /**
         * @var $end_point
         *      String  should contain the rest of the url after the Curl api url ( self::Curl_api_url );
         */
        private $end_point;

        /**
         * @var $params
         *      Array   parameters for the cURL call should be in this array, when we do the cURL call, they will be used
         *              as GET or POST depending on the method set (self::method)
         */
        private $params = array();

        /**
         * @var $headers
         *      Array   containing the headers we want to send in our cURL call
         */
        private $request_headers = array();

        /**
         * @var $response
         *      StdClass   containing the response from our cURL call
         */
        private $response;

        /**
         * @var $response_headers
         *      Array   containing the response_headers from our cURL call
         */
        private $response_headers;

        /**
         * @var $suffix
         *      String  url part that is specified after the endpoint
         */
        private $suffix;

        /**
         * @var $prefix
         *      String url part that is specified before the endpoint
         */
        private $prefix;

        /**
         * @var $ssl
         *      Boolean true if SSL headers wanted
         */
        private $ssl;

        /**
         * Getter to get the array of methods that we should be allowed to accept
         *
         * @return Array
         */
        public function getAllowedMethods()
        {
            return $this->allowed_methods;
        }


        /**
         * setter for the method, i.e is this going to be a get call or a post call
         *
         * @param  $method String
         * @throws \Exception        if method that doesn't exist in self::getAllowedMethods() is provided
         * @return Curl
         */
        public function setMethod($method)
        {
            //do some pre validation
            $method = strtoupper($method);

            if (!in_array($method, $this->getAllowedMethods())) {
                throw new \Exception('invalid_method_specified');
            }

            $this->method = $method;

            return $this;
        }

        /**
         * getter for what method we are going to use in the cURL call
         *
         * @return String
         */
        public function getMethod()
        {
            return $this->method;
        }

        /**
         * Setter for the base url (i.e. 'http://www.test.com/api' )
         *
         * @param $base_url String
         * @return Curl
         */
        public function setBaseUrl($base_url)
        {
            $this->base_url = $base_url;

            return $this;
        }

        /**
         * Getter for the base url
         *
         * @return String
         */
        public function getBaseUrl()
        {
            return $this->base_url;
        }

        /**
         * Setter the end_point, an example would be rental_units/get
         *
         * @param $end_point     String      the endpoint
         * @return Curl         this instance of this class
         */
        public function setEndPoint($end_point)
        {
            $this->end_point = $end_point;

            return $this;
        }

        /**
         * Getter for private var end_point
         *
         * @return String
         */
        public function getEndPoint()
        {
            return $this->end_point;
        }

        /**
         * Getter for the array of parameters
         *
         * @return Array
         */
        public function getParams()
        {
            return $this->params;
        }

        /**
         * Setter for the http header array we have
         *
         * @param $headers Array    containing the http headers we will want to send
         * @return Curl             this instance of the Curl Lib
         */
        public function setRequestHeaders($headers)
        {
            $this->request_headers = $headers;

            return $this;
        }

        /**
         * Getter for private var that contains the http headers
         *
         * @return Array   containing http headers
         */
        public function getRequestHeaders()
        {
            return $this->request_headers;
        }

        /**
         * Setter for private var response_headers
         *
         * @param $response_headers  Array
         * @return Curl              this instance of this class
         */
        private function setResponseHeaders(array $response_headers)
        {
            $this->response_headers = $response_headers;

            return $this;
        }

        /**
         * Getter for private var response_headers
         *
         * @return Array
         */
        public function getResponseHeaders()
        {
            return $this->response_headers;
        }

        /**
         * Setter for private var response
         *
         * @param $response \stdClass    the json_decoded response
         * @return Curl                 this instance of the Curl lib
         */
        private function setResponse(\stdClass $response)
        {
            $this->response = $response;

            return $this;
        }

        /**
         * Getter for the cURL response
         *
         * @return \stdClass         containing the json_decoded response
         */
        public function getResponse()
        {
            return $this->response;
        }

        /**
         * Setter for private var suffix
         *
         * @param $suffix String    the sting to use as a suffix
         * @return Curl             this instance of this class
         */
        public function setSuffix($suffix)
        {
            $this->suffix = trim($suffix,'/');

            return $this;
        }

        /**
         * Getter for private var suffix
         *
         * @return
         *   mixed
         */
        public function getSuffix()
        {
            return $this->suffix;
        }

        /**
         * Setter for private var prefix
         *
         * @param $prefix   String
         * @return Curl     this instance of this class
         */
        public function setPrefix($prefix)
        {
            $this->prefix = trim($prefix,'/');

            return $this;
        }

        /**
         * Getter for private var prefix
         *
         * @return
         *   mixed
         */
        public function getPrefix()
        {
            return $this->prefix;
        }

        /**
         * Setter for whether of not to use SSL headers
         *
         * @param $ssl Boolean
         * @return Curl         this instance of this class
         */
        public function setSsl($ssl)
        {
            $this->ssl = $ssl;

            return $this;
        }

        /**
         * Getter for whether of not to use SSL headers
         *
         * @return Boolean
         */
        public function getSsl()
        {
            return (bool) $this->ssl;
        }


        /**
         * method to add a parameter that will be used as a GET or POST param
         *
         * @param $key String       the key for the parameter (i.e. 'owner_id')
         * @param $val String       the value of the parameters
         * @return Curl             this instance of the Curl Lib
         */
        public function addParam($key, $val)
        {
            $this->params[$key] = $val;

            return $this;
        }

        /**
         * method to remove a parameter in our array of params
         *
         * @param $key String the key of the parameter that you want to remove
         * @return Curl       this instance of the Curl lib
         */
        public function removeParam($key)
        {
            //check that the param is set before removing it!
            if ( array_key_exists($key, $this->getParams()) ) {
                unset($this->params[$key]);
            }

            return $this;
        }

        /**
         * get the Url for the cURL call, if method it set to post, will add the params to the url
         *
         * @return String      containing the full url for our cURL call
         * @throws \Exception   if no method has been set
         * @throws \Exception   if the Curl_api_url has notbeen set
         * @throws \Exception   if the endpoing has not been set
         */
        private function getUrl()
        {
            if ( $this->getMethod() === null) {
                throw new \Exception('Can not construct the url without a method set');
            }

            if ( $this->getBaseUrl() === null) {
                throw new \Exception('Can not construct the url without a Base Url set');
            }

            if ( $this->getEndPoint() === null) {
                throw new \Exception('Can not construct the url if there is not an endpoint set');
            }

            $url = rtrim($this->getBaseUrl(),'/');

            //add prefix if one is set
            if ( $this->getPrefix() !== null ) {
                $url .= '/' . $this->getPrefix();
            }

            $url .= '/' . $this->getEndPoint();


            if ( $this->getSuffix() !== null ) {
                $url .= "/" . $this->getSuffix() . "/";
            }

            if ( $this->getMethod() === 'GET') {
                //add parameters to the end of the url
                $url .= '?' . http_build_query($this->getParams());
            }

            return $url;
        }

        /**
         * method to make the cURL call
         *
         * @returns Boolean    True if successful
         * @throws \Exception   if method isn't supported
         */
        public function call()
        {
            $ch = curl_init($this->getUrl());

            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->getRequestHeaders());
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
            curl_setopt($ch, CURLOPT_TIMEOUT, 20);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            if ( $this->getSsl() ) {
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);
                curl_setopt($ch, CURLOPT_CERTINFO, 1);
            }

            switch ($this->getMethod()) {
                case 'GET':
                    break;
                case 'POST':
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $this->getParams());
                    break;
                default:
                    throw new \Exception('Unsupported method set');
                    break;
            }

            $response           = curl_exec($ch);

            if ($response == false) {
                //TODO log an error
            }

            $header_size        = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
            $header             = substr($response, 0, $header_size);
            $body               = substr($response, $header_size);
            $decoded_response   = json_decode($response);

            if ($decoded_response !== null) {
                $this->setResponse($decoded_response);
            }

            $this->setResponseHeaders(array($header));

            return ( $this->getResponse() !== null ) ? true : false;
        }

    }

}

