# Mage2 Module Customer Status

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Specifications](#markdown-header-specifications)

## Main Functionalities
- Change customer status (frontend / backend)


### Installiation

 - Unzip the zip file in `app/code/`
 - Enable the module by running `php bin/magento module:enable Mi_Status`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Specifications

 - Controller
	- frontend > mis/customer/status (GET)
		field with customer status
	- frontend > mis/customer/statusPost (POST)
		save status attribute value
	- backend > customer/index/edit (GET / POST)
		Customer Information / Customer Status
		save and retrieve status from admin