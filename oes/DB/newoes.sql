/*!40101 SET NAMES utf8 */;

--
-- Current Database: `ns_oes`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `ns_oes2` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ns_oes2`;

--
-- Table structure for table `institute`
--

DROP TABLE IF EXISTS `institute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `institute` (
  `instid` int(11) NOT NULL DEFAULT '0',
  `institutename` varchar(32) DEFAULT NULL,
  `ownername` varchar(32) DEFAULT NULL,
  `address` varchar(32) DEFAULT NULL,
  `contactno` varchar(32) DEFAULT NULL,
  `mobileno` varchar(32) DEFAULT NULL,
  `emailid` varchar(32) DEFAULT NULL,
  `website` varchar(32) DEFAULT NULL,
  `regno` varchar(32) DEFAULT NULL,
  `regdate` varchar(32) DEFAULT NULL,
  `instituteloginname` varchar(32) DEFAULT NULL,
  `institutepassword` varchar(32) DEFAULT NULL,
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  PRIMARY KEY (`instid`)
  ); 

--
-- Table structure for table `adminlogin`
--

DROP TABLE IF EXISTS `adminlogin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adminlogin` (
  `admname` varchar(32) NOT NULL,
  `instid` int(11) NOT NULL DEFAULT '0',
  `admpassword` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`admname`)
  );


--
-- Table structure for table `question`
-- 

DROP TABLE IF EXISTS `question`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `question` (
  `testid` bigint(20) NOT NULL DEFAULT '0',
  `qnid` int(11) NOT NULL DEFAULT '0',
  `question` varchar(500) DEFAULT NULL,
  `optiona` varchar(100) DEFAULT NULL,
  `optionb` varchar(100) DEFAULT NULL,
  `optionc` varchar(100) DEFAULT NULL,
  `optiond` varchar(100) DEFAULT NULL,
  `correctanswer` enum('optiona','optionb','optionc','optiond') DEFAULT NULL,
  `marks` int(11) DEFAULT NULL,
  `instid` int(11) NOT NULL DEFAULT '0',
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  PRIMARY KEY (`testid`,`qnid`),
  CONSTRAINT `question_ibfk_1` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`),
  CONSTRAINT `question_ibfk_2` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)
  );
  

  
--
-- Table structure for table `studentquestion`
--

DROP TABLE IF EXISTS `studentquestion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studentquestion` (
  `stdid` bigint(20) NOT NULL DEFAULT '0',
  `testid` bigint(20) NOT NULL DEFAULT '0',
  `qnid` int(11) NOT NULL DEFAULT '0',
  `instid` int(11) NOT NULL DEFAULT '0',
  `answered` enum('answered','unanswered','review') DEFAULT NULL,
  `stdanswer` enum('optiona','optionb','optionc','optiond') DEFAULT NULL,
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  PRIMARY KEY (`stdid`,`testid`,`qnid`),
  KEY `testid` (`testid`,`qnid`),
  CONSTRAINT `studentquestion_ibfk_1` FOREIGN KEY (`stdid`) REFERENCES `student` (`stdid`),
  CONSTRAINT `studentquestion_ibfk_2` FOREIGN KEY (`testid`, `qnid`) REFERENCES `question` (`testid`, `qnid`),
  CONSTRAINT `studentquestion_ibfk_3` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)
  );
  
--
-- Table structure for table `studenttest`
--

DROP TABLE IF EXISTS `studenttest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studenttest` (
  `stdid` bigint(20) NOT NULL DEFAULT '0',
  `testid` bigint(20) NOT NULL DEFAULT '0',
  `instid` int(11) NOT NULL DEFAULT '0',
  `starttime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `endtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `correctlyanswered` int(11) DEFAULT NULL,
  `status` enum('over','inprogress') DEFAULT NULL,
  PRIMARY KEY (`stdid`,`testid`),
  KEY `testid` (`testid`),
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  CONSTRAINT `studenttest_ibfk_1` FOREIGN KEY (`stdid`) REFERENCES `student` (`stdid`),
  CONSTRAINT `studenttest_ibfk_2` FOREIGN KEY (`testid`) REFERENCES `test` (`testid`),
  CONSTRAINT `studenttest_ibfk_3` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)
  );
  
  
--
-- Table structure for table `testconductor`
--

DROP TABLE IF EXISTS `testconductor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `testconductor` (
  `tcid` bigint(20) NOT NULL,
  `tcname` varchar(40) DEFAULT NULL,
  `tcpassword` varchar(40) DEFAULT NULL,
  `emailid` varchar(40) DEFAULT NULL,
  `contactno` varchar(20) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `instid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tcid`),
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  UNIQUE KEY `stdname` (`tcname`),
  UNIQUE KEY `emailid` (`emailid`),
  CONSTRAINT `testconductor_fk1` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)	
  );
  
  
