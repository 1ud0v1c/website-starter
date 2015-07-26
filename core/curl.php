<?php
    class Curl {
        private $userAgent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.2 (KHTML, like Gecko) Chrome/22.0.1216.0 Safari/537.2";
        private $url = "";

        public function __construct($url) {
            $this->url = $url;
        }

        public function fetchURL() {
            if(!function_exists("curl_init")){
                die("Désolé cURL n'est pas installé !");
            }

            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $this->url);
            curl_setopt($curl, CURLOPT_USERAGENT, $this->userAgent);
            curl_setopt($curl, CURLOPT_AUTOREFERER, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);

            curl_setopt($curl, CURLOPT_VERBOSE, 1);
            $data = curl_exec($curl);
            curl_close($curl);

            return $data;
        }
    }
 ?>
