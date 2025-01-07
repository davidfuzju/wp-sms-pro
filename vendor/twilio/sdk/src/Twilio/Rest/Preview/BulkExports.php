<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */
namespace WPSmsPro\Vendor\Twilio\Rest\Preview;

use WPSmsPro\Vendor\Twilio\Domain;
use WPSmsPro\Vendor\Twilio\Exceptions\TwilioException;
use WPSmsPro\Vendor\Twilio\InstanceContext;
use WPSmsPro\Vendor\Twilio\Rest\Preview\BulkExports\ExportConfigurationList;
use WPSmsPro\Vendor\Twilio\Rest\Preview\BulkExports\ExportList;
use WPSmsPro\Vendor\Twilio\Version;
/**
 * @property ExportList $exports
 * @property ExportConfigurationList $exportConfiguration
 * @method \Twilio\Rest\Preview\BulkExports\ExportContext exports(string $resourceType)
 * @method \Twilio\Rest\Preview\BulkExports\ExportConfigurationContext exportConfiguration(string $resourceType)
 */
class BulkExports extends Version
{
    protected $_exports;
    protected $_exportConfiguration;
    /**
     * Construct the BulkExports version of Preview
     *
     * @param Domain $domain Domain that contains the version
     */
    public function __construct(Domain $domain)
    {
        parent::__construct($domain);
        $this->version = 'BulkExports';
    }
    protected function getExports() : ExportList
    {
        if (!$this->_exports) {
            $this->_exports = new ExportList($this);
        }
        return $this->_exports;
    }
    protected function getExportConfiguration() : ExportConfigurationList
    {
        if (!$this->_exportConfiguration) {
            $this->_exportConfiguration = new ExportConfigurationList($this);
        }
        return $this->_exportConfiguration;
    }
    /**
     * Magic getter to lazy load root resources
     *
     * @param string $name Resource to return
     * @return \Twilio\ListResource The requested resource
     * @throws TwilioException For unknown resource
     */
    public function __get(string $name)
    {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->{$method}();
        }
        throw new TwilioException('Unknown resource ' . $name);
    }
    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call(string $name, array $arguments) : InstanceContext
    {
        $property = $this->{$name};
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array(array($property, 'getContext'), $arguments);
        }
        throw new TwilioException('Resource does not have a context');
    }
    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() : string
    {
        return '[Twilio.Preview.BulkExports]';
    }
}
