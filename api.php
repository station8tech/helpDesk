<?php

class formStackAPI {
    
    private $token = '';
    public $ticketFormID = '2147205';
    
    public function getSubmissionsTable(){
        
        $key = $this->token;
        $formID = $this->ticketFormID;
        $url = 'https://www.formstack.com/api/v2/form/'.$formID.'/submission.json?data=true&oauth_token='.$key;
        $string = file_get_contents($url);
        $json = json_decode($string, true);
        
            foreach ($json['submissions'] as $p) {
                
                //removes first= and last=
                $fullStringName = $p['data']['36496273']['value'];
                $first = 'first =';
                $firstName = str_replace($first, '', $fullStringName);
                $last = 'last =';
                $fullName= str_replace($last, '', $firstName);
              
                $ticketID = $p['id'];
                $status = $p['data']['36496275']['value'];
                $dateTime = $p['data']['36479111']['value'];
                $problem = $p['data']['36479112']['value'];
                
                //change status color
                if ($status == "Assigned"){
                    $statusColor = "<font color='orange'>".$status."</font>";
                }
                
                if ($status == "On Hold"){
                    $statusColor = "<font color='blue'>".$status."</font>";
                }
                
                if ($status == "Complete"){
                    $statusColor = "<font color='green'>".$status."</font>";
                }
               
               if ($status == "Open"){
                    $statusColor = "<font color='red'>".$status."</font>";
                }
                
                echo "<tr><td><a href='/edit/?id=".$ticketID."'><img src='/img/edit.png'></a></td><td>".$statusColor."</td><td>".$p['id']."</td><td>".$fullName."</td><td>".$dateTime."</td><td>".$problem."</td></tr>";
                      
             
           
        }//end foreach
        
              
    } //end get Submissions
    

    public function getFormData($formid){
        
        $id = $formid;
        $key = $this->token;
        $url = 'https://www.formstack.com/api/v2/submission/'.$id.':id.json?oauth_token='.$key;
        $string =file_get_contents($url);
        $json = json_decode($string,true);
        
        
                $fullStringName = $json['data']['0']['value'];
                $first = 'first =';
                $firstName = str_replace($first, '', $fullStringName);
                $last = 'last =';
                $fullName= str_replace($last, '', $firstName);
                $email = $json['data'][1]['value']; 
                $datetime = $json['data'][2]['value'];
                $problem = $json['data'][3]['value'];
                $urlPic = $json['data'][4]['value'];
                $status = $json['data'][5]['value'];
                $comments = $json['data'][6]['value'];
                
                $result = array($fullName,$email,$datetime,$problem,$urlPic,$status,$comments);
                
                return $result;
        
    } //end get getFormData
    
    
    public function putFormData($formid, $field1, $field2){
        
        $id = $formid;
        $key = $this->token;
        $url = 'https://www.formstack.com/api/v2/submission/'.$id.'.json?oauth_token='.$key;
        $fields = array('field_36496275'=> $field1, 'field_36496301'=> $field2);
        
        $post_field_string = http_build_query($fields, '', '&');
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
        $string = curl_exec($ch);
        curl_close ($ch);
        
        $json = json_decode($string,true);
        $response = $json['success'];
        return $response;
        
        
    }//end putFormData
    
    
    public function deleteSubmission($formid){
     
        $id = $formid;
        $key = $this->token;
        $url = 'https://www.formstack.com/api/v2/submission/'.$id.'.json?oauth_token='.$key;   
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $string = curl_exec($curl);
        curl_close ($curl);
        
        $json = json_decode($string,true);
        $response = $json['success'];
        return $response;
    }
    
    
} //end class

    