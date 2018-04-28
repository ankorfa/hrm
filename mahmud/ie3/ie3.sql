-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2016 at 12:39 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ie3`
--

-- --------------------------------------------------------

--
-- Table structure for table `0_areas`
--

CREATE TABLE IF NOT EXISTS `0_areas` (
  `area_code` int(11) NOT NULL,
  `description` varchar(60) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_areas`
--

INSERT INTO `0_areas` (`area_code`, `description`, `inactive`) VALUES
(1, 'Global', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_attachments`
--

CREATE TABLE IF NOT EXISTS `0_attachments` (
  `id` int(11) unsigned NOT NULL,
  `description` varchar(60) NOT NULL DEFAULT '',
  `type_no` int(11) NOT NULL DEFAULT '0',
  `trans_no` int(11) NOT NULL DEFAULT '0',
  `unique_name` varchar(60) NOT NULL DEFAULT '',
  `tran_date` date NOT NULL DEFAULT '0000-00-00',
  `filename` varchar(60) NOT NULL DEFAULT '',
  `filesize` int(11) NOT NULL DEFAULT '0',
  `filetype` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_audit_trail`
--

CREATE TABLE IF NOT EXISTS `0_audit_trail` (
  `id` int(11) NOT NULL,
  `type` smallint(6) unsigned NOT NULL DEFAULT '0',
  `trans_no` int(11) unsigned NOT NULL DEFAULT '0',
  `user` smallint(6) unsigned NOT NULL DEFAULT '0',
  `stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `description` varchar(60) DEFAULT NULL,
  `fiscal_year` int(11) NOT NULL,
  `gl_date` date NOT NULL DEFAULT '0000-00-00',
  `gl_seq` int(11) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_bank_accounts`
--

CREATE TABLE IF NOT EXISTS `0_bank_accounts` (
  `account_code` varchar(15) NOT NULL DEFAULT '',
  `account_type` smallint(6) NOT NULL DEFAULT '0',
  `bank_account_name` varchar(60) NOT NULL DEFAULT '',
  `bank_account_number` varchar(100) NOT NULL DEFAULT '',
  `bank_name` varchar(60) NOT NULL DEFAULT '',
  `bank_address` tinytext,
  `bank_curr_code` char(3) NOT NULL DEFAULT '',
  `dflt_curr_act` tinyint(1) NOT NULL DEFAULT '0',
  `id` smallint(6) NOT NULL,
  `last_reconciled_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ending_reconcile_balance` double NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_bank_accounts`
--

INSERT INTO `0_bank_accounts` (`account_code`, `account_type`, `bank_account_name`, `bank_account_number`, `bank_name`, `bank_address`, `bank_curr_code`, `dflt_curr_act`, `id`, `last_reconciled_date`, `ending_reconcile_balance`, `inactive`) VALUES
('1060', 0, 'Current account', '9999999999', 'Wachovia Bank', '', 'USD', 1, 1, '0000-00-00 00:00:00', 0, 0),
('1065', 3, 'Petty Cash account', 'N/A', 'N/A', '', 'USD', 0, 2, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_bank_trans`
--

CREATE TABLE IF NOT EXISTS `0_bank_trans` (
  `id` int(11) NOT NULL,
  `type` smallint(6) DEFAULT NULL,
  `trans_no` int(11) DEFAULT NULL,
  `bank_act` varchar(15) NOT NULL DEFAULT '',
  `ref` varchar(40) DEFAULT NULL,
  `trans_date` date NOT NULL DEFAULT '0000-00-00',
  `amount` double DEFAULT NULL,
  `dimension_id` int(11) NOT NULL DEFAULT '0',
  `dimension2_id` int(11) NOT NULL DEFAULT '0',
  `person_type_id` int(11) NOT NULL DEFAULT '0',
  `person_id` tinyblob,
  `reconciled` date DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_bank_trans`
--

INSERT INTO `0_bank_trans` (`id`, `type`, `trans_no`, `bank_act`, `ref`, `trans_date`, `amount`, `dimension_id`, `dimension2_id`, `person_type_id`, `person_id`, `reconciled`) VALUES
(1, 22, 4, '1', '1', '2014-06-21', -3465, 0, 0, 3, 0x32, NULL),
(2, 26, 1, '1', '', '2014-06-21', -10, 0, 0, 1, 0x31, NULL),
(3, 26, 1, '1', '', '2014-06-21', -20, 0, 0, 1, 0x30, NULL),
(4, 0, 18, '1', '1', '2014-02-20', 1000, 0, 0, 0, '', NULL),
(5, 0, 19, '1', '2', '2014-02-21', 4000, 0, 0, 0, '', NULL),
(6, 2, 5, '1', '1', '2014-06-21', 100, 0, 0, 4, 0x33, NULL),
(7, 1, 8, '1', '1', '2014-06-21', -50, 0, 0, 4, 0x31, NULL),
(8, 26, 5, '1', '', '2014-06-21', -10, 0, 0, 1, 0x31, NULL),
(9, 26, 5, '1', '', '2014-06-21', -20, 0, 0, 1, 0x30, NULL),
(10, 26, 7, '1', '', '2014-06-21', -10, 0, 0, 1, 0x31, NULL),
(11, 26, 7, '1', '', '2014-06-21', -20, 0, 0, 1, 0x30, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `0_bom`
--

CREATE TABLE IF NOT EXISTS `0_bom` (
  `id` int(11) NOT NULL,
  `parent` char(20) NOT NULL DEFAULT '',
  `component` char(20) NOT NULL DEFAULT '',
  `workcentre_added` int(11) NOT NULL DEFAULT '0',
  `loc_code` char(5) NOT NULL DEFAULT '',
  `quantity` double NOT NULL DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_bom`
--

INSERT INTO `0_bom` (`id`, `parent`, `component`, `workcentre_added`, `loc_code`, `quantity`) VALUES
(1, '3400', '102', 1, 'DEF', 1),
(2, '3400', '103', 1, 'DEF', 1),
(3, '3400', '104', 1, 'DEF', 1);

-- --------------------------------------------------------

--
-- Table structure for table `0_budget_trans`
--

CREATE TABLE IF NOT EXISTS `0_budget_trans` (
  `counter` int(11) NOT NULL,
  `type` smallint(6) NOT NULL DEFAULT '0',
  `type_no` bigint(16) NOT NULL DEFAULT '1',
  `tran_date` date NOT NULL DEFAULT '0000-00-00',
  `account` varchar(15) NOT NULL DEFAULT '',
  `memo_` tinytext NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `dimension_id` int(11) DEFAULT '0',
  `dimension2_id` int(11) DEFAULT '0',
  `person_type_id` int(11) DEFAULT NULL,
  `person_id` tinyblob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_chart_class`
--

CREATE TABLE IF NOT EXISTS `0_chart_class` (
  `cid` varchar(3) NOT NULL,
  `class_name` varchar(60) NOT NULL DEFAULT '',
  `ctype` tinyint(1) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_chart_class`
--

INSERT INTO `0_chart_class` (`cid`, `class_name`, `ctype`, `inactive`) VALUES
('1', 'Assets', 1, 0),
('2', 'Liabilities', 2, 0),
('3', 'Income', 4, 0),
('4', 'Costs', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_chart_master`
--

CREATE TABLE IF NOT EXISTS `0_chart_master` (
  `account_code` varchar(15) NOT NULL DEFAULT '',
  `account_code2` varchar(15) NOT NULL DEFAULT '',
  `account_name` varchar(60) NOT NULL DEFAULT '',
  `account_type` varchar(10) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_chart_master`
--

INSERT INTO `0_chart_master` (`account_code`, `account_code2`, `account_name`, `account_type`, `inactive`) VALUES
('1060', '', 'Checking Account', '1', 0),
('1065', '', 'Petty Cash', '1', 0),
('1200', '', 'Accounts Receivables', '1', 0),
('1205', '', 'Allowance for doubtful accounts', '1', 0),
('1510', '', 'Inventory', '2', 0),
('1520', '', 'Stocks of Raw Materials', '2', 0),
('1530', '', 'Stocks of Work In Progress', '2', 0),
('1540', '', 'Stocks of Finsihed Goods', '2', 0),
('1550', '', 'Goods Received Clearing account', '2', 0),
('1820', '', 'Office Furniture &amp; Equipment', '3', 0),
('1825', '', 'Accum. Amort. -Furn. &amp; Equip.', '3', 0),
('1840', '', 'Vehicle', '3', 0),
('1845', '', 'Accum. Amort. -Vehicle', '3', 0),
('2100', '', 'Accounts Payable', '4', 0),
('2110', '', 'Accrued Income Tax - Federal', '4', 0),
('2120', '', 'Accrued Income Tax - State', '4', 0),
('2130', '', 'Accrued Franchise Tax', '4', 0),
('2140', '', 'Accrued Real &amp; Personal Prop Tax', '4', 0),
('2150', '', 'Sales Tax', '4', 0),
('2160', '', 'Accrued Use Tax Payable', '4', 0),
('2210', '', 'Accrued Wages', '4', 0),
('2220', '', 'Accrued Comp Time', '4', 0),
('2230', '', 'Accrued Holiday Pay', '4', 0),
('2240', '', 'Accrued Vacation Pay', '4', 0),
('2310', '', 'Accr. Benefits - 401K', '4', 0),
('2320', '', 'Accr. Benefits - Stock Purchase', '4', 0),
('2330', '', 'Accr. Benefits - Med, Den', '4', 0),
('2340', '', 'Accr. Benefits - Payroll Taxes', '4', 0),
('2350', '', 'Accr. Benefits - Credit Union', '4', 0),
('2360', '', 'Accr. Benefits - Savings Bond', '4', 0),
('2370', '', 'Accr. Benefits - Garnish', '4', 0),
('2380', '', 'Accr. Benefits - Charity Cont.', '4', 0),
('2620', '', 'Bank Loans', '5', 0),
('2680', '', 'Loans from Shareholders', '5', 0),
('3350', '', 'Common Shares', '6', 0),
('3590', '', 'Retained Earnings - prior years', '7', 0),
('4010', '', 'Sales', '8', 0),
('4430', '', 'Shipping &amp; Handling', '9', 0),
('4440', '', 'Interest', '9', 0),
('4450', '', 'Foreign Exchange Gain', '9', 0),
('4500', '', 'Prompt Payment Discounts', '9', 0),
('4510', '', 'Discounts Given', '9', 0),
('5010', '', 'Cost of Goods Sold - Retail', '10', 0),
('5020', '', 'Material Usage Varaiance', '10', 0),
('5030', '', 'Consumable Materials', '10', 0),
('5040', '', 'Purchase price Variance', '10', 0),
('5050', '', 'Purchases of materials', '10', 0),
('5060', '', 'Discounts Received', '10', 0),
('5100', '', 'Freight', '10', 0),
('5410', '', 'Wages &amp; Salaries', '11', 0),
('5420', '', 'Wages - Overtime', '11', 0),
('5430', '', 'Benefits - Comp Time', '11', 0),
('5440', '', 'Benefits - Payroll Taxes', '11', 0),
('5450', '', 'Benefits - Workers Comp', '11', 0),
('5460', '', 'Benefits - Pension', '11', 0),
('5470', '', 'Benefits - General Benefits', '11', 0),
('5510', '', 'Inc Tax Exp - Federal', '11', 0),
('5520', '', 'Inc Tax Exp - State', '11', 0),
('5530', '', 'Taxes - Real Estate', '11', 0),
('5540', '', 'Taxes - Personal Property', '11', 0),
('5550', '', 'Taxes - Franchise', '11', 0),
('5560', '', 'Taxes - Foreign Withholding', '11', 0),
('5610', '', 'Accounting &amp; Legal', '12', 0),
('5615', '', 'Advertising &amp; Promotions', '12', 0),
('5620', '', 'Bad Debts', '12', 0),
('5660', '', 'Amortization Expense', '12', 0),
('5685', '', 'Insurance', '12', 0),
('5690', '', 'Interest &amp; Bank Charges', '12', 0),
('5700', '', 'Office Supplies', '12', 0),
('5760', '', 'Rent', '12', 0),
('5765', '', 'Repair &amp; Maintenance', '12', 0),
('5780', '', 'Telephone', '12', 0),
('5785', '', 'Travel &amp; Entertainment', '12', 0),
('5790', '', 'Utilities', '12', 0),
('5795', '', 'Registrations', '12', 0),
('5800', '', 'Licenses', '12', 0),
('5810', '', 'Foreign Exchange Loss', '12', 0),
('9990', '', 'Year Profit/Loss', '12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_chart_types`
--

CREATE TABLE IF NOT EXISTS `0_chart_types` (
  `id` varchar(10) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `class_id` varchar(3) NOT NULL DEFAULT '',
  `parent` varchar(10) NOT NULL DEFAULT '-1',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_chart_types`
--

INSERT INTO `0_chart_types` (`id`, `name`, `class_id`, `parent`, `inactive`) VALUES
('1', 'Current Assets', '1', '', 0),
('2', 'Inventory Assets', '1', '', 0),
('3', 'Capital Assets', '1', '', 0),
('4', 'Current Liabilities', '2', '', 0),
('5', 'Long Term Liabilities', '2', '', 0),
('6', 'Share Capital', '2', '', 0),
('7', 'Retained Earnings', '2', '', 0),
('8', 'Sales Revenue', '3', '', 0),
('9', 'Other Revenue', '3', '', 0),
('10', 'Cost of Goods Sold', '4', '', 0),
('11', 'Payroll Expenses', '4', '', 0),
('12', 'General &amp; Administrative expenses', '4', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_comments`
--

CREATE TABLE IF NOT EXISTS `0_comments` (
  `type` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `date_` date DEFAULT '0000-00-00',
  `memo_` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_credit_status`
--

CREATE TABLE IF NOT EXISTS `0_credit_status` (
  `id` int(11) NOT NULL,
  `reason_description` char(100) NOT NULL DEFAULT '',
  `dissallow_invoices` tinyint(1) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_credit_status`
--

INSERT INTO `0_credit_status` (`id`, `reason_description`, `dissallow_invoices`, `inactive`) VALUES
(1, 'Good History', 0, 0),
(3, 'No more work until payment received', 1, 0),
(4, 'In liquidation', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_crm_categories`
--

CREATE TABLE IF NOT EXISTS `0_crm_categories` (
  `id` int(11) NOT NULL COMMENT 'pure technical key',
  `type` varchar(20) NOT NULL COMMENT 'contact type e.g. customer',
  `action` varchar(20) NOT NULL COMMENT 'detailed usage e.g. department',
  `name` varchar(30) NOT NULL COMMENT 'for category selector',
  `description` tinytext NOT NULL COMMENT 'usage description',
  `system` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'nonzero for core system usage',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_crm_categories`
--

INSERT INTO `0_crm_categories` (`id`, `type`, `action`, `name`, `description`, `system`, `inactive`) VALUES
(1, 'cust_branch', 'general', 'General', 'General contact data for customer branch (overrides company setting)', 1, 0),
(2, 'cust_branch', 'invoice', 'Invoices', 'Invoice posting (overrides company setting)', 1, 0),
(3, 'cust_branch', 'order', 'Orders', 'Order confirmation (overrides company setting)', 1, 0),
(4, 'cust_branch', 'delivery', 'Deliveries', 'Delivery coordination (overrides company setting)', 1, 0),
(5, 'customer', 'general', 'General', 'General contact data for customer', 1, 0),
(6, 'customer', 'order', 'Orders', 'Order confirmation', 1, 0),
(7, 'customer', 'delivery', 'Deliveries', 'Delivery coordination', 1, 0),
(8, 'customer', 'invoice', 'Invoices', 'Invoice posting', 1, 0),
(9, 'supplier', 'general', 'General', 'General contact data for supplier', 1, 0),
(10, 'supplier', 'order', 'Orders', 'Order confirmation', 1, 0),
(11, 'supplier', 'delivery', 'Deliveries', 'Delivery coordination', 1, 0),
(12, 'supplier', 'invoice', 'Invoices', 'Invoice posting', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_crm_contacts`
--

CREATE TABLE IF NOT EXISTS `0_crm_contacts` (
  `id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL DEFAULT '0' COMMENT 'foreign key to crm_contacts',
  `type` varchar(20) NOT NULL COMMENT 'foreign key to crm_categories',
  `action` varchar(20) NOT NULL COMMENT 'foreign key to crm_categories',
  `entity_id` varchar(11) DEFAULT NULL COMMENT 'entity id in related class table'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_crm_contacts`
--

INSERT INTO `0_crm_contacts` (`id`, `person_id`, `type`, `action`, `entity_id`) VALUES
(1, 1, 'customer', 'general', '1'),
(2, 2, 'customer', 'general', '2'),
(3, 3, 'customer', 'general', '3'),
(4, 4, 'cust_branch', 'general', '1'),
(5, 5, 'cust_branch', 'general', '2'),
(6, 6, 'cust_branch', 'general', '3'),
(7, 7, 'supplier', 'general', '1'),
(8, 8, 'supplier', 'general', '2'),
(9, 9, 'supplier', 'general', '3');

-- --------------------------------------------------------

--
-- Table structure for table `0_crm_persons`
--

CREATE TABLE IF NOT EXISTS `0_crm_persons` (
  `id` int(11) NOT NULL,
  `ref` varchar(30) NOT NULL,
  `name` varchar(60) NOT NULL,
  `name2` varchar(60) DEFAULT NULL,
  `address` tinytext,
  `phone` varchar(30) DEFAULT NULL,
  `phone2` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `lang` char(5) DEFAULT NULL,
  `notes` tinytext NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_crm_persons`
--

INSERT INTO `0_crm_persons` (`id`, `ref`, `name`, `name2`, `address`, `phone`, `phone2`, `fax`, `email`, `lang`, `notes`, `inactive`) VALUES
(1, 'Beefeater', '', NULL, NULL, NULL, NULL, NULL, '', '', '', 0),
(2, 'Ghostbusters', '', NULL, NULL, NULL, NULL, NULL, '', NULL, '', 0),
(3, 'Brezan', '', NULL, NULL, NULL, NULL, NULL, '', '', '', 0),
(4, 'Beefeater', 'Main Branch', NULL, '', '', '', '', '', NULL, '', 0),
(5, 'Ghostbusters', 'Main Branch', NULL, 'Address 1\nAddress 2\nAddress 3', '', '', '', '', NULL, '', 0),
(6, 'Brezan', 'Main Branch', NULL, 'Address 1\nAddress 2\nAddress 3', '', '', '', '', NULL, '', 0),
(7, 'Junk Beer', 'Contact', NULL, 'Address 1\nAddress 2\nAddress 3', '+45 55667788', '', '', '', '', '', 0),
(8, 'Lucky Luke', 'Luke', NULL, 'Address 1\nAddress 2\nAddress 3', '(111) 222.333.444', '', '', '', NULL, '', 0),
(9, 'Money Makers', 'Makers', NULL, 'Address 1\nAddress 2\nAddress 3', '+44 444 555 666', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_currencies`
--

CREATE TABLE IF NOT EXISTS `0_currencies` (
  `currency` varchar(60) NOT NULL DEFAULT '',
  `curr_abrev` char(3) NOT NULL DEFAULT '',
  `curr_symbol` varchar(10) NOT NULL DEFAULT '',
  `country` varchar(100) NOT NULL DEFAULT '',
  `hundreds_name` varchar(15) NOT NULL DEFAULT '',
  `auto_update` tinyint(1) NOT NULL DEFAULT '1',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_currencies`
--

INSERT INTO `0_currencies` (`currency`, `curr_abrev`, `curr_symbol`, `country`, `hundreds_name`, `auto_update`, `inactive`) VALUES
('US Dollars', 'USD', '$', 'United States', 'Cents', 1, 0),
('CA Dollars', 'CAD', '$', 'Canada', 'Cents', 1, 0),
('Euro', 'EUR', '?', 'Europe', 'Cents', 1, 0),
('Pounds', 'GBP', '?', 'England', 'Pence', 1, 0),
('DK Kroner', 'DKK', 'kr', 'Denmark', 'Ore', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_cust_allocations`
--

CREATE TABLE IF NOT EXISTS `0_cust_allocations` (
  `id` int(11) NOT NULL,
  `amt` double unsigned DEFAULT NULL,
  `date_alloc` date NOT NULL DEFAULT '0000-00-00',
  `trans_no_from` int(11) DEFAULT NULL,
  `trans_type_from` int(11) DEFAULT NULL,
  `trans_no_to` int(11) DEFAULT NULL,
  `trans_type_to` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_cust_allocations`
--

INSERT INTO `0_cust_allocations` (`id`, `amt`, `date_alloc`, `trans_no_from`, `trans_type_from`, `trans_no_to`, `trans_type_to`) VALUES
(1, 37.68, '2014-06-21', 3, 11, 18, 10);

-- --------------------------------------------------------

--
-- Table structure for table `0_cust_branch`
--

CREATE TABLE IF NOT EXISTS `0_cust_branch` (
  `branch_code` int(11) NOT NULL,
  `debtor_no` int(11) NOT NULL DEFAULT '0',
  `br_name` varchar(60) NOT NULL DEFAULT '',
  `branch_ref` varchar(30) NOT NULL DEFAULT '',
  `br_address` tinytext NOT NULL,
  `area` int(11) DEFAULT NULL,
  `salesman` int(11) NOT NULL DEFAULT '0',
  `contact_name` varchar(60) NOT NULL DEFAULT '',
  `default_location` varchar(5) NOT NULL DEFAULT '',
  `tax_group_id` int(11) DEFAULT NULL,
  `sales_account` varchar(15) NOT NULL DEFAULT '',
  `sales_discount_account` varchar(15) NOT NULL DEFAULT '',
  `receivables_account` varchar(15) NOT NULL DEFAULT '',
  `payment_discount_account` varchar(15) NOT NULL DEFAULT '',
  `default_ship_via` int(11) NOT NULL DEFAULT '1',
  `disable_trans` tinyint(4) NOT NULL DEFAULT '0',
  `br_post_address` tinytext NOT NULL,
  `group_no` int(11) NOT NULL DEFAULT '0',
  `notes` tinytext NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_cust_branch`
--

INSERT INTO `0_cust_branch` (`branch_code`, `debtor_no`, `br_name`, `branch_ref`, `br_address`, `area`, `salesman`, `contact_name`, `default_location`, `tax_group_id`, `sales_account`, `sales_discount_account`, `receivables_account`, `payment_discount_account`, `default_ship_via`, `disable_trans`, `br_post_address`, `group_no`, `notes`, `inactive`) VALUES
(1, 1, 'Beefeater Ltd.', 'Beefeater', '', 1, 1, 'Main Branch', 'DEF', 2, '', '4510', '1200', '4500', 1, 0, 'Address 1\nAddress 2\nAddress 3', 0, '', 0),
(2, 2, 'Ghostbusters Corp.', 'Ghostbusters', 'Address 1\nAddress 2\nAddress 3', 1, 1, 'Main Branch', 'DEF', 1, '', '4510', '1200', '4500', 1, 0, 'Address 1\nAddress 2\nAddress 3', 0, '', 0),
(3, 3, 'Brezan', 'Brezan', 'Address 1\nAddress 2\nAddress 3', 1, 1, 'Main Branch', 'DEF', 1, '', '4510', '1200', '4500', 1, 0, 'Address 1\nAddress 2\nAddress 3', 0, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_debtors_master`
--

CREATE TABLE IF NOT EXISTS `0_debtors_master` (
  `debtor_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `debtor_ref` varchar(30) NOT NULL,
  `address` tinytext,
  `tax_id` varchar(55) NOT NULL DEFAULT '',
  `curr_code` char(3) NOT NULL DEFAULT '',
  `sales_type` int(11) NOT NULL DEFAULT '1',
  `dimension_id` int(11) NOT NULL DEFAULT '0',
  `dimension2_id` int(11) NOT NULL DEFAULT '0',
  `credit_status` int(11) NOT NULL DEFAULT '0',
  `payment_terms` int(11) DEFAULT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `pymt_discount` double NOT NULL DEFAULT '0',
  `credit_limit` float NOT NULL DEFAULT '1000',
  `notes` tinytext NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_debtors_master`
--

INSERT INTO `0_debtors_master` (`debtor_no`, `name`, `debtor_ref`, `address`, `tax_id`, `curr_code`, `sales_type`, `dimension_id`, `dimension2_id`, `credit_status`, `payment_terms`, `discount`, `pymt_discount`, `credit_limit`, `notes`, `inactive`) VALUES
(1, 'Beefeater Ltd.', 'Beefeater', 'Addr 1\nAddr 2\nAddr 3', '345678', 'GBP', 2, 0, 0, 1, 3, 0, 0, 1000, '', 0),
(2, 'Ghostbusters Corp.', 'Ghostbusters', 'Address 1\nAddress 2\nAddress 3', '2222222', 'USD', 1, 0, 0, 1, 4, 0, 0, 1000, '', 0),
(3, 'Brezan', 'Brezan', 'Address 1\nAddress 2\nAddress 3', '7777777', 'EUR', 2, 0, 0, 1, 3, 0, 0, 1000, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_debtor_trans`
--

CREATE TABLE IF NOT EXISTS `0_debtor_trans` (
  `trans_no` int(11) unsigned NOT NULL DEFAULT '0',
  `type` smallint(6) unsigned NOT NULL DEFAULT '0',
  `version` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `debtor_no` int(11) unsigned DEFAULT NULL,
  `branch_code` int(11) NOT NULL DEFAULT '-1',
  `tran_date` date NOT NULL DEFAULT '0000-00-00',
  `due_date` date NOT NULL DEFAULT '0000-00-00',
  `reference` varchar(60) NOT NULL DEFAULT '',
  `tpe` int(11) NOT NULL DEFAULT '0',
  `order_` int(11) NOT NULL DEFAULT '0',
  `ov_amount` double NOT NULL DEFAULT '0',
  `ov_gst` double NOT NULL DEFAULT '0',
  `ov_freight` double NOT NULL DEFAULT '0',
  `ov_freight_tax` double NOT NULL DEFAULT '0',
  `ov_discount` double NOT NULL DEFAULT '0',
  `alloc` double NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '1',
  `ship_via` int(11) DEFAULT NULL,
  `dimension_id` int(11) NOT NULL DEFAULT '0',
  `dimension2_id` int(11) NOT NULL DEFAULT '0',
  `payment_terms` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_debtor_trans`
--

INSERT INTO `0_debtor_trans` (`trans_no`, `type`, `version`, `debtor_no`, `branch_code`, `tran_date`, `due_date`, `reference`, `tpe`, `order_`, `ov_amount`, `ov_gst`, `ov_freight`, `ov_freight_tax`, `ov_discount`, `alloc`, `rate`, `ship_via`, `dimension_id`, `dimension2_id`, `payment_terms`) VALUES
(17, 10, 0, 2, 2, '2014-06-21', '2014-06-22', '1', 1, 2, 50, 2.5, 0, 0, 0, 0, 1, 1, 0, 0, 4),
(18, 10, 1, 3, 3, '2014-06-21', '2014-07-01', '2', 2, 3, 35.89, 1.79, 0, 0, 0, 37.68, 1.3932, 1, 2, 0, 3),
(19, 10, 0, 2, 2, '2014-06-21', '2014-06-22', '3', 1, 5, 50, 0, 5, 0, 0, 0, 1, 1, 0, 0, 4),
(3, 11, 0, 3, 3, '2014-06-21', '0000-00-00', '1', 2, 3, 35.89, 1.79, 0, 0, 0, 37.68, 1.3932, 1, 2, 0, 3),
(2, 13, 0, 1, 1, '2014-06-21', '2014-06-22', '1', 2, 1, 60.8, 0, 10, 0, 0, 0, 1.6445729799917, 1, 0, 0, 3),
(3, 13, 1, 2, 2, '2014-06-21', '2014-06-22', 'auto', 1, 2, 50, 2.5, 0, 0, 0, 0, 1, 1, 0, 0, 4),
(4, 13, 1, 3, 3, '2014-06-21', '2014-07-01', 'auto', 2, 3, 35.89, 1.79, 0, 0, 0, 0, 1.3932, 1, 2, 0, 3),
(5, 13, 1, 2, 2, '2014-06-21', '2014-06-22', 'auto', 1, 5, 50, 0, 5, 0, 0, 0, 1, 1, 0, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `0_debtor_trans_details`
--

CREATE TABLE IF NOT EXISTS `0_debtor_trans_details` (
  `id` int(11) NOT NULL,
  `debtor_trans_no` int(11) DEFAULT NULL,
  `debtor_trans_type` int(11) DEFAULT NULL,
  `stock_id` varchar(20) NOT NULL DEFAULT '',
  `description` tinytext,
  `unit_price` double NOT NULL DEFAULT '0',
  `unit_tax` double NOT NULL DEFAULT '0',
  `quantity` double NOT NULL DEFAULT '0',
  `discount_percent` double NOT NULL DEFAULT '0',
  `standard_cost` double NOT NULL DEFAULT '0',
  `qty_done` double NOT NULL DEFAULT '0',
  `src_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_debtor_trans_details`
--

INSERT INTO `0_debtor_trans_details` (`id`, `debtor_trans_no`, `debtor_trans_type`, `stock_id`, `description`, `unit_price`, `unit_tax`, `quantity`, `discount_percent`, `standard_cost`, `qty_done`, `src_id`) VALUES
(1, 2, 13, '102', '17inch VGA Monitor', 30.4, 0, 2, 0, 10, 0, 1),
(2, 3, 13, '102', '17inch VGA Monitor', 50, 2.5, 1, 0, 10, 1, 2),
(3, 17, 10, '102', '17inch VGA Monitor', 50, 2.5, 1, 0, 10, 2, 2),
(4, 4, 13, '102', '17inch VGA Monitor', 35.89, 1.79, 1, 0, 10, 1, 3),
(5, 18, 10, '102', '17inch VGA Monitor', 35.89, 1.79, 1, 0, 10, 1, 4),
(6, 5, 13, '102', '17inch VGA Monitor', 50, 2.38, 1, 0, 10, 1, 5),
(7, 19, 10, '102', '17inch VGA Monitor', 50, 2.38, 1, 0, 10, 0, 6),
(8, 3, 11, '102', '17inch VGA Monitor', 35.89, 1.79, 1, 0, 10, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `0_dimensions`
--

CREATE TABLE IF NOT EXISTS `0_dimensions` (
  `id` int(11) NOT NULL,
  `reference` varchar(60) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `type_` tinyint(1) NOT NULL DEFAULT '1',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `date_` date NOT NULL DEFAULT '0000-00-00',
  `due_date` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_dimensions`
--

INSERT INTO `0_dimensions` (`id`, `reference`, `name`, `type_`, `closed`, `date_`, `due_date`) VALUES
(1, '1', 'Support', 1, 0, '2014-06-21', '2020-07-11'),
(2, '2', 'Development', 1, 0, '2014-06-21', '2020-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `0_exchange_rates`
--

CREATE TABLE IF NOT EXISTS `0_exchange_rates` (
  `id` int(11) NOT NULL,
  `curr_code` char(3) NOT NULL DEFAULT '',
  `rate_buy` double NOT NULL DEFAULT '0',
  `rate_sell` double NOT NULL DEFAULT '0',
  `date_` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_exchange_rates`
--

INSERT INTO `0_exchange_rates` (`id`, `curr_code`, `rate_buy`, `rate_sell`, `date_`) VALUES
(1, 'DKK', 0.18717252868313, 0.18717252868313, '2014-06-21'),
(2, 'GBP', 1.6445729799917, 1.6445729799917, '2014-06-21'),
(3, 'EUR', 1.3932, 1.3932, '2014-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `0_fiscal_year`
--

CREATE TABLE IF NOT EXISTS `0_fiscal_year` (
  `id` int(11) NOT NULL,
  `begin` date DEFAULT '0000-00-00',
  `end` date DEFAULT '0000-00-00',
  `closed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_fiscal_year`
--

INSERT INTO `0_fiscal_year` (`id`, `begin`, `end`, `closed`) VALUES
(1, '2013-01-01', '2013-12-31', 0),
(2, '2014-01-01', '2014-12-31', 0),
(3, '2015-01-01', '2015-12-31', 0),
(4, '2016-01-01', '2016-12-31', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_gl_trans`
--

CREATE TABLE IF NOT EXISTS `0_gl_trans` (
  `counter` int(11) NOT NULL,
  `type` smallint(6) NOT NULL DEFAULT '0',
  `type_no` bigint(16) NOT NULL DEFAULT '1',
  `tran_date` date NOT NULL DEFAULT '0000-00-00',
  `account` varchar(15) NOT NULL DEFAULT '',
  `memo_` tinytext NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `dimension_id` int(11) NOT NULL DEFAULT '0',
  `dimension2_id` int(11) NOT NULL DEFAULT '0',
  `person_type_id` int(11) DEFAULT NULL,
  `person_id` tinyblob
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_gl_trans`
--

INSERT INTO `0_gl_trans` (`counter`, `type`, `type_no`, `tran_date`, `account`, `memo_`, `amount`, `dimension_id`, `dimension2_id`, `person_type_id`, `person_id`) VALUES
(1, 20, 7, '2014-06-21', '2100', '', -3465, 0, 0, 3, 0x32),
(2, 20, 7, '2014-06-21', '1510', '', 1000, 0, 0, 3, 0x32),
(3, 20, 7, '2014-06-21', '1510', '', 1100, 0, 0, 3, 0x32),
(4, 20, 7, '2014-06-21', '1510', '', 1200, 0, 0, 3, 0x32),
(5, 20, 7, '2014-06-21', '2150', '', 165, 0, 0, 3, 0x32),
(6, 22, 4, '2014-06-21', '2100', '', 3465, 0, 0, 3, 0x32),
(7, 22, 4, '2014-06-21', '1060', '', -3465, 0, 0, 3, 0x32),
(8, 26, 1, '2014-06-21', '1510', '', -100, 0, 0, NULL, ''),
(9, 26, 1, '2014-06-21', '1510', '', -110, 0, 0, NULL, ''),
(10, 26, 1, '2014-06-21', '1510', '', -120, 0, 0, NULL, ''),
(11, 26, 1, '2014-06-21', '1060', 'Overhead Cost', -10, 0, 0, 1, 0x31),
(12, 26, 1, '2014-06-21', '1530', 'Overhead Cost', 10, 0, 0, 1, 0x31),
(13, 26, 1, '2014-06-21', '1060', 'Labour Cost', -20, 0, 0, 1, 0x30),
(14, 26, 1, '2014-06-21', '1530', 'Labour Cost', 20, 0, 0, 1, 0x30),
(15, 26, 1, '2014-06-21', '1510', '', 330, 0, 0, NULL, ''),
(16, 13, 2, '2014-06-21', '5010', '', 20, 0, 0, 2, 0x31),
(17, 13, 2, '2014-06-21', '1510', '', -20, 0, 0, 2, 0x31),
(18, 13, 3, '2014-06-21', '5010', '', 10, 0, 0, 2, 0x32),
(19, 13, 3, '2014-06-21', '1510', '', -10, 0, 0, 2, 0x32),
(20, 10, 17, '2014-06-21', '4010', '', -50, 0, 0, 2, 0x32),
(21, 10, 17, '2014-06-21', '1200', '', 52.5, 0, 0, 2, 0x32),
(22, 10, 17, '2014-06-21', '2150', '', -2.5, 0, 0, 2, 0x32),
(23, 13, 4, '2014-06-21', '5010', '', 10, 2, 0, 2, 0x33),
(24, 13, 4, '2014-06-21', '1510', '', -10, 0, 0, 2, 0x33),
(25, 10, 18, '2014-06-21', '4010', '', -50, 2, 0, 2, 0x33),
(26, 10, 18, '2014-06-21', '1200', '', 52.5, 0, 0, 2, 0x33),
(27, 10, 18, '2014-06-21', '2150', '', -2.5, 0, 0, 2, 0x33),
(28, 0, 18, '2014-02-20', '1060', '', 1000, 0, 0, NULL, ''),
(29, 0, 18, '2014-02-20', '3350', '', -1000, 0, 0, NULL, ''),
(30, 0, 19, '2014-02-21', '1060', '', 4000, 0, 0, NULL, ''),
(31, 0, 19, '2014-02-21', '3350', '', -4000, 0, 0, NULL, ''),
(32, 26, 3, '2014-06-21', '1510', '', -20, 0, 0, NULL, ''),
(33, 26, 3, '2014-06-21', '1510', '', -22, 0, 0, NULL, ''),
(34, 26, 3, '2014-06-21', '1510', '', -24, 0, 0, NULL, ''),
(35, 26, 3, '2014-06-21', '1540', '', 66, 0, 0, NULL, ''),
(36, 2, 5, '2014-06-21', '2150', 'Cash Sales', -4.76, 0, 0, 4, 0x33),
(37, 2, 5, '2014-06-21', '4010', 'Cash Sales', -95.24, 0, 0, 4, 0x33),
(38, 2, 5, '2014-06-21', '1060', '', 100, 0, 0, 4, 0x33),
(39, 1, 8, '2014-06-21', '2150', 'Maintenance', 2.38, 0, 0, 4, 0x31),
(40, 1, 8, '2014-06-21', '5765', 'Maintenance', 47.62, 0, 0, 4, 0x31),
(41, 1, 8, '2014-06-21', '1060', '', -50, 0, 0, 4, 0x31),
(42, 20, 8, '2014-06-21', '2100', '', -20, 0, 0, 3, 0x32),
(43, 20, 8, '2014-06-21', '2150', '', 0.95, 0, 0, 3, 0x32),
(44, 20, 8, '2014-06-21', '5780', '', 19.05, 0, 0, 3, 0x32),
(45, 26, 4, '2014-06-21', '1510', '', -40, 0, 0, NULL, ''),
(46, 26, 4, '2014-06-21', '1510', '', -44, 0, 0, NULL, ''),
(47, 26, 4, '2014-06-21', '1510', '', -48, 0, 0, NULL, ''),
(48, 26, 4, '2014-06-21', '1540', '', 132, 0, 0, NULL, ''),
(49, 26, 2, '2014-06-21', '1510', '', -20, 0, 0, NULL, ''),
(50, 26, 2, '2014-06-21', '1510', '', -22, 0, 0, NULL, ''),
(51, 26, 2, '2014-06-21', '1510', '', -24, 0, 0, NULL, ''),
(52, 26, 2, '2014-06-21', '1540', '', 66, 0, 0, NULL, ''),
(53, 26, 5, '2014-06-21', '1510', '', -50, 0, 0, NULL, ''),
(54, 26, 5, '2014-06-21', '1510', '', -55, 0, 0, NULL, ''),
(55, 26, 5, '2014-06-21', '1510', '', -60, 0, 0, NULL, ''),
(56, 26, 5, '2014-06-21', '1060', 'Overhead Cost', -10, 0, 0, 1, 0x31),
(57, 26, 5, '2014-06-21', '1530', 'Overhead Cost', 10, 0, 0, 1, 0x31),
(58, 26, 5, '2014-06-21', '1060', 'Labour Cost', -20, 0, 0, 1, 0x30),
(59, 26, 5, '2014-06-21', '1530', 'Labour Cost', 20, 0, 0, 1, 0x30),
(60, 26, 5, '2014-06-21', '1540', '', 165, 0, 0, NULL, ''),
(61, 26, 6, '2014-06-21', '1510', '', 50, 0, 0, NULL, ''),
(62, 26, 6, '2014-06-21', '1510', '', 55, 0, 0, NULL, ''),
(63, 26, 6, '2014-06-21', '1510', '', 60, 0, 0, NULL, ''),
(64, 26, 6, '2014-06-21', '1540', '', -165, 0, 0, NULL, ''),
(65, 26, 7, '2014-06-21', '1510', '', 20, 0, 0, NULL, ''),
(66, 26, 7, '2014-06-21', '1510', '', 22, 0, 0, NULL, ''),
(67, 26, 7, '2014-06-21', '1510', '', 24, 0, 0, NULL, ''),
(68, 26, 7, '2014-06-21', '1060', 'Overhead Cost', -10, 0, 0, 1, 0x31),
(69, 26, 7, '2014-06-21', '1530', 'Overhead Cost', 10, 0, 0, 1, 0x31),
(70, 26, 7, '2014-06-21', '1060', 'Labour Cost', -20, 0, 0, 1, 0x30),
(71, 26, 7, '2014-06-21', '1530', 'Labour Cost', 20, 0, 0, 1, 0x30),
(72, 26, 7, '2014-06-21', '1540', '', -66, 0, 0, NULL, ''),
(73, 13, 5, '2014-06-21', '5010', '', 10, 0, 0, 2, 0x32),
(74, 13, 5, '2014-06-21', '1510', '', -10, 0, 0, 2, 0x32),
(75, 10, 19, '2014-06-21', '4010', '', -47.62, 0, 0, 2, 0x32),
(76, 10, 19, '2014-06-21', '1200', '', 55, 0, 0, 2, 0x32),
(77, 10, 19, '2014-06-21', '4430', '', -5, 0, 0, 2, 0x32),
(78, 10, 19, '2014-06-21', '2150', '', -2.38, 0, 0, 2, 0x32),
(79, 11, 3, '2014-06-21', '5010', '', -10, 2, 0, 2, 0x33),
(80, 11, 3, '2014-06-21', '1510', '', 10, 0, 0, 2, 0x33),
(81, 11, 3, '2014-06-21', '4010', '', 50, 2, 0, 2, 0x33),
(82, 11, 3, '2014-06-21', '1200', '', -52.5, 0, 0, 2, 0x33),
(83, 11, 3, '2014-06-21', '2150', '', 2.5, 0, 0, 2, 0x33);

-- --------------------------------------------------------

--
-- Table structure for table `0_grn_batch`
--

CREATE TABLE IF NOT EXISTS `0_grn_batch` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `purch_order_no` int(11) DEFAULT NULL,
  `reference` varchar(60) NOT NULL DEFAULT '',
  `delivery_date` date NOT NULL DEFAULT '0000-00-00',
  `loc_code` varchar(5) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_grn_batch`
--

INSERT INTO `0_grn_batch` (`id`, `supplier_id`, `purch_order_no`, `reference`, `delivery_date`, `loc_code`) VALUES
(1, 2, 1, '1', '2014-06-21', 'DEF');

-- --------------------------------------------------------

--
-- Table structure for table `0_grn_items`
--

CREATE TABLE IF NOT EXISTS `0_grn_items` (
  `id` int(11) NOT NULL,
  `grn_batch_id` int(11) DEFAULT NULL,
  `po_detail_item` int(11) NOT NULL DEFAULT '0',
  `item_code` varchar(20) NOT NULL DEFAULT '',
  `description` tinytext,
  `qty_recd` double NOT NULL DEFAULT '0',
  `quantity_inv` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_grn_items`
--

INSERT INTO `0_grn_items` (`id`, `grn_batch_id`, `po_detail_item`, `item_code`, `description`, `qty_recd`, `quantity_inv`) VALUES
(1, 1, 1, '102', '17inch VGA Monitor', 100, 100),
(2, 1, 2, '103', '32MB VGA Card', 100, 100),
(3, 1, 3, '104', '52x CD Drive', 100, 100);

-- --------------------------------------------------------

--
-- Table structure for table `0_groups`
--

CREATE TABLE IF NOT EXISTS `0_groups` (
  `id` smallint(6) unsigned NOT NULL,
  `description` varchar(60) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_groups`
--

INSERT INTO `0_groups` (`id`, `description`, `inactive`) VALUES
(1, 'Small', 0),
(2, 'Medium', 0),
(3, 'Large', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_item_codes`
--

CREATE TABLE IF NOT EXISTS `0_item_codes` (
  `id` int(11) unsigned NOT NULL,
  `item_code` varchar(20) NOT NULL,
  `stock_id` varchar(20) NOT NULL,
  `description` varchar(200) NOT NULL DEFAULT '',
  `category_id` smallint(6) unsigned NOT NULL,
  `quantity` double NOT NULL DEFAULT '1',
  `is_foreign` tinyint(1) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_item_codes`
--

INSERT INTO `0_item_codes` (`id`, `item_code`, `stock_id`, `description`, `category_id`, `quantity`, `is_foreign`, `inactive`) VALUES
(1, '102', '102', '17inch VGA Monitor', 1, 1, 0, 0),
(2, '103', '103', '32MB VGA Card', 1, 1, 0, 0),
(3, '104', '104', '52x CD Drive', 1, 1, 0, 0),
(4, '3400', '3400', 'P4 Business System', 3, 1, 0, 0),
(5, '201', '201', 'Assembly Labour', 4, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_item_tax_types`
--

CREATE TABLE IF NOT EXISTS `0_item_tax_types` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `exempt` tinyint(1) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_item_tax_types`
--

INSERT INTO `0_item_tax_types` (`id`, `name`, `exempt`, `inactive`) VALUES
(1, 'Regular', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_item_tax_type_exemptions`
--

CREATE TABLE IF NOT EXISTS `0_item_tax_type_exemptions` (
  `item_tax_type_id` int(11) NOT NULL DEFAULT '0',
  `tax_type_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_item_units`
--

CREATE TABLE IF NOT EXISTS `0_item_units` (
  `abbr` varchar(20) NOT NULL,
  `name` varchar(40) NOT NULL,
  `decimals` tinyint(2) NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_item_units`
--

INSERT INTO `0_item_units` (`abbr`, `name`, `decimals`, `inactive`) VALUES
('each', 'Each', 0, 0),
('hr', 'Hours', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_locations`
--

CREATE TABLE IF NOT EXISTS `0_locations` (
  `loc_code` varchar(5) NOT NULL DEFAULT '',
  `location_name` varchar(60) NOT NULL DEFAULT '',
  `delivery_address` tinytext NOT NULL,
  `phone` varchar(30) NOT NULL DEFAULT '',
  `phone2` varchar(30) NOT NULL DEFAULT '',
  `fax` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `contact` varchar(30) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_locations`
--

INSERT INTO `0_locations` (`loc_code`, `location_name`, `delivery_address`, `phone`, `phone2`, `fax`, `email`, `contact`, `inactive`) VALUES
('DEF', 'Default', 'Delivery 1\nDelivery 2\nDelivery 3', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_loc_stock`
--

CREATE TABLE IF NOT EXISTS `0_loc_stock` (
  `loc_code` char(5) NOT NULL DEFAULT '',
  `stock_id` char(20) NOT NULL DEFAULT '',
  `reorder_level` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_loc_stock`
--

INSERT INTO `0_loc_stock` (`loc_code`, `stock_id`, `reorder_level`) VALUES
('DEF', '102', 0),
('DEF', '103', 0),
('DEF', '104', 0),
('DEF', '201', 0),
('DEF', '3400', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_movement_types`
--

CREATE TABLE IF NOT EXISTS `0_movement_types` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_movement_types`
--

INSERT INTO `0_movement_types` (`id`, `name`, `inactive`) VALUES
(1, 'Adjustment', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_payment_terms`
--

CREATE TABLE IF NOT EXISTS `0_payment_terms` (
  `terms_indicator` int(11) NOT NULL,
  `terms` char(80) NOT NULL DEFAULT '',
  `days_before_due` smallint(6) NOT NULL DEFAULT '0',
  `day_in_following_month` smallint(6) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_payment_terms`
--

INSERT INTO `0_payment_terms` (`terms_indicator`, `terms`, `days_before_due`, `day_in_following_month`, `inactive`) VALUES
(1, 'Due 15th Of the Following Month', 0, 17, 0),
(2, 'Due By End Of The Following Month', 0, 30, 0),
(3, 'Payment due within 10 days', 10, 0, 0),
(4, 'Cash Only', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_prices`
--

CREATE TABLE IF NOT EXISTS `0_prices` (
  `id` int(11) NOT NULL,
  `stock_id` varchar(20) NOT NULL DEFAULT '',
  `sales_type_id` int(11) NOT NULL DEFAULT '0',
  `curr_abrev` char(3) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_prices`
--

INSERT INTO `0_prices` (`id`, `stock_id`, `sales_type_id`, `curr_abrev`, `price`) VALUES
(1, '3400', 1, 'USD', 100),
(2, '102', 1, 'USD', 50),
(3, '103', 1, 'USD', 55),
(4, '104', 1, 'USD', 60);

-- --------------------------------------------------------

--
-- Table structure for table `0_printers`
--

CREATE TABLE IF NOT EXISTS `0_printers` (
  `id` tinyint(3) unsigned NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(60) NOT NULL,
  `queue` varchar(20) NOT NULL,
  `host` varchar(40) NOT NULL,
  `port` smallint(11) unsigned NOT NULL,
  `timeout` tinyint(3) unsigned NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_printers`
--

INSERT INTO `0_printers` (`id`, `name`, `description`, `queue`, `host`, `port`, `timeout`) VALUES
(1, 'QL500', 'Label printer', 'QL500', 'server', 127, 20),
(2, 'Samsung', 'Main network printer', 'scx4521F', 'server', 515, 5),
(3, 'Local', 'Local print server at user IP', 'lp', '', 515, 10);

-- --------------------------------------------------------

--
-- Table structure for table `0_print_profiles`
--

CREATE TABLE IF NOT EXISTS `0_print_profiles` (
  `id` smallint(6) unsigned NOT NULL,
  `profile` varchar(30) NOT NULL,
  `report` varchar(5) DEFAULT NULL,
  `printer` tinyint(3) unsigned DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_print_profiles`
--

INSERT INTO `0_print_profiles` (`id`, `profile`, `report`, `printer`) VALUES
(1, 'Out of office', '', 0),
(2, 'Sales Department', '', 0),
(3, 'Central', '', 2),
(4, 'Sales Department', '104', 2),
(5, 'Sales Department', '105', 2),
(6, 'Sales Department', '107', 2),
(7, 'Sales Department', '109', 2),
(8, 'Sales Department', '110', 2),
(9, 'Sales Department', '201', 2);

-- --------------------------------------------------------

--
-- Table structure for table `0_purch_data`
--

CREATE TABLE IF NOT EXISTS `0_purch_data` (
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `stock_id` char(20) NOT NULL DEFAULT '',
  `price` double NOT NULL DEFAULT '0',
  `suppliers_uom` char(50) NOT NULL DEFAULT '',
  `conversion_factor` double NOT NULL DEFAULT '1',
  `supplier_description` char(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_purch_data`
--

INSERT INTO `0_purch_data` (`supplier_id`, `stock_id`, `price`, `suppliers_uom`, `conversion_factor`, `supplier_description`) VALUES
(2, '102', 10, '', 1, '17inch VGA Monitor'),
(2, '103', 11, '', 1, '32MB VGA Card'),
(2, '104', 12, '', 1, '52x CD Drive');

-- --------------------------------------------------------

--
-- Table structure for table `0_purch_orders`
--

CREATE TABLE IF NOT EXISTS `0_purch_orders` (
  `order_no` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL DEFAULT '0',
  `comments` tinytext,
  `ord_date` date NOT NULL DEFAULT '0000-00-00',
  `reference` tinytext NOT NULL,
  `requisition_no` tinytext,
  `into_stock_location` varchar(5) NOT NULL DEFAULT '',
  `delivery_address` tinytext NOT NULL,
  `total` double NOT NULL DEFAULT '0',
  `tax_included` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_purch_orders`
--

INSERT INTO `0_purch_orders` (`order_no`, `supplier_id`, `comments`, `ord_date`, `reference`, `requisition_no`, `into_stock_location`, `delivery_address`, `total`, `tax_included`) VALUES
(1, 2, '', '2014-06-01', '1', '', 'DEF', 'Delivery 1\nDelivery 2\nDelivery 3', 0, 0),
(2, 3, '', '2014-06-21', '2', '', 'DEF', 'Delivery 1\nDelivery 2\nDelivery 3', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_purch_order_details`
--

CREATE TABLE IF NOT EXISTS `0_purch_order_details` (
  `po_detail_item` int(11) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '0',
  `item_code` varchar(20) NOT NULL DEFAULT '',
  `description` tinytext,
  `delivery_date` date NOT NULL DEFAULT '0000-00-00',
  `qty_invoiced` double NOT NULL DEFAULT '0',
  `unit_price` double NOT NULL DEFAULT '0',
  `act_price` double NOT NULL DEFAULT '0',
  `std_cost_unit` double NOT NULL DEFAULT '0',
  `quantity_ordered` double NOT NULL DEFAULT '0',
  `quantity_received` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_purch_order_details`
--

INSERT INTO `0_purch_order_details` (`po_detail_item`, `order_no`, `item_code`, `description`, `delivery_date`, `qty_invoiced`, `unit_price`, `act_price`, `std_cost_unit`, `quantity_ordered`, `quantity_received`) VALUES
(1, 1, '102', '17inch VGA Monitor', '2014-07-01', 100, 10, 10, 10, 100, 100),
(2, 1, '103', '32MB VGA Card', '2014-07-01', 100, 11, 11, 11, 100, 100),
(3, 1, '104', '52x CD Drive', '2014-07-01', 100, 12, 12, 12, 100, 100),
(4, 2, '102', '17inch VGA Monitor', '2014-07-01', 0, 5, 0, 0, 1, 0),
(5, 2, '103', '32MB VGA Card', '2014-07-01', 0, 5, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_quick_entries`
--

CREATE TABLE IF NOT EXISTS `0_quick_entries` (
  `id` smallint(6) unsigned NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `description` varchar(60) NOT NULL,
  `base_amount` double NOT NULL DEFAULT '0',
  `base_desc` varchar(60) DEFAULT NULL,
  `bal_type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_quick_entries`
--

INSERT INTO `0_quick_entries` (`id`, `type`, `description`, `base_amount`, `base_desc`, `bal_type`) VALUES
(1, 1, 'Maintenance', 0, 'Amount', 0),
(2, 4, 'Phone', 0, 'Amount', 0),
(3, 2, 'Cash Sales', 0, 'Amount', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_quick_entry_lines`
--

CREATE TABLE IF NOT EXISTS `0_quick_entry_lines` (
  `id` smallint(6) unsigned NOT NULL,
  `qid` smallint(6) unsigned NOT NULL,
  `amount` double DEFAULT '0',
  `action` varchar(2) NOT NULL,
  `dest_id` varchar(15) NOT NULL DEFAULT '',
  `dimension_id` smallint(6) unsigned DEFAULT NULL,
  `dimension2_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_quick_entry_lines`
--

INSERT INTO `0_quick_entry_lines` (`id`, `qid`, `amount`, `action`, `dest_id`, `dimension_id`, `dimension2_id`) VALUES
(1, 1, 0, 't-', '1', 0, 0),
(2, 2, 0, 't-', '1', 0, 0),
(3, 3, 0, 't-', '1', 0, 0),
(4, 3, 0, '=', '4010', 0, 0),
(5, 1, 0, '=', '5765', 0, 0),
(6, 2, 0, '=', '5780', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_recurrent_invoices`
--

CREATE TABLE IF NOT EXISTS `0_recurrent_invoices` (
  `id` smallint(6) unsigned NOT NULL,
  `description` varchar(60) NOT NULL DEFAULT '',
  `order_no` int(11) unsigned NOT NULL,
  `debtor_no` int(11) unsigned DEFAULT NULL,
  `group_no` smallint(6) unsigned DEFAULT NULL,
  `days` int(11) NOT NULL DEFAULT '0',
  `monthly` int(11) NOT NULL DEFAULT '0',
  `begin` date NOT NULL DEFAULT '0000-00-00',
  `end` date NOT NULL DEFAULT '0000-00-00',
  `last_sent` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_refs`
--

CREATE TABLE IF NOT EXISTS `0_refs` (
  `id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `reference` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_refs`
--

INSERT INTO `0_refs` (`id`, `type`, `reference`) VALUES
(18, 0, '1'),
(19, 0, '2');

-- --------------------------------------------------------

--
-- Table structure for table `0_salesman`
--

CREATE TABLE IF NOT EXISTS `0_salesman` (
  `salesman_code` int(11) NOT NULL,
  `salesman_name` char(60) NOT NULL DEFAULT '',
  `salesman_phone` char(30) NOT NULL DEFAULT '',
  `salesman_fax` char(30) NOT NULL DEFAULT '',
  `salesman_email` varchar(100) NOT NULL DEFAULT '',
  `provision` double NOT NULL DEFAULT '0',
  `break_pt` double NOT NULL DEFAULT '0',
  `provision2` double NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_salesman`
--

INSERT INTO `0_salesman` (`salesman_code`, `salesman_name`, `salesman_phone`, `salesman_fax`, `salesman_email`, `provision`, `break_pt`, `provision2`, `inactive`) VALUES
(1, 'Sales Person', '', '', '', 5, 1000, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_sales_orders`
--

CREATE TABLE IF NOT EXISTS `0_sales_orders` (
  `order_no` int(11) NOT NULL,
  `trans_type` smallint(6) NOT NULL DEFAULT '30',
  `version` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `debtor_no` int(11) NOT NULL DEFAULT '0',
  `branch_code` int(11) NOT NULL DEFAULT '0',
  `reference` varchar(100) NOT NULL DEFAULT '',
  `customer_ref` tinytext NOT NULL,
  `comments` tinytext,
  `ord_date` date NOT NULL DEFAULT '0000-00-00',
  `order_type` int(11) NOT NULL DEFAULT '0',
  `ship_via` int(11) NOT NULL DEFAULT '0',
  `delivery_address` tinytext NOT NULL,
  `contact_phone` varchar(30) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `deliver_to` tinytext NOT NULL,
  `freight_cost` double NOT NULL DEFAULT '0',
  `from_stk_loc` varchar(5) NOT NULL DEFAULT '',
  `delivery_date` date NOT NULL DEFAULT '0000-00-00',
  `payment_terms` int(11) DEFAULT NULL,
  `total` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_sales_orders`
--

INSERT INTO `0_sales_orders` (`order_no`, `trans_type`, `version`, `type`, `debtor_no`, `branch_code`, `reference`, `customer_ref`, `comments`, `ord_date`, `order_type`, `ship_via`, `delivery_address`, `contact_phone`, `contact_email`, `deliver_to`, `freight_cost`, `from_stk_loc`, `delivery_date`, `payment_terms`, `total`) VALUES
(1, 30, 1, 0, 1, 1, '1', '', '', '2014-06-21', 2, 1, 'Address 1\nAddress 2\nAddress 3', '', '', 'Beefeater Ltd.', 10, 'DEF', '2014-06-22', 3, 0),
(2, 30, 1, 0, 2, 2, '2', '', '', '2014-06-21', 1, 1, 'Address 1\nAddress 2\nAddress 3', '', '', 'Ghostbusters Corp.', 0, 'DEF', '2014-06-22', 4, 0),
(3, 30, 1, 0, 3, 3, '3', '', '', '2014-06-21', 2, 1, 'Address 1\nAddress 2\nAddress 3', '', '', 'Brezan', 0, 'DEF', '2014-07-01', 3, 0),
(4, 30, 0, 0, 1, 1, '4', '', '', '2014-06-21', 2, 1, 'Address 1\nAddress 2\nAddress 3', '', '', 'Beefeater Ltd.', 0, 'DEF', '2014-06-22', 3, 0),
(5, 30, 1, 0, 2, 2, '5', '', '', '2014-06-21', 1, 1, 'Address 1\nAddress 2\nAddress 3', '', '', 'Ghostbusters Corp.', 5, 'DEF', '2014-06-22', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_sales_order_details`
--

CREATE TABLE IF NOT EXISTS `0_sales_order_details` (
  `id` int(11) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '0',
  `trans_type` smallint(6) NOT NULL DEFAULT '30',
  `stk_code` varchar(20) NOT NULL DEFAULT '',
  `description` tinytext,
  `qty_sent` double NOT NULL DEFAULT '0',
  `unit_price` double NOT NULL DEFAULT '0',
  `quantity` double NOT NULL DEFAULT '0',
  `discount_percent` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_sales_order_details`
--

INSERT INTO `0_sales_order_details` (`id`, `order_no`, `trans_type`, `stk_code`, `description`, `qty_sent`, `unit_price`, `quantity`, `discount_percent`) VALUES
(1, 1, 30, '102', '17inch VGA Monitor', 2, 30.4, 2, 0),
(2, 2, 30, '102', '17inch VGA Monitor', 1, 50, 1, 0),
(3, 3, 30, '102', '17inch VGA Monitor', 1, 35.89, 1, 0),
(4, 4, 30, '102', '17inch VGA Monitor', 0, 21.28, 2, 0),
(5, 5, 30, '102', '17inch VGA Monitor', 1, 50, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_sales_pos`
--

CREATE TABLE IF NOT EXISTS `0_sales_pos` (
  `id` smallint(6) unsigned NOT NULL,
  `pos_name` varchar(30) NOT NULL,
  `cash_sale` tinyint(1) NOT NULL,
  `credit_sale` tinyint(1) NOT NULL,
  `pos_location` varchar(5) NOT NULL,
  `pos_account` smallint(6) unsigned NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_sales_pos`
--

INSERT INTO `0_sales_pos` (`id`, `pos_name`, `cash_sale`, `credit_sale`, `pos_location`, `pos_account`, `inactive`) VALUES
(1, 'Default', 1, 1, 'DEF', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_sales_types`
--

CREATE TABLE IF NOT EXISTS `0_sales_types` (
  `id` int(11) NOT NULL,
  `sales_type` char(50) NOT NULL DEFAULT '',
  `tax_included` int(1) NOT NULL DEFAULT '0',
  `factor` double NOT NULL DEFAULT '1',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_sales_types`
--

INSERT INTO `0_sales_types` (`id`, `sales_type`, `tax_included`, `factor`, `inactive`) VALUES
(1, 'Retail', 1, 1, 0),
(2, 'Wholesale', 0, 0.7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_security_roles`
--

CREATE TABLE IF NOT EXISTS `0_security_roles` (
  `id` int(11) NOT NULL,
  `role` varchar(30) NOT NULL,
  `description` varchar(50) DEFAULT NULL,
  `sections` text,
  `areas` text,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_security_roles`
--

INSERT INTO `0_security_roles` (`id`, `role`, `description`, `sections`, `areas`, `inactive`) VALUES
(1, 'Inquiries', 'Inquiries', '768;2816;3072;3328;5632;5888;8192;8448;10752;11008;13312;15872;16128', '257;258;259;260;513;514;515;516;517;518;519;520;521;522;523;524;525;773;774;2822;3073;3075;3076;3077;3329;3330;3331;3332;3333;3334;3335;5377;5633;5640;5889;5890;5891;7937;7938;7939;7940;8193;8194;8450;8451;10497;10753;11009;11010;11012;13313;13315;15617;15618;15619;15620;15621;15622;15623;15624;15625;15626;15873;15882;16129;16130;16131;16132', 0),
(2, 'System Administrator', 'System Administrator', '256;512;768;2816;3072;3328;5376;5632;5888;7936;8192;8448;10496;10752;11008;13056;13312;15616;15872;16128', '257;258;259;260;513;514;515;516;517;518;519;520;521;522;523;524;525;526;769;770;771;772;773;774;2817;2818;2819;2820;2821;2822;2823;3073;3074;3082;3075;3076;3077;3078;3079;3080;3081;3329;3330;3331;3332;3333;3334;3335;5377;5633;5634;5635;5636;5637;5641;5638;5639;5640;5889;5890;5891;7937;7938;7939;7940;8193;8194;8195;8196;8197;8449;8450;8451;10497;10753;10754;10755;10756;10757;11009;11010;11011;11012;13057;13313;13314;13315;15617;15618;15619;15620;15621;15622;15623;15624;15628;15625;15626;15627;15873;15874;15875;15876;15877;15878;15879;15880;15883;15881;15882;16129;16130;16131;16132', 0),
(3, 'Salesman', 'Salesman', '768;3072;5632;8192;15872', '773;774;3073;3075;3081;5633;8194;15873', 0),
(4, 'Stock Manager', 'Stock Manager', '2816;3072;3328;5632;5888;8192;8448;10752;11008;13312;15872;16128', '2818;2822;3073;3076;3077;3329;3330;3330;3330;3331;3331;3332;3333;3334;3335;5633;5640;5889;5890;5891;8193;8194;8450;8451;10753;11009;11010;11012;13313;13315;15882;16129;16130;16131;16132', 0),
(5, 'Production Manager', 'Production Manager', '512;2816;3072;3328;5632;5888;8192;8448;10752;11008;13312;15616;15872;16128', '521;523;524;2818;2819;2820;2821;2822;2823;3073;3074;3076;3077;3078;3079;3080;3081;3329;3330;3330;3330;3331;3331;3332;3333;3334;3335;5633;5640;5640;5889;5890;5891;8193;8194;8196;8197;8450;8451;10753;10755;11009;11010;11012;13313;13315;15617;15619;15620;15621;15624;15624;15876;15877;15880;15882;16129;16130;16131;16132', 0),
(6, 'Purchase Officer', 'Purchase Officer', '512;2816;3072;3328;5376;5632;5888;8192;8448;10752;11008;13312;15616;15872;16128', '521;523;524;2818;2819;2820;2821;2822;2823;3073;3074;3076;3077;3078;3079;3080;3081;3329;3330;3330;3330;3331;3331;3332;3333;3334;3335;5377;5633;5635;5640;5640;5889;5890;5891;8193;8194;8196;8197;8449;8450;8451;10753;10755;11009;11010;11012;13313;13315;15617;15619;15620;15621;15624;15624;15876;15877;15880;15882;16129;16130;16131;16132', 0),
(7, 'AR Officer', 'AR Officer', '512;768;2816;3072;3328;5632;5888;8192;8448;10752;11008;13312;15616;15872;16128', '521;523;524;771;773;774;2818;2819;2820;2821;2822;2823;3073;3073;3074;3075;3076;3077;3078;3079;3080;3081;3081;3329;3330;3330;3330;3331;3331;3332;3333;3334;3335;5633;5633;5634;5637;5638;5639;5640;5640;5889;5890;5891;8193;8194;8194;8196;8197;8450;8451;10753;10755;11009;11010;11012;13313;13315;15617;15619;15620;15621;15624;15624;15873;15876;15877;15878;15880;15882;16129;16130;16131;16132', 0),
(8, 'AP Officer', 'AP Officer', '512;2816;3072;3328;5376;5632;5888;8192;8448;10752;11008;13312;15616;15872;16128', '257;258;259;260;521;523;524;769;770;771;772;773;774;2818;2819;2820;2821;2822;2823;3073;3074;3082;3076;3077;3078;3079;3080;3081;3329;3330;3331;3332;3333;3334;3335;5377;5633;5635;5640;5889;5890;5891;7937;7938;7939;7940;8193;8194;8196;8197;8449;8450;8451;10497;10753;10755;11009;11010;11012;13057;13313;13315;15617;15619;15620;15621;15624;15876;15877;15880;15882;16129;16130;16131;16132', 0),
(9, 'Accountant', 'New Accountant', '512;768;2816;3072;3328;5376;5632;5888;8192;8448;10752;11008;13312;15616;15872;16128', '257;258;259;260;521;523;524;771;772;773;774;2818;2819;2820;2821;2822;2823;3073;3074;3075;3076;3077;3078;3079;3080;3081;3329;3330;3331;3332;3333;3334;3335;5377;5633;5634;5635;5637;5638;5639;5640;5889;5890;5891;7937;7938;7939;7940;8193;8194;8196;8197;8449;8450;8451;10497;10753;10755;11009;11010;11012;13313;13315;15617;15618;15619;15620;15621;15624;15873;15876;15877;15878;15880;15882;16129;16130;16131;16132', 0),
(10, 'Sub Admin', 'Sub Admin', '512;768;2816;3072;3328;5376;5632;5888;8192;8448;10752;11008;13312;15616;15872;16128', '257;258;259;260;521;523;524;771;772;773;774;2818;2819;2820;2821;2822;2823;3073;3074;3082;3075;3076;3077;3078;3079;3080;3081;3329;3330;3331;3332;3333;3334;3335;5377;5633;5634;5635;5637;5638;5639;5640;5889;5890;5891;7937;7938;7939;7940;8193;8194;8196;8197;8449;8450;8451;10497;10753;10755;11009;11010;11012;13057;13313;13315;15617;15619;15620;15621;15624;15873;15874;15876;15877;15878;15879;15880;15882;16129;16130;16131;16132', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_shippers`
--

CREATE TABLE IF NOT EXISTS `0_shippers` (
  `shipper_id` int(11) NOT NULL,
  `shipper_name` varchar(60) NOT NULL DEFAULT '',
  `phone` varchar(30) NOT NULL DEFAULT '',
  `phone2` varchar(30) NOT NULL DEFAULT '',
  `contact` tinytext NOT NULL,
  `address` tinytext NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_shippers`
--

INSERT INTO `0_shippers` (`shipper_id`, `shipper_name`, `phone`, `phone2`, `contact`, `address`, `inactive`) VALUES
(1, 'Default', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_sql_trail`
--

CREATE TABLE IF NOT EXISTS `0_sql_trail` (
  `id` int(11) unsigned NOT NULL,
  `sql` text NOT NULL,
  `result` tinyint(1) NOT NULL,
  `msg` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_stock_category`
--

CREATE TABLE IF NOT EXISTS `0_stock_category` (
  `category_id` int(11) NOT NULL,
  `description` varchar(60) NOT NULL DEFAULT '',
  `dflt_tax_type` int(11) NOT NULL DEFAULT '1',
  `dflt_units` varchar(20) NOT NULL DEFAULT 'each',
  `dflt_mb_flag` char(1) NOT NULL DEFAULT 'B',
  `dflt_sales_act` varchar(15) NOT NULL DEFAULT '',
  `dflt_cogs_act` varchar(15) NOT NULL DEFAULT '',
  `dflt_inventory_act` varchar(15) NOT NULL DEFAULT '',
  `dflt_adjustment_act` varchar(15) NOT NULL DEFAULT '',
  `dflt_assembly_act` varchar(15) NOT NULL DEFAULT '',
  `dflt_dim1` int(11) DEFAULT NULL,
  `dflt_dim2` int(11) DEFAULT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `dflt_no_sale` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_stock_category`
--

INSERT INTO `0_stock_category` (`category_id`, `description`, `dflt_tax_type`, `dflt_units`, `dflt_mb_flag`, `dflt_sales_act`, `dflt_cogs_act`, `dflt_inventory_act`, `dflt_adjustment_act`, `dflt_assembly_act`, `dflt_dim1`, `dflt_dim2`, `inactive`, `dflt_no_sale`) VALUES
(1, 'Components', 1, 'each', 'B', '4010', '5010', '1510', '5040', '1530', 0, 0, 0, 0),
(2, 'Charges', 1, 'each', 'D', '4010', '5010', '1510', '5040', '1530', 0, 0, 0, 0),
(3, 'Systems', 1, 'each', 'M', '4010', '5010', '1510', '5040', '1530', 0, 0, 0, 0),
(4, 'Services', 1, 'hr', 'D', '4010', '5010', '1510', '5040', '1530', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_stock_master`
--

CREATE TABLE IF NOT EXISTS `0_stock_master` (
  `stock_id` varchar(20) NOT NULL DEFAULT '',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `tax_type_id` int(11) NOT NULL DEFAULT '0',
  `description` varchar(200) NOT NULL DEFAULT '',
  `long_description` tinytext NOT NULL,
  `units` varchar(20) NOT NULL DEFAULT 'each',
  `mb_flag` char(1) NOT NULL DEFAULT 'B',
  `sales_account` varchar(15) NOT NULL DEFAULT '',
  `cogs_account` varchar(15) NOT NULL DEFAULT '',
  `inventory_account` varchar(15) NOT NULL DEFAULT '',
  `adjustment_account` varchar(15) NOT NULL DEFAULT '',
  `assembly_account` varchar(15) NOT NULL DEFAULT '',
  `dimension_id` int(11) DEFAULT NULL,
  `dimension2_id` int(11) DEFAULT NULL,
  `actual_cost` double NOT NULL DEFAULT '0',
  `last_cost` double NOT NULL DEFAULT '0',
  `material_cost` double NOT NULL DEFAULT '0',
  `labour_cost` double NOT NULL DEFAULT '0',
  `overhead_cost` double NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0',
  `no_sale` tinyint(1) NOT NULL DEFAULT '0',
  `editable` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_stock_master`
--

INSERT INTO `0_stock_master` (`stock_id`, `category_id`, `tax_type_id`, `description`, `long_description`, `units`, `mb_flag`, `sales_account`, `cogs_account`, `inventory_account`, `adjustment_account`, `assembly_account`, `dimension_id`, `dimension2_id`, `actual_cost`, `last_cost`, `material_cost`, `labour_cost`, `overhead_cost`, `inactive`, `no_sale`, `editable`) VALUES
('102', 1, 1, '17inch VGA Monitor', '', 'each', 'B', '4010', '5010', '1510', '5040', '1530', 0, 0, 0, 0, 10, 0, 0, 0, 0, 0),
('103', 1, 1, '32MB VGA Card', '', 'each', 'B', '4010', '5010', '1510', '5040', '1530', 0, 0, 0, 0, 11, 0, 0, 0, 0, 0),
('104', 1, 1, '52x CD Drive', '', 'each', 'B', '4010', '5010', '1510', '5040', '1530', 0, 0, 0, 0, 12, 0, 0, 0, 0, 0),
('201', 4, 1, 'Assembly Labour', '', 'hr', 'D', '4010', '5010', '5010', '5040', '1530', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('3400', 3, 1, 'P4 Business System', '', 'each', 'M', '4010', '5010', '1540', '5040', '1530', 0, 0, 0, 0, 33, 3.9999999999999, 2, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_stock_moves`
--

CREATE TABLE IF NOT EXISTS `0_stock_moves` (
  `trans_id` int(11) NOT NULL,
  `trans_no` int(11) NOT NULL DEFAULT '0',
  `stock_id` char(20) NOT NULL DEFAULT '',
  `type` smallint(6) NOT NULL DEFAULT '0',
  `loc_code` char(5) NOT NULL DEFAULT '',
  `tran_date` date NOT NULL DEFAULT '0000-00-00',
  `person_id` int(11) DEFAULT NULL,
  `price` double NOT NULL DEFAULT '0',
  `reference` char(40) NOT NULL DEFAULT '',
  `qty` double NOT NULL DEFAULT '1',
  `discount_percent` double NOT NULL DEFAULT '0',
  `standard_cost` double NOT NULL DEFAULT '0',
  `visible` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_stock_moves`
--

INSERT INTO `0_stock_moves` (`trans_id`, `trans_no`, `stock_id`, `type`, `loc_code`, `tran_date`, `person_id`, `price`, `reference`, `qty`, `discount_percent`, `standard_cost`, `visible`) VALUES
(1, 1, '102', 25, 'DEF', '2014-06-21', 2, 10, '', 100, 0, 10, 1),
(2, 1, '103', 25, 'DEF', '2014-06-21', 2, 11, '', 100, 0, 11, 1),
(3, 1, '104', 25, 'DEF', '2014-06-21', 2, 12, '', 100, 0, 12, 1),
(4, 1, '102', 26, 'DEF', '2014-06-21', 0, 0, '1', -10, 0, 0, 1),
(5, 1, '103', 26, 'DEF', '2014-06-21', 0, 0, '1', -10, 0, 0, 1),
(6, 1, '104', 26, 'DEF', '2014-06-21', 0, 0, '1', -10, 0, 0, 1),
(7, 1, '3400', 26, 'DEF', '2014-06-21', 0, 0, '1', 10, 0, 0, 1),
(8, 2, '102', 13, 'DEF', '2014-06-21', 0, 30.4, '1', -2, 0, 10, 1),
(9, 3, '102', 13, 'DEF', '2014-06-21', 0, 50, 'auto', -1, 0, 10, 1),
(10, 4, '102', 13, 'DEF', '2014-06-21', 0, 35.89, 'auto', -1, 0, 10, 1),
(11, 3, '102', 26, 'DEF', '2014-06-21', 0, 0, '3', -2, 0, 0, 1),
(12, 3, '103', 26, 'DEF', '2014-06-21', 0, 0, '3', -2, 0, 0, 1),
(13, 3, '104', 26, 'DEF', '2014-06-21', 0, 0, '3', -2, 0, 0, 1),
(14, 3, '3400', 26, 'DEF', '2014-06-21', 0, 0, '3', 2, 0, 0, 1),
(15, 4, '102', 26, 'DEF', '2014-06-21', 0, 0, '4', -4, 0, 0, 1),
(16, 4, '103', 26, 'DEF', '2014-06-21', 0, 0, '4', -4, 0, 0, 1),
(17, 4, '104', 26, 'DEF', '2014-06-21', 0, 0, '4', -4, 0, 0, 1),
(18, 4, '3400', 26, 'DEF', '2014-06-21', 0, 0, '4', 4, 0, 0, 1),
(19, 2, '102', 26, 'DEF', '2014-06-21', 0, 0, '', -2, 0, 0, 1),
(20, 2, '103', 26, 'DEF', '2014-06-21', 0, 0, '', -2, 0, 0, 1),
(21, 2, '104', 26, 'DEF', '2014-06-21', 0, 0, '', -2, 0, 0, 1),
(22, 1, '3400', 29, 'DEF', '2014-06-21', 0, 0, '', 2, 0, 0, 1),
(23, 5, '102', 26, 'DEF', '2014-06-21', 0, 0, '5', -5, 0, 0, 1),
(24, 5, '103', 26, 'DEF', '2014-06-21', 0, 0, '5', -5, 0, 0, 1),
(25, 5, '104', 26, 'DEF', '2014-06-21', 0, 0, '5', -5, 0, 0, 1),
(26, 5, '3400', 26, 'DEF', '2014-06-21', 0, 0, '5', 5, 0, 0, 1),
(27, 6, '102', 26, 'DEF', '2014-06-21', 0, 0, '6', 5, 0, 0, 1),
(28, 6, '103', 26, 'DEF', '2014-06-21', 0, 0, '6', 5, 0, 0, 1),
(29, 6, '104', 26, 'DEF', '2014-06-21', 0, 0, '6', 5, 0, 0, 1),
(30, 6, '3400', 26, 'DEF', '2014-06-21', 0, 0, '6', -5, 0, 0, 1),
(31, 7, '102', 26, 'DEF', '2014-06-21', 0, 0, '7', 2, 0, 0, 1),
(32, 7, '103', 26, 'DEF', '2014-06-21', 0, 0, '7', 2, 0, 0, 1),
(33, 7, '104', 26, 'DEF', '2014-06-21', 0, 0, '7', 2, 0, 0, 1),
(34, 7, '3400', 26, 'DEF', '2014-06-21', 0, 0, '7', -2, 0, 0, 1),
(35, 5, '102', 13, 'DEF', '2014-06-21', 0, 50, 'auto', -1, 0, 10, 1),
(36, 3, '102', 11, 'DEF', '2014-06-21', 0, 37.68, 'Return Ex Inv: 18', 1, 0, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_suppliers`
--

CREATE TABLE IF NOT EXISTS `0_suppliers` (
  `supplier_id` int(11) NOT NULL,
  `supp_name` varchar(60) NOT NULL DEFAULT '',
  `supp_ref` varchar(30) NOT NULL DEFAULT '',
  `address` tinytext NOT NULL,
  `supp_address` tinytext NOT NULL,
  `gst_no` varchar(25) NOT NULL DEFAULT '',
  `contact` varchar(60) NOT NULL DEFAULT '',
  `supp_account_no` varchar(40) NOT NULL DEFAULT '',
  `website` varchar(100) NOT NULL DEFAULT '',
  `bank_account` varchar(60) NOT NULL DEFAULT '',
  `curr_code` char(3) DEFAULT NULL,
  `payment_terms` int(11) DEFAULT NULL,
  `tax_included` tinyint(1) NOT NULL DEFAULT '0',
  `dimension_id` int(11) DEFAULT '0',
  `dimension2_id` int(11) DEFAULT '0',
  `tax_group_id` int(11) DEFAULT NULL,
  `credit_limit` double NOT NULL DEFAULT '0',
  `purchase_account` varchar(15) NOT NULL DEFAULT '',
  `payable_account` varchar(15) NOT NULL DEFAULT '',
  `payment_discount_account` varchar(15) NOT NULL DEFAULT '',
  `notes` tinytext NOT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_suppliers`
--

INSERT INTO `0_suppliers` (`supplier_id`, `supp_name`, `supp_ref`, `address`, `supp_address`, `gst_no`, `contact`, `supp_account_no`, `website`, `bank_account`, `curr_code`, `payment_terms`, `tax_included`, `dimension_id`, `dimension2_id`, `tax_group_id`, `credit_limit`, `purchase_account`, `payable_account`, `payment_discount_account`, `notes`, `inactive`) VALUES
(1, 'Junk Beer ApS', 'Junk Beer', 'Mailing 1\nMailing 2\nMailing 3', 'Address 1\nAddress 2\nAddress 3', '123456', 'Contact', '111', '', '', 'DKK', 3, 0, 1, 0, 2, 1000, '', '2100', '5060', 'A supplier with junk beers.', 0),
(2, 'Lucky Luke Inc.', 'Lucky Luke', 'Mailing 1\nMailing 2\nMailing 3', 'Address 1\nAddress 2\nAddress 3', '654321', 'Luke', '333', '', '', 'USD', 3, 0, 0, 0, 1, 500, '', '2100', '5060', '', 0),
(3, 'Money Makers Ltd.', 'Money Makers', 'Mailing 1\nMailing 2\nMailing 3', 'Address 1\nAddress 2\nAddress 3', '987654', 'Makers', '222', '', '', 'GBP', 3, 0, 0, 0, 2, 300, '', '2100', '5060', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_supp_allocations`
--

CREATE TABLE IF NOT EXISTS `0_supp_allocations` (
  `id` int(11) NOT NULL,
  `amt` double unsigned DEFAULT NULL,
  `date_alloc` date NOT NULL DEFAULT '0000-00-00',
  `trans_no_from` int(11) DEFAULT NULL,
  `trans_type_from` int(11) DEFAULT NULL,
  `trans_no_to` int(11) DEFAULT NULL,
  `trans_type_to` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_supp_allocations`
--

INSERT INTO `0_supp_allocations` (`id`, `amt`, `date_alloc`, `trans_no_from`, `trans_type_from`, `trans_no_to`, `trans_type_to`) VALUES
(1, 3465, '2014-06-21', 4, 22, 7, 20);

-- --------------------------------------------------------

--
-- Table structure for table `0_supp_invoice_items`
--

CREATE TABLE IF NOT EXISTS `0_supp_invoice_items` (
  `id` int(11) NOT NULL,
  `supp_trans_no` int(11) DEFAULT NULL,
  `supp_trans_type` int(11) DEFAULT NULL,
  `gl_code` varchar(15) NOT NULL DEFAULT '',
  `grn_item_id` int(11) DEFAULT NULL,
  `po_detail_item_id` int(11) DEFAULT NULL,
  `stock_id` varchar(20) NOT NULL DEFAULT '',
  `description` tinytext,
  `quantity` double NOT NULL DEFAULT '0',
  `unit_price` double NOT NULL DEFAULT '0',
  `unit_tax` double NOT NULL DEFAULT '0',
  `memo_` tinytext
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_supp_invoice_items`
--

INSERT INTO `0_supp_invoice_items` (`id`, `supp_trans_no`, `supp_trans_type`, `gl_code`, `grn_item_id`, `po_detail_item_id`, `stock_id`, `description`, `quantity`, `unit_price`, `unit_tax`, `memo_`) VALUES
(1, 7, 20, '0', 1, 1, '102', '17inch VGA Monitor', 100, 10, 0.5, ''),
(2, 7, 20, '0', 2, 2, '103', '32MB VGA Card', 100, 11, 0.55, ''),
(3, 7, 20, '0', 3, 3, '104', '52x CD Drive', 100, 12, 0.6, ''),
(4, 8, 20, '2150', 0, 0, '', '', 0, 0.95, 0, 'Phone'),
(5, 8, 20, '5780', 0, 0, '', '', 0, 19.05, 0, 'Phone');

-- --------------------------------------------------------

--
-- Table structure for table `0_supp_trans`
--

CREATE TABLE IF NOT EXISTS `0_supp_trans` (
  `trans_no` int(11) unsigned NOT NULL DEFAULT '0',
  `type` smallint(6) unsigned NOT NULL DEFAULT '0',
  `supplier_id` int(11) unsigned DEFAULT NULL,
  `reference` tinytext NOT NULL,
  `supp_reference` varchar(60) NOT NULL DEFAULT '',
  `tran_date` date NOT NULL DEFAULT '0000-00-00',
  `due_date` date NOT NULL DEFAULT '0000-00-00',
  `ov_amount` double NOT NULL DEFAULT '0',
  `ov_discount` double NOT NULL DEFAULT '0',
  `ov_gst` double NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '1',
  `alloc` double NOT NULL DEFAULT '0',
  `tax_included` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_supp_trans`
--

INSERT INTO `0_supp_trans` (`trans_no`, `type`, `supplier_id`, `reference`, `supp_reference`, `tran_date`, `due_date`, `ov_amount`, `ov_discount`, `ov_gst`, `rate`, `alloc`, `tax_included`) VALUES
(7, 20, 2, '1', '5t', '2014-06-21', '2014-07-01', 3300, 0, 165, 1, 3465, 0),
(8, 20, 2, '2', 'cc', '2014-06-21', '2014-07-01', 20, 0, 0, 1, 0, 0),
(4, 22, 2, '1', '', '2014-06-21', '2014-06-21', -3465, 0, 0, 1, 3465, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_sys_prefs`
--

CREATE TABLE IF NOT EXISTS `0_sys_prefs` (
  `name` varchar(35) NOT NULL DEFAULT '',
  `category` varchar(30) DEFAULT NULL,
  `type` varchar(20) NOT NULL DEFAULT '',
  `length` smallint(6) DEFAULT NULL,
  `value` tinytext
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_sys_prefs`
--

INSERT INTO `0_sys_prefs` (`name`, `category`, `type`, `length`, `value`) VALUES
('coy_name', 'setup.company', 'varchar', 60, 'Euro Bagla iT Ltd'),
('gst_no', 'setup.company', 'varchar', 25, '9876543'),
('coy_no', 'setup.company', 'varchar', 25, '123456789'),
('tax_prd', 'setup.company', 'int', 11, '1'),
('tax_last', 'setup.company', 'int', 11, '1'),
('postal_address', 'setup.company', 'tinytext', 0, 'Address 1\r\nAddress 2\r\nAddress 3'),
('phone', 'setup.company', 'varchar', 30, '(222) 111.222.333'),
('fax', 'setup.company', 'varchar', 30, ''),
('email', 'setup.company', 'varchar', 100, 'delta@delta.com'),
('coy_logo', 'setup.company', 'varchar', 100, 'image001.png'),
('domicile', 'setup.company', 'varchar', 55, ''),
('curr_default', 'setup.company', 'char', 3, 'USD'),
('use_dimension', 'setup.company', 'tinyint', 1, '1'),
('f_year', 'setup.company', 'int', 11, '2'),
('no_item_list', 'setup.company', 'tinyint', 1, '0'),
('no_customer_list', 'setup.company', 'tinyint', 1, '0'),
('no_supplier_list', 'setup.company', 'tinyint', 1, '0'),
('base_sales', 'setup.company', 'int', 11, '1'),
('time_zone', 'setup.company', 'tinyint', 1, '0'),
('add_pct', 'setup.company', 'int', 5, '-1'),
('round_to', 'setup.company', 'int', 5, '1'),
('login_tout', 'setup.company', 'smallint', 6, '600'),
('past_due_days', 'glsetup.general', 'int', 11, '30'),
('profit_loss_year_act', 'glsetup.general', 'varchar', 15, '9990'),
('retained_earnings_act', 'glsetup.general', 'varchar', 15, '3590'),
('bank_charge_act', 'glsetup.general', 'varchar', 15, '5690'),
('exchange_diff_act', 'glsetup.general', 'varchar', 15, '4450'),
('default_credit_limit', 'glsetup.customer', 'int', 11, '1000'),
('accumulate_shipping', 'glsetup.customer', 'tinyint', 1, '0'),
('legal_text', 'glsetup.customer', 'tinytext', 0, ''),
('freight_act', 'glsetup.customer', 'varchar', 15, '4430'),
('debtors_act', 'glsetup.sales', 'varchar', 15, '1200'),
('default_sales_act', 'glsetup.sales', 'varchar', 15, '4010'),
('default_sales_discount_act', 'glsetup.sales', 'varchar', 15, '4510'),
('default_prompt_payment_act', 'glsetup.sales', 'varchar', 15, '4500'),
('default_delivery_required', 'glsetup.sales', 'smallint', 6, '1'),
('default_dim_required', 'glsetup.dims', 'int', 11, '20'),
('pyt_discount_act', 'glsetup.purchase', 'varchar', 15, '5060'),
('creditors_act', 'glsetup.purchase', 'varchar', 15, '2100'),
('po_over_receive', 'glsetup.purchase', 'int', 11, '10'),
('po_over_charge', 'glsetup.purchase', 'int', 11, '10'),
('allow_negative_stock', 'glsetup.inventory', 'tinyint', 1, '0'),
('default_inventory_act', 'glsetup.items', 'varchar', 15, '1510'),
('default_cogs_act', 'glsetup.items', 'varchar', 15, '5010'),
('default_adj_act', 'glsetup.items', 'varchar', 15, '5040'),
('default_inv_sales_act', 'glsetup.items', 'varchar', 15, '4010'),
('default_assembly_act', 'glsetup.items', 'varchar', 15, '1530'),
('default_workorder_required', 'glsetup.manuf', 'int', 11, '20'),
('version_id', 'system', 'varchar', 11, '2.3rc'),
('auto_curr_reval', 'setup.company', 'smallint', 6, '1'),
('grn_clearing_act', 'glsetup.purchase', 'varchar', 15, '1550'),
('bcc_email', 'setup.company', 'varchar', 100, '');

-- --------------------------------------------------------

--
-- Table structure for table `0_sys_types`
--

CREATE TABLE IF NOT EXISTS `0_sys_types` (
  `type_id` smallint(6) NOT NULL DEFAULT '0',
  `type_no` int(11) NOT NULL DEFAULT '1',
  `next_reference` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_sys_types`
--

INSERT INTO `0_sys_types` (`type_id`, `type_no`, `next_reference`) VALUES
(0, 19, '3'),
(1, 8, '2'),
(2, 5, '2'),
(4, 3, '1'),
(10, 19, '4'),
(11, 3, '2'),
(12, 6, '1'),
(13, 5, '2'),
(16, 2, '1'),
(17, 2, '1'),
(18, 1, '3'),
(20, 8, '3'),
(21, 1, '1'),
(22, 4, '2'),
(25, 1, '2'),
(26, 1, '8'),
(28, 1, '1'),
(29, 1, '2'),
(30, 5, '6'),
(32, 0, '1'),
(35, 1, '1'),
(40, 1, '3');

-- --------------------------------------------------------

--
-- Table structure for table `0_tags`
--

CREATE TABLE IF NOT EXISTS `0_tags` (
  `id` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(60) DEFAULT NULL,
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_tag_associations`
--

CREATE TABLE IF NOT EXISTS `0_tag_associations` (
  `record_id` varchar(15) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_tax_groups`
--

CREATE TABLE IF NOT EXISTS `0_tax_groups` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL DEFAULT '',
  `tax_shipping` tinyint(1) NOT NULL DEFAULT '0',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_tax_groups`
--

INSERT INTO `0_tax_groups` (`id`, `name`, `tax_shipping`, `inactive`) VALUES
(1, 'Tax', 0, 0),
(2, 'Tax Exempt', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_tax_group_items`
--

CREATE TABLE IF NOT EXISTS `0_tax_group_items` (
  `tax_group_id` int(11) NOT NULL DEFAULT '0',
  `tax_type_id` int(11) NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_tax_group_items`
--

INSERT INTO `0_tax_group_items` (`tax_group_id`, `tax_type_id`, `rate`) VALUES
(1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `0_tax_types`
--

CREATE TABLE IF NOT EXISTS `0_tax_types` (
  `id` int(11) NOT NULL,
  `rate` double NOT NULL DEFAULT '0',
  `sales_gl_code` varchar(15) NOT NULL DEFAULT '',
  `purchasing_gl_code` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(60) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_tax_types`
--

INSERT INTO `0_tax_types` (`id`, `rate`, `sales_gl_code`, `purchasing_gl_code`, `name`, `inactive`) VALUES
(1, 5, '2150', '2150', 'Tax', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_trans_tax_details`
--

CREATE TABLE IF NOT EXISTS `0_trans_tax_details` (
  `id` int(11) NOT NULL,
  `trans_type` smallint(6) DEFAULT NULL,
  `trans_no` int(11) DEFAULT NULL,
  `tran_date` date NOT NULL,
  `tax_type_id` int(11) NOT NULL DEFAULT '0',
  `rate` double NOT NULL DEFAULT '0',
  `ex_rate` double NOT NULL DEFAULT '1',
  `included_in_price` tinyint(1) NOT NULL DEFAULT '0',
  `net_amount` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL DEFAULT '0',
  `memo` tinytext
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_trans_tax_details`
--

INSERT INTO `0_trans_tax_details` (`id`, `trans_type`, `trans_no`, `tran_date`, `tax_type_id`, `rate`, `ex_rate`, `included_in_price`, `net_amount`, `amount`, `memo`) VALUES
(1, 20, 7, '2014-06-21', 1, 5, 1, 0, 3300, 165, '5t'),
(2, 13, 3, '2014-06-21', 1, 5, 1, 0, 50, 2.5, 'auto'),
(3, 10, 17, '2014-06-21', 1, 5, 1, 0, 50, 2.5, '1'),
(4, 13, 4, '2014-06-21', 1, 5, 1.3932, 0, 35.89, 1.7945, 'auto'),
(5, 10, 18, '2014-06-21', 1, 5, 1.3932, 0, 35.89, 1.7945, '2'),
(6, 2, 5, '2014-06-21', 1, 5, 1, 0, 95.2, 4.76, ''),
(7, 1, 8, '2014-06-21', 1, 5, 1, 0, -47.6, -2.38, ''),
(8, 20, 8, '2014-06-21', 1, 5, 1, 0, -19, -0.95, 'cc'),
(9, 13, 5, '2014-06-21', 1, 5, 1, 1, 47.619047619048, 2.3809523809524, 'auto'),
(10, 10, 19, '2014-06-21', 1, 5, 1, 1, 47.619047619048, 2.3809523809524, '3'),
(11, 11, 3, '2014-06-21', 1, 5, 1.3932, 0, 35.89, 1.7945, '1');

-- --------------------------------------------------------

--
-- Table structure for table `0_useronline`
--

CREATE TABLE IF NOT EXISTS `0_useronline` (
  `id` int(11) NOT NULL,
  `timestamp` int(15) NOT NULL DEFAULT '0',
  `ip` varchar(40) NOT NULL DEFAULT '',
  `file` varchar(100) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_users`
--

CREATE TABLE IF NOT EXISTS `0_users` (
  `id` smallint(6) NOT NULL,
  `user_id` varchar(60) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `real_name` varchar(100) NOT NULL DEFAULT '',
  `role_id` int(11) NOT NULL DEFAULT '1',
  `phone` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `date_format` tinyint(1) NOT NULL DEFAULT '0',
  `date_sep` tinyint(1) NOT NULL DEFAULT '0',
  `tho_sep` tinyint(1) NOT NULL DEFAULT '0',
  `dec_sep` tinyint(1) NOT NULL DEFAULT '0',
  `theme` varchar(20) NOT NULL DEFAULT 'default',
  `page_size` varchar(20) NOT NULL DEFAULT 'A4',
  `prices_dec` smallint(6) NOT NULL DEFAULT '2',
  `qty_dec` smallint(6) NOT NULL DEFAULT '2',
  `rates_dec` smallint(6) NOT NULL DEFAULT '4',
  `percent_dec` smallint(6) NOT NULL DEFAULT '1',
  `show_gl` tinyint(1) NOT NULL DEFAULT '1',
  `show_codes` tinyint(1) NOT NULL DEFAULT '0',
  `show_hints` tinyint(1) NOT NULL DEFAULT '0',
  `last_visit_date` datetime DEFAULT NULL,
  `query_size` tinyint(1) unsigned NOT NULL DEFAULT '10',
  `graphic_links` tinyint(1) DEFAULT '1',
  `pos` smallint(6) DEFAULT '1',
  `print_profile` varchar(30) NOT NULL DEFAULT '',
  `rep_popup` tinyint(1) DEFAULT '1',
  `sticky_doc_date` tinyint(1) DEFAULT '0',
  `startup_tab` varchar(20) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_users`
--

INSERT INTO `0_users` (`id`, `user_id`, `password`, `real_name`, `role_id`, `phone`, `email`, `language`, `date_format`, `date_sep`, `tho_sep`, `dec_sep`, `theme`, `page_size`, `prices_dec`, `qty_dec`, `rates_dec`, `percent_dec`, `show_gl`, `show_codes`, `show_hints`, `last_visit_date`, `query_size`, `graphic_links`, `pos`, `print_profile`, `rep_popup`, `sticky_doc_date`, `startup_tab`, `inactive`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'Administrator', 2, '', 'adm@adm.com', 'C', 0, 0, 0, 0, 'default', 'Letter', 2, 2, 4, 1, 1, 0, 0, '2016-05-21 12:38:11', 10, 1, 1, '', 1, 0, 'orders', 0),
(2, 'demouser', '5f4dcc3b5aa765d61d8327deb882cf99', 'Demo User', 9, '999-999-999', 'demo@demo.nu', 'en_US', 0, 0, 0, 0, 'default', 'Letter', 2, 2, 3, 1, 1, 0, 0, '2014-02-06 19:02:35', 10, 1, 1, '1', 1, 0, 'orders', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_voided`
--

CREATE TABLE IF NOT EXISTS `0_voided` (
  `type` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL DEFAULT '0',
  `date_` date NOT NULL DEFAULT '0000-00-00',
  `memo_` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_workcentres`
--

CREATE TABLE IF NOT EXISTS `0_workcentres` (
  `id` int(11) NOT NULL,
  `name` char(40) NOT NULL DEFAULT '',
  `description` char(50) NOT NULL DEFAULT '',
  `inactive` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_workcentres`
--

INSERT INTO `0_workcentres` (`id`, `name`, `description`, `inactive`) VALUES
(1, 'Workshop', 'Workshop in Alabama', 0);

-- --------------------------------------------------------

--
-- Table structure for table `0_workorders`
--

CREATE TABLE IF NOT EXISTS `0_workorders` (
  `id` int(11) NOT NULL,
  `wo_ref` varchar(60) NOT NULL DEFAULT '',
  `loc_code` varchar(5) NOT NULL DEFAULT '',
  `units_reqd` double NOT NULL DEFAULT '1',
  `stock_id` varchar(20) NOT NULL DEFAULT '',
  `date_` date NOT NULL DEFAULT '0000-00-00',
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `required_by` date NOT NULL DEFAULT '0000-00-00',
  `released_date` date NOT NULL DEFAULT '0000-00-00',
  `units_issued` double NOT NULL DEFAULT '0',
  `closed` tinyint(1) NOT NULL DEFAULT '0',
  `released` tinyint(1) NOT NULL DEFAULT '0',
  `additional_costs` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_workorders`
--

INSERT INTO `0_workorders` (`id`, `wo_ref`, `loc_code`, `units_reqd`, `stock_id`, `date_`, `type`, `required_by`, `released_date`, `units_issued`, `closed`, `released`, `additional_costs`) VALUES
(1, '1', 'DEF', 10, '3400', '2014-06-21', 0, '2014-06-21', '2014-06-21', 10, 1, 1, 10),
(2, '2', 'DEF', 3, '3400', '2014-06-21', 2, '2014-07-11', '2014-06-21', 2, 0, 1, 0),
(3, '3', 'DEF', 2, '3400', '2014-06-21', 0, '2014-06-21', '2014-06-21', 2, 1, 1, 0),
(4, '4', 'DEF', 4, '3400', '2014-06-21', 0, '2014-06-21', '2014-06-21', 4, 1, 1, 0),
(5, '5', 'DEF', 5, '3400', '2014-06-21', 0, '2014-06-21', '2014-06-21', 5, 1, 1, 10),
(6, '6', 'DEF', -5, '3400', '2014-06-21', 1, '2014-06-21', '2014-06-21', -5, 1, 1, 0),
(7, '7', 'DEF', -2, '3400', '2014-06-21', 1, '2014-06-21', '2014-06-21', -2, 1, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `0_wo_issues`
--

CREATE TABLE IF NOT EXISTS `0_wo_issues` (
  `issue_no` int(11) NOT NULL,
  `workorder_id` int(11) NOT NULL DEFAULT '0',
  `reference` varchar(100) DEFAULT NULL,
  `issue_date` date DEFAULT NULL,
  `loc_code` varchar(5) DEFAULT NULL,
  `workcentre_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_wo_issue_items`
--

CREATE TABLE IF NOT EXISTS `0_wo_issue_items` (
  `id` int(11) NOT NULL,
  `stock_id` varchar(40) DEFAULT NULL,
  `issue_id` int(11) DEFAULT NULL,
  `qty_issued` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `0_wo_manufacture`
--

CREATE TABLE IF NOT EXISTS `0_wo_manufacture` (
  `id` int(11) NOT NULL,
  `reference` varchar(100) DEFAULT NULL,
  `workorder_id` int(11) NOT NULL DEFAULT '0',
  `quantity` double NOT NULL DEFAULT '0',
  `date_` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_wo_manufacture`
--

INSERT INTO `0_wo_manufacture` (`id`, `reference`, `workorder_id`, `quantity`, `date_`) VALUES
(1, '1', 2, 2, '2014-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `0_wo_requirements`
--

CREATE TABLE IF NOT EXISTS `0_wo_requirements` (
  `id` int(11) NOT NULL,
  `workorder_id` int(11) NOT NULL DEFAULT '0',
  `stock_id` char(20) NOT NULL DEFAULT '',
  `workcentre` int(11) NOT NULL DEFAULT '0',
  `units_req` double NOT NULL DEFAULT '1',
  `std_cost` double NOT NULL DEFAULT '0',
  `loc_code` char(5) NOT NULL DEFAULT '',
  `units_issued` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `0_wo_requirements`
--

INSERT INTO `0_wo_requirements` (`id`, `workorder_id`, `stock_id`, `workcentre`, `units_req`, `std_cost`, `loc_code`, `units_issued`) VALUES
(1, 1, '102', 1, 1, 0, 'DEF', 10),
(2, 1, '103', 1, 1, 0, 'DEF', 10),
(3, 1, '104', 1, 1, 0, 'DEF', 10),
(4, 2, '102', 1, 1, 0, 'DEF', 0),
(5, 2, '103', 1, 1, 0, 'DEF', 0),
(6, 2, '104', 1, 1, 0, 'DEF', 0),
(7, 3, '102', 1, 1, 0, 'DEF', 2),
(8, 3, '103', 1, 1, 0, 'DEF', 2),
(9, 3, '104', 1, 1, 0, 'DEF', 2),
(10, 4, '102', 1, 1, 0, 'DEF', 4),
(11, 4, '103', 1, 1, 0, 'DEF', 4),
(12, 4, '104', 1, 1, 0, 'DEF', 4),
(13, 5, '102', 1, 1, 0, 'DEF', 5),
(14, 5, '103', 1, 1, 0, 'DEF', 5),
(15, 5, '104', 1, 1, 0, 'DEF', 5),
(16, 6, '102', 1, 1, 0, 'DEF', -5),
(17, 6, '103', 1, 1, 0, 'DEF', -5),
(18, 6, '104', 1, 1, 0, 'DEF', -5),
(19, 7, '102', 1, 1, 0, 'DEF', -2),
(20, 7, '103', 1, 1, 0, 'DEF', -2),
(21, 7, '104', 1, 1, 0, 'DEF', -2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `0_areas`
--
ALTER TABLE `0_areas`
  ADD PRIMARY KEY (`area_code`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `0_attachments`
--
ALTER TABLE `0_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type_no` (`type_no`,`trans_no`);

--
-- Indexes for table `0_audit_trail`
--
ALTER TABLE `0_audit_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Seq` (`fiscal_year`,`gl_date`,`gl_seq`),
  ADD KEY `Type_and_Number` (`type`,`trans_no`);

--
-- Indexes for table `0_bank_accounts`
--
ALTER TABLE `0_bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_account_name` (`bank_account_name`),
  ADD KEY `bank_account_number` (`bank_account_number`),
  ADD KEY `account_code` (`account_code`);

--
-- Indexes for table `0_bank_trans`
--
ALTER TABLE `0_bank_trans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_act` (`bank_act`,`ref`),
  ADD KEY `type` (`type`,`trans_no`),
  ADD KEY `bank_act_2` (`bank_act`,`reconciled`),
  ADD KEY `bank_act_3` (`bank_act`,`trans_date`);

--
-- Indexes for table `0_bom`
--
ALTER TABLE `0_bom`
  ADD PRIMARY KEY (`parent`,`component`,`workcentre_added`,`loc_code`),
  ADD KEY `component` (`component`),
  ADD KEY `id` (`id`),
  ADD KEY `loc_code` (`loc_code`),
  ADD KEY `parent` (`parent`,`loc_code`),
  ADD KEY `workcentre_added` (`workcentre_added`);

--
-- Indexes for table `0_budget_trans`
--
ALTER TABLE `0_budget_trans`
  ADD PRIMARY KEY (`counter`),
  ADD KEY `Type_and_Number` (`type`,`type_no`),
  ADD KEY `Account` (`account`,`tran_date`,`dimension_id`,`dimension2_id`);

--
-- Indexes for table `0_chart_class`
--
ALTER TABLE `0_chart_class`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `0_chart_master`
--
ALTER TABLE `0_chart_master`
  ADD PRIMARY KEY (`account_code`),
  ADD KEY `account_name` (`account_name`),
  ADD KEY `accounts_by_type` (`account_type`,`account_code`);

--
-- Indexes for table `0_chart_types`
--
ALTER TABLE `0_chart_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `0_comments`
--
ALTER TABLE `0_comments`
  ADD KEY `type_and_id` (`type`,`id`);

--
-- Indexes for table `0_credit_status`
--
ALTER TABLE `0_credit_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reason_description` (`reason_description`);

--
-- Indexes for table `0_crm_categories`
--
ALTER TABLE `0_crm_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`,`action`),
  ADD UNIQUE KEY `type_2` (`type`,`name`);

--
-- Indexes for table `0_crm_contacts`
--
ALTER TABLE `0_crm_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`,`action`);

--
-- Indexes for table `0_crm_persons`
--
ALTER TABLE `0_crm_persons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref` (`ref`);

--
-- Indexes for table `0_currencies`
--
ALTER TABLE `0_currencies`
  ADD PRIMARY KEY (`curr_abrev`);

--
-- Indexes for table `0_cust_allocations`
--
ALTER TABLE `0_cust_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `From` (`trans_type_from`,`trans_no_from`),
  ADD KEY `To` (`trans_type_to`,`trans_no_to`);

--
-- Indexes for table `0_cust_branch`
--
ALTER TABLE `0_cust_branch`
  ADD PRIMARY KEY (`branch_code`,`debtor_no`),
  ADD KEY `branch_code` (`branch_code`),
  ADD KEY `branch_ref` (`branch_ref`),
  ADD KEY `group_no` (`group_no`);

--
-- Indexes for table `0_debtors_master`
--
ALTER TABLE `0_debtors_master`
  ADD PRIMARY KEY (`debtor_no`),
  ADD UNIQUE KEY `debtor_ref` (`debtor_ref`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `0_debtor_trans`
--
ALTER TABLE `0_debtor_trans`
  ADD PRIMARY KEY (`type`,`trans_no`),
  ADD KEY `debtor_no` (`debtor_no`,`branch_code`),
  ADD KEY `tran_date` (`tran_date`),
  ADD KEY `order_` (`order_`);

--
-- Indexes for table `0_debtor_trans_details`
--
ALTER TABLE `0_debtor_trans_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Transaction` (`debtor_trans_type`,`debtor_trans_no`),
  ADD KEY `src_id` (`src_id`);

--
-- Indexes for table `0_dimensions`
--
ALTER TABLE `0_dimensions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reference` (`reference`),
  ADD KEY `date_` (`date_`),
  ADD KEY `due_date` (`due_date`),
  ADD KEY `type_` (`type_`);

--
-- Indexes for table `0_exchange_rates`
--
ALTER TABLE `0_exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `curr_code` (`curr_code`,`date_`);

--
-- Indexes for table `0_fiscal_year`
--
ALTER TABLE `0_fiscal_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `begin` (`begin`),
  ADD UNIQUE KEY `end` (`end`);

--
-- Indexes for table `0_gl_trans`
--
ALTER TABLE `0_gl_trans`
  ADD PRIMARY KEY (`counter`),
  ADD KEY `Type_and_Number` (`type`,`type_no`),
  ADD KEY `dimension_id` (`dimension_id`),
  ADD KEY `dimension2_id` (`dimension2_id`),
  ADD KEY `tran_date` (`tran_date`),
  ADD KEY `account_and_tran_date` (`account`,`tran_date`);

--
-- Indexes for table `0_grn_batch`
--
ALTER TABLE `0_grn_batch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_date` (`delivery_date`),
  ADD KEY `purch_order_no` (`purch_order_no`);

--
-- Indexes for table `0_grn_items`
--
ALTER TABLE `0_grn_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grn_batch_id` (`grn_batch_id`);

--
-- Indexes for table `0_groups`
--
ALTER TABLE `0_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `0_item_codes`
--
ALTER TABLE `0_item_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stock_id` (`stock_id`,`item_code`),
  ADD KEY `item_code` (`item_code`);

--
-- Indexes for table `0_item_tax_types`
--
ALTER TABLE `0_item_tax_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `0_item_tax_type_exemptions`
--
ALTER TABLE `0_item_tax_type_exemptions`
  ADD PRIMARY KEY (`item_tax_type_id`,`tax_type_id`);

--
-- Indexes for table `0_item_units`
--
ALTER TABLE `0_item_units`
  ADD PRIMARY KEY (`abbr`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `0_locations`
--
ALTER TABLE `0_locations`
  ADD PRIMARY KEY (`loc_code`);

--
-- Indexes for table `0_loc_stock`
--
ALTER TABLE `0_loc_stock`
  ADD PRIMARY KEY (`loc_code`,`stock_id`),
  ADD KEY `stock_id` (`stock_id`);

--
-- Indexes for table `0_movement_types`
--
ALTER TABLE `0_movement_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `0_payment_terms`
--
ALTER TABLE `0_payment_terms`
  ADD PRIMARY KEY (`terms_indicator`),
  ADD UNIQUE KEY `terms` (`terms`);

--
-- Indexes for table `0_prices`
--
ALTER TABLE `0_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `price` (`stock_id`,`sales_type_id`,`curr_abrev`);

--
-- Indexes for table `0_printers`
--
ALTER TABLE `0_printers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `0_print_profiles`
--
ALTER TABLE `0_print_profiles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `profile` (`profile`,`report`);

--
-- Indexes for table `0_purch_data`
--
ALTER TABLE `0_purch_data`
  ADD PRIMARY KEY (`supplier_id`,`stock_id`);

--
-- Indexes for table `0_purch_orders`
--
ALTER TABLE `0_purch_orders`
  ADD PRIMARY KEY (`order_no`),
  ADD KEY `ord_date` (`ord_date`);

--
-- Indexes for table `0_purch_order_details`
--
ALTER TABLE `0_purch_order_details`
  ADD PRIMARY KEY (`po_detail_item`),
  ADD KEY `order` (`order_no`,`po_detail_item`);

--
-- Indexes for table `0_quick_entries`
--
ALTER TABLE `0_quick_entries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `description` (`description`);

--
-- Indexes for table `0_quick_entry_lines`
--
ALTER TABLE `0_quick_entry_lines`
  ADD PRIMARY KEY (`id`),
  ADD KEY `qid` (`qid`);

--
-- Indexes for table `0_recurrent_invoices`
--
ALTER TABLE `0_recurrent_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `0_refs`
--
ALTER TABLE `0_refs`
  ADD PRIMARY KEY (`id`,`type`),
  ADD KEY `Type_and_Reference` (`type`,`reference`);

--
-- Indexes for table `0_salesman`
--
ALTER TABLE `0_salesman`
  ADD PRIMARY KEY (`salesman_code`),
  ADD UNIQUE KEY `salesman_name` (`salesman_name`);

--
-- Indexes for table `0_sales_orders`
--
ALTER TABLE `0_sales_orders`
  ADD PRIMARY KEY (`trans_type`,`order_no`);

--
-- Indexes for table `0_sales_order_details`
--
ALTER TABLE `0_sales_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sorder` (`trans_type`,`order_no`);

--
-- Indexes for table `0_sales_pos`
--
ALTER TABLE `0_sales_pos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pos_name` (`pos_name`);

--
-- Indexes for table `0_sales_types`
--
ALTER TABLE `0_sales_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sales_type` (`sales_type`);

--
-- Indexes for table `0_security_roles`
--
ALTER TABLE `0_security_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Indexes for table `0_shippers`
--
ALTER TABLE `0_shippers`
  ADD PRIMARY KEY (`shipper_id`),
  ADD UNIQUE KEY `name` (`shipper_name`);

--
-- Indexes for table `0_sql_trail`
--
ALTER TABLE `0_sql_trail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `0_stock_category`
--
ALTER TABLE `0_stock_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Indexes for table `0_stock_master`
--
ALTER TABLE `0_stock_master`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `0_stock_moves`
--
ALTER TABLE `0_stock_moves`
  ADD PRIMARY KEY (`trans_id`),
  ADD KEY `type` (`type`,`trans_no`),
  ADD KEY `Move` (`stock_id`,`loc_code`,`tran_date`);

--
-- Indexes for table `0_suppliers`
--
ALTER TABLE `0_suppliers`
  ADD PRIMARY KEY (`supplier_id`),
  ADD KEY `supp_ref` (`supp_ref`);

--
-- Indexes for table `0_supp_allocations`
--
ALTER TABLE `0_supp_allocations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `From` (`trans_type_from`,`trans_no_from`),
  ADD KEY `To` (`trans_type_to`,`trans_no_to`);

--
-- Indexes for table `0_supp_invoice_items`
--
ALTER TABLE `0_supp_invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Transaction` (`supp_trans_type`,`supp_trans_no`,`stock_id`);

--
-- Indexes for table `0_supp_trans`
--
ALTER TABLE `0_supp_trans`
  ADD PRIMARY KEY (`type`,`trans_no`),
  ADD KEY `supplier_id` (`supplier_id`),
  ADD KEY `SupplierID_2` (`supplier_id`,`supp_reference`),
  ADD KEY `type` (`type`),
  ADD KEY `tran_date` (`tran_date`);

--
-- Indexes for table `0_sys_prefs`
--
ALTER TABLE `0_sys_prefs`
  ADD PRIMARY KEY (`name`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `0_sys_types`
--
ALTER TABLE `0_sys_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `0_tags`
--
ALTER TABLE `0_tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`,`name`);

--
-- Indexes for table `0_tag_associations`
--
ALTER TABLE `0_tag_associations`
  ADD UNIQUE KEY `record_id` (`record_id`,`tag_id`);

--
-- Indexes for table `0_tax_groups`
--
ALTER TABLE `0_tax_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `0_tax_group_items`
--
ALTER TABLE `0_tax_group_items`
  ADD PRIMARY KEY (`tax_group_id`,`tax_type_id`);

--
-- Indexes for table `0_tax_types`
--
ALTER TABLE `0_tax_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `0_trans_tax_details`
--
ALTER TABLE `0_trans_tax_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Type_and_Number` (`trans_type`,`trans_no`),
  ADD KEY `tran_date` (`tran_date`);

--
-- Indexes for table `0_useronline`
--
ALTER TABLE `0_useronline`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timestamp` (`timestamp`),
  ADD KEY `ip` (`ip`);

--
-- Indexes for table `0_users`
--
ALTER TABLE `0_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `0_voided`
--
ALTER TABLE `0_voided`
  ADD UNIQUE KEY `id` (`type`,`id`);

--
-- Indexes for table `0_workcentres`
--
ALTER TABLE `0_workcentres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `0_workorders`
--
ALTER TABLE `0_workorders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `wo_ref` (`wo_ref`);

--
-- Indexes for table `0_wo_issues`
--
ALTER TABLE `0_wo_issues`
  ADD PRIMARY KEY (`issue_no`),
  ADD KEY `workorder_id` (`workorder_id`);

--
-- Indexes for table `0_wo_issue_items`
--
ALTER TABLE `0_wo_issue_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `0_wo_manufacture`
--
ALTER TABLE `0_wo_manufacture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workorder_id` (`workorder_id`);

--
-- Indexes for table `0_wo_requirements`
--
ALTER TABLE `0_wo_requirements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workorder_id` (`workorder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `0_areas`
--
ALTER TABLE `0_areas`
  MODIFY `area_code` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_attachments`
--
ALTER TABLE `0_attachments`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_audit_trail`
--
ALTER TABLE `0_audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_bank_accounts`
--
ALTER TABLE `0_bank_accounts`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `0_bank_trans`
--
ALTER TABLE `0_bank_trans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `0_bom`
--
ALTER TABLE `0_bom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_budget_trans`
--
ALTER TABLE `0_budget_trans`
  MODIFY `counter` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_credit_status`
--
ALTER TABLE `0_credit_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `0_crm_categories`
--
ALTER TABLE `0_crm_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'pure technical key',AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `0_crm_contacts`
--
ALTER TABLE `0_crm_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `0_crm_persons`
--
ALTER TABLE `0_crm_persons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `0_cust_allocations`
--
ALTER TABLE `0_cust_allocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_cust_branch`
--
ALTER TABLE `0_cust_branch`
  MODIFY `branch_code` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_debtors_master`
--
ALTER TABLE `0_debtors_master`
  MODIFY `debtor_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_debtor_trans_details`
--
ALTER TABLE `0_debtor_trans_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `0_dimensions`
--
ALTER TABLE `0_dimensions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `0_exchange_rates`
--
ALTER TABLE `0_exchange_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_fiscal_year`
--
ALTER TABLE `0_fiscal_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `0_gl_trans`
--
ALTER TABLE `0_gl_trans`
  MODIFY `counter` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `0_grn_batch`
--
ALTER TABLE `0_grn_batch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_grn_items`
--
ALTER TABLE `0_grn_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_groups`
--
ALTER TABLE `0_groups`
  MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_item_codes`
--
ALTER TABLE `0_item_codes`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `0_item_tax_types`
--
ALTER TABLE `0_item_tax_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_movement_types`
--
ALTER TABLE `0_movement_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_payment_terms`
--
ALTER TABLE `0_payment_terms`
  MODIFY `terms_indicator` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `0_prices`
--
ALTER TABLE `0_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `0_printers`
--
ALTER TABLE `0_printers`
  MODIFY `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_print_profiles`
--
ALTER TABLE `0_print_profiles`
  MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `0_purch_orders`
--
ALTER TABLE `0_purch_orders`
  MODIFY `order_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `0_purch_order_details`
--
ALTER TABLE `0_purch_order_details`
  MODIFY `po_detail_item` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `0_quick_entries`
--
ALTER TABLE `0_quick_entries`
  MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_quick_entry_lines`
--
ALTER TABLE `0_quick_entry_lines`
  MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `0_recurrent_invoices`
--
ALTER TABLE `0_recurrent_invoices`
  MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_salesman`
--
ALTER TABLE `0_salesman`
  MODIFY `salesman_code` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_sales_order_details`
--
ALTER TABLE `0_sales_order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `0_sales_pos`
--
ALTER TABLE `0_sales_pos`
  MODIFY `id` smallint(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_sales_types`
--
ALTER TABLE `0_sales_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `0_security_roles`
--
ALTER TABLE `0_security_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `0_shippers`
--
ALTER TABLE `0_shippers`
  MODIFY `shipper_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_sql_trail`
--
ALTER TABLE `0_sql_trail`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_stock_category`
--
ALTER TABLE `0_stock_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `0_stock_moves`
--
ALTER TABLE `0_stock_moves`
  MODIFY `trans_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `0_suppliers`
--
ALTER TABLE `0_suppliers`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `0_supp_allocations`
--
ALTER TABLE `0_supp_allocations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_supp_invoice_items`
--
ALTER TABLE `0_supp_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `0_tags`
--
ALTER TABLE `0_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_tax_groups`
--
ALTER TABLE `0_tax_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `0_tax_types`
--
ALTER TABLE `0_tax_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_trans_tax_details`
--
ALTER TABLE `0_trans_tax_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `0_useronline`
--
ALTER TABLE `0_useronline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_users`
--
ALTER TABLE `0_users`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `0_workcentres`
--
ALTER TABLE `0_workcentres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_workorders`
--
ALTER TABLE `0_workorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `0_wo_issues`
--
ALTER TABLE `0_wo_issues`
  MODIFY `issue_no` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_wo_issue_items`
--
ALTER TABLE `0_wo_issue_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `0_wo_manufacture`
--
ALTER TABLE `0_wo_manufacture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `0_wo_requirements`
--
ALTER TABLE `0_wo_requirements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
