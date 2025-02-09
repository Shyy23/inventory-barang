

INSERT INTO `items`( `item_name`, `category_id`, `location_id`, `stock`, `description`, `image`, `status`) VALUES 
('PC Desktop',1,1,10,'Komputer utama yang digunakan untuk coding, desain, dan pengolahan data. Biasanya memiliki spesifikasi tinggi.','assets/img/products/pc.jpg','available'),
('Laptop',1,1,12,'Perangkat komputer portabel yang digunakan oleh siswa/guru untuk mengerjakan tugas di dalam maupun luar kelas.','assets/img/products/laptop.jpg','available'),
('Router', 2, 2, 15, 'Perangkat yang menghubungkan jaringan lokal ke internet.', 'assets/img/products/router.jpg', 'available'),
('SSD & HDD', 3, 3, 20, 'Penyimpanan data komputer. SSD lebih cepat dibanding HDD.', 'assets/img/products/ssd_hdd.jpg', 'available'),
('OS Windows 11', 4, 4, 15, 'Software utama yang mengelola perangkat keras dan perangkat lunak komputer.', 'assets/img/products/windows.jpg', 'available'),
('Dokumentasi API & Framework', 6, 6, 20, 'Buku atau file referensi tentang framework seperti React, Laravel, atau Spring Boot.', 'assets/img/products/dokumentasi.jpg', 'available'),
('Meja Panjang', 7, 7 , 13, 'Meja khusus untuk menaruh komputer dan perangkat lainnya.','assets/img/products/meja.jpg', 'available'),
('Kipas Pendingin Ruangan', 8, 8, 18, 'Menjaga suhu ruangan tetap sejuk agar komputer tidak cepat panas.', 'assets/img/products/kipas.jpg', 'available'),
('Converter HDMI', 5, 5, 18, 'Kabel untuk menyambungkan monitor dengan komputer atau laptop.', 'assets/img/products/hdmi.jpg', 'available');


