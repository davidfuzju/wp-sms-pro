<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Wireless\V1\Sim;

use WPSmsPro\Vendor\Twilio\Deserialize;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceResource;
use WPSmsPro\Vendor\Twilio\Values;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property string $sid
 * @property string $simSid
 * @property string $accountSid
 * @property string $radioLink
 * @property string $operatorMcc
 * @property string $operatorMnc
 * @property string $operatorCountry
 * @property string $operatorName
 * @property string $cellId
 * @property array $cellLocationEstimate
 * @property int $packetsUploaded
 * @property int $packetsDownloaded
 * @property \DateTime $lastUpdated
 * @property \DateTime $start
 * @property \DateTime $end
 * @property string $imei
 */
class DataSessionInstance extends InstanceResource
{
    /**
     * Initialize the DataSessionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $simSid The SID of the Sim resource that the Data Session is
     *                       for
     */
    public function __construct(Version $version, array $payload, string $simSid)
    {
        parent::__construct($version);
        // Marshaled Properties
        $this->properties = ['sid' => Values::array_get($payload, 'sid'), 'simSid' => Values::array_get($payload, 'sim_sid'), 'accountSid' => Values::array_get($payload, 'account_sid'), 'radioLink' => Values::array_get($payload, 'radio_link'), 'operatorMcc' => Values::array_get($payload, 'operator_mcc'), 'operatorMnc' => Values::array_get($payload, 'operator_mnc'), 'operatorCountry' => Values::array_get($payload, 'operator_country'), 'operatorName' => Values::array_get($payload, 'operator_name'), 'cellId' => Values::array_get($payload, 'cell_id'), 'cellLocationEstimate' => Values::array_get($payload, 'cell_location_estimate'), 'packetsUploaded' => Values::array_get($payload, 'packets_uploaded'), 'packetsDownloaded' => Values::array_get($payload, 'packets_downloaded'), 'lastUpdated' => Deserialize::dateTime(Values::array_get($payload, 'last_updated')), 'start' => Deserialize::dateTime(Values::array_get($payload, 'start')), 'end' => Deserialize::dateTime(Values::array_get($payload, 'end')), 'imei' => Values::array_get($payload, 'imei')];
        $this->solution = ['simSid' => $simSid];
    }
    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->{$method}();
        }
        throw new TwilioException('Unknown property: ' . $name);
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Wireless.V1.DataSessionInstance]';
    }
}
