-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 05:59 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `training_calendar`
--

CREATE TABLE `training_calendar` (
  `code` int(7) NOT NULL,
  `training` varchar(225) NOT NULL,
  `image` varchar(100) NOT NULL,
  `initial` varchar(50) NOT NULL,
  `about` longtext NOT NULL,
  `target_audience` longtext NOT NULL,
  `start_date` date NOT NULL,
  `duration` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_calendar`
--

INSERT INTO `training_calendar` (`code`, `training`, `image`, `initial`, `about`, `target_audience`, `start_date`, `duration`, `location`, `status`) VALUES
(1, 'Modern Records Management training', 'MRMT.png', 'MRMT', 'The role of records management is being redefined in organizations across the world.  The role of records management is being redefined in organizations across the world. It\'s no longer enough to be a steward of information. Business executives are looking at records managers to play a critical role in accelerating business activities, enriching customer experiences, and improving operational agility.   Records managers who know how to leverage and enable all the information they used to try to lock down are playing vital roles in their organization\'s digital transformation efforts.  Our Modern Records Management training course will give you the tools to future-proof your career. You will learn how to:  Position records management as a business enabler. Capture records efficiently regardless of format. Use automation to avoid common records management risks. Support privacy and eDiscovery requirements. Manage records effectively throughout the records lifecycle. Select and implement a digital recordkeeping system.', 'The Modern Records Management Training is designed for; Records, Archives, Information and Data Management Specialists, Human Resource Managers, Procurement Specialists, Project Managers, Administrative Staff, Law Clerks.', '2023-11-27', '2 Months', 'Kampala - Uganda', '1'),
(2, 'Records & Archives Management Training', 'RAMT.png', 'RAMT', 'Records, data, and related information assets are increasingly becoming strategic issues for organizations in both the public and private sectors. Yet, managing records in the changing work environment is a major challenge for many organizations. For example, changes in law, such as the recent changes in the finance and employment law, often call for tighter controls on contract documentation, and lead to a need for enhanced management of human resource and contract records.  In addition, electronic information is under threat from cyber-attack and personal information is at risk of exposure. As such, the development and implementation of a records management program that includes document control methods to identify, secure and protect critical information, is necessary for every organization.  A key factor in meeting both the challenge and addressing the strategic management is the provision of education and/or training for employers and potential employees.  Providing this at the appropriate level of detail and in the appropriate areas of the subject, commensurate with roles and responsibilities so that these people can discharge, both effectively and efficiently, their responsibilities for managing records in the electronic environment.   PASI has designed a Records and Information Management Training Course. This course shall convey practical methods for identifying and developing the systems of records management and document control that an organization needs.  By the end, each participant will have a plan of action as well as the necessary skills to assist with the development and implementation of an appropriate program for managing their organization’s documents, records, and information.  By the end of the course participants should be able to,  Develop a records management program to enhance the value of the organization’s information and reduce risk and cost. Develop document control methods to identify, secure, protect and retain critical information such as working retention schedules. Apply regulations, standards, and ethical guidelines to the management of information for compliance. Participate in advising procurement of records and information management tools including stationery, storage equipment and computing technologies. Identify risks associated with poor management of information to reduce penalties and cost; and Identify the records and information assets and develop an information asset register to identify critical information within their organization', 'This course is designed for individuals who manage, or who are involved with, any aspect of data, document control and records management.  This includes but not limited to Chief Information Analysts, Human Resource Managers, Records and information managers, Procurement Officers, In-house counsel, Privacy officers, Information security and protection managers, Litigation and discovery staff, Compliance officers, Internal auditors, IT and Enterprise content management professionals, and Administrative managers.', '2023-11-27', '4 Months', 'Kampala - Uganda', '1'),
(4, '​Implementing Information Management on SharePoint and Office 365 Training', 'IIMSO.png', 'IIMSO', 'SharePoint is a powerful and flexible platform that can be customized to fit any number  SharePoint is a powerful and flexible platform that can be customized to fit any number of unique scenarios, but, at the end of the day, it\'s still just a tool. It will only ever be as good as it\'s set up to be.  Our Implementing Information Management on SharePoint and Office 365 course will show you how to implement and manage your SharePoint environment to unlock its full power as an information management platform.  Through a blend of hands-on labs and lectures you will learn how to build the same kinds of term sets, hierarchies, workflows, records retention rules, and other components that you will need to deliver back in your organization.  This training course will help you:  Identify appropriate and inappropriate scenarios for SharePoint. Design content import strategies. Configure search to improve findability. Select SharePoint components to create a user experience. Select and configure information protection tools.', 'Any information professional or business professional tasked with leading or supporting an information management project or initiative.  This includes but not limited to Information & Data Managers, Business Analysts, Information Analysts, Human Resource Managers, Records and information managers, Procurement Officers, Information security and protection managers, Compliance officers, Accountants, Internal auditors, Project Managers, Enterprise content management professionals, and Administrative staff.', '2023-11-22', '3 Months', 'Kampala - Uganda', '1'),
(5, 'Agile Management Training', 'AMT.png', 'AMT', 'Organizations of all sizes are turning project initiatives to generate new value and agile  Organizations of all sizes are turning project initiatives to generate new value and agile methods to empower the project teams to success.  In this course you will learn the principles of agile project management and gain the tools and skills necessary to lead your team and organization through agile transformation.  As a leader you will learn principles of an agile mindset, how greater agility can yield the value organizations generate through project initiatives. Then you will learn how to adapt these principles to your unique environment and craft a plan for implementation across the whole organization.  PASI’s agile course explores the methodologies and practices of Agile development and explains the key concepts and principles that form the foundation of Agile project management. Our course opens the world of sprint development to you and your team. You will learn from experts who have implemented and practices agility within their own organizations.  This self-paced course contains vocabulary games, flashcards, and interactive exercises to supplement and enhance your understanding of Agile concepts, to help you become a more proficient Agile practitioner.  With our agile management course you will be able to;  Define Agile management. Identify the similarities and differences among several Agile methodologies. Describe the stages of the Agile development cycle and identify the factors that promote project success. Assess your team’s performance and transformation efforts. Understand the nuances of leading and working with Agile teams. Apply best practices from organizations that have successfully incorporated Agile methodologies into their business activities.', 'This course is designed for all professionals involved in any form of project. It is designed for project leaders to thrive in any initiative including how to communicate effectively, coordinate with business analysts, manage joint venture partnerships, manage progress, address risks, compliance, quality and procurement considerations.', '2024-01-01', '1 Months', 'Kampala - Uganda', '1'),
(6, 'Business Process Management Training: Digitize Core Business Processes', 'BPMD.png', 'BPMD', 'How well an organization operates is dictated by its business processes,  How well an organization operates is dictated by its business processes, but most of these processes are not as efficient, standardized, or optimized as they should be. The cost of poorly designed processes hits organizations in dollars and reputation.  Our Business Process Management (BPM) course provides practical guidance to map, standardize, and automate operational processes with the right strategies and technologies. Through a mixture of lecture and hands-on exercises, you’ll learn how to analyze and troubleshoot existing business processes and make specific recommendations for improvement to maximize ROI and ensure compliance.  Our Business Process Management (BPM) course will help you:  Identify, map, understand, and manage processes across the enterprise. Analyze existing business processes to identify issues and potential solutions. Get a thorough understanding of different workflow and BPM technologies. Understand the fundamentals of flowcharting and use standard charting symbols and functions Determine the most effective process improvement approach for a particular situation. Design and implement an effective process improvement programs.', 'This course covers flowcharting, the different approaches to business analysis, modeling and modeling tools, evaluating workflows, and more.  It is designated for every individual whose work is a bit more robust and who are involved in core business processes.  This includes but not limited to Information & Data Managers, Business Analysts, Information Analysts, Human Resource Managers, Records and information managers, Procurement Officers, Information security and protection managers, Compliance officers, Accountants, Internal auditors, Project Managers, Enterprise content management professionals, and Administrative staff.', '2024-02-05', '3 Months', 'Kampala - Uganda', '1'),
(7, 'Confidentiality in Information & Data Management', 'CIDM.png', 'CIDM', 'Confidential information can be as small as a fingerprint or as big as a business plan. It’s the details of an internal investigation or a secret ingredient for success. One breach or careless mistake can put an entire organization at risk. Do employees know how to protect confidential information?', '', '0000-00-00', '', '', ''),
(8, 'Information Governance Course', 'IGC.png', 'IGC', 'The volume, variety, and velocity of organizational information is changing the game for governance\r\n\r\nThe volume, variety, and velocity of organizational information is changing the game for governance and compliance. Applying a paper paradigm of policies and processes no longer works and it certainly doesn’t scale. Governance functions must now be automated and focus as much on defensible disposition as on retention, and as much on data extraction as data archiving.\r\n\r\nOur Information Governance course will provide you with a systematic approach for managing information assets in support of business goals and objectives. The course will also help you to develop a framework for ensuring regulatory compliance.\r\n\r\nOur Information Governance course will help you:\r\n\r\nDesign and implement a pragmatic framework for managing information assets.\r\nIdentify required roles and responsibilities for information governance throughout the organization.\r\nGain support for an effective information governance program from stakeholders and staff.\r\nImprove how information is captured, shared, accessed, stored, and disposed of.\r\nReduce storage and legal costs.\r\nSave time and money through greater interoperability and standardized components.\r\nEnsure legal and regulatory compliance.', 'Any information professional or business professional tasked with leading or supporting an information management project or initiative.\r\n\r\nThis includes but not limited to Information & Data Managers, Business Analysts, Information Analysts, Human Resource Managers, Records and information managers, Procurement Officers, Information security and protection managers, Compliance officers, Accountants, Internal auditors, Project Managers, Enterprise content management professionals, and Administrative staff', '2024-12-09', '3', 'Kampala - Uganda', '1'),
(9, 'Confident Change Management for Information Professionals Training', 'CCMIPT.png', 'CCMIPT', 'Implementing a new technology or process can be a costly and time-consuming endeavour.\r\n\r\nImplementing a new technology or process can be a costly and time-consuming endeavour. But did you know that the most common reason for an information management project to fail isn\'t the technical implementation itself? It’s often issues with user adoption and resistance to change that can cause your project to derail before you\'ve even begun.\r\n\r\nDon’t let this happen to you! Learn the practice of change management – the people side of organizational change - to ensure the success of your next project.\r\n\r\nOur Confident Change Management for Information Professionals course will prepare you to successfully lead or support projects involving organizational change. You will learn all the aspects of change management and the skills necessary to implement large-scale change management efforts, including how to:\r\n\r\nIdentify the internal and external factors driving the need for change in the organization.\r\nDevelop strategies for motivation of stakeholders.\r\nConstruct and analyze communications strategies and messages that effectively promote user adoption.\r\nDevelop and maintain relationships with stakeholders and provide direction and feedback in ways that are easy for the stakeholder to understand.\r\nImplement change management projects in your organization.', 'Any information professional or business professional tasked with leading or supporting an information management project or initiative.', '2024-12-16', '2 Months', 'Kampala - Uganda', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `training_calendar`
--
ALTER TABLE `training_calendar`
  ADD PRIMARY KEY (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `training_calendar`
--
ALTER TABLE `training_calendar`
  MODIFY `code` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
