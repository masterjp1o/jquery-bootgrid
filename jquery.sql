CREATE TABLE IF NOT EXISTS `program` (
  `program_id` int(11) NOT NULL,
  `program_name` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `program` (`program_id`, `program_name`) VALUES
(1, 'performance challenge fund'),
(2, 'Gender and Development'),
(3, 'Interagency');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--


--
-- Dumping data for table `product`
--

INSERT INTO `document` (`document_id`, `program_id`, `document_name`, `document_type`, `document_image`,`document_recieved`,`document_date`,`document_dater`,`document_remarks`) 
VALUES
(1, 1, 'Performance Challenege Fund', 'department order','departmentorder.jpg','patrick','2008-12-12','2018-12-12','sdfsf');



-- --------------------------------------------------------

--
-- Indexes for table `category`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`program_id`) ;

--
-- Indexes for table `product`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `program`
  MODIFY `program_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `document`
  MODIFY `document_id` int(11) NOT NULL AUTO_INCREMENT;
