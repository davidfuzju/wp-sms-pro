v4.3.7 - 2025-03-31
- Fix: Resolved issue with custom mobile field meta keys in Ultimate Member integration when using keys other than `mobile_number`.
- Fix: Resolved issue with URL encoding in message processing for Semaphore Gateway.
- Fix: Removed inactivated gateways.

v4.3.6 - 2024-12-23
- Update: Added support for `userSuppliedId` in BulkSMS SMS gateway.
- Fix: Resolved issue with MSG91 gateway variable support.
- Fix: Addressed issues with Semaphore SMS gateway functionality.
- Fix: Corrected user creation process before verification.
- Fix: Fixed "Attempt to assign property on null" error in `RepeatingMessages.php`.
- New: Added support for Cloudtalk SMS gateway.

v4.3.5 - 2024-11-24
- New: Added support for Incoming messages to the BulkSMS gateway.
- New: Introduced Brevo SMS gateway integration.
- Fix: Resolved admin notification issue for new orders in the block-based WooCommerce checkout.

v4.3.4 - 2024-10-27
- Enhancement: Updated routing for SMS gateway RouteSMS.
- Enhancement: Ensured full compatibility with WordPress version 6.7.
- Enhancement: Improved validation and functionality in OTP and SMS-based login.
- Enhancement: Added support for the `redirect_to` parameter in mobile login for enhanced redirection control.
- New: Added support for the SMS gateway mysms.com.

v4.3.3 (2024-08-26)
- Enhancement: Improved OTP verification process to fix js errors.
- Enhancement: Enhanced SMS gateway integrations for Amazon SNS, MiMSMS, and OVH.
- Enhancement: Added support for incoming messages via the Clickatell gateway.

v4.3.2 (2024-07-30)
- Enhancement: Gateways SmsPapa, AlphaSms, InfoBip, and Clickatell updated
- Enhancement: Added compatibility with login/register redirect plugins
- Enhancement: Added support for shortening URLs in SMS content
- Fix: Resolved sender name issue for the OVH gateway
- New: Added support for the Juhe.cn gateway

v4.3.1 (2024-05-31)
- Update: Gateways BulkSMS-Gateway and SMS NOC updated.
- Update: Added Semaphore, SMS Papa, Gupshup, and Telesign gateways.
- Fixes: Fixed new order status notification issue.
- Improvement: Updated intl-tel-input plugin and styles.
- Improvement: Replaced legacy send SMS method with `wp_sms_send()` to support background processing.
- Improvement: Implemented minor enhancements and general clean-up.

v4.3 (2024-04-08)
- Update: Enhanced mobile styles and UI for the login process.
- Update: Upgraded gateways, including BulkSMSGateWay, OVH, and Dianahost, for improved performance.
- Update: Expanded Twilio support to include WhatsApp, enhancing messaging capabilities.
- Addition: Introduced new gateways: Amazon SNS, eSMS, AlphaSms, MailBit, and Klasiksms, broadening our service offerings.
- Improvement: Resolved issues with Ultimate Member Use Mobile Field Handler in multi-registration forms, improving user registration flow.
- Improvement: Added required fields to SendSmsBlockAjaxController, ensuring data integrity.
- Improvement: Fixed a translation bug and updated the POT file, enhancing localization.
- Improvement: Conducted minor improvements and cleaned up various functionalities for smoother operation.

