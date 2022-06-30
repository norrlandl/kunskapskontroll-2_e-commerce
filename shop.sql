-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Värd: localhost:8889
-- Tid vid skapande: 30 jun 2022 kl 09:54
-- Serverversion: 5.7.34
-- PHP-version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `shop`
--

-- --------------------------------------------------------

--
-- Tabellstruktur `orders`
--

CREATE TABLE `orders` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `total_price` int(9) NOT NULL,
  `billing_full_name` varchar(150) NOT NULL,
  `billing_street` varchar(100) NOT NULL,
  `billing_postal_code` varchar(100) NOT NULL,
  `billing_city` varchar(100) NOT NULL,
  `billing_country` varchar(100) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `billing_full_name`, `billing_street`, `billing_postal_code`, `billing_city`, `billing_country`, `create_date`) VALUES
(27, 76, 723, 'MAMP Master Modal', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-27 12:15:26'),
(28, 76, 3420, 'MAMP Master Modal', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-27 13:29:04'),
(29, 76, 747, 'MAMP Master Modal', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-28 08:56:15'),
(32, 76, 2674, 'MAMP Master Modal', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 14:07:01'),
(33, 76, 1445, 'MAMP Master Modal', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 14:08:01'),
(34, 76, 249, 'MAMP Master Modal', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 14:08:26'),
(35, 76, 299, 'MAMP Master Modal', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 14:09:56');

-- --------------------------------------------------------

--
-- Tabellstruktur `order_items`
--

CREATE TABLE `order_items` (
  `id` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `product_title` varchar(150) NOT NULL,
  `quantity` int(9) NOT NULL,
  `unit_price` int(9) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_title`, `quantity`, `unit_price`, `created_at`) VALUES
(63, 27, 18, 'Lofoten', 1, 225, '2022-06-27 12:15:26'),
(64, 27, 19, 'Hermelin', 1, 199, '2022-06-27 12:15:26'),
(65, 27, 20, 'Blå isvattnet', 1, 299, '2022-06-27 12:15:26'),
(66, 28, 20, 'Blå isvattnet', 1, 299, '2022-06-27 13:29:04'),
(67, 28, 21, 'Hytte', 1, 249, '2022-06-27 13:29:04'),
(68, 28, 19, 'Hermelin', 1, 199, '2022-06-27 13:29:04'),
(69, 28, 18, 'Lofoten', 1, 225, '2022-06-27 13:29:04'),
(70, 28, 12, 'Strand', 9, 199, '2022-06-27 13:29:04'),
(71, 28, 9, 'Fiskeby', 1, 199, '2022-06-27 13:29:04'),
(72, 28, 10, 'Gulstugan', 2, 229, '2022-06-27 13:29:04'),
(73, 29, 19, 'Hermelin', 1, 199, '2022-06-28 08:56:15'),
(74, 29, 20, 'Blå isvattnet', 1, 299, '2022-06-28 08:56:15'),
(75, 29, 21, 'Hytte', 1, 249, '2022-06-28 08:56:15'),
(78, 32, 19, 'Hermelin', 5, 199, '2022-06-29 14:07:01'),
(79, 32, 13, 'Grön', 1, 159, '2022-06-29 14:07:01'),
(80, 32, 14, 'Vatten', 5, 259, '2022-06-29 14:07:01'),
(81, 32, 18, 'Lofoten', 1, 225, '2022-06-29 14:07:01'),
(82, 33, 21, 'Hytte', 1, 249, '2022-06-29 14:08:01'),
(83, 33, 20, 'Blå isvattnet', 4, 299, '2022-06-29 14:08:01'),
(84, 34, 21, 'Hytte', 1, 249, '2022-06-29 14:08:26'),
(85, 35, 20, 'Blå isvattnet', 1, 299, '2022-06-29 14:09:56'),
(97, 43, 21, 'Hytte', 1, 249, '2022-06-29 20:53:04'),
(98, 44, 21, 'Hytte', 1, 249, '2022-06-29 20:54:40'),
(99, 45, 10, 'Gulstugan', 3, 229, '2022-06-29 20:56:28'),
(100, 45, 8, 'Senja', 1, 459, '2022-06-29 20:56:28'),
(101, 45, 19, 'Hermelin', 1, 199, '2022-06-29 20:56:28'),
(102, 45, 18, 'Lofoten', 1, 225, '2022-06-29 20:56:28'),
(103, 45, 20, 'Blå isvattnet', 2, 299, '2022-06-29 20:56:28'),
(104, 46, 21, 'Hytte', 1, 249, '2022-06-29 20:56:49'),
(105, 47, 21, 'Hytte', 1, 249, '2022-06-30 07:37:16'),
(106, 48, 19, 'Hermelin', 1, 199, '2022-06-30 08:57:51'),
(107, 48, 20, 'Blå isvattnet', 5, 299, '2022-06-30 08:57:51'),
(108, 48, 10, 'Gulstugan', 2, 229, '2022-06-30 08:57:51'),
(109, 48, 8, 'Senja', 1, 459, '2022-06-30 08:57:51');

-- --------------------------------------------------------

--
-- Tabellstruktur `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(90) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `img_url` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `stock`, `img_url`) VALUES
(7, 'Tur', 'Quisque maximus aliquet elementum. Aenean convallis pretium odio, vitae cursus dolor pharetra nec. Vestibulum quis lobortis sapien. Quisque nunc diam, ullamcorper ac augue sit amet, hendrerit tristique nunc. Pellentesque bibendum, tellus et hendrerit iaculis, erat turpis dictum urna, consectetur consectetur felis ante quis felis. Maecenas lacinia ullamcorper purus non ultricies. Aliquam erat volutpat.', 159, 30, 'norge-5.jpg'),
(8, 'Senja', 'Pellentesque bibendum, tellus et hendrerit iaculis, erat turpis dictum urna, consectetur consectetur felis ante quis felis. Maecenas lacinia ullamcorper purus non ultricies. Aliquam erat volutpat.', 459, 32, 'norge-6.jpg'),
(9, 'Fiskeby', 'Pellentesque bibendum, tellus et hendrerit iaculis, erat turpis dictum urna, consectetur consectetur felis ante quis felis. Maecenas lacinia ullamcorper purus non ultricies. Aliquam erat volutpat.', 199, 22, 'norge-10.jpg'),
(10, 'Gulstugan', 'Aenean convallis pretium odio, vitae cursus dolor pharetra nec. Vestibulum quis lobortis sapien. Quisque nunc diam, ullamcorper ac augue sit amet, hendrerit tristique nunc. Pellentesque bibendum, tellus et hendrerit iaculis, erat turpis dictum urna, consectetur consectetur felis ante quis felis. Maecenas lacinia ullamcorper purus non ultricies. Aliquam erat volutpat.', 229, 13, 'norge-11.jpg'),
(11, 'By', 'Nam cursus non augue at tempus. Cras eu iaculis urna. Vivamus convallis ullamcorper gravida. Nunc elementum at tellus quis maximus. Nullam id velit sapien. Nullam consectetur nulla lorem, nec efficitur neque ullamcorper non.', 299, 18, 'norge-12.jpg'),
(12, 'Strand', 'Vivamus convallis ullamcorper gravida. Nunc elementum at tellus quis maximus. Nullam id velit sapien. Nullam consectetur nulla lorem, nec efficitur neque ullamcorper non.', 199, 24, 'norge-9.jpg'),
(13, 'Grön', 'Nunc elementum at tellus quis maximus. Nullam id velit sapien. Nullam consectetur nulla lorem, nec efficitur neque ullamcorper non. Nam cursus non augue at tempus. Cras eu iaculis urna. Vivamus convallis ullamcorper gravida.', 159, 21, 'norge-8.jpg'),
(14, 'Vatten', 'Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam at sapien nec augue dignissim tincidunt. Sed eget quam at elit auctor faucibus vitae quis velit. Cras vitae eros eget felis varius accumsan. Donec interdum arcu quis odio molestie pharetra non et erat.', 259, 25, 'norge-7.jpg'),
(18, 'Lofoten', 'Duis tincidunt vestibulum felis ut efficitur. Ut varius erat sed lacinia egestas. Donec imperdiet lorem faucibus nunc commodo, sit amet pellentesque nisi tristique. Maecenas mattis, eros ultrices iaculis aliquet, augue tortor suscipit arcu, ut commodo dolor erat non libero. Etiam a eros nec diam imperdiet rutrum ut tristique justo.', 225, 20, 'norge-2.jpg'),
(19, 'Hermelin', 'Maecenas eu erat turpis. Vestibulum pellentesque, urna nec congue accumsan, mi elit bibendum odio, vitae placerat leo mi et velit. Mauris magna neque, pretium vitae lorem in, commodo aliquet quam. In tincidunt faucibus pharetra. Morbi tincidunt efficitur dui, sit amet malesuada nisi mattis sodales.', 199, 15, 'norge-13.jpg'),
(20, 'Blå isvattnet', 'Duis auctor pretium dui, id fringilla est semper et. Curabitur scelerisque auctor magna, in iaculis eros bibendum vel. In ac vestibulum nulla, non tempus metus. Suspendisse vitae eros facilisis lectus fermentum auctor ut ac orci.', 299, 40, 'norge-3.jpg'),
(21, 'Hytte', 'Suspendisse in posuere ligula, at dignissim diam. Nullam rhoncus consequat diam, eu sagittis orci feugiat ut. Nulla id eros et lorem efficitur vehicula.', 249, 22, 'norge-4.jpg');

-- --------------------------------------------------------

--
-- Tabellstruktur `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(60) NOT NULL,
  `phone` varchar(60) NOT NULL,
  `street` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `city` varchar(90) NOT NULL,
  `country` varchar(90) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `phone`, `street`, `postal_code`, `city`, `country`, `create_date`) VALUES
(76, 'MAMP Master', 'Modal Master', 'mamp@hotmail.com', '$2y$12$RMusNaBxoHiaIQ4cdcNl..qFegsHg8irEhfDowDTxVRs0KmGPpIRe', '0703667006', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-27 11:49:06'),
(79, 'Maja', 'Dahlqvist', 'maja@hotmail.com', '$2y$12$imRwuiCLNAor3O/Ih373uOyJ0hVBrjFTqF2tPAs54Gb.cQ8/h9fmS', '0703667006', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 06:52:00'),
(80, 'Frida', 'Karlsson', 'frida@hotmail.com', '$2y$12$Rsp9JWO9HLRm709ZPzCXauEtwGrfiwKTS2G7CjGptyAG00KjMdfgO', '0703667006', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 19:45:08'),
(81, 'Jonna', 'Sundling', 'jonna@hotmail.com', '$2y$12$.Ugjal6suwiw.b4OCEyUTeda9k1TAb7LmhnoHY3/a2Xd7ANltDLJC', '0703667006', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 19:46:40'),
(82, 'Ebba', 'Andersson', 'ebba@hotmail.com', '$2y$12$A1jYU3OYRSiDUqOi5DJqE./JUhY.1Te4TD9oOlDHUgtSvs8FHkS66', '0703667006', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 19:47:05'),
(83, 'Linn', 'Svahn', 'linn@hotmail.com', '$2y$12$Oe99QzT7USDv0WQVr.12j.hahnytRs.toPO.5h8CnlR/JiYfLJHAi', '0703667006', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-29 19:49:22'),
(87, 'Lina', 'Holmlund', 'lina_holmlund@hotmail.com', '$2y$12$sF.EgWcFYyH7c5Q4JLsTGeTOE9d6uBuQJzlYBZzs6FSVLqsVEW70C', '0703667006', 'Åsgatan 35B', '93140', 'Skellefteå', 'Sverige', '2022-06-30 08:53:54');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Index för tabell `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT för tabell `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT för tabell `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT för tabell `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
