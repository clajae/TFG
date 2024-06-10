CREATE DATABASE qwawrodw_vertexBrothers_db;

USE qwawrodw_vertexBrothers_db;

-- vertexBrothers_db.roles definition
CREATE TABLE `roles` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.users definition
CREATE TABLE `users` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password_key` VARCHAR(255) NOT NULL,
  `rol_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_UN` (`email`),
  KEY `users_rol_id_foreign` (`rol_id`),
  CONSTRAINT `users_FK` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.students definition
CREATE TABLE `students` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `nationality` VARCHAR(255) NOT NULL,
  `age` INT NOT NULL,
  `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `rol_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `students_UN` (`email`),
  KEY `students_user_id_foreign` (`user_id`),
  KEY `students_rol_id_foreign` (`rol_id`),
  CONSTRAINT `students_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `students_FK_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.teachers definition
CREATE TABLE `teachers` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `nationality` VARCHAR(255) NOT NULL,
  `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `rol_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `teachers_UN` (`email`),
  KEY `teachers_user_id_foreign` (`user_id`),
  KEY `teachers_rol_id_foreign` (`rol_id`),
  CONSTRAINT `teachers_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `teachers_FK_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.administrators definition
CREATE TABLE `administrators` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(255) NOT NULL,
  `user_id` BIGINT(20) UNSIGNED DEFAULT NULL,
  `rol_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `administrators_UN` (`email`),
  KEY `administrators_user_id_foreign` (`user_id`),
  KEY `administrators_rol_id_foreign` (`rol_id`),
  CONSTRAINT `administrators_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `administrators_FK_1` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.courses definition
CREATE TABLE `courses` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `duration` VARCHAR(255) NOT NULL,
  `num_lessons` INT NOT NULL,
  `teacher_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `courses_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `courses_FK` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.lessons definition
CREATE TABLE `lessons` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `duration` VARCHAR(255) NOT NULL,
  `url` VARCHAR(800) NOT NULL,
  `course_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lessons_course_id_foreign` (`course_id`),
  CONSTRAINT `lessons_FK` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.work_groups definition
CREATE TABLE `work_groups` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `teacher_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `work_groups_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `work_groups_FK` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.students_teachers definition
CREATE TABLE `students_teachers` (
  `student_id` BIGINT(20) UNSIGNED NOT NULL,
  `teacher_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`student_id`, `teacher_id`),
  KEY `students_teachers_student_id_foreign` (`student_id`),
  KEY `students_teachers_teacher_id_foreign` (`teacher_id`),
  CONSTRAINT `students_teachers_FK` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `students_teachers_FK_1` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.students_courses definition
