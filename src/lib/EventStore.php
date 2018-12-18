<?php

class EventStore {

   private $filePath = '';

   public function __construct($filePath) {
      $this->filePath = $filePath;
   }

   public function push($event) {
      $data = array(
         'servers' => array()
      );

      if (file_exists($this->filePath)) {
         $raw = file_get_contents($this->filePath);
         $data = json_decode($raw, true);
      }

      if (!isset($data['servers'])) {
         $data['servers'] = array();
      }

      $server = null;
      foreach ($data['servers'] as &$existingServer) {
         if ($existingServer['name'] == $event->getServerName()) {
            $server = &$existingServer;
            break;
         }
      }

      if (!$server) {
         $server = array(
            'name' => $event->getServerName(),
            'events' => array(),
         );
         $data['servers'][] = &$server;
      }

      $server['events'][] = $event->build();
      $server['events'] = array_slice($server['events'], -100);

      $raw = json_encode($data);
      file_put_contents($this->filePath, $raw);
   }

}