--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `courseid` int(11) NOT NULL,
  `coursename` varchar(40) DEFAULT NULL,
  `coursedesc` varchar(100) DEFAULT NULL,
  `tcid` bigint(20),
  `instid` int(11) NOT NULL DEFAULT '0',
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  PRIMARY KEY (`courseid`),
  UNIQUE KEY `coursename` (`coursename`),
  CONSTRAINT `course_fk1` FOREIGN KEY (`tcid`) REFERENCES `testconductor` (`tcid`),
  CONSTRAINT `course_fk2` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)
  );
  
  
--
-- Table structure for table `level`
--

DROP TABLE IF EXISTS `level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `level` (
  `levelid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `levelname` varchar(40) DEFAULT NULL,
  `leveldesc` varchar(100) DEFAULT NULL,
  `tcid` bigint(20),
  `instid` int(11) NOT NULL DEFAULT '0',
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  PRIMARY KEY (`levelid`),
  UNIQUE KEY `levelname` (`levelname`),
  CONSTRAINT `level_fk1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  CONSTRAINT `level_fk2` FOREIGN KEY (`tcid`) REFERENCES `testconductor` (`tcid`),
  CONSTRAINT `level_fk3` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)	
  );
  
  
--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subject` (
  `subid` int(11) NOT NULL,
  `levelid` int(11) NOT NULL,
  `courseid` int(11) NOT NULL,
  `subname` varchar(40) DEFAULT NULL,
  `subdesc` varchar(100) DEFAULT NULL,
  `tcid` bigint(20),
  `instid` int(11) NOT NULL DEFAULT '0',
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  PRIMARY KEY (`subid`),
  UNIQUE KEY `subname` (`subname`),
  CONSTRAINT `subject_fk1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  CONSTRAINT `subject_fk2` FOREIGN KEY (`levelid`) REFERENCES `level` (`levelid`),
  CONSTRAINT `subject_fk3` FOREIGN KEY (`tcid`) REFERENCES `testconductor` (`tcid`),
  CONSTRAINT `subject_fk4` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)	
  );
  
  
--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `testid` int(20) NOT NULL,
  `testname` varchar(30) NOT NULL,
  `testdesc` varchar(100) DEFAULT NULL,
  `testdate` date DEFAULT NULL,
  `testtime` time DEFAULT NULL,
  `courseid` int(11) DEFAULT NULL,
  `levelid` int(11) DEFAULT NULL,
  `subid` int(11) DEFAULT NULL,
  `instid` int(11) NOT NULL DEFAULT '0',
  `testfrom` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `testto` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duration` int(11) DEFAULT NULL,
  `totalquestions` int(11) DEFAULT NULL,
  `attemptedstudents` bigint(20) DEFAULT NULL,
  `testcode` varchar(40) NOT NULL,
  `tcid` bigint(20),
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  PRIMARY KEY (`testid`),
  UNIQUE KEY `testname` (`testname`),
  CONSTRAINT `test_fk1` FOREIGN KEY (`courseid`) REFERENCES `course` (`courseid`),
  CONSTRAINT `test_fk2` FOREIGN KEY (`levelid`) REFERENCES `level` (`levelid`),
  CONSTRAINT `test_fk3` FOREIGN KEY (`subid`) REFERENCES `subject` (`subid`),
  CONSTRAINT `test_fk4` FOREIGN KEY (`tcid`) REFERENCES `testconductor` (`tcid`),
  CONSTRAINT `test_fk5` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)
);


--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `studentid` int(11) NOT NULL DEFAULT '0',
  `instid` int(11) NOT NULL DEFAULT '0',
  `fname` varchar(32) DEFAULT NULL,
  `mname` varchar(32) DEFAULT NULL,
  `lname` varchar(32) DEFAULT NULL,
  `address` varchar(32) DEFAULT NULL,
  `contactno` varchar(32) DEFAULT NULL,
  `mobileno` varchar(32) DEFAULT NULL,
  `emailid` varchar(32) DEFAULT NULL,
  `dob` date, 
  `age` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(32) DEFAULT NULL,
  `courseid` int(11) NOT NULL DEFAULT '0',
  `levelid` int(11) NOT NULL DEFAULT '0',
  `doa` date, 
  `login_name` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `isactive` boolean DEFAULT NULL,
  `isdeleted` boolean DEFAULT NULL,
  PRIMARY KEY (`userid`),
  CONSTRAINT `test_fk5` FOREIGN KEY (`instid`) REFERENCES `institute` (`instituteid`)
  );