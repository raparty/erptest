-- School ERP Schema Export
-- Generated on: 2026-02-10 09:20:03

--- Table: account_category ---
CREATE TABLE `account_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: account_exp_income_detail ---
CREATE TABLE `account_exp_income_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('Income','Expense') NOT NULL,
  `date_of_txn` date NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: accounts ---
CREATE TABLE `accounts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` enum('Income','Expense') NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_method` enum('Cash','Online','Cheque') DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: admin ---
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admin` AS select `users`.`user_id` AS `admin_user`,`users`.`password` AS `admin_password`,`users`.`id` AS `id` from `users` where (`users`.`role` = 'Admin');

--- Table: admissions ---
CREATE TABLE `admissions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_pic` varchar(255) DEFAULT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `class_id` int NOT NULL,
  `admission_date` date NOT NULL,
  `aadhaar_no` varchar(12) DEFAULT NULL,
  `aadhaar_doc_path` varchar(255) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_phone` varchar(15) DEFAULT NULL,
  `past_school_info` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reg_no` (`reg_no`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: allocate_class_section ---
CREATE TABLE `allocate_class_section` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `section_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: allocate_class_stream ---
CREATE TABLE `allocate_class_stream` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `stream_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: allocate_class_subject ---
CREATE TABLE `allocate_class_subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `subject_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: allocate_sections ---
CREATE TABLE `allocate_sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int DEFAULT NULL,
  `section_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `allocate_sections_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `allocate_sections_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: allocate_subjects ---
CREATE TABLE `allocate_subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`),
  KEY `subject_id` (`subject_id`),
  CONSTRAINT `allocate_subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`),
  CONSTRAINT `allocate_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: attendance ---
CREATE TABLE `attendance` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `status` enum('Present','Absent','Late') NOT NULL,
  `attendance_date` date NOT NULL,
  `marked_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`attendance_date`),
  CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: book_manager ---