v4.2.6 (2023-12-03)
- Addition: New Send SMS Gutenberg block for websites. [Read more](https://wp-sms-pro.com/24549/wp-sms-pro-v4-2-6-new-send-sms-feature-in-gutenberg-block/)
- Addition: New SMS gateways, including SmsBuddy, SmsNoc and Releans

v4.2.5 (2023-11-19)
- Improvement: Backward compatibility with multi inputs GravityForms
- Fixes: MontyMobile Gateway Issue
- Fixes: Time-out issue in TextMarketer

v4.2.4 (2023-11-13)
- Improvement: The Send SMS box on WooCommerce Order Page
- Improvement: Mobile Verification Input to a single field to make more compatible with RTL and usabilities.
- Improvement: Gateways Montymobile and Textmarketer
- Fixes: Some PHP implode issues on PHP v7.3
- Fixes: JavaScript issue that occurred when the Login with SMS feature was disabled

v4.2.3 (2023-10-17)
- Addition: Added mobile field in Awesome support form
- Improvement: Backward compatibility with new custom WooCommerce order table and HPOS.
- Improvement: Gateway eskiz updated to the latest version.
- Improvement: Awesome Support functionalities and added new notifications

v4.2.2 (2023-10-08)
- Fixes: The repeating SMS issue has been fixed.

v4.2.1 (2023-09-24)
- Fixes: Addressed a Flex issue with Login via SMS in RTL mode.
- Fixes: Resolved an MMS problem related to Telnyx.
- Improvement: Enhanced the performance and functionality of the OVH gateway.
- Improvement: Added the capability to specify SenderAddressType in websmsa.at.

v4.2.0 (2023-09-08)
- Addition: Enable Phone Registration for SMS Login
- Improvement: Updated SMS Gateways MIMsms, Telnyx, and SmsPoh
- Improvement: Enhance BuddyPress & UltimateMember Mobile Field Handler with a New Field Handler Framework

v4.1.0.2 (2023-07-16)
- Fixes: Wrong calling WooCommerce helper function has been fixed

v4.1.0.1 (2023-07-09)
- Fixes: The opt-in WooCommerce issue

v4.1.0 (2023-07-04)
- Addition: Integrated new gateways BulkSmsMa, Micron, and ApiFon for expanded SMS sending options.
- Addition: Introduced a new feature that allows sending SMS after user approval in Ultimate Member.
- Addition: Added a new option to display WooCommerce order status update checkbox on the checkout page.
- Addition: Implemented an opt-in checkbox on the WooCommerce checkout page for customers to confirm their consent to receive notifications.
- Improvement: The login with mobile styles and UI
- Update: Updated Gateway 4jawaly to ensure compatibility and improved performance.
- Bugfix: Resolved a notice error in the WhatsApp gateway and added support for MMS functionality.
- Bugfix: Fixed the issue of fetching customer mobile number after adding a note on the WooCommerce order page.

v4.0.3 (2023-05-16)
- New: Mobile numbers dropdown is now supported in the SMS metabox on the WooCommerce view order.
- New: Hubtel gateway is now supported.
- Improved: The SmsCountry gateway has been updated.
- Improved: The SmsMisr gateway has been updated.
- Improved: The WhatsAppCloud gateway has been updated to version 16 and supported the template
- Bugfix: An issue with certain gateways has been resolved.

v4.0.2 (2023-04-16)
- Bugfix: An issue to get the correct variables in OTP
- Improvement: The Notify Service from Twilio has been removed
- Improvement: Compatibility with PHP v7.0

v4.0.1 (2023-03-21)
- Improvement: Update MSG91 gateway API
- Bugfix: Fix the issue in SmsCountry API
- Bugfix: Fix correct option for add_mobile_field
- Bugfix: PHP v8.2 compatibility

v4.0 (2023-03-12)
- New: The login with SMS is re-designed and improved
- New: The SMS OTP functionality is refactored and improved
- New: The plugin structure and add the service provider
- New: SMS gateway ApidSms, WhatsAppApi and SmsViro
- Update: The WooCommerce Verification moved out to Add-On WP SMS WooCommerce Pro
- Update: The SMS gateways, SmsMisr and SmsCountry
- Improvement: PHP v8.2 compatibility
- Improvement: The showing correct status in scheduled
- Improvement: Support the order message variables in the send SMS box in WooCommerce order view
- Improvement: Compatibility with WP SMS v6.1

v3.4 (2023-01-21)
- New: The functionality of the variables on messages has been refactored
- New: The variables on WooCommerce are completed
- New: Support gateway SMSdone
- New: Support gateway Sendinblue
- Update: Bulksmsbd gateway is updated.
- Update: Update scheduled menu cap
- Bugfix: The load Text-domain real-path issue has been fixed

v3.3.17 (2022-12-18)
- New: Implement order_meta variable for WC
- New: Save the SMS responses in WooCommerce order notes
- Bugfix: The failure issue to correctly include defines in WP_CLI
- Bugfix: The session issue in OTP
- Bugfix: The SmsMisr.php and fix issues
- Improvement: Loading the templates
- Improvement: Better style for statuses
- Improvement: Speedup Twilio while sending SMS

v3.3.16 (2022-11-23)
- New: Mehrafraz gateway is now added to the WP SMS Pro.
- Update: Kaleyra gateway is updated.
- Update: SMSMISR gateway is updated.
- Bugfix: The unmaintained library for the OVH gateway is now fixed.
- Bugfix: The session warnings are fixed.
- Improvement: Backward compatibility for autoload.php.
- Improvement: A Helper has been implemented to load templates instead of using of require_once function to deliver better performance and have cleaner codes.

v3.3.15 (2022-11-05)
- New: Order meta key variable is now implemented
- New: Compatibility with BuddyBoss
- Update: Bulksmsbd gateway has been updated
- Bugfix: Kaleyra gateway error has been fixed
- Bugfix: Sending SMS to BuddyPress via API now is fixed
- Bugfix: Getting the correct ID field in BuddyPress has been fixed
- Bugfix: Retrieving the correct number in BuddyPress profile
- Improvement: SMSMISR gateway has been updated. Now you can send OTP messages through this gateway.

v3.3.14 (2022-10-23)
- New: Support gateway SmsCentral.com.au
- New: Support gateway SmsPoh
- New: Support gateway OVH SMS
- Update: Move out AspSms to the free version
- Update: The language files
- Bugfix: GreenWeb gateway gets credit method
- Improvement: The performance of the updater has been improved

v3.3.13 (2022-09-10)
- New: Support WhatsApp Business API
- Bugfix: BuddyPress database not found error when BuddyPress is deactivated
- Improvement: Add support SMS routes & DND for BulkSmsNigeria

v3.3.12 (2022-08-05)
- New: Quick reply in Scheduled and repeating messages
- New: New SMS gateway MessageMedia from Australia
- Bugfix: Sorting function issue in admin pages fixed
- Bugfix: The issue in the htd.ps gateway has been fixed
- Bugfix: The issue in WP Job Manager
- Improvement: Href tab links on the Scheduled page

v3.3.11 (2022-07-05)
- Improvement: Minor bugfix & things that should be fixed
- Improvement: Support longMessageMaxParts parameter for BulkSms gateway
- New: Gateway Firetext.co.uk has been added

v3.3.10 (2022-06-12)
- New: Repeating messages has been supported in scheduled SMS!
- New: A new option in settings to make the mobile number optional in WooCommerce checkout
- New: Add support %order_total_currency% and %order_total_currency_symbol% variables to the WooCommerce order notifications
- Bugfix: compatibility with the old version of WP SMS
- Improvement: Options & error messages in WooCommerce class

v3.3.9 (2022-05-05)
- New: Gateway Textteam from Australia has been added
- New: Gateway Greenweb from Bangladesh has been added
- Bugfix: Prevent overwriting the mobile field by woocommerce functionality and improvement
- Bugfix: Sanitize inputs & hardened plugin security
- Bugfix: The MMS issue in Plivo when has PowerPack UUID
- Bugfix: The encoding issue in Greenweb gateway has been fixed
- Improvement: Possibility to send MMS in Twilio when the Notify SID is configured
- Improvement: Make white-label login with mobile, the copyright is removed
- Update: The POT file has been updated

v3.3.8 (2022-04-15)
- Update: Supported Sub Account Twilio
- Update: Gateway kaleyra.com has been updated
- Update: Gateway textlocal.in has been updated
- Add Gateway eskiz.uz has been added
- Add: Gateway Link Mobility (France) has been added
- Feature: The group receiver job notification has been added WP-Job Manager
- Feature: The `%order_total%` has been supported in Woocommerce Notify by status variables

v3.3.7 (2022-03-07)
- Feature: Implement roles for WooCommerce new product notification
- Feature: Gateway LinkMobility and BTSSMS has been added
- Improvement: Gateways MSG91 and Twilio has been updated
- Improvement: Admin redirection and notices logic
- Improvement: Compatible and improvement the UltimateMembers mobile field functionality
- Improvement: Compatible SmsMisr with the old version of PHP
- Bugfix: A query issue to get properly WooCommerce customer's mobile numbers has been fixed

v3.3.6 (2022-01-15)
- Add: Bitly Short URL!
- Add: Quform form content shortcode
- Add: Sinch SMS gateway has been added
- Add: SmsBroadCast SMS gateway has been added
- Add: MontyMobile SMS gateway has been added
- Add: SigmaSms SMS gateway has been added
- Add: TurboSms SMS gateway has been added
- Add: NobelSms SMS gateway has been added
- Add: SmsMasivOS SMS gateway has been added
- Update: ISmartSms SMS gateway has been updated
- Update: Dianahost SMS gateway has been updated
- Bugfix: showing the correct WooCommerce currency symbol in order total notification
- Improvement: GravityForms variables

v3.3.5 (2021-12-08)
- Feature: Supported the order items variable in WooCommerce notifications
- Feature: Supported private message notification in BuddyPress

v3.3.4 (2021-12-05)
- Bugfix: Passing the correct order total in WooCommerce order notifications has been fixed
- Bugfix: Sending the BuddyPress welcome notification has been fixed
- Bugfix: A tweak BuddyPress notice error has been fixed
- Feature: A France gateway called Spot-Hit.fr has been added

v3.3.3.1 (2021-11-22)
- Bugfix: TextMagic SMS gateway issue has been fixed
- Bugfix: Passing the correct accepted arguments in Awesome Support hooks

v3.3.3 (2021-11-14)
- Added: The new Poland SMS gateway called SMSEagle has been added
- Added: Sync & compatibility BuddyPress mobile numbers option
- Added: BuddyPress chose the mobile field for sending SMS
- Update: Translations & strings
- Improvement: WooCommerce OTP verification responsive issue

v3.3.2 (2021-10-25)
- Improvement: The WooCommerce mobile verification (OTP) has been improved, the OTP box will be shown after submitting the checkout form
- Update: The Plivo gateway has been updated to the latest API version
- Tweak: Log the failed SMS has been fixed for the Twilio gateway
- Added: The new Norway SMS gateway called TeletopiaSMS has been added
- Added: New option for disabling the existing number validation in the WooCommerce OTP process

v3.3.1 (2021-10-02)
- Enhancement: Forgetting the correct local time, used the `current_datetime()` instead of `current_time()`.
- Enhancement: The issue in the Plivo gateway to check the response status code.
- New: Media has been added to the Scheduled and Scheduled list.
- New: The new gateway called BrqSMS (mazinhost.com) has been added.
- Update: The MMS is supported in Twilio and Plivo gateways.
- Update: The plugin updater library has been updated.

v3.3 (2021-09-20)
- Updated Twilio gateway's fields
- Updated Plivo gateway and supported to work with the test numbers
- Added a filter for check scheduled cron interval
- Added BareedSMS gateway
- Added a new option in the Ultimate Members setting for syncing the old numbers
- Added a new option in the Ultimate Members setting to select the mobile field number to sync
- Added Mobishastra gateway in the setting page
- Fixed critical error in TextLocal gateway
- Improvement Time-zone conversion in sending scheduled SMS
- Improvement the license settings functionality

v3.2.9 (2021-08-17)
- New admin design
- Added PowerPack uuid in Plivo
- Added notify.lk gateway
- Updated Telnyx to new api (Please re-configure again)

v3.2.8 (2021-06-26)
- Added smschef.com gateway
- Fixed unicode issue in smsbox.be gateway and compatibility with unicode option in the setting page.

v3.2.7 (2021-06-12)
- Added sendsms.ro gateway
- Added smsbox.be gateway
- Fixed unicode issue in gtxmessaging gateway
- Fixed get credit on sendpk gateway

v3.2.6 (2021-05-14)
- Fixed Twilio bulksms time-out issue and supported Twilio Messaging Service and Notify
- Added Singleton plugin initialization.
- Updated plivo gateway
- Fixed sms.to API response

v3.2.5 (2021-04-04)
- Added a new option to edit SMS scheduled.
- Added taqnyat.sa gateway
- Updated sms.to gateway

v3.2.4 (2021-02-12)
- Added thesmsworld.com gateway
- Fixed session notice error in WordPress site health.
- Added autofill WooCommerce OTP mobile field support.
- Updated mimsms.com gateway
- Improvement plivo gateway.
- Minor Improvement and clean-up some functionalities.

v3.2.3 (2020-12-24)
- Improvement Telnyx gateway
- Improvement Bulksms gateway
- Improvement Order status trigger for WooCommerce
- Improvement Get User Billing Phone for WooCommerce

v3.2.2 (2020-11-21)
- Removed some disabled gateways (magicdeal4u, tropo, makolar)
- Updated makolar gateway.
- Fixed issue in kaleyta gateway.

v3.2.1 (2020-09-19)
- Added new SMS gateways in the plugin (tiniyo.com, vatansms.com, smsmessanger.co.za, vfirst.com)
- Minor Improvement.

v3.2 (2020-09-06)
- Added new SMS gateways in the plugin (unifonic and bulksmsbd)
- Added while-list countries for WooCommerce SMS OTP.
- Added a new variable for the WooCommerce option for retrieving the unique order URL.
- Added OTP option in the setting page which is supports many useful options.
- Updated the alfacell gateway.
- Supported the PHP constants for defining the license in the wp-config.php `define('WP_SMS_LICENSE', 'your-license');`
- Improvement the sending SMS on the WooCommerce order page.
- Compatible with the new version of QuForms.

v3.1.8 (2020-03-15)
- Added Woocommerce Notification by order Status
- Added mimsms.com gateway
- Added jusibe.com gateway
- Updated isms.com.my gateway
- Updated skebby.it gateway
- Fixed minor issues.

v3.1.7 (2020-01-09)
- Added: GravityForms forms fields in setting page.
- Added: Gateways (htd.ps, telnyx.com and makolar.com)
- Fixed: Added `read_and_close` argument for starting season.

v3.1.6 (2019-11-25)
- Fixed Issue in SMS Schedule.
- Fixed Sending Unicode Messages in Venmo.
- Fixed Compatible with Awesome Support v5.8.0
- Fixed An issue in alfa gateway.

v3.1.5 (2019-10-19)
- Added Kaleyra & gtxmessaging gateways
- Added Billing Phone in WooCommerce variables.
- Added Kwtsms.com gateway.
- Added Dianahost.com gateway.
- Added Sendpulse.com gateway.
- Fixed The rest api encountered error in site health.

v3.1.4 (2019-09-06)
- Updated Infobip gateway.

v3.1.3 (2019-09-04)
- Fixed: issue in Infobip gateway.
- Updated: German language.

v3.1.2 (2019-08-12)
- Added Bulksmsnigeria gateway.
- Added Aspsms.com gateway.
- Added Sms.ru gateway.
- Updated Infobip gateway.
- Updated Orange gateway.
- Fixed WooCommerce product update users numbers.
- Fixed International input loading options.

v3.1.1 (2019-07-1)
- Added Sendhub gateway.
- Added Skebby gateway.
- Added Tropo gateway.
- Added Upsidewireless gateway.
- Added Orange gateway.
- Added Proovl gateway.
- Added Messente gateway.
- Added Springedge gateway.

v3.1.0 (2019-06-17)
- Added Scheduled SMS feature (For sending on custom time SMS from WordPress).
- Added Zipwhip gateway.
- Added Routesms gateway.
- Added Tyntec gateway.
- Added Smscountry gateway.
- Added Alfa-cell as mobily.ws gateway.
- Added 4jawaly gateway.
- Updated Nexmo gateway.
- Updated Twilio gateway.
- Updated Bandwith Gateway.
- Updated Onewaysms gateway.
- Updated BulkSMS gateway.
- Fixed integrations enable/disable check settings.
- Minor improvements plugin structure.

v3.0.4 (2019-04-10)
- Updated Mocean gateway.
- Fixed TextMarketer gateway.
- Minor improvements.

v3.0.3 (2019-03-19)
- Added meta box in WooCommerce for send SMS to customer order.
- Added Send SMS option in WooCommerce order note.
- Added Smsgateway.me and bandwidth.com gateways.
- Improvement Moceansms, Pswin, Viensms and Clickatell gateways.

v3.0.2 (2019-03-10)
- Added integrate with Ultimate Members plugin.
- Added smsmisr.com gateway.
- Updated Textmagic gateway.
- Improvement clickatell.com gateway.
- Fixed BuddyPress integration with new version(3.x).
- Fixed Nexmo gateway.
- Fixed minor bugs.

v3.0.1 (2019-01-30)
- Updated Twilio.com gateway.

v3.0 (2019-01-21)
- Added WooCommerce OTP SMS mobile verification on orders with limitation and period time on retries.
- Added gateway Textlocal.in
- Added gateway Onewaysms.com.my
- Added gateway Ismartsms.net
- Added gateway Bulksmsgateway.in
- Added gateway Ooredoo-sms.com
- Added gateway Textlocal.com
- Added gateway Qsms.com.au
- Added gateway Hoiio.com
- Added gateway Textmagic.com
- Optimized The main structure of the plugin and split process to increase performance and load.
- Updated integration with the new Quform V2
- Fixed minor bugs.

v2.4.2 (2018-10-10)
- Improved the update checker.

v2.4.1 (2018-10-05)
- Improved the update checker, which has been optimized. Also, the problem of speed reduction has been resolved.

v2.4.0 (2018-09-09)
- Added the new option of choosing the field from which numbers can be taken and sending messages to these numbers in the WooCommerce checkout page.
- Added Message Body Text for custom SMS messages in the site login page.
- Added the new variables for WooCommerce. `%billing_first_name%`, `%billing_company%`, `%billing_address%` and `%order_total%`.
- Implemented the Login with mobile feature.
- Updated Libraries and SDKs to latest version.
- Updated the Twilio, Moceansms, Clickatell, Mobily and Plivo gateways.
- Fixed the issue of finding the user on the login page with mobile popups

v2.3.2 (2018-06-29)
- Updated Libraries to latest version.
- Fixed untranslated the Order status for the WooCommerce notifications.

v2.3.1 (2018-04-22)
- New integration (Awesome Support plugin) (https://wordpress.org/plugins/awesome-support/)

v2.3 (2018-01-25)
- Added License key for auto update.
- Added Send SMS to multi numbers in the all phone number fields.
- Added Messagebird.com and Msg360.in gateways.
- Supported Twilio gateway for sending bulk SMS.
- Updated Gateway libraries to the latest version.

v2.2.9 (2017-11-16)
- NOTICE: Please update wp-sms to the latest version.
- Updated libraries.
- Improvement mobile verifies number.
- Fixed issue to get the credential in Twilio gateway.

v2.2.8 (2017-09-30)
- Supported with WP-Job-Manager for sending notifications to admin & employers.
- Updated libraries and dependencies of gateways.
- Updated smsfactor.com gateway.

v2.2.7 (2017-09-09)
- Added Order number variable to Woocommerce notifications message (Notify for new order for admin and customer).
- Fixed issue in verify mobile number when user registered in Woocommerce.
- Improvement getting mobile number in BoddyPress & Woocommerce.

v2.2.6 (2017-06-08)
- WordPress 4.8 compatibility
- Supported sending bulk message for bulksms and clickatell gateway

v2.2.5 (2017-03-24)
- Fixed smsapi.com gateway to get credit and sending sms
- Fixed clockworksms.com gateway to get credit
- Fixed yamamah.com gateway to sending sms
- Fixed mobily.ws gateway to sending sms

v2.2.4 (2017-02-04)
- Improvement request to the gateway
- Fixed twilio gateway to get credit
- Updated German translations

v2.2.3 (2017-01-24)
- Added verify user registration by sms verification code
- Support clicksend.com and smsapi.com gateway
- Improvements settings page and used main plugin for settings handler
- Improvement bulksms gateway for get correct EAPI URL

v2.2.2 (2017-01-20)
- PHP 7.1 compatibility
- Improvements all premium gateway classes.
- Supported `textmarketer.co.uk` gateway.

v2.2.1 (2017-01-17)
- Fixed load premium gateway issue on the dropdown list.

v2.2.0 (2017-01-13)
- Compatible with WP 4.7
- Compatible with WP-SMS v4.0
- Added composer dependency for load libraries.
- Added `WP_Error` in the all gateway classes.
- Added new classes for doing any proccess.
- Fixed and improvement gateways: Twilio, Nexmo, Infobip, Clickatell, Plivo, Bulksms.
- Fixed already start session in login sms.
- Improvement all syntax for notice errors.

v2.1.0 (2016-06-04)
- Added New filters `wp_sms_from`, `wp_sms_to`, `wp_sms_msg` in the plugin.
- Added pswin.com gateway.
- Added esms.vn gateway.
- Added smsfactor.com gateway.
- Added Arabic language.
- Fixed `Undefined index` errors in ths plugin when wordpress debug is enable.

v2.0 (2015-10-03)
- Added login to wordpress ability with sms.
- Added customers field to WooCommerce for send notification new products.
- Added sms notification to WooCommerce for customer after submit order.
- Added show all gravity forms to send an SMS to each form.
- Added send a sms to field value to each form in gravity forms.
- Added show all Quforms to send an SMS to each form.
- Added send a sms to field value to each form in Quforms.
- Added option to EDD checkout page to enable mobile field number.
- Added sms notification to EDD for customer after submit order.
- Remove Awesome support integration from the plugin.
- Integration with buddypress for get notification of mention and reply to comments.

v1.4.1 (2015-08-16)
- Added vsms.club
- Added ssdindia.com
- Fixed Notification send sms after enable plugin
- Fixed Integration with new ver of CF7
- Update Arabic translation.
- Added German translation.

v1.4 (2015-06-03)
- New integration (Awesome Support plugin) (https://wordpress.org/plugins/awesome-support/)
- Added rules on mobile field number for subscribe form. (maximum and minimum number)
- Added place holder on mobile filed number for subscribe form for help to user.
- Added plivo.com gateway
- Added bulksmshyderabad.co.in gateway
- Added ozioma.net
- Added sendsms247.com
- Added smslive247.com
- Added Chinese translator. (Thanks Jack Chen)
- Improved subscribe ajax form.
- Improved subscribe form and changed the form design.
- Fixed a problem in send post to subscribers.

v1.3.7 (2015-05-02)
- Support special characters in cpsms gateway.

v1.3.6 (2015-05-02)
- Fixed Contact form 7 shortcode. currently supported.
- Updated Twilio library.

v1.3.5 (2015-04-09)
- Added dsms.in webservice.
- Added cpsms.dk webservice.
- Added afilnet.com webservice.

v1.3.4 (2015-03-37)
- Fixed unicode message in mobily.ws webservice.
- Change bulksms webservice url.

v1.3.3 (2015-03-07)
- Added ra.sa webservice.
- Fixed clickatell.com webservice.

v1.3.2 (2015-02-21)
- Added magicdeal4u.com webservice.
- Added livesms.eu webservice.
- Added cellsynt.net webservice.

v1.3.1 (2015-01-26)
- Added Send sms to subscribers option When published new woocommerce products.
- Added Mobile field number for woocommerce.
- Added Change order notification sms for woocommerce.
- Added Variables %status%, %order_name%, %customer_first_name%, %customer_last_name% for woocommerce new order.
- Added Mobile field number in create a new user from admin.
- Fixed notification sms when create a new user.

v1.3 (2015-01-16)
- Added Numbers of Wordpress Users to send sms page.
- Added Mobile validate number to class plugin.
- Added Option for Disable/Enable credit account in admin menu.
- Added Description field optino for subscribe form widget.
- Added msg91.com webservice.
- Included username & password field for reset button in webservice tab.
- Updated: Widget code now adhears to WordPress standards.
- Fixed SSL problem in clockworksms.com webservice.
- Remove number_format in show credit sms.

v1.2.4 (2015-01-03)
- Added Gravity form notification to plugin.
- Fixed problem in include files.

v1.2.3 (2014-12-26)
- Added low stock notification for WooCommerce.
- Remove mobile country code from tell friend section.
- Change folder and files structure plugin.

v1.2.2 (2014-12-15)
- Fixed bulksms webservice.
- Fixed send sms url in admin menu.
- Fixed sms items in posted sms page.
- Fixed subscribe items in subscribe page.
- Fixed Mobile validation number.
- Fixed Warning error when export subscribers.
- Changed rial unit to credit.

v1.2.1 (2014-12-06)
- Fixed clickatell webservice.
- Fixed Notifications sms to subscribes.
- Fixed Mobile validation in subscribe form.
- Added Reset button for remove web service data.
- Added Turkish language.
- Added Danish language.

v1.2 (2014-11-14)
- Added dot4all.it webservice.

v1.1 (2014-11-11)>
- Added mobily.ws webservice.

v1.0 (2014-11-06)
- First release.