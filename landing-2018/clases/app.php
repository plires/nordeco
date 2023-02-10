<?php
require_once( __DIR__ . '/../vendor/autoload.php' );

  class App 
  {

    public function registerEmailContactsInPerfit($api, $list, $post, $emailTo) 
    {

      $date = date("d-M-y H:i");

      $perfit = new PerfitSDK\Perfit( ['apiKey' => $api ] );
      $listId = $list;
      $interest = PERFIT_INTEREST;

      $response = $perfit->post('/lists/' .$listId. '/contacts', 
        [
          'firstName' => $post['name'], 
          'email' => $post['email'],
          'customFields' => 
            [
              [
                'id' => 10, 
                'value' => 'google'
              ],
              [
                'id' => 12, 
                'value' => $post['phone']
              ],
              [
                'id' => 16, 
                'value' => RECIPIENT
              ],
              [
                'id' => 14, 
                'value' => $post['origin'] . ' - ' . $date
              ],
              [
                'id' => 17, 
                'value' => PERFIT_ACCOUNT
              ]
            ],
          'interests' => 
            [
              [
                'id' => $interest, 
                'value' => $post['rubro']
              ]
            ]
        ]          
      );

      return $response;
        
    }

  }

?>