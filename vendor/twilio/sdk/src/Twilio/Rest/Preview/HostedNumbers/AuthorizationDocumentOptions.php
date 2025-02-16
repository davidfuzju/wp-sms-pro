<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview\HostedNumbers;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class AuthorizationDocumentOptions
{
    /**
     * @param string[] $hostedNumberOrderSids A list of HostedNumberOrder sids.
     * @param string $addressSid Address sid.
     * @param string $email Email.
     * @param string[] $ccEmails A list of emails.
     * @param string $status The Status of this AuthorizationDocument.
     * @param string $contactTitle Title of signee of this Authorization Document.
     * @param string $contactPhoneNumber Authorization Document's signee's phone
     *                                   number.
     * @return UpdateAuthorizationDocumentOptions Options builder
     */
    public static function update(array $hostedNumberOrderSids = Values::ARRAY_NONE, string $addressSid = Values::NONE, string $email = Values::NONE, array $ccEmails = Values::ARRAY_NONE, string $status = Values::NONE, string $contactTitle = Values::NONE, string $contactPhoneNumber = Values::NONE) : UpdateAuthorizationDocumentOptions
    {
        return new UpdateAuthorizationDocumentOptions($hostedNumberOrderSids, $addressSid, $email, $ccEmails, $status, $contactTitle, $contactPhoneNumber);
    }
    /**
     * @param string $email Email.
     * @param string $status The Status of this AuthorizationDocument.
     * @return ReadAuthorizationDocumentOptions Options builder
     */
    public static function read(string $email = Values::NONE, string $status = Values::NONE) : ReadAuthorizationDocumentOptions
    {
        return new ReadAuthorizationDocumentOptions($email, $status);
    }
    /**
     * @param string[] $ccEmails A list of emails.
     * @return CreateAuthorizationDocumentOptions Options builder
     */
    public static function create(array $ccEmails = Values::ARRAY_NONE) : CreateAuthorizationDocumentOptions
    {
        return new CreateAuthorizationDocumentOptions($ccEmails);
    }
}
class UpdateAuthorizationDocumentOptions extends Options
{
    /**
     * @param string[] $hostedNumberOrderSids A list of HostedNumberOrder sids.
     * @param string $addressSid Address sid.
     * @param string $email Email.
     * @param string[] $ccEmails A list of emails.
     * @param string $status The Status of this AuthorizationDocument.
     * @param string $contactTitle Title of signee of this Authorization Document.
     * @param string $contactPhoneNumber Authorization Document's signee's phone
     *                                   number.
     */
    public function __construct(array $hostedNumberOrderSids = Values::ARRAY_NONE, string $addressSid = Values::NONE, string $email = Values::NONE, array $ccEmails = Values::ARRAY_NONE, string $status = Values::NONE, string $contactTitle = Values::NONE, string $contactPhoneNumber = Values::NONE)
    {
        $this->options['hostedNumberOrderSids'] = $hostedNumberOrderSids;
        $this->options['addressSid'] = $addressSid;
        $this->options['email'] = $email;
        $this->options['ccEmails'] = $ccEmails;
        $this->options['status'] = $status;
        $this->options['contactTitle'] = $contactTitle;
        $this->options['contactPhoneNumber'] = $contactPhoneNumber;
    }
    /**
     * A list of HostedNumberOrder sids that this AuthorizationDocument will authorize for hosting phone number capabilities on Twilio's platform.
     *
     * @param string[] $hostedNumberOrderSids A list of HostedNumberOrder sids.
     * @return $this Fluent Builder
     */
    public function setHostedNumberOrderSids(array $hostedNumberOrderSids) : self
    {
        $this->options['hostedNumberOrderSids'] = $hostedNumberOrderSids;
        return $this;
    }
    /**
     * A 34 character string that uniquely identifies the Address resource that is associated with this AuthorizationDocument.
     *
     * @param string $addressSid Address sid.
     * @return $this Fluent Builder
     */
    public function setAddressSid(string $addressSid) : self
    {
        $this->options['addressSid'] = $addressSid;
        return $this;
    }
    /**
     * Email that this AuthorizationDocument will be sent to for signing.
     *
     * @param string $email Email.
     * @return $this Fluent Builder
     */
    public function setEmail(string $email) : self
    {
        $this->options['email'] = $email;
        return $this;
    }
    /**
     * Email recipients who will be informed when an Authorization Document has been sent and signed
     *
     * @param string[] $ccEmails A list of emails.
     * @return $this Fluent Builder
     */
    public function setCcEmails(array $ccEmails) : self
    {
        $this->options['ccEmails'] = $ccEmails;
        return $this;
    }
    /**
     * Status of an instance resource. It can hold one of the values: 1. opened 2. signing, 3. signed LOA, 4. canceled, 5. failed. See the section entitled [Status Values](https://www.twilio.com/docs/api/phone-numbers/hosted-number-authorization-documents#status-values) for more information on each of these statuses.
     *
     * @param string $status The Status of this AuthorizationDocument.
     * @return $this Fluent Builder
     */
    public function setStatus(string $status) : self
    {
        $this->options['status'] = $status;
        return $this;
    }
    /**
     * The title of the person authorized to sign the Authorization Document for this phone number.
     *
     * @param string $contactTitle Title of signee of this Authorization Document.
     * @return $this Fluent Builder
     */
    public function setContactTitle(string $contactTitle) : self
    {
        $this->options['contactTitle'] = $contactTitle;
        return $this;
    }
    /**
     * The contact phone number of the person authorized to sign the Authorization Document.
     *
     * @param string $contactPhoneNumber Authorization Document's signee's phone
     *                                   number.
     * @return $this Fluent Builder
     */
    public function setContactPhoneNumber(string $contactPhoneNumber) : self
    {
        $this->options['contactPhoneNumber'] = $contactPhoneNumber;
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
        return '[Twilio.Preview.HostedNumbers.UpdateAuthorizationDocumentOptions ' . $options . ']';
    }
}
class ReadAuthorizationDocumentOptions extends Options
{
    /**
     * @param string $email Email.
     * @param string $status The Status of this AuthorizationDocument.
     */
    public function __construct(string $email = Values::NONE, string $status = Values::NONE)
    {
        $this->options['email'] = $email;
        $this->options['status'] = $status;
    }
    /**
     * Email that this AuthorizationDocument will be sent to for signing.
     *
     * @param string $email Email.
     * @return $this Fluent Builder
     */
    public function setEmail(string $email) : self
    {
        $this->options['email'] = $email;
        return $this;
    }
    /**
     * Status of an instance resource. It can hold one of the values: 1. opened 2. signing, 3. signed LOA, 4. canceled, 5. failed. See the section entitled [Status Values](https://www.twilio.com/docs/api/phone-numbers/hosted-number-authorization-documents#status-values) for more information on each of these statuses.
     *
     * @param string $status The Status of this AuthorizationDocument.
     * @return $this Fluent Builder
     */
    public function setStatus(string $status) : self
    {
        $this->options['status'] = $status;
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
        return '[Twilio.Preview.HostedNumbers.ReadAuthorizationDocumentOptions ' . $options . ']';
    }
}
class CreateAuthorizationDocumentOptions extends Options
{
    /**
     * @param string[] $ccEmails A list of emails.
     */
    public function __construct(array $ccEmails = Values::ARRAY_NONE)
    {
        $this->options['ccEmails'] = $ccEmails;
    }
    /**
     * Email recipients who will be informed when an Authorization Document has been sent and signed.
     *
     * @param string[] $ccEmails A list of emails.
     * @return $this Fluent Builder
     */
    public function setCcEmails(array $ccEmails) : self
    {
        $this->options['ccEmails'] = $ccEmails;
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
        return '[Twilio.Preview.HostedNumbers.CreateAuthorizationDocumentOptions ' . $options . ']';
    }
}
