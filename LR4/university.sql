-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 17 2021 г., 22:30
-- Версия сервера: 10.4.21-MariaDB
-- Версия PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `university`
--

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'ИВТб-191'),
(2, 'ИСТб-191'),
(3, 'ИСТб-211'),
(4, 'ИВТб-201'),
(5, 'ПИб-191');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(11) UNSIGNED NOT NULL,
  `img_path` varchar(45) NOT NULL DEFAULT 'no_img.png',
  `full_name` varchar(45) NOT NULL,
  `id_group` int(10) UNSIGNED NOT NULL,
  `characteristic` varchar(1020) DEFAULT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `img_path`, `full_name`, `id_group`, `characteristic`, `year`) VALUES
(1, 'student_1.jpg', 'Тетерин Вадим Львович', 1, 'Принимает активное участие в общественной и спортивной жизни университета: является членом команды по волейболу.', 2019),
(2, 'student_2.jpg', 'Шашков Григорий Семенович', 3, 'За время учебы зарекомендовал себя добросовестным и дисциплинированным студентом. С учебным планом справляется, средний балл академической успеваемости – 4, 5, задолженности по дисциплинам не имеет, затруднений в учебе не испытывает.', 2021),
(3, 'student_3.jpg', 'Сергеев Арсений Тимурович', 5, 'Характер – спокойный, дружелюбный. Конфликтов избегает, доброжелателен, приветлив, общителен. На критику реагирует правильно.', 2019),
(4, 'student_4.jpg', 'Гурьев Петр Юрьевич', 3, 'Принимал участие в культурно-массовых мероприятиях, организовываемых университетом: день первокурсника и день открытых дверей. Член институтской команды КВН.', 2021),
(5, 'student_5.jpg', 'Суворов Михаил Юрьевич', 4, 'За время учебы показал себя добросовестным и дисциплинированным студентом. С учебным планом справляется, затруднений в учебном процессе не имеет. Средний балл — 4,2. Не пропускает занятия без уважительных причин. ', 2020),
(6, 'student_6.jpg', 'Григорьев Эрик Юлианович', 4, 'Студент активно участвуют во внеучебной жизни группы. Принимает участие в культмассовых мероприятиях. Имеет спокойный характер, позитивное мышление. Спокойно относится к критике, с уважением относится к преподавателям института.', 2020),
(7, 'student_7.jpg', 'Осипов Сергей Парфеньевич', 5, 'За период обучения проявила отличные учебные качества такие как: трудолюбие, выносливость, стрессоустойчивость, усердие, усидчивость, тягу к знаниям.\r\n\r\nСредний балл за первый и второй семестр 2019 – 2021 учебного года составил 5,0.\r\n\r\nТакже были замечены', 2019),
(8, 'student_8.jpg', 'Бирюков Клим Сергеевич', 1, 'За время учебы в колледже проявил себя с положительной стороны, дисциплинированный студент, учится в меру своих возможностей, занятий не пропускает. Активно участвует, во всех мероприятиях, проводимых в колледже и группе.', 2019),
(9, 'student_9.jpg', 'Никифоров Леонтий Натанович', 3, 'Дисциплинирован и тактичен. С коллективом имеет хорошие ровные отношения, не замечен в конфликтных ситуациях.', 2021),
(10, 'student_10.jpg', 'Быков Макар Парфеньевич', 4, 'За время учебы показал себя дисциплинированным и трудолюбивым студентом. Справляется с учебным планом, долгов по экзаменационному контролю не имеет. Средний балл в зачетной книжке — 4.', 2020),
(11, 'student_11.jpg', 'Кулаков Иван Яковович', 5, 'За время учебы зарекомендовал себя добросовестным и дисциплинированным студентом. С учебным планом справляется, средний балл академической успеваемости – 4, 3, задолженности по дисциплинам не имеет, затруднений в учебе не испытывает.', 2019),
(12, 'student_12.jpg', 'Елисеева Юлия Филипповна', 1, 'Дисциплинированная, не допускает пропусков занятий без уважительных причин. Занимает должность старосты. К своим обязанностям относится добросовестно, все поручения и просьбы выполняет ответственно.', 2019),
(13, 'student_13.jpg', 'Козлова Лилия Александровна', 4, 'За период обучения проявила достаточные способности, познавательную активность. Зарекомендовала себя как дисциплинированная, ответственная студентка, иногда допускала пропуски занятий без уважительных причин. ', 2020),
(14, 'student_14.jpg', 'Орехова Полина Вячеславовна', 2, 'Не имеет пропусков занятий без уважительной причины.\r\n\r\nОтношение к общественной работе в группе очень ответственное, к разовым поручениям относится серьезно, не нуждается во внешнем контроле. Отношение со студентами в группе дружелюбные и хорошие.', 2019),
(15, 'student_15.jpg', 'Голубева Дарьяна Давидовна', 2, 'Человеческие качества на высоком уровне. Характеризуется добротой, отзывчивостью, ответственностью, не пропускает занятий без уважительных причин. Имеет привычку всегда завершать начатые дела и относится ко всему с высокой точностью и самоотверженностью. К окружающим требовательна, но справедлива.', 2019),
(16, 'student_16.jpg', 'Логинова Диана Семеновна', 3, 'Зарекомендовала себя как дисциплинированная, ответственная студентка, иногда допускала пропуски занятий без уважительных причин. Учебным материалом овладела преимущественно на достаточном уровне. Училась в меру своих сил, но могла бы иметь и высшие результаты.', 2021),
(17, 'student_17.jpg', 'Лазарева Эвелина Эдуардовна', 1, 'Принимала активное участие в общественной жизни академической группы, отделения и колледжа. Исполняла обязанности культмассового сектора группы, со всеми однокурсниками имела ровные, дружеские отношения.\r\n\r\nОтветственно относилась к обязанностям, разовые поручения выполняла своевременно и добросовестно.', 2019),
(18, 'student_18.jpg', 'Исаева Алёна Арсеньевна', 5, 'За период обучения проявила отличные учебные качества такие как: трудолюбие, выносливость, стрессоустойчивость, усердие, усидчивость, тягу к знаниям.', 2019),
(19, 'student_19.jpg', 'Самсонова Ульяна Прокловна', 3, 'Дисциплинированная, не допускает пропусков занятий без уважительных причин. Имеет авторитет среди товарищей и преподавателей колледжа.\r\nВедёт здоровый образ жизни, не курит, занимается танцами, принимает активное участие в жизни вуза.', 2021),
(20, 'student_20.jpg', 'Сергеева Вера Ивановна', 2, 'Отношение в коллективе дружеские. Без претензий и с охотой помогает неуспевающим, а также выполняет все поручения и требования преподавателей. В группе занимает должность Академсектора, к тому же помогает другим должностным лицам с выполнением их обязанностей.', 2019);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `login` varchar(45) NOT NULL,
  `full_name` varchar(45) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(100) DEFAULT NULL,
  `interests` varchar(100) DEFAULT NULL,
  `vk` varchar(45) NOT NULL,
  `gender` varchar(45) DEFAULT NULL,
  `blood_type` int(11) DEFAULT NULL,
  `factor` varchar(45) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`login`, `full_name`, `birthday`, `address`, `interests`, `vk`, `gender`, `blood_type`, `factor`, `password`) VALUES
('kirill.mdr@gmail.com', 'Кирилл', '1111-11-11', 'г. Волгоград, ул. им. Пожарского, д. 338а', 'авфы', 'https://vk.com/ki_mdr', 'male', 2, 'plus', '$2y$10$KxacoRbuaTiqMQV5hIQ2r.zAgoP0Eb78iIMbXGG5LhVDA7iMZ0KqC');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_1` (`id_group`) USING BTREE;

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `foreign_key_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