CREATE TABLE `students_courses` (
  `student_id` BIGINT(20) UNSIGNED NOT NULL,
  `course_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`student_id`, `course_id`),
  KEY `students_courses_student_id_foreign` (`student_id`),
  KEY `students_courses_course_id_foreign` (`course_id`),
  CONSTRAINT `students_courses_FK` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `students_courses_FK_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- vertexBrothers_db.students_work_groups definition
CREATE TABLE `students_work_groups` (
  `student_id` BIGINT(20) UNSIGNED NOT NULL,
  `work_group_id` BIGINT(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`student_id`, `work_group_id`),
  KEY `students_work_groups_student_id_foreign` (`student_id`),
  KEY `students_work_groups_work_group_id_id_foreign` (`work_group_id`),
  CONSTRAINT `students_work_groups_FK` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `students_work_groups_FK_1` FOREIGN KEY (`work_group_id`) REFERENCES `work_groups` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos en la tabla `roles`
INSERT INTO roles (name) VALUES
('Estudiante'),
('Profesor'),
('Administrador');

-- Insertar datos en la tabla `users`
INSERT INTO users (name, email, password_key, rol_id) VALUES
('Ana Mendez', 'ana@gmail.com', 'ana', 1),
('David Perez', 'david@gmail.com', 'david', 1),
('Pedro Lopez', 'pedroteacher@gmail.com', 'pedroteacher', 2),
('Antonio Lorenzo', 'antonioteacher@gmail.com', 'antonioteacher', 2),
('Juan David Mendoza', 'juandavidteacher@gmail.com', 'juandavidteacher', 2),
('Juan David Mendoza', 'juandavidadmin@gmail.com', 'juandavidadmin', 3),
('Agustín Sanchez', 'agustinadmin@gmail.com', 'agustinadmin', 3);

-- Insertar datos en la tabla `students`
INSERT INTO students (name, email, password, phone, nationality, age, user_id, rol_id) VALUES
('Ana Mendez', 'ana@gmail.com', 'ana', '987452321', 'Español', 20, 1, 1),
('David Perez', 'david@gmail.com', 'david', '987654321', 'Español', 30, 2, 1);

-- Insertar datos en la tabla `teachers`
INSERT INTO teachers (name, email, password, phone, nationality, user_id, rol_id) VALUES
('Pedro Lopez', 'pedroteacher@gmail.com', 'pedroteacher', '111222333', 'Español', 3, 2),
('Antonio Lorenzo', 'antonioteacher@gmail.com', 'antonioteacher', '987654321', 'Español', 4, 2),
('Juan David Mendoza', 'juandavidteacher@gmail.com', 'juandavidteacher', '987651321', 'Español', 5, 2);

-- Insertar datos en la tabla `administrators`
INSERT INTO administrators (name, email, password, phone, user_id, rol_id) VALUES
('Juan David Mendoza', 'juandavidadmin@gmail.com', 'juandavidadmin', '987654321', 6, 3),
('Agustín Sanchez', 'agustinadmin@gmail.com', 'agustinadmin', '123456789', 7, 3);

-- Insertar datos en la tabla `courses`
INSERT INTO courses (name, duration, num_lessons, teacher_id) VALUES
('Curso 1', '45h 30min', 6, 2),
('Curso 2', '78h 12min', 3, 1);

-- Insertar datos en la tabla `lessons`
INSERT INTO lessons (name, duration, url, course_id) VALUES
('Lección 1', '1h 50min', 'https://www.youtube.com/watch?v=I75CUdSJifw&list=PLU8oAlHdN5BkinrODGXToK9oPAlnJxmW_', 1),
('Lección 2', '2h 12min', 'https://www.youtube.com/watch?v=tXxOAXP-gkg&list=PLU8oAlHdN5BkinrODGXToK9oPAlnJxmW_&index=2', 1),
('Lección 3', '9h 58min', 'https://www.youtube.com/watch?v=qgwDQkPKeE8&list=PLU8oAlHdN5BkinrODGXToK9oPAlnJxmW_&index=3', 1),
('Lección 4', '12h', 'https://www.youtube.com/watch?v=wemLtlYFP7s&list=PLU8oAlHdN5BkinrODGXToK9oPAlnJxmW_&index=4', 1),
('Lección 5', '8h', 'https://www.youtube.com/watch?v=Ja9UVEgAzEw&list=PLU8oAlHdN5BkinrODGXToK9oPAlnJxmW_&index=5', 1),
('Lección 6', '12h', 'https://www.youtube.com/watch?v=IOdmCo_7U6s&list=PLU8oAlHdN5BkinrODGXToK9oPAlnJxmW_&index=6', 1),
('Lección 1', '7h 5min', 'https://www.youtube.com/watch?v=lLsyzBggW_o&list=PLH_tVOsiVGzmnl7ImSmhIw5qb9Sy5KJRE', 2),
('Lección 2', '2h 56min', 'https://www.youtube.com/watch?v=YqSB8WSlb2o&list=PLH_tVOsiVGzmnl7ImSmhIw5qb9Sy5KJRE&index=2', 2),
('Lección 3', '4h 43min', 'https://www.youtube.com/watch?v=BhOTNewtPcE&list=PLH_tVOsiVGzmnl7ImSmhIw5qb9Sy5KJRE&index=3', 2);

-- Insertar datos en la tabla `work_groups`
INSERT INTO work_groups (name, teacher_id) VALUES
('Grupo de Trabajo Pedro Lopez - 1', 1),
('Grupo de Trabajo Pedro Lopez - 2', 1);

-- Insertar datos en la tabla `students_teachers`
INSERT INTO students_teachers (student_id, teacher_id) VALUES
(1, 1),
(2, 1),
(1, 2);

-- Insertar datos en la tabla `students_courses`
INSERT INTO students_courses (student_id, course_id) VALUES
(1, 1),
(1, 2),
(2, 2);

-- Insertar datos en la tabla `students_work_groups`
INSERT INTO students_work_groups (student_id, work_group_id) VALUES
(1, 1),
(2, 1),
(1, 2);
