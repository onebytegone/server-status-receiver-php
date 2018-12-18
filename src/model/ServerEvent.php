<?php

class ServerEvent {

   private $serverName = '';
   private $payload = array();

   public function __construct($serverName, $payload) {
      $this->serverName = $serverName;
      $this->payload = $payload;
      $this->timestamp = date(DateTime::ISO8601);
   }

   public function getServerName() {
      return $this->serverName;
   }

   public function build() {
      return array(
         'timestamp' => $this->timestamp,
         'payload' => array_merge(
            array( 'requestIP' => $this->getRequestIP() ),
            $this->payload
         ),
      );
   }

   private function getRequestIP() {
      return $_SERVER['REMOTE_ADDR'] ?: ($_SERVER['HTTP_X_FORWARDED_FOR'] ?: $_SERVER['HTTP_CLIENT_IP']);
   }

}
