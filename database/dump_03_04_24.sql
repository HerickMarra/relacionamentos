-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 09/04/2024 às 23:00
-- Versão do servidor: 10.6.17-MariaDB
-- Versão do PHP: 8.1.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `homol_privateherick`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `emotions`
--

CREATE TABLE `emotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emotion` enum('happy','alert','serious') NOT NULL DEFAULT 'happy',
  `visible` enum('true','false') NOT NULL DEFAULT 'true',
  `level` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `emotions`
--

INSERT INTO `emotions` (`id`, `emotion`, `visible`, `level`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'serious', 'true', 5, 'Apagou mensagem', 2, '2024-03-15 14:34:27', '2024-03-15 14:34:27'),
(2, 'happy', 'true', 8, 'Foi atencioso', 2, '2024-03-15 14:34:49', '2024-03-15 14:34:49'),
(4, 'happy', 'true', 5, ' ', 2, '2024-03-15 14:34:55', '2024-03-15 14:34:55'),
(5, 'happy', 'true', 1, 'Se importa muito', 2, '2024-03-15 14:35:09', '2024-03-15 14:35:09'),
(6, 'happy', 'true', 3, 'Disse que me ama', 2, '2024-03-15 14:35:30', '2024-03-15 14:35:30'),
(7, 'happy', 'true', 5, 'Carinhoso', 2, '2024-03-15 14:36:09', '2024-03-15 14:36:09'),
(8, 'alert', 'false', 1, 'Impaciente, não consegue esperar minnhas respostas', 2, '2024-03-15 14:37:03', '2024-03-15 14:37:03'),
(9, 'happy', 'false', 1, 'Cheiroso, perfume que eu gosto', 2, '2024-03-15 14:37:29', '2024-03-15 14:37:29'),
(10, 'happy', 'false', 4, 'Me ajudou no perrengue de ter pego ônibus errado', 2, '2024-03-15 14:38:15', '2024-03-15 14:38:15'),
(11, 'happy', 'false', 7, 'Colocou crédito pra mim sem nem eu pedir, só  pra poder falar comigo', 2, '2024-03-15 14:39:08', '2024-03-15 14:39:08'),
(12, 'happy', 'true', 10, 'Saiu cmg para o potiguar.', 1, '2024-03-16 14:16:36', '2024-03-16 14:16:36'),
(13, 'alert', 'false', 10, 'Falou muito de pessoas não desejadas.', 1, '2024-03-16 14:17:21', '2024-03-16 14:17:21'),
(14, 'happy', 'true', 5, 'Me deu uma rosa', 2, '2024-03-16 14:27:58', '2024-03-16 14:27:58'),
(15, 'happy', 'true', 8, 'Passou tempo de qualidade comigo no potiguar', 2, '2024-03-16 14:28:25', '2024-03-16 14:28:25'),
(16, 'happy', 'true', 4, 'Cancelou o uber pra andar comigo', 2, '2024-03-16 14:30:36', '2024-03-16 14:30:36'),
(17, 'alert', 'true', 1, 'Acha que eu trairia ele', 2, '2024-03-16 14:31:08', '2024-03-16 14:31:08'),
(18, 'happy', 'true', 5, 'Passou no pátio pra me ver', 2, '2024-03-18 00:32:27', '2024-03-18 00:32:27'),
(19, 'happy', 'true', 5, 'Me deu uma cartinha e um bis', 2, '2024-03-18 00:32:55', '2024-03-18 00:32:55'),
(20, 'happy', 'true', 5, 'Foi na casa da kamila me buscar pra passar tempo comigo', 2, '2024-03-18 00:33:34', '2024-03-18 00:33:34'),
(21, 'alert', 'true', 2, 'Está banalizando o 10 vermelho', 2, '2024-03-18 19:51:30', '2024-03-18 19:51:30'),
(22, 'happy', 'true', 8, 'Não só desembaraçou meu cabelo como um mestre, mas também faz questão de aprender a finalizar e fazer penteados.', 2, '2024-03-18 19:52:48', '2024-03-18 19:52:48'),
(24, 'happy', 'true', 10, 'Se afastou do aires', 1, '2024-03-19 13:14:45', '2024-03-19 13:14:45'),
(25, 'happy', 'true', 5, 'Me deu cartinha chocolate cacau show', 1, '2024-03-19 13:18:13', '2024-03-19 13:18:13'),
(26, 'serious', 'true', 5, 'Ao sair some do whats, por horas.', 1, '2024-03-19 18:05:15', '2024-03-19 18:05:15'),
(27, 'serious', 'true', 5, 'Muito homens ao redor.', 1, '2024-03-19 18:21:26', '2024-03-19 18:21:26'),
(28, 'happy', 'true', 8, 'Me trata com carinho.', 1, '2024-03-19 21:03:56', '2024-03-19 21:03:56'),
(29, 'happy', 'true', 5, 'Saiu para comer hambúrguer cmg', 1, '2024-03-20 13:48:29', '2024-03-20 13:48:29'),
(30, 'happy', 'true', 4, 'Ficou acordada até tarde cmg', 1, '2024-03-20 19:22:09', '2024-03-20 19:22:09'),
(31, 'happy', 'true', 10, 'É a garota maís incrível ❤️', 1, '2024-03-21 07:57:53', '2024-03-21 07:57:53'),
(32, 'alert', 'true', 1, 'Não entra no app diariamente', 1, '2024-03-21 07:58:11', '2024-03-21 07:58:11'),
(33, 'happy', 'true', 6, 'Foi pra academia cmg', 2, '2024-03-21 14:28:21', '2024-03-21 14:28:21'),
(34, 'happy', 'true', 2, 'Foi na minha hamburgueria favorita de Planaltina cmg🥰, dei só 2 de nota pq n queria engordar :(', 2, '2024-03-21 14:30:19', '2024-03-21 14:30:19'),
(35, 'happy', 'true', 3, 'Lembrou que eu estava com vontede de comer kinder ovo e me deu, junto com bis e raffaelo. Mas é tudo um plano pra me engordar :(', 2, '2024-03-22 14:04:02', '2024-03-22 14:04:02'),
(36, 'happy', 'true', 5, 'Fez massagem no meu pé, todas as vezes que eu pedi.', 2, '2024-03-22 14:04:40', '2024-03-22 14:04:40'),
(37, 'happy', 'true', 7, 'Penteou o meu cabelo', 2, '2024-03-22 15:20:28', '2024-03-22 15:20:28'),
(38, 'happy', 'true', 5, 'Fez café da manhã gostoso pra mim', 2, '2024-03-22 15:20:41', '2024-03-22 15:20:41'),
(39, 'happy', 'true', 10, 'Jogou life strange cmg ❤️', 1, '2024-03-23 03:29:23', '2024-03-23 03:29:23'),
(40, 'alert', 'true', 1, 'Falou pra minha avó que não namoramos.', 1, '2024-03-23 03:29:44', '2024-03-23 03:29:44'),
(41, 'happy', 'true', 10, 'Sempre é muito compreensiva comigo.', 1, '2024-03-24 06:30:17', '2024-03-24 06:30:17'),
(42, 'alert', 'true', 1, 'Brigou comigo', 1, '2024-03-24 06:30:46', '2024-03-24 06:30:46'),
(43, 'happy', 'true', 5, 'Foi paciente cmg, e me entendeu', 1, '2024-03-24 18:31:19', '2024-03-24 18:31:19'),
(44, 'happy', 'true', 5, 'Me perdoou, e não ficou brava ❤️', 1, '2024-03-24 18:31:47', '2024-03-24 18:31:47'),
(45, 'happy', 'true', 10, 'Zeramos o It takes Two ihuuul! ❤️', 1, '2024-03-26 02:47:20', '2024-03-26 02:47:20'),
(46, 'serious', 'true', 6, 'Desrespeitou minha vontade, e foi para o rolê só pra pesar o clima', 2, '2024-03-27 20:34:47', '2024-03-27 20:34:47'),
(47, 'happy', 'true', 8, 'Passou a  tarde comigo e terminamos it takes two', 2, '2024-03-27 20:35:50', '2024-03-27 20:35:50'),
(48, 'happy', 'true', 1, 'Me acha gostosa, e disse que tá adirando só o meu corpo', 2, '2024-03-29 16:42:40', '2024-03-29 16:42:40'),
(49, 'alert', 'true', 2, 'Atrapalhou o meu sono', 2, '2024-03-29 16:42:55', '2024-03-29 16:42:55'),
(50, 'happy', 'true', 5, 'Foi no face Bar cmg ❤️', 1, '2024-03-30 23:06:37', '2024-03-30 23:06:37'),
(51, 'happy', 'true', 9, 'Passou muito tempo cmg 💓', 1, '2024-03-30 23:07:37', '2024-03-30 23:07:37'),
(52, 'alert', 'true', 2, 'Me fez comer muito e quase passar mal', 1, '2024-03-30 23:08:04', '2024-03-30 23:08:04'),
(53, 'happy', 'true', 10, 'Passou mt tempo cmg, e de qualidade', 2, '2024-03-31 03:52:30', '2024-03-31 03:52:30'),
(55, 'alert', 'true', 3, 'Quebrou o pescoço pra olhar pra mulher', 2, '2024-03-31 03:55:04', '2024-03-31 03:55:04'),
(56, 'alert', 'true', 6, 'Teimou pra deixar eu ver o cll velho', 2, '2024-03-31 03:55:34', '2024-03-31 03:55:34'),
(58, 'happy', 'true', 5, 'Elogiou bastante', 2, '2024-03-31 03:57:27', '2024-03-31 03:57:27'),
(59, 'alert', 'true', 2, 'Não pintou nem fez biscuit que tinhamos combinado de fazer', 2, '2024-03-31 03:58:33', '2024-03-31 03:58:33'),
(60, 'happy', 'true', 5, 'Foi andando até o potiguar pq eu pedi', 2, '2024-03-31 03:58:54', '2024-03-31 03:58:54'),
(61, 'happy', 'true', 5, 'Assistiu e apreciou a viagem de shihito comigo', 2, '2024-03-31 05:51:12', '2024-03-31 05:51:12'),
(62, 'serious', 'true', 5, 'Apagou msg', 2, '2024-03-31 06:32:16', '2024-03-31 06:32:16'),
(63, 'happy', 'true', 8, 'Foi ao teatro comigo e lanchinho dps', 2, '2024-04-01 15:34:12', '2024-04-01 15:34:12'),
(64, 'alert', 'true', 4, 'Eduarda osorio', 2, '2024-04-01 15:34:44', '2024-04-01 15:34:44'),
(65, 'alert', 'true', 1, 'Fingiu que assistiu castelo animado', 2, '2024-04-01 23:12:33', '2024-04-01 23:12:33'),
(66, 'happy', 'true', 4, 'Aguentou 3', 2, '2024-04-01 23:12:46', '2024-04-01 23:12:46'),
(67, 'happy', 'true', 10, 'Passou muito tempo de qualidade cmg  💓', 1, '2024-04-02 00:42:29', '2024-04-02 00:42:29'),
(68, 'happy', 'true', 10, 'Me deu ovos de páscoa', 1, '2024-04-02 00:42:44', '2024-04-02 00:42:44'),
(69, 'happy', 'true', 10, 'Me deu uma magnífica cartinha junto com os chocolates', 1, '2024-04-02 00:43:11', '2024-04-02 00:43:11'),
(70, 'happy', 'true', 5, 'Foi ao teatro lanchamos e dormiu cmg ❤️', 1, '2024-04-02 00:44:28', '2024-04-02 00:44:28'),
(71, 'happy', 'true', 6, 'Assistimos dois filmes do Studio Ghibli', 1, '2024-04-02 00:45:40', '2024-04-02 00:45:40'),
(72, 'alert', 'true', 3, 'Brigou cmg sobre garotas no meu insta sendo que a balança não está igual, e eu tô parando de seguir todas 💔❤️‍🩹', 1, '2024-04-02 00:47:02', '2024-04-02 00:47:02'),
(73, 'alert', 'true', 1, 'Ameaçou ir embora só pq a confrontei 😢', 1, '2024-04-02 00:53:11', '2024-04-02 00:53:11'),
(74, 'happy', 'true', 5, 'Me deu uma cartinha de duplo sentido', 1, '2024-04-02 00:53:39', '2024-04-02 00:53:39'),
(75, 'happy', 'true', 8, 'Me ajudou a deixar as unhas, sobrancelhas e pernas bonitas', 2, '2024-04-02 02:50:42', '2024-04-02 02:50:42'),
(76, 'happy', 'true', 10, 'É a garota maís incrível desse mundo todo.', 1, '2024-04-04 05:22:53', '2024-04-04 05:22:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `status` enum('pendente','confirmado','cancelado') DEFAULT 'pendente',
  `act` enum('youtube','link','desc') DEFAULT NULL,
  `act_link` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `events`
--

INSERT INTO `events` (`id`, `picture`, `title`, `desc`, `status`, `act`, `act_link`, `date`, `created_at`, `updated_at`) VALUES
(1, '/img/evento.png', 'Arturo Ui', NULL, 'confirmado', 'link', 'https://www.instagram.com/p/C4QhPjysSPD/?igsh=MTAwNjQ1cTY1MzMzNg==', '2024-03-31', '2024-03-28 16:02:43', '2024-03-28 16:02:44'),
(2, '/uploads/events/kungfu.jpeg', 'Cinema', NULL, 'pendente', NULL, NULL, '2024-04-18', NULL, NULL),
(3, '/uploads/events/o-melhor-brinquedo.jpg', 'Nocolândia', NULL, 'pendente', NULL, NULL, '2024-04-21', NULL, NULL),
(4, 'https://bolixe.com.br/wp-content/uploads/2019/04/Boliche-Para-Idosos.jpg', 'boliche pier 21', NULL, 'confirmado', 'link', 'https://www.strikerdf.com.br/', '2024-05-23', '2024-04-04 02:13:43', '2024-04-04 02:13:43'),
(5, 'https://i0.wp.com/nerdizmo.uai.com.br/wp-content/uploads/sites/29/2021/03/8-itens-que-todo-mestre-de-rpg-gostaria-de-ter-nerdizmo-capa.jpg?fit=950%2C500&ssl=1', 'RPG amigos Rafah', NULL, 'confirmado', NULL, NULL, '2024-04-13', '2024-04-04 02:19:18', '2024-04-04 02:19:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_03_04_031908_create_notifications_table', 1),
(6, '2024_03_07_121438_add_last_login_to_users_table', 2),
(8, '2024_03_12_231431_create_emotions_table', 3),
(9, '2024_03_19_010553_adicionar_colunas_a_notifications', 4),
(10, '2024_03_28_155521_create_events_table', 5),
(11, '2024_03_28_221949_create_records_table', 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification` text NOT NULL,
  `status` enum('visualizada','pendente') NOT NULL DEFAULT 'pendente',
  `image` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `subdesc` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `notifications`
--

INSERT INTO `notifications` (`id`, `notification`, `status`, `image`, `color`, `subdesc`, `desc`, `title`, `icon`, `user_id`, `created_at`, `updated_at`) VALUES
(44, '', 'visualizada', '/img/anne.jpg', '#FC1A1A', '5/10', 'Apagou mensagem', 'Rafaelah', 'bi bi-exclamation-octagon-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(45, '', 'visualizada', '/img/anne.jpg', '#3BB900', '8/10', 'Foi atencioso', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(46, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', ' ', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(47, '', 'visualizada', '/img/anne.jpg', '#3BB900', '1/10', 'Se importa muito', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(48, '', 'visualizada', '/img/anne.jpg', '#3BB900', '3/10', 'Disse que me ama', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(49, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Carinhoso', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(50, '', 'visualizada', '/img/anne.jpg', '#FFB800', '1/10', 'Impaciente, não consegue esperar minnhas respostas', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(51, '', 'visualizada', '/img/anne.jpg', '#3BB900', '1/10', 'Cheiroso, perfume que eu gosto', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(52, '', 'visualizada', '/img/anne.jpg', '#3BB900', '4/10', 'Me ajudou no perrengue de ter pego ônibus errado', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(53, '', 'visualizada', '/img/anne.jpg', '#3BB900', '7/10', 'Colocou crédito pra mim sem nem eu pedir, só  pra poder falar comigo', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(54, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'Saiu cmg para o potiguar.', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-19 13:10:02', '2024-04-02 02:55:14'),
(55, '', 'visualizada', '/img/marra.png', '#FFB800', '10/10', 'Falou muito de pessoas não desejadas.', 'Herick Marra', 'bi bi-exclamation-triangle-fill', 2, '2024-03-19 13:10:02', '2024-04-02 02:55:14'),
(56, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Me deu uma rosa', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(57, '', 'visualizada', '/img/anne.jpg', '#3BB900', '8/10', 'Passou tempo de qualidade comigo no potiguar', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(58, '', 'visualizada', '/img/anne.jpg', '#3BB900', '4/10', 'Cancelou o uber pra andar comigo', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(59, '', 'visualizada', '/img/anne.jpg', '#FFB800', '1/10', 'Acha que eu trairia ele', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(60, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Passou no pátio pra me ver', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(61, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Me deu uma cartinha e um bis', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(62, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Foi na casa da kamila me buscar pra passar tempo comigo', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(63, '', 'visualizada', '/img/anne.jpg', '#FFB800', '2/10', 'Está banalizando o 10 vermelho', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(64, '', 'visualizada', '/img/anne.jpg', '#3BB900', '8/10', 'Não só desembaraçou meu cabelo como um mestre, mas também faz questão de aprender a finalizar e fazer penteados.', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-19 13:10:02', '2024-04-08 19:13:44'),
(65, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'Se afastou do aires', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-19 13:14:45', '2024-04-02 02:55:14'),
(66, '', 'visualizada', '/img/marra.png', '#3BB900', '5/10', 'Me deu cartinha chocolate cacau show', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-19 13:18:13', '2024-04-02 02:55:14'),
(67, '', 'visualizada', '/img/marra.png', '#FC1A1A', '5/10', 'Ao sair some do whats, por horas.', 'Herick Marra', 'bi bi-exclamation-octagon-fill', 2, '2024-03-19 18:05:15', '2024-04-02 02:55:14'),
(69, '', 'visualizada', '/img/marra.png', '#3BB900', '8/10', 'Me trata com carinho.', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-19 21:03:56', '2024-04-02 02:55:14'),
(70, '', 'visualizada', '/img/marra.png', '#3BB900', '5/10', 'Saiu para comer hambúrguer cmg', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-20 13:48:29', '2024-04-02 02:55:14'),
(71, '', 'visualizada', '/img/marra.png', '#3BB900', '4/10', 'Ficou acordada até tarde cmg', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-20 19:22:09', '2024-04-02 02:55:14'),
(72, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'É a garota maís incrível ❤️', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-21 07:57:53', '2024-04-02 02:55:14'),
(73, '', 'visualizada', '/img/marra.png', '#FFB800', '1/10', 'Não entra no app diariamente', 'Herick Marra', 'bi bi-exclamation-triangle-fill', 2, '2024-03-21 07:58:11', '2024-04-02 02:55:14'),
(74, '', 'visualizada', '/img/anne.jpg', '#3BB900', '6/10', 'Foi pra academia cmg', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-21 14:28:21', '2024-04-08 19:13:44'),
(75, '', 'visualizada', '/img/anne.jpg', '#3BB900', '2/10', 'Foi na minha hamburgueria favorita de Planaltina cmg🥰, dei só 2 de nota pq n queria engordar :(', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-21 14:30:19', '2024-04-08 19:13:44'),
(76, '', 'visualizada', '/img/anne.jpg', '#3BB900', '3/10', 'Lembrou que eu estava com vontede de comer kinder ovo e me deu, junto com bis e raffaelo. Mas é tudo um plano pra me engordar :(', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-22 14:04:02', '2024-04-08 19:13:44'),
(77, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Fez massagem no meu pé, todas as vezes que eu pedi.', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-22 14:04:40', '2024-04-08 19:13:44'),
(78, '', 'visualizada', '/img/anne.jpg', '#3BB900', '7/10', 'Penteou o meu cabelo', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-22 15:20:28', '2024-04-08 19:13:44'),
(79, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Fez café da manhã gostoso pra mim', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-22 15:20:41', '2024-04-08 19:13:44'),
(80, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'Jogou life strange cmg ❤️', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-23 03:29:23', '2024-04-02 02:55:14'),
(81, '', 'visualizada', '/img/marra.png', '#FFB800', '1/10', 'Falou pra minha avó que não namoramos.', 'Herick Marra', 'bi bi-exclamation-triangle-fill', 2, '2024-03-23 03:29:44', '2024-04-02 02:55:14'),
(82, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'Sempre é muito compreensiva comigo.', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-24 06:30:17', '2024-04-02 02:55:14'),
(83, '', 'visualizada', '/img/marra.png', '#FFB800', '1/10', 'Brigou comigo', 'Herick Marra', 'bi bi-exclamation-triangle-fill', 2, '2024-03-24 06:30:46', '2024-04-02 02:55:14'),
(84, '', 'visualizada', '/img/marra.png', '#3BB900', '5/10', 'Foi paciente cmg, e me entendeu', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-24 18:31:19', '2024-04-02 02:55:14'),
(85, '', 'visualizada', '/img/marra.png', '#3BB900', '5/10', 'Me perdoou, e não ficou brava ❤️', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-24 18:31:47', '2024-04-02 02:55:14'),
(86, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'Zeramos o It takes Two ihuuul! ❤️', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-26 02:47:20', '2024-04-02 02:55:14'),
(87, '', 'visualizada', '/img/anne.jpg', '#FC1A1A', '6/10', 'Desrespeitou minha vontade, e foi para o rolê só pra pesar o clima', 'Rafaelah', 'bi bi-exclamation-octagon-fill', 1, '2024-03-27 20:34:47', '2024-04-08 19:13:44'),
(88, '', 'visualizada', '/img/anne.jpg', '#3BB900', '8/10', 'Passou a  tarde comigo e terminamos it takes two', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-27 20:35:50', '2024-04-08 19:13:44'),
(89, '', 'visualizada', '/img/anne.jpg', '#3BB900', '1/10', 'Me acha gostosa, e disse que tá adirando só o meu corpo', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-29 16:42:40', '2024-04-08 19:13:44'),
(90, '', 'visualizada', '/img/anne.jpg', '#FFB800', '2/10', 'Atrapalhou o meu sono', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-03-29 16:42:55', '2024-04-08 19:13:44'),
(91, '', 'visualizada', '/img/marra.png', '#3BB900', '5/10', 'Foi no face Bar cmg ❤️', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-30 23:06:37', '2024-04-02 02:55:14'),
(92, '', 'visualizada', '/img/marra.png', '#3BB900', '9/10', 'Passou muito tempo cmg 💓', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-03-30 23:07:37', '2024-04-02 02:55:14'),
(93, '', 'visualizada', '/img/marra.png', '#FFB800', '2/10', 'Me fez comer muito e quase passar mal', 'Herick Marra', 'bi bi-exclamation-triangle-fill', 2, '2024-03-30 23:08:04', '2024-04-02 02:55:14'),
(94, '', 'visualizada', '/img/anne.jpg', '#3BB900', '10/10', 'Passou mt tempo cmg, e de qualidade', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-31 03:52:30', '2024-04-08 19:13:44'),
(95, '', 'visualizada', '/img/anne.jpg', '#3BB900', '10/10', 'Passou mt tempo cmg, e de qualidade', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-31 03:52:31', '2024-04-08 19:13:44'),
(96, '', 'visualizada', '/img/anne.jpg', '#FFB800', '3/10', 'Quebrou o pescoço pra olhar pra mulher', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-03-31 03:55:04', '2024-04-08 19:13:44'),
(97, '', 'visualizada', '/img/anne.jpg', '#FFB800', '6/10', 'Teimou pra deixar eu ver o cll velho', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-03-31 03:55:34', '2024-04-08 19:13:44'),
(98, '', 'visualizada', '/img/anne.jpg', '#FFB800', '6/10', 'Teimou pra deixar eu ver o cll velho', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-03-31 03:55:35', '2024-04-08 19:13:44'),
(99, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Elogiou bastante', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-31 03:57:27', '2024-04-08 19:13:44'),
(100, '', 'visualizada', '/img/anne.jpg', '#FFB800', '2/10', 'Não pintou nem fez biscuit que tinhamos combinado de fazer', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-03-31 03:58:33', '2024-04-08 19:13:44'),
(101, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Foi andando até o potiguar pq eu pedi', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-31 03:58:54', '2024-04-08 19:13:44'),
(102, '', 'visualizada', '/img/anne.jpg', '#3BB900', '5/10', 'Assistiu e apreciou a viagem de shihito comigo', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-03-31 05:51:12', '2024-04-08 19:13:44'),
(103, '', 'visualizada', '/img/anne.jpg', '#FC1A1A', '5/10', 'Apagou msg', 'Rafaelah', 'bi bi-exclamation-octagon-fill', 1, '2024-03-31 06:32:16', '2024-04-08 19:13:44'),
(104, '', 'visualizada', '/img/anne.jpg', '#3BB900', '8/10', 'Foi ao teatro comigo e lanchinho dps', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-04-01 15:34:12', '2024-04-08 19:13:44'),
(105, '', 'visualizada', '/img/anne.jpg', '#FFB800', '4/10', 'Eduarda osorio', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-04-01 15:34:44', '2024-04-08 19:13:44'),
(106, '', 'visualizada', '/img/anne.jpg', '#FFB800', '1/10', 'Fingiu que assistiu castelo animado', 'Rafaelah', 'bi bi-exclamation-triangle-fill', 1, '2024-04-01 23:12:33', '2024-04-08 19:13:44'),
(107, '', 'visualizada', '/img/anne.jpg', '#3BB900', '4/10', 'Aguentou 3', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-04-01 23:12:46', '2024-04-08 19:13:44'),
(108, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'Passou muito tempo de qualidade cmg  💓', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-04-02 00:42:29', '2024-04-02 02:55:14'),
(109, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'Me deu ovos de páscoa', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-04-02 00:42:44', '2024-04-02 02:55:14'),
(110, '', 'visualizada', '/img/marra.png', '#3BB900', '10/10', 'Me deu uma magnífica cartinha junto com os chocolates', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-04-02 00:43:11', '2024-04-02 02:55:14'),
(111, '', 'visualizada', '/img/marra.png', '#3BB900', '5/10', 'Foi ao teatro lanchamos e dormiu cmg ❤️', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-04-02 00:44:28', '2024-04-02 02:55:14'),
(112, '', 'visualizada', '/img/marra.png', '#3BB900', '6/10', 'Assistimos dois filmes do Studio Ghibli', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-04-02 00:45:40', '2024-04-02 02:55:14'),
(113, '', 'visualizada', '/img/marra.png', '#FFB800', '3/10', 'Brigou cmg sobre garotas no meu insta sendo que a balança não está igual, e eu tô parando de seguir todas 💔❤️‍🩹', 'Herick Marra', 'bi bi-exclamation-triangle-fill', 2, '2024-04-02 00:47:02', '2024-04-02 02:55:14'),
(114, '', 'visualizada', '/img/marra.png', '#FFB800', '1/10', 'Ameaçou ir embora só pq a confrontei 😢', 'Herick Marra', 'bi bi-exclamation-triangle-fill', 2, '2024-04-02 00:53:11', '2024-04-02 02:55:14'),
(115, '', 'visualizada', '/img/marra.png', '#3BB900', '5/10', 'Me deu uma cartinha de duplo sentido', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-04-02 00:53:39', '2024-04-02 02:55:14'),
(116, '', 'visualizada', '/img/anne.jpg', '#3BB900', '8/10', 'Me ajudou a deixar as unhas, sobrancelhas e pernas bonitas', 'Rafaelah', 'bi bi-emoji-heart-eyes-fill', 1, '2024-04-02 02:50:42', '2024-04-08 19:13:44'),
(117, '', 'pendente', '/img/marra.png', '#3BB900', '10/10', 'É a garota maís incrível desse mundo todo.', 'Herick Marra', 'bi bi-emoji-heart-eyes-fill', 2, '2024-04-04 05:22:53', '2024-04-04 05:22:53');

-- --------------------------------------------------------

--
-- Estrutura para tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `records`
--

CREATE TABLE `records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `picture` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `desc` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `records`
--

INSERT INTO `records` (`id`, `picture`, `date`, `desc`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '/uploads/records/image_66065523e4b77.png', '2024-03-29', '', 1, '2024-03-29 08:44:03', '2024-03-29 08:44:03'),
(2, '/uploads/records/image_660655626ed18.png', '2024-03-29', '', 1, '2024-03-29 08:45:06', '2024-03-29 08:45:06'),
(3, '/uploads/records/image_6606558a4cbce.png', '2024-03-29', '', 1, '2024-03-29 08:45:46', '2024-03-29 08:45:46'),
(4, '/uploads/records/image_6606c5c7c8c13.png', '2024-03-29', '', 1, '2024-03-29 16:44:39', '2024-03-29 16:44:39'),
(5, '/uploads/records/image_6606c62670861.png', '2024-03-29', '', 1, '2024-03-29 16:46:14', '2024-03-29 16:46:14'),
(6, '/uploads/records/image_660721de02b1c.png', '2024-03-29', '', 1, '2024-03-29 23:17:34', '2024-03-29 23:17:34'),
(7, '/uploads/records/image_660721e88758d.png', '2024-03-29', '', 1, '2024-03-29 23:17:44', '2024-03-29 23:17:44'),
(8, '/uploads/records/image_660723662fc7e.png', '2024-03-29', '', 1, '2024-03-29 23:24:06', '2024-03-29 23:24:06'),
(9, '/uploads/records/image_6607236bd8bec.png', '2024-03-29', '', 1, '2024-03-29 23:24:11', '2024-03-29 23:24:11'),
(10, '/uploads/records/image_6609bcbbdbeb9.png', '2024-03-31', '', 1, '2024-03-31 22:42:51', '2024-03-31 22:42:51'),
(11, '/uploads/records/image_6609bcc90a64d.png', '2024-03-31', '', 1, '2024-03-31 22:43:05', '2024-03-31 22:43:05'),
(12, '/uploads/records/image_6609bccad1aec.png', '2024-03-31', '', 1, '2024-03-31 22:43:06', '2024-03-31 22:43:06'),
(13, '/uploads/records/image_6609bcd5ce42e.png', '2024-03-31', '', 1, '2024-03-31 22:43:17', '2024-03-31 22:43:17'),
(14, '/uploads/records/image_6609bcdfe2b8d.png', '2024-03-31', '', 1, '2024-03-31 22:43:27', '2024-03-31 22:43:27'),
(15, '/uploads/records/image_6609dfcfab0dc.png', '2024-03-31', '', 1, '2024-04-01 01:12:31', '2024-04-01 01:12:31'),
(16, '/uploads/records/image_6609dff410e02.png', '2024-03-31', '', 1, '2024-04-01 01:13:08', '2024-04-01 01:13:08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `profile_picture`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'Herick Marra', 'marra', NULL, '/img/marra.png', NULL, '$2y$12$13gk/qf3atitX50Nw469xuDbRNrzxbMyLz6GkYs8xvg.j71oWFVnS', NULL, '2024-03-06 19:55:18', '2024-04-10 00:49:20', '2024-04-10 00:49:20'),
(2, 'Rafaelah', 'rafah', NULL, '/img/anne.jpg', NULL, '$2y$12$BteHy69IMzWWWBQN5ZUyg.5W4DUhT1InAkSTjB72AlOq8i5q3ESGe', NULL, '2024-03-06 19:55:18', '2024-04-02 02:55:14', '2024-04-02 02:55:14');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `emotions`
--
ALTER TABLE `emotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emotions_user_id_foreign` (`user_id`);

--
-- Índices de tabela `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Índices de tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `records_user_id_foreign` (`user_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emotions`
--
ALTER TABLE `emotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de tabela `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `records`
--
ALTER TABLE `records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `emotions`
--
ALTER TABLE `emotions`
  ADD CONSTRAINT `emotions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `records`
--
ALTER TABLE `records`
  ADD CONSTRAINT `records_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
