<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Video\V1;

use WPSmsPro\Vendor\Twilio\Options;
use WPSmsPro\Vendor\Twilio\Values;
abstract class CompositionSettingsOptions
{
    /**
     * @param string $awsCredentialsSid The SID of the stored Credential resource
     * @param string $encryptionKeySid The SID of the Public Key resource to use
     *                                 for encryption
     * @param string $awsS3Url The URL of the AWS S3 bucket where the compositions
     *                         should be stored
     * @param bool $awsStorageEnabled Whether all compositions should be written to
     *                                the aws_s3_url
     * @param bool $encryptionEnabled Whether all compositions should be stored in
     *                                an encrypted form
     * @return CreateCompositionSettingsOptions Options builder
     */
    public static function create(string $awsCredentialsSid = Values::NONE, string $encryptionKeySid = Values::NONE, string $awsS3Url = Values::NONE, bool $awsStorageEnabled = Values::NONE, bool $encryptionEnabled = Values::NONE) : CreateCompositionSettingsOptions
    {
        return new CreateCompositionSettingsOptions($awsCredentialsSid, $encryptionKeySid, $awsS3Url, $awsStorageEnabled, $encryptionEnabled);
    }
}
class CreateCompositionSettingsOptions extends Options
{
    /**
     * @param string $awsCredentialsSid The SID of the stored Credential resource
     * @param string $encryptionKeySid The SID of the Public Key resource to use
     *                                 for encryption
     * @param string $awsS3Url The URL of the AWS S3 bucket where the compositions
     *                         should be stored
     * @param bool $awsStorageEnabled Whether all compositions should be written to
     *                                the aws_s3_url
     * @param bool $encryptionEnabled Whether all compositions should be stored in
     *                                an encrypted form
     */
    public function __construct(string $awsCredentialsSid = Values::NONE, string $encryptionKeySid = Values::NONE, string $awsS3Url = Values::NONE, bool $awsStorageEnabled = Values::NONE, bool $encryptionEnabled = Values::NONE)
    {
        $this->options['awsCredentialsSid'] = $awsCredentialsSid;
        $this->options['encryptionKeySid'] = $encryptionKeySid;
        $this->options['awsS3Url'] = $awsS3Url;
        $this->options['awsStorageEnabled'] = $awsStorageEnabled;
        $this->options['encryptionEnabled'] = $encryptionEnabled;
    }
    /**
     * The SID of the stored Credential resource.
     *
     * @param string $awsCredentialsSid The SID of the stored Credential resource
     * @return $this Fluent Builder
     */
    public function setAwsCredentialsSid(string $awsCredentialsSid) : self
    {
        $this->options['awsCredentialsSid'] = $awsCredentialsSid;
        return $this;
    }
    /**
     * The SID of the Public Key resource to use for encryption.
     *
     * @param string $encryptionKeySid The SID of the Public Key resource to use
     *                                 for encryption
     * @return $this Fluent Builder
     */
    public function setEncryptionKeySid(string $encryptionKeySid) : self
    {
        $this->options['encryptionKeySid'] = $encryptionKeySid;
        return $this;
    }
    /**
     * The URL of the AWS S3 bucket where the compositions should be stored. We only support DNS-compliant URLs like `https://documentation-example-twilio-bucket/compositions`, where `compositions` is the path in which you want the compositions to be stored. This URL accepts only URI-valid characters, as described in the <a href='https://tools.ietf.org/html/rfc3986#section-2'>RFC 3986</a>.
     *
     * @param string $awsS3Url The URL of the AWS S3 bucket where the compositions
     *                         should be stored
     * @return $this Fluent Builder
     */
    public function setAwsS3Url(string $awsS3Url) : self
    {
        $this->options['awsS3Url'] = $awsS3Url;
        return $this;
    }
    /**
     * Whether all compositions should be written to the `aws_s3_url`. When `false`, all compositions are stored in our cloud.
     *
     * @param bool $awsStorageEnabled Whether all compositions should be written to
     *                                the aws_s3_url
     * @return $this Fluent Builder
     */
    public function setAwsStorageEnabled(bool $awsStorageEnabled) : self
    {
        $this->options['awsStorageEnabled'] = $awsStorageEnabled;
        return $this;
    }
    /**
     * Whether all compositions should be stored in an encrypted form. The default is `false`.
     *
     * @param bool $encryptionEnabled Whether all compositions should be stored in
     *                                an encrypted form
     * @return $this Fluent Builder
     */
    public function setEncryptionEnabled(bool $encryptionEnabled) : self
    {
        $this->options['encryptionEnabled'] = $encryptionEnabled;
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
        return '[Twilio.Video.V1.CreateCompositionSettingsOptions ' . $options . ']';
    }
}
