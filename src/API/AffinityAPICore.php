<?php namespace Fopio\AffinityAPI\API;

/**
 * Class AffinityAPICore
 * @package App\Packages\Affinity
 */
abstract class AffinityAPICore implements AffinityAPIInterface
{
    private $password;

    private $username;

    private $wsdl_uri;

    protected $client = null;

    protected $token = null;

    protected $settings;

    protected $default_projection;

    protected $default_ordering;

    protected $filter;

    public function __construct()
    {
        $this->username = env('AFFINITY_USERNAME');

        $this->password = env('AFFINITY_PASSWORD');

        $this->wsdl_uri = env('AFFINITY_URI');

        $this->settings = env('APP_ENV') == 'production' ? config('affinity.affinity-settings-production') : config('affinity.affinity-settings-local');

        $this->default_projection = new Projection();

        $this->default_ordering = new Ordering();

        $this->filter = new Filter();
    }

    public function __call($method, $arguments)
    {
        if(method_exists($this, $method)) {
            $this->setClient();

            return call_user_func_array(array($this,$method),$arguments);
        }

        throw new \Exception('Method: '. $method.' does not exist!');
    }

    /**
     * Sets the client if not already set, this should be called by magic call method on each method request
     */
    public function setClient()
    {
        if(!isset($this->client)){
            $this->client = new \SoapClient($this->wsdl_uri, array('trace' => true, 'exceptions' => true));

            $this->client->__setLocation($this->wsdl_uri);
        }

        return $this;
    }

    /**
     * Returns the string token provided by affinity
     * @return null
     */
    public function getToken()
    {
        try {
            $login_result = $this->client->GetIdentityToken(array("UserName" => $this->username, "Password" => $this->password, "ApplicationName" => "PHP Script", "ApplicationReference" => "PHP Test"));

            $this->token = $login_result->GetIdentityTokenResult->IdentityToken;

            return $this->token;
        } catch (\Exception $e) {
            var_dump($e->getMessage());

            dd($login_result);
        }
    }

    /**
     * Turns an XML string response into an object
     * @param $xml_string
     * @return object
     */
    protected function xmlToObject($xml_string, $add_parent_node = true)
    {
        $xml_object = ($add_parent_node) ? simplexml_load_string('<xml>' . $xml_string . '</xml>') : simplexml_load_string($xml_string);

        $xml_object = json_encode($xml_object);

        return json_decode($xml_object);
    }

    /**
     * Converts an associate array into an XML string
     * @param array $array
     * @return string
     */
    protected function arrayToXMLString(array $array, $root = null)
    {
        $xml_string = '';

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $child_string = $this->arrayToXMLString($value);

                $xml_string .= '<' . $key . '>' . $child_string . '</' . $key . '>';
            } elseif (is_object($value)) {
                $xml_string .= '<' . $key . '></' . $key . '>';
            } else {
                $xml_string .= '<' . $key . '>' . $value . '</' . $key . '>';
            }
        }

        return ($root == null) ? $xml_string : '<' . $root . '>' . $xml_string . '</' . $root . '>';
    }

    /**
     * Determines if the response from Affinity was an error
     * @param $response
     * @return bool
     */
    public function errorResponse($response)
    {
        if (!isset($response->ResponseCode) || $response->ResponseCode != 0) return true;
    }


    /**
     * This is used to keep error report standard across the Affinity API
     * @param \ $response
     * @return object
     */
    protected function reportError($response)
    {
        $response->Error = true;

        return $response;
    }

    /**
     * Gets the setting based on environment
     * @param $key
     * @return mixed
     */
    public function getSetting($key)
    {
        return $this->settings[$key];
    }

    /**
     * returns all the settings for environment
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getSettings()
    {
        return $this->settings;
    }
}