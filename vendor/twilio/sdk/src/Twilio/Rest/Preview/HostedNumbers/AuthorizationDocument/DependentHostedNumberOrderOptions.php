<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\HostedNumbers\AuthorizationDocument;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class DependentHostedNumberOrderOptions
{
    /**
     * @param string $status The Status of this HostedNumberOrder.
     * @param string $phoneNumber An E164 formatted phone number.
     * @param string $incomingPhoneNumberSid IncomingPhoneNumber sid.
     * @param string $friendlyName A human readable description of this resource.
     * @param string $uniqueName A unique, developer assigned name of this
     *                           HostedNumberOrder.
     * @return ReadDependentHostedNumberOrderOptions Options builder
     */
    public static function read(string $status = Values::NONE, string $phoneNumber = Values::NONE, string $incomingPhoneNumberSid = Values::NONE, string $friendlyName = Values::NONE, string $uniqueName = Values::NONE) : ReadDependentHostedNumberOrderOptions
    {
        return new ReadDependentHostedNumberOrderOptions($status, $phoneNumber, $incomingPhoneNumberSid, $friendlyName, $uniqueName);
    }
}
class ReadDependentHostedNumberOrderOptions extends Options
{
    /**
     * @param string $status The Status of this HostedNumberOrder.
     * @param string $phoneNumber An E164 formatted phone number.
     * @param string $incomingPhoneNumberSid IncomingPhoneNumber sid.
     * @param string $friendlyName A human readable description of this resource.
     * @param string $uniqueName A unique, developer assigned name of this
     *                           HostedNumberOrder.
     */
    public function __construct(string $status = Values::NONE, string $phoneNumber = Values::NONE, string $incomingPhoneNumberSid = Values::NONE, string $friendlyName = Values::NONE, string $uniqueName = Values::NONE)
    {
        $this->options['status'] = $status;
        $this->options['phoneNumber'] = $phoneNumber;
        $this->options['incomingPhoneNumberSid'] = $incomingPhoneNumberSid;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['uniqueName'] = $uniqueName;
    }
    /**
     * Status of an instance resource. It can hold one of the values: 1. opened 2. signing, 3. signed LOA, 4. canceled, 5. failed. See the section entitled [Status Values](https://www.twilio.com/docs/api/phone-numbers/hosted-number-authorization-documents#status-values) for more information on each of these statuses.
     *
     * @param string $status The Status of this HostedNumberOrder.
     * @return $this Fluent Builder
     */
    public function setStatus(string $status) : self
    {
        $this->options['status'] = $status;
        return $this;
    }
    /**
     * An E164 formatted phone number hosted by this HostedNumberOrder.
     *
     * @param string $phoneNumber An E164 formatted phone number.
     * @return $this Fluent Builder
     */
    public function setPhoneNumber(string $phoneNumber) : self
    {
        $this->options['phoneNumber'] = $phoneNumber;
        return $this;
    }
    /**
     * A 34 character string that uniquely identifies the IncomingPhoneNumber resource created by this HostedNumberOrder.
     *
     * @param string $incomingPhoneNumberSid IncomingPhoneNumber sid.
     * @return $this Fluent Builder
     */
    public function setIncomingPhoneNumberSid(string $incomingPhoneNumberSid) : self
    {
        $this->options['incomingPhoneNumberSid'] = $incomingPhoneNumberSid;
        return $this;
    }
    /**
     * A human readable description of this resource, up to 64 characters.
     *
     * @param string $friendlyName A human readable description of this resource.
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName) : self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }
    /**
     * Provides a unique and addressable name to be assigned to this HostedNumberOrder, assigned by the developer, to be optionally used in addition to SID.
     *
     * @param string $uniqueName A unique, developer assigned name of this
     *                           HostedNumberOrder.
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName) : self
    {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Preview.HostedNumbers.ReadDependentHostedNumberOrderOptions ' . $options . ']';
    }
}
