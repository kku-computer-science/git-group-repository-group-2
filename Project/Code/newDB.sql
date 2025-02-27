CREATE TABLE Users (
    userId BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    scholarId VARCHAR(20),
    fname_en VARCHAR(100),
    fname_th VARCHAR(100),
    lname_en VARCHAR(100),
    lname_th VARCHAR(100),
    email VARCHAR(50),
    username VARCHAR(50),
    password VARCHAR(50),
    academic_ranks_en VARCHAR(25),
    academic_ranks_th VARCHAR(25),
    doctoral_degree VARCHAR(5),
    position_th VARCHAR(50),
    position_en VARCHAR(50),
    title_name_en VARCHAR(10),
    title_name_th VARCHAR(10),
    picture VARCHAR(50),
    isAuthor BOOLEAN
);

CREATE TABLE Education (
    EduId BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userId BIGINT(20) UNSIGNED,
    year VARCHAR(4),
    degree VARCHAR(50),
    field_of_study VARCHAR(100),
    institution VARCHAR(100),
    FOREIGN KEY (userId) REFERENCES Users(userId)
);

CREATE TABLE Author (
    authorId BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    author_fname_en VARCHAR(50),
    author_fname_th VARCHAR(50),
    author_lname_en VARCHAR(50),
    author_lname_th VARCHAR(50)
);

CREATE TABLE Papergroup (
    groupId BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    userId BIGINT(20) UNSIGNED,
    authorId BIGINT(20) UNSIGNED,
    FOREIGN KEY (userId) REFERENCES Users(userId),
    FOREIGN KEY (authorId) REFERENCES Author(authorId)
);

CREATE TABLE Sourcepaper (
    sourceId BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    sourceName VARCHAR(20)
);

CREATE TABLE Paper (
    paperId BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    groupId BIGINT(20) UNSIGNED,
    sourceId BIGINT(20) UNSIGNED,
    paperName TEXT,
    paperType VARCHAR(50),
    paperSubType VARCHAR(50),
    paperYear INT(4),
    paperVolume VARCHAR(50),
    paperCite INT(11),
    paperPage VARCHAR(50),
    paperDoi VARCHAR(100),
    FOREIGN KEY (groupId) REFERENCES Papergroup(groupId),
    FOREIGN KEY (sourceId) REFERENCES Sourcepaper(sourceId)
);

INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('urachart@kku.ac.th', 'Urachart', 'Kokaew', 'อุรฉัตร', 'โคแก้ว', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นาง', 'Mrs.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('ngamnij@kku.ac.th', 'Ngamnij', 'Arch-int', 'งามนิจ', 'อาจอินทร์', 'Ph.D.', 'Associate Professor', 'รองศาสตราจารย์', 'Assoc. Prof. Dr.', 'รศ.ดร.', 'นาง', 'Mrs.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('chakso@kku.ac.th', 'Chakchai', 'So-In', 'จักรชัย', 'โสอินทร์', 'Ph.D.', 'Associate Professor', 'รองศาสตราจารย์', 'Assoc. Prof. Dr.', 'รศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('somjit@kku.ac.th', 'Somjit', 'Arch-int', 'สมจิตร', 'อาจอินทร์', 'Ph.D.', 'Associate Professor', 'รองศาสตราจารย์', 'Assoc. Prof. Dr.', 'รศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('chaiyapon@kku.ac.th', 'Chaiyapon', 'Keeratikasikorn', 'ชัยพล', 'กีรติกสิกร', 'Ph.D.', 'Associate Professor', 'รองศาสตราจารย์', 'Assoc. Prof. Dr.', 'รศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('punhor1@kku.ac.th', 'Punyaphol', 'Horata', 'ปัญญาพล', 'หอระตะ', 'Ph.D.', 'Associate Professor', 'รองศาสตราจารย์', 'Assoc. Prof. Dr.', 'รศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('wongsar@kku.ac.th', 'Sartra', 'Wongthanavasu', 'ศาสตรา', 'วงศ์ธนวสุ', 'Ph.D.', 'Professor', 'ศาสตราจารย์', 'Prof. Dr.', 'ศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('sunkra@kku.ac.th', 'Sirapat', 'Chiewchanwattana', 'สิรภัทร', 'เชี่ยวชาญวัฒนา', 'Ph.D.', 'Associate Professor', 'รองศาสตราจารย์', 'Assoc. Prof. Dr.', 'รศ.ดร.', 'นาง', 'Mrs.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('skhamron@kku.ac.th', 'Khamron', 'Sunat', 'คำรณ', 'สุนัติ', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('chitsutha@kku.ac.th', 'Chitsutha', 'Soomlek', 'ชิตสุธา', 'สุ่มเล็ก', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นางสาว', 'Miss');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('nagon@kku.ac.th', 'Nagon', 'Watanakij', 'ณกร', 'วัฒนกิจ', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('sumkas@kku.ac.th', 'Sumonta', 'Kasemvilas', 'สุมณฑา', 'เกษมวิลาศ', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นางสาว', 'Miss');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('wpaweena@kku.ac.th', 'Paweena', 'Wanchai', 'ปวีณา', 'วันชัย', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นางสาว', 'Miss');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('reungsang@kku.ac.th', 'Pipat', 'Reungsang', 'พิพัธน์', 'เรืองแสง', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('pusadee@kku.ac.th', 'Pusadee', 'Seresangtakul', 'พุธษดี', 'ศิริแสงตระกูล', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นางสาว', 'Miss');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('monlwa@kku.ac.th', 'Monlica', 'Wattana', 'มัลลิกา', 'วัฒนะ', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นางสาว', 'Miss');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('wararat@kku.ac.th', 'Wararat', 'Songpan', 'วรารัตน์', 'สงฆ์แป้น', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นาง', 'Mrs.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('praipa@kku.ac.th', 'Praisan', 'Padungweang', 'ไพรสันต์', 'ผดุงเวียง', 'Ph.D.', 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('saiyan@kku.ac.th', 'Saiyan', 'Saiyod', 'สายยัญ', 'สายยศ', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('silain@kku.ac.th', 'Silada', 'Intarasothonchun', 'สิลดา', 'อินทรโสธรฉันท์', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นางสาว', 'Miss');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('rasamee@kku.ac.th', 'Rasamee', 'Suwanwerakamtorn', 'รัศมี', 'สุวรรณวีระกำธร', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นาง', 'Mrs.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('curawa@kku.ac.th', 'Urawan', 'Chanket', 'อุราวรรณ', 'จันทร์เกษ', 'Ph.D.', 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof. Dr.', 'ผศ.ดร.', 'นางสาว', 'Miss');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('phetim@kku.ac.th', 'Phet', 'Aimtongkham', 'เพชร', 'อิ่มทองคำ', 'Ph.D.', 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('twachi@kku.ac.th', 'Wachirawut', 'Thamviset', 'วชิราวุธ', 'ธรรมวิเศษ', 'Ph.D.', 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('waruwu@kku.ac.th', 'Warunya', 'Wunnasri', 'วรัญญา', 'วรรณศรี', 'Ph.D.', 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.ดร.', 'นางสาว', 'Miss');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('rapassit@kku.ac.th', 'Rapassit', 'Chinnapatjee', 'รภัสสิทธิ์', 'ชินภัทรจีรัสถ์', 'Ph.D.', 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('sakpod@kku.ac.th', 'Sakpod', 'Tongleamnak', 'ศักดิ์พจน์', 'ทองเลี่ยมนาค', 'Ph.D.', 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.ดร.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('thanaphon@kku.ac.th', 'Thanaphon', 'Tangchoopong', 'ธนพล', 'ตั้งชูพงศ์', NULL, 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('sarunap@kku.ac.th', 'Sarun', 'Apichontrakul', 'ศรัณย์', 'อภิชนตระกูล', NULL, 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('admin@gmail.com', 'admin', '-', 'ผู้ดูแลระบบ', '-', NULL, NULL, NULL, NULL, NULL, 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('chanode@kku.ac.th', 'Chanon', 'Dechsupa', 'ชานนท์', 'เดชสุภา', NULL, 'Lecturer', 'อาจารย์', 'Lecturer', 'อ.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('sunti@kku.ac.th', 'Sunti', 'Tintanai', 'สันติ', 'ทินตะนัย', NULL, 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof.', 'ผศ.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('Boonsup@kku.ac.th', 'Boonsup', 'Waikham', 'บุญทรัพย์', 'ไวคำ', NULL, 'Assistant Professor', 'ผู้ช่วยศาสตราจารย์', 'Asst. Prof.', 'ผศ.', 'นาย', 'Mr.');
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('staff@gmail.com', 'staff', '-', 'เจ้าหน้าที่', '-', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('test@gmail.com', 'watcharawatchara', 'sritionwong', 'วัชระวัชระ', 'ศรีต้นวงศ์', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('watchara@kkumail.com', 'watchara', 'sritonwong', 'วัชระ ', 'ศรีต้นวงศ์', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('adidorn@kkumail.com', 'adisorn', 'naruang', 'อดิศร', 'นาเรือง', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('pongsathon.janyoi@kkumail.com', 'Pongsathon', 'Janyoi', 'พงษ์ศธร', 'จันทรย้อย', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('rojanha@kku.ac.th', '-', '-', 'โรจนวรรณ', 'หาดี', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('Natech@kku.ac.th', '-', '-', 'เนตรนรินทร์', 'ชนะบัว', NULL, NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO users (email, fname_en, lname_en, fname_th, lname_th, doctoral_degree, academic_ranks_en, academic_ranks_th, position_en, position_th, title_name_th, title_name_en) VALUES ('noirattikorn@gmail.com', '-', '-', 'รัตติกร', 'แทนเพชร', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