INSERT INTO `users`( `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES 
('Ahmad Riyadi', 'ahmadriyadi@example.com', 'siswa', NOW(), '$2y$10$KjRseWwC9f5f6YxQz.eLruJ9tQi.nxZDLVmFb11T0tfj/W1R/JT8m', NULL, NOW(), NOW()),
('Budi Santoso', 'budisantoso@example.com', 'siswa', NOW(), '$2y$10$B8s7d6f8g6fs1wDfpP0C9Bjk.3s7pRfC2FfZuxxU5TzxptGG9.Dk6', NULL, NOW(), NOW()),
('Citra Lestari', 'citralestari@example.com', 'siswa', NOW(), '$2y$10$Z7g6d8k4Lp0Q7fsrGmF5yLJ78RtWYpZt/KL9p.Q3DqpJmsQmHFiXG', NULL, NOW(), NOW()),
('Dewi Anggraini', 'dewianggraini@example.com', 'siswa', NOW(), '$2y$10$V5t6y7Q9fA8d4L3G9ZfGmlP8wF3FfKJpWxQpY7C9sX3DqG9HDfKZ6', NULL, NOW(), NOW()),
('Eko Saputra', 'ekosaputra@example.com', 'siswa', NOW(), '$2y$10$Y8d5K9LfX0Q7GmF5rD9t6A3W8pFqC9sZX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW()),
('Fajar Prasetyo', 'fajarprasetyo@example.com', 'siswa', NOW(), '$2y$10$J5W9d6y7K8L4G3FqM9ZpF8XA9C9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW()),
('Gita Ramadhani', 'gitaramadhani@example.com', 'siswa', NOW(), '$2y$10$R9D6F7L5Q8M3GpF5XA9K9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW()),
('Hadi Wijaya', 'hadiwijaya@example.com', 'siswa', NOW(), '$2y$10$M7Q9D6F5XA8L4GpF9C9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW());

INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `level`) VALUES 


INSERT INTO `subjects`( `subject_name`) VALUES 
('PBO'),
('GameDev'),
('WebDev'),
('Mobile'),
('Database'),
('P5'),

INSERT INTO `users` (`name`, `email`, `level`,`email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES 
('Admin Satu', 'admin1@example.com', NOW(), '$2y$10$A8d6F9Q7L5GpM4X3C9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW(), 'admin'),
('Admin Dua', 'admin2@example.com', NOW(), '$2y$10$X9D7Q6L5F8M3GpF9CA9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW(), 'admin');

INSERT INTO `users` (`name`, `email`,`level`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES 
('Siti Aisyah', 'siti.aisyah@example.com','admin',  NOW(), '$2y$10$KJ9f7Ls8X3DqpY7fG9pJmsQmHFiXG9D6F5XA8M', NULL, NOW(), NOW()),
('Bambang Supriyadi', 'bambang.supriyadi@example.com','admin',  NOW(), '$2y$10$A9F7X3DqpY7fG9pJmsQmHFiXG9D6F5XA8M', NULL, NOW(), NOW()),
('Nurul Hidayah', 'nurul.hidayah@example.com', 'admin',  NOW(), '$2y$10$M8D7Q9F5XA3GpF9CA9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW()),
('Hendri Setiawan', 'hendri.setiawan@example.com', 'admin',  NOW(), '$2y$10$Q7D9F5XA3GpF9CA9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW()),
('Dewi Kartika', 'dewi.kartika@example.com', 'admin',  NOW(), '$2y$10$X9D7Q6L5F8M3GpF9CA9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW()),
('Joko Priyono', 'joko.priyono@example.com', 'admin',  NOW(), '$2y$10$Y8D7F9Q6L5XA3GpF9CA9sX3DqpY7fG9pJmsQmHFiXG', NULL, NOW(), NOW());

INSERT INTO `abcs`( `abc_name`) VALUES 
('A'),
('B'),
('C')

INSERT INTO `locations`( `location_name`) VALUES
 ('Lemari  A'),
 ('Lemari  B'),
 ('Lemari  C'),
 ('Lemari  D'),
 ('Lemari  E'),
 ('Lemari  F'),
 ('Lemari  G'),
 ('Lemari  H'),
 ('Lemari  I'),
 ('Lemari  J')

 INSERT INTO `subjects`(`subject_name`) VALUES 
 ('P5'),
 ('PBO'),
 ('GameDev'),
 ('Mobile'),
 ('WebDev'),
 ('Database'),
 ('Informatika'),
 ('UI/UX'),
 ('IPAS')

 INSERT INTO `classes`( `level`, `major`, `abc_id`) VALUES 
 ('10','RPL',1),
 ('10','RPL',2),
 ('11','RPL',1),
 ('11','RPL',2),
 ('12','RPL',1),
 ('12','RPL',2)

INSERT INTO `categories`(`category_id`, `category_name`) VALUES
(1, 'Komputer & Laptop'),  
(2, 'Monitor & Peripherals'),  
(3, 'Komponen Hardware'),  
(4, 'Jaringan & Networking'),  
(5, 'Alat Elektronik'),  
(6, 'Software & Lisensi'),  
(7, 'Meja & Kursi Kerja'),  
(8, 'Buku & Modul Pembelajaran'),  
(9, 'Aksesoris & Kabel'),  
(10, 'Alat Kebersihan & Perawatan')

INSERT INTO `users`(`nomor_induk`, `role`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES 
('198607232010121001', 'admin', 'admin1@example.com', NOW(), 'hashed_password_1', NULL, NOW(), NOW()),
('198507152009111002', 'admin', 'admin2@example.com', NOW(), 'hashed_password_2', NULL, NOW(), NOW()),
('197912312005061003', 'admin', 'admin3@example.com', NOW(), 'hashed_password_3', NULL, NOW(), NOW()),
('198203211999081004', 'admin', 'admin4@example.com', NOW(), 'hashed_password_4', NULL, NOW(), NOW()),
('199011052012091005', 'admin', 'admin5@example.com', NOW(), 'hashed_password_5', NULL, NOW(), NOW()),

('1234567890', 'siswa', 'siswa1@example.com', NOW(), 'hashed_password_6', NULL, NOW(), NOW()),
('1234567891', 'siswa', 'siswa2@example.com', NOW(), 'hashed_password_7', NULL, NOW(), NOW()),
('1234567892', 'siswa', 'siswa3@example.com', NOW(), 'hashed_password_8', NULL, NOW(), NOW()),
('1234567893', 'siswa', 'siswa4@example.com', NOW(), 'hashed_password_9', NULL, NOW(), NOW()),
('1234567894', 'siswa', 'siswa5@example.com', NOW(), 'hashed_password_10', NULL, NOW(), NOW());

INSERT INTO `items`( `item_name`, `category_id`, `location_id`, `stock`, `description`, `image`, `status`) VALUES 
('PC Desktop',1,1,10,'Komputer utama yang digunakan untuk coding, desain, dan pengolahan data. Biasanya memiliki spesifikasi tinggi.','assets/img/products/pc.jpg','available'),
('Laptop',1,1,12,'Perangkat komputer portabel yang digunakan oleh siswa/guru untuk mengerjakan tugas di dalam maupun luar kelas.','assets/img/products/laptop.jpg','available'),
('Router', 2, 2, 15, 'Perangkat yang menghubungkan jaringan lokal ke internet.', 'assets/img/products/router.jpg', 'available'),
('SSD & HDD', 3, 3, 20, 'Penyimpanan data komputer. SSD lebih cepat dibanding HDD.', 'assets/img/products/ssd_hdd.jpg', 'available'),
('OS Windows 11', 4, 4, 15, 'Software utama yang mengelola perangkat keras dan perangkat lunak komputer.', 'assets/img/products/windows.jpg', 'available'),
('Dokumentasi API & Framework', 6, 6, 20, 'Buku atau file referensi tentang framework seperti React, Laravel, atau Spring Boot.', 'assets/img/products/dokumentasi.jpg', 'available'),
('Meja Panjang', 7, 7 , 13, 'Meja khusus untuk menaruh komputer dan perangkat lainnya.','assets/img/products/meja.jpg', 'available'),
('Kipas Pendingin Ruangan', 8, 8, 18, 'Menjaga suhu ruangan tetap sejuk agar komputer tidak cepat panas.', 'assets/img/products/kipas.jpg', 'available'),
('Converter HDMI', 5, 5, 18, 'Kabel untuk menyambungkan monitor dengan komputer atau laptop.', 'assets/img/products/hdmi.jpg', 'available');
('Projector & Screen', 5, 5, 15, 'Digunakan untuk presentasi materi pembelajaran.', 'assets/img/products/projector.jpg', 'available')

INSERT INTO `item_units`( `item_id`, `unit_name`, `unit_status`, `unit_image`) VALUES 
('[value-2]','[value-3]','[value-4]','[value-5]')

assets/img/products/projectors/1.jpg
assets/img/products/laptops/1.jpg


INSERT INTO `teachers`(`user_id`, `name`, `nip`, `gender`, `teacher_role`, `phone_number`, `address`) VALUES
(1, 'Admin 1', '198607232010121001', 'M', 'subject_teacher', '081234567890', 'Jl. Merdeka No. 1'),
(2, 'Admin 2', '198507152009111002', 'F', 'subject_teacher', '081234567891', 'Jl. Pancasila No. 2'),
(3, 'Admin 3', '197912312005061003', 'M', 'subject_teacher', '081234567892', 'Jl. Bhinneka No. 3'),
(4, 'Admin 4', '198203211999081004', 'F', 'subject_teacher', '081234567893', 'Jl. Persatuan No. 4'),
(5, 'Admin 5', '199011052012091005', 'M', 'subject_teacher', '081234567894', 'Jl. Kebangsaan No. 5');

INSERT INTO `students`(`user_id`, `name`, `nisn`, `gender`, `class_id`, `phone_number`, `address`) VALUES
(6, 'Siswa 1', '1234567890', 'M', 3, '081234567895', 'Jl. Pendidikan No. 1'),
(7, 'Siswa 2', '1234567891', 'F', 3, '081234567896', 'Jl. Ilmu No. 2'),
(8, 'Siswa 3', '1234567892', 'M', 4, '081234567897', 'Jl. Pengetahuan No. 3'),
(9, 'Siswa 4', '1234567893', 'F', 4, '081234567898', 'Jl. Teknologi No. 4'),
(10, 'Siswa 5', '1234567894', 'M', 3, '081234567899', 'Jl. Inovasi No. 5');

INSERT INTO `teacher_details`(`teacher_id`, `class_id`, `subject_id`, `academic_year`) VALUES
(1, 3, 2, '2024/2025'),
(2, 3, 3, '2024/2025'),
(3, 4, 4, '2024/2025'),
(4, 4, 5, '2024/2025'),
(5, 3, 6, '2024/2025');