CREATE TABLE `book_manager` (
  `book_id` int NOT NULL AUTO_INCREMENT,
  `book_category_id` int NOT NULL,
  `book_number` varchar(100) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_author` varchar(255) DEFAULT NULL,
  `book_description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: book_managers ---
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `book_managers` AS select `book_manager`.`book_id` AS `book_id`,`book_manager`.`book_category_id` AS `book_category_id`,`book_manager`.`book_number` AS `book_number`,`book_manager`.`book_name` AS `book_name`,`book_manager`.`book_author` AS `book_author`,`book_manager`.`book_description` AS `book_description`,`book_manager`.`created_at` AS `created_at` from `book_manager`;

--- Table: class ---
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `class` AS select `classes`.`id` AS `id`,`classes`.`class_name` AS `class_name` from `classes`;

--- Table: classes ---
CREATE TABLE `classes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `class_name` (`class_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: exam_add_maximum_marks ---
CREATE TABLE `exam_add_maximum_marks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `stream_id` int DEFAULT NULL,
  `subject_id` int NOT NULL,
  `term_id` int NOT NULL,
  `max_marks` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: exam_nuber_of_term ---
CREATE TABLE `exam_nuber_of_term` (
  `term_id` int NOT NULL AUTO_INCREMENT,
  `term_name` varchar(100) NOT NULL,
  PRIMARY KEY (`term_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: exam_subject_marks ---
CREATE TABLE `exam_subject_marks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_no` varchar(50) NOT NULL,
  `subject_id` int NOT NULL,
  `term_id` int NOT NULL,
  `marks_obtained` int NOT NULL,
  `session` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: exam_time_table ---
CREATE TABLE `exam_time_table` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `exam_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: fees ---
CREATE TABLE `fees` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `amount_paid` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` enum('Cash','Online','Cheque') NOT NULL,
  `remarks` text,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `fees_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: fees_package ---
CREATE TABLE `fees_package` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_name` varchar(100) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: fees_term ---
CREATE TABLE `fees_term` (
  `id` int NOT NULL AUTO_INCREMENT,
  `term_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: library_books ---
CREATE TABLE `library_books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_title` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `isbn_no` varchar(50) DEFAULT NULL,
  `status` enum('Available','Issued') DEFAULT 'Available',
  `cat_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `isbn_no` (`isbn_no`),
  KEY `cat_id` (`cat_id`),
  CONSTRAINT `library_books_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `library_categories` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: library_categories ---
CREATE TABLE `library_categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `cat_name` (`category_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: library_fine_managers ---
CREATE TABLE `library_fine_managers` (
  `fine_id` int NOT NULL AUTO_INCREMENT,
  `fine_rate` decimal(10,2) NOT NULL,
  `no_of_days` int NOT NULL,
  `session` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`fine_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: library_issued_books ---
CREATE TABLE `library_issued_books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_id` int DEFAULT NULL,
  `student_id` varchar(20) DEFAULT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('Issued','Returned') DEFAULT 'Issued',
  PRIMARY KEY (`id`),
  KEY `book_id` (`book_id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `library_issued_books_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `library_books` (`id`),
  CONSTRAINT `library_issued_books_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: marks ---
CREATE TABLE `marks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` varchar(20) NOT NULL,
  `subject_name` varchar(50) NOT NULL,
  `exam_type` enum('Unit Test','Mid-Term','Final') NOT NULL,
  `marks_obtained` int NOT NULL,
  `total_marks` int DEFAULT '100',
  `academic_year` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`),
  CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: month ---
CREATE TABLE `month` (
  `id` int NOT NULL AUTO_INCREMENT,
  `month_name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: registration_counter ---
CREATE TABLE `registration_counter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `counter_value` int NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: rte_student_info ---
CREATE TABLE `rte_student_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_no` varchar(50) NOT NULL,
  `student_admission_no` varchar(50) DEFAULT NULL,
  `addmission_date` varchar(50) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `stream` varchar(50) DEFAULT NULL,
  `admission_fee` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `s_address` text,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pin_code` varchar(20) DEFAULT NULL,
  `s_mobile_no` varchar(20) DEFAULT NULL,
  `s_email` varchar(255) DEFAULT NULL,
  `f_name` varchar(255) DEFAULT NULL,
  `m_name` varchar(255) DEFAULT NULL,
  `f_address` text,
  `f_mobile_no` varchar(20) DEFAULT NULL,
  `f_email` varchar(255) DEFAULT NULL,
  `caste_certificate` varchar(10) DEFAULT NULL,
  `bonafied_cetificate` varchar(10) DEFAULT NULL,
  `income_certificate` varchar(10) DEFAULT NULL,
  `previous_class_certificate` varchar(10) DEFAULT NULL,
  `session` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_no` (`registration_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: school_detail ---
CREATE TABLE `school_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_name` varchar(255) NOT NULL,
  `school_address` text,
  `school_logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: school_details ---
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `school_details` AS select `school_detail`.`id` AS `id`,`school_detail`.`school_name` AS `school_name`,`school_detail`.`school_address` AS `school_address`,`school_detail`.`school_logo` AS `school_logo` from `school_detail`;

--- Table: section ---
CREATE TABLE `section` (
  `id` int NOT NULL AUTO_INCREMENT,
  `section_name` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: sections ---
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `sections` AS select `section`.`id` AS `id`,`section`.`section_name` AS `section_name` from `section`;

--- Table: staff_categories ---
CREATE TABLE `staff_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: staff_category ---
CREATE TABLE `staff_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: staff_departments ---
CREATE TABLE `staff_departments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dept_name` (`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: staff_details ---
CREATE TABLE `staff_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `qualification` text,
  `date_of_joining` date DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`),
  CONSTRAINT `staff_details_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: staff_employee ---
CREATE TABLE `staff_employee` (
  `id` int NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `dept_id` int NOT NULL,
  `cat_id` int NOT NULL,
  `pos_id` int NOT NULL,
  `qualification_id` int NOT NULL,
  `salary` decimal(10,2) DEFAULT '0.00',
  `joining_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: staff_positions ---
CREATE TABLE `staff_positions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `position_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `position_name` (`position_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: staff_qualification ---
CREATE TABLE `staff_qualification` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qualification_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: staff_qualifications ---
CREATE TABLE `staff_qualifications` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qualification_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: student_books_detail ---
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_books_detail` AS select `student_books_details`.`id` AS `id`,`student_books_details`.`registration_no` AS `registration_no`,`student_books_details`.`book_number` AS `book_number`,`student_books_details`.`issue_date` AS `issue_date`,`student_books_details`.`return_date` AS `return_date`,`student_books_details`.`booking_status` AS `booking_status`,`student_books_details`.`session` AS `session`,`student_books_details`.`created_at` AS `created_at` from `student_books_details`;

--- Table: student_books_details ---
CREATE TABLE `student_books_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_no` varchar(50) NOT NULL,
  `book_number` varchar(100) NOT NULL,
  `issue_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `booking_status` enum('0','1') DEFAULT '1' COMMENT '1=Issued, 0=Returned',
  `session` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: student_fees_detail ---
CREATE TABLE `student_fees_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_no` varchar(100) NOT NULL,
  `reciept_no` varchar(100) NOT NULL,
  `fees_term` int NOT NULL,
  `fees_amount` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `session` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: student_fine_detail ---
CREATE TABLE `student_fine_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_no` varchar(100) NOT NULL,
  `book_number` varchar(100) NOT NULL,
  `fine_amount` decimal(10,2) NOT NULL,
  `session` varchar(50) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: student_fine_details ---
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_fine_details` AS select `student_fine_detail`.`id` AS `id`,`student_fine_detail`.`registration_no` AS `registration_no`,`student_fine_detail`.`book_number` AS `book_number`,`student_fine_detail`.`fine_amount` AS `fine_amount`,`student_fine_detail`.`session` AS `session`,`student_fine_detail`.`date` AS `date` from `student_fine_detail`;

--- Table: student_info ---
CREATE TABLE `student_info` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_no` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `class` varchar(50) NOT NULL,
  `stream` varchar(50) DEFAULT '0',
  `session` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `registration_no` (`registration_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: student_infos ---
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `student_infos` AS select `student_info`.`id` AS `id`,`student_info`.`registration_no` AS `registration_no`,`student_info`.`name` AS `name`,`student_info`.`class` AS `class`,`student_info`.`stream` AS `stream`,`student_info`.`session` AS `session`,`student_info`.`created_at` AS `created_at` from `student_info`;

--- Table: student_transport_fees_detail ---
CREATE TABLE `student_transport_fees_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_no` varchar(50) NOT NULL,
  `fees_amount` decimal(10,2) NOT NULL,
  `month_id` int NOT NULL,
  `session` varchar(50) NOT NULL,
  `payment_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: subjects ---
CREATE TABLE `subjects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(100) NOT NULL,
  `subject_code` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subject_name` (`subject_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: streams ---
CREATE TABLE `streams` (
  `id` int NOT NULL AUTO_INCREMENT,
  `stream_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `stream_name` (`stream_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: transport ---
CREATE TABLE `transport` (
  `id` int NOT NULL AUTO_INCREMENT,
  `route_name` varchar(100) NOT NULL,
  `vehicle_number` varchar(20) DEFAULT NULL,
  `driver_name` varchar(100) DEFAULT NULL,
  `driver_contact` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: transport_add_route ---
CREATE TABLE `transport_add_route` (
  `route_id` int NOT NULL AUTO_INCREMENT,
  `route_name` varchar(255) NOT NULL,
  `cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`route_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: transport_add_vechile ---
CREATE TABLE `transport_add_vechile` (
  `vechile_id` int NOT NULL AUTO_INCREMENT,
  `vechile_no` varchar(100) NOT NULL,
  `route_id` text,
  `no_of_seats` int DEFAULT '0',
  PRIMARY KEY (`vechile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: transport_student_detail ---
CREATE TABLE `transport_student_detail` (
  `id` int NOT NULL AUTO_INCREMENT,
  `registration_no` varchar(50) NOT NULL,
  `route_id` int NOT NULL,
  `vehicle_id` int NOT NULL,
  `session` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--- Table: users ---
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','Teacher','Student') NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `transport_id` int DEFAULT NULL,
  `class_section` varchar(10) DEFAULT NULL,
  `dept_id` int DEFAULT NULL,
  `pos_id` int DEFAULT NULL,
  `qualification` text,
  `joining_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  KEY `transport_id` (`transport_id`),
  KEY `dept_id` (`dept_id`),
  KEY `pos_id` (`pos_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`transport_id`) REFERENCES `transport` (`id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`dept_id`) REFERENCES `staff_departments` (`id`),
  CONSTRAINT `users_ibfk_3` FOREIGN KEY (`pos_id`) REFERENCES `staff_positions` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

