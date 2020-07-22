<?php
namespace App\Service;


/**
 * clase con el mpetodo genérico para consumo de servicios Rest
 * @author Snayder Acero <hacero@viajemos.com>
 */
class GenericRestService
{
    
    /**
     * generic Rest Client
    */
    public function genericRestClient($baseUrl, $apiAction, $typMethod, $lstParams, $arrHeaders, $crlOptions = array(CURLOPT_ENCODING => ''), $dscService = "")
    {
        // create Response Array
        $arrResponse = array (
            "status" => "ERROR",
            "result" => "Ocurrió un error al acceder a: ".$dscService
        );
        try {
            // call Rest Service.
            $apiInstance = new \RestClient([
                'base_url'     => $baseUrl,
                'curl_options' => $crlOptions
            ]);
            // Method Request
            $rstApi = $apiInstance->{$typMethod}($apiAction, $lstParams, $arrHeaders);
            // echo "<pre>";var_dump($rstApi);echo "</pre>";die;
            // validate response Code
            if ($this->validatePropertyExist($rstApi, 'info', 'http_code') == 200 || $this->validatePropertyExist($rstApi, 'info', 'http_code') == 301) {
                // set Array Response
                $arrResponse = array (
                    "status" => "OK",
                    "result" => (array)$rstApi->decode_response()
                );
            } else {
                // decode Json Response
                $decResponse = json_decode($this->validatePropertyExist($rstApi, 'response'));
                // set Array Response
                $arrResponse = array (
                    "status" => "ERROR",
                    "result" => $this->validatePropertyExist($decResponse, 'title')." - ".$this->validatePropertyExist($decResponse, 'description')
                );
            }
        } catch (\Exception $ex) {
            // message Exception
            $msgException = "Error realizando el Request: ".$ex->getMessage()." - ".$ex->getFile()." - ".$ex->getLine();
            // set Array Response
            $arrResponse = array ("status" => "ERROR", "result" => $msgException);
        }
        // default Return
        return $arrResponse;
       
    }
}