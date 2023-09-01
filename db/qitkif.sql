-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 01 sep. 2023 à 09:33
-- Version du serveur : 10.5.12-MariaDB-0+deb11u1
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `c0qitkif`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `photo`) VALUES
(1, 'AdminQitKif', '$2y$10$ZYSSBENGoEsJiG1AX2r0l.SfilnQD4GWIa8QytlP5CwEhxZk0cEra', 'cropped-EDLI4 (1).png');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE `avis` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_user_avis` bigint(20) NOT NULL,
  `note` int(11) NOT NULL DEFAULT 0,
  `comment` text DEFAULT NULL,
  `date_` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`id`, `id_user`, `id_user_avis`, `note`, `comment`, `date_`) VALUES
(1, 2, 1, 4, 'dddddd', '2023-03-13 10:55:54'),
(2, 40, 25, 3, 'Saika nety', '2023-08-31 11:21:15');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type` enum('objet','service') NOT NULL,
  `icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `type`, `icon`) VALUES
(1, 'Multimédia', 'objet', 'multimedia.png'),
(2, 'Mode', 'objet', 'mode.png'),
(4, 'Téléphone', 'objet', 'appel.png'),
(5, 'Nourriture', 'objet', 'burger.png'),
(6, 'Médicament', 'objet', 'medicament.png'),
(7, 'Article de cuisine', 'objet', 'cuisine.png'),
(8, 'Animal', 'objet', 'animal.png'),
(9, 'Article de maison', 'objet', 'articles-de-toilette.png'),
(10, 'Beauté', 'objet', 'produits-de-beaute.png'),
(11, 'Electroménager', 'objet', 'electronique.png'),
(12, 'Education', 'objet', 'examen.png'),
(13, 'Matériel pro', 'objet', 'materiel-promotionnel.png'),
(14, 'Jouet', 'objet', 'boite-de-rangement.png'),
(15, 'Autres', 'objet', 'pensez-autrement.png'),
(16, 'Location', 'service', 'voiture-de-location.png'),
(17, 'Maintenance', 'service', 'maintenance.png'),
(18, 'Travaux', 'service', 'charpentier.png'),
(19, 'Prestation', 'service', 'b2c.png'),
(20, 'Course', 'service', 'liste-de-courses.png'),
(21, 'Transport', 'service', 'transport.png'),
(22, 'Artisanat', 'service', 'artisanat.png'),
(23, 'Autres', 'service', 'client.png');

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `idcontact` int(11) NOT NULL,
  `whatsapp` text NOT NULL,
  `facebook` text NOT NULL,
  `adresse` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`idcontact`, `whatsapp`, `facebook`, `adresse`) VALUES
(1, '+2250707839168', 'https://www.facebook.com/Qitkif', 'Côte d\'Ivoire - Abidjan, Cocody');

-- --------------------------------------------------------

--
-- Structure de la table `description`
--

CREATE TABLE `description` (
  `id` int(11) NOT NULL,
  `entete` varchar(255) NOT NULL DEFAULT '0',
  `contenu` varchar(255) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `description`
--

INSERT INTO `description` (`id`, `entete`, `contenu`, `image`) VALUES
(5, 'QitKif est une application de transaction sécurisée et facile à utiliser !', 'Protégez (enfin) vos achats et ventes entre particuliers pour éviter les arnaques, garantir la qualité convenue et changer nos habitudes de consommation.\nL’application est simple et facile d’utilisation.', 'transaction-dargent.png'),
(8, 'QitKif, L\'application idéale pour faire affaire avec un inconnu. Tout ce dont j’ai besoin pour le bon déroulement de mes transactions', 'La confiance et la sécurité sont la base de QitKif', 'paymate.png'),
(9, 'Je crée un compte et je me connecte facilement', 'La simplicité de cette application commence par la création facile d’un compte. Cette application intuitive est parfaite en tout genre.', 'kyc.png'),
(10, 'J’envoie mon offre d’achat ou  de vente sécurisé', 'Acheteur : Une fois la perle rare dénichée, laissez-vous guider pour envoyer votre offre d’achat.\r\nVendeur : Une fois prêt à vendre votre bien, laissez-vous guider pour éditer votre lien de paiement sécurisé.', 'achats-en-ligne.png'),
(12, 'L’acheteur sécurise son paiement et le vendeur est assuré d’être payé', 'Votre paiement est sécurisé sur un compte jusqu’à validation de la transaction. Vous êtes assuré de recevoir votre achat !', 'coffre-fort.png'),
(15, 'Je récupère mon achat', 'Une fois le colis livré, vous disposez de 12h pour le récupérer et vérifier que votre achat est conforme à vos attentes.', 'colis.png'),
(16, 'Je finalise ma transaction', 'Votre achat est conforme à vos attentes, vous n’avez plus qu’à valider votre transaction depuis l’application.', 'pouces-vers-le-haut.png'),
(17, 'QitKif protège en cas de litige l’acheteur et le vendeur', 'Si la transaction ne se déroule pas comme prévue, je me laisse guider pour trouver une solution rapide et juste.', 'resolution-de-probleme.png');

-- --------------------------------------------------------

--
-- Structure de la table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `faq`
--

INSERT INTO `faq` (`id`, `title`, `content`) VALUES
(1, 'C\'est quoi QitKif ?', 'QitKif est une application mobile de sécurisation des moyens de paiement entre particuliers. \r\nElle est conçue pour sécuriser les ventes et les achats, ainsi que les services entre particuliers. Les utilisateurs \r\npourront  l\'utiliser  pour  vendre  ou  acheter  sur  les  sites  de  petites  annonces,  ou  les  réseaux  sociaux  en  toute \r\nconfiance.'),
(2, 'Comment s\'inscrire ?', 'Il  faut  d’abord  télécharger  l’application  sur  Play  Store  (pour  les  téléphones  Android),  Apple  Store  (pour  les \r\ntéléphones IOS) ou sur qitkif.com. \r\nA l’ouverture de l’application, cliquer sur S’INSCRIRE et renseigner le formulaire. \r\nEt, Valider le formulaire, après avoir cocher les conditions générales, en faisant SUIVANT. \r\nUn code de 4 chiffres vous sera envoyé sur le numéro de téléphone que vous avez renseigné dans le formulaire. \r\nSaisissez ce code de 4 chiffres et VALIDER, vous serez amené à créer un nouveau code de 4 chiffres (avec double \r\nvalidation). Ce code sera désormais votre code d’identification. \r\nPour vous connecter à l’application, vos identifiants seront votre numéro de téléphone (celui enregistré dans le \r\nformulaire) et le code de 4 chiffres que vous avez créé.'),
(3, 'Mot de passe oublié, que faire ?', 'Lors de votre connexion à l’application, si vous avez oublié votre code de connexion. Il vous suffit de cliquer sur \r\n« Code oublié ». Un nouveau code vous sera envoyé sur le numéro que vous utilisez pour vous connecter.'),
(4, 'Que faire quand mon compte est bloqué ?', 'Si votre compte est bloqué, contacter le support en envoyant un mail à contact@qitkif.com ou en envoyant un \r\nmessage WhatsApp au +2250759241000 ou +2250707839168. En quelques minutes votre compte sera rétabli.'),
(5, 'Peut-on signaler un vendeur ?', 'Oui  en  contactant  le  support  ou  en  laissant  un  message  dans  l’application  « Service  client ».  Une  icône  de \r\nconversation dans le menu horizontal de l’application est là à cet effet.'),
(6, 'Peut-on signaler un acheteur ?', 'Oui  en  contactant  le  support  ou  en  laissant  un  message  dans  l’application  « Service  client ».  Une  icône  de \r\nconversation dans le menu horizontal de l’application est là à cet effet.'),
(7, 'Comment QitKif accompagne ses utilisateurs ?', 'QitKif assure la sécurité des transactions en étant au début et à la fin de chaque transaction. \r\nL\'application dispose d\'administrateur qui s\'assure que les transactions se déroulent bien.  Les délais d\'exécution \r\nsont surveillés et la communication avec les utilisateurs est assurée. \r\nEn cas de litiges, une médiation est immédiatement ouverte entre le vendeur et l\'acheteur pour une résolution \r\nrapide.'),
(8, 'Comment trouver un vendeur ?', 'Si vous êtes un acheteur et que vous souhaitez trouver un vendeur pour lui faire une offre d’achat, il vous faut \r\nfaire « Acheter » dans le menu horizontal de l’application. Et, rechercher votre vendeur à partir de son identifiant, \r\nson numéro de téléphone ou son adresse électronique. Mais, au préalable, il faudrait que le vendeur ait un compte \r\nQitKif. \r\nUne fois le vendeur trouvé dans la liste qui apparaitra, sélectionnez-le et faites « Suivant ».'),
(9, 'Comment trouver un client ?', 'Si vous êtes un vendeur et que vous souhaitez trouver un acheteur pour lui faire une proposition de vente, il vous \r\nfaut  faire  « Vendre »  dans  le  menu  horizontal  de  l’application.  Et,  rechercher  votre  acheteur  à  partir  de  son \r\nidentifiant, son numéro de téléphone ou son adresse électronique. Mais au préalable, il faudrait que l’acheteur ait \r\nun compte QitKif. \r\nUne fois l’acheteur trouvé dans la liste qui apparaitra, sélectionnez-le et faites « Suivant ».'),
(10, 'Comment parler au service client ?', 'Il vous suffit d’envoyer votre message dans l’application « Service client ». Une icône de conversation dans le menu \r\nhorizontal de l’application est là à cet effet. Ou en envoyant un mail à contact@qitkif.com ou en envoyant un \r\nmessage WhatsApp au +2250759241000 ou +2250707839168.'),
(11, 'Peut-on être vendeur et client en même temps ?', 'Oui. Avec le seul compte que vous avez créé, vous pouvez à la fois vendre et acheter.'),
(12, 'En tant que vendeur, au bout de combien de temps je recevrai mon argent ?', 'Dès que l’acheteur valide la réception de son article, votre argent est immédiatement versé sur votre compte.  \r\nLorsque vous expédiez le colis à l’acheteur, vous définissez le temps maximum de livraison. Dès que ce temps est \r\natteint (bien entendu avec une marge prévue par l’application), si l’acheteur ne valide pas la réception, l’application \r\nlui envoie une notification, ainsi qu’à vous le vendeur, pour demander à l’acheteur de valider la réception ou \r\nd’ouvrir un litige en cas de non-réception ou de non-conformité du colis. Si l’acheteur ne réagit pas, la transaction \r\nest considérée comme terminée et l’argent est immédiatement versé sur le compte du vendeur.'),
(13, 'Comment se rétracter après un achat ?', 'Après un achat, il est possible d’annuler la commande avant que le vendeur ait effectué la mise en livraison. \r\nL’acheteur se voit dans ce cas restituer son argent de façon automatique. Si le vendeur a  déjà  livré le colis, \r\nl’annulation n’est plus possible. Mais une médiation peut être ouverte, à la demande de l’acheteur. La plateforme \r\nde QitKif va gérer la médiation entre le vendeur et l’acheteur.'),
(14, 'Le prélèvement sur mon compte mobile money se fait en instantané ?', 'Le prélèvement est instantané dès que vous validez l’achat.'),
(15, 'Livreur et colis en retard, que faire ?', 'Ouvrir  un  litige  via  l’application  « Service  client ».  Une  icône  de  conversation  dans  le  menu  horizontal  de \r\nl’application est là à cet effet. Une communication sera établie avec le vendeur pour trouver une solution rapide.'),
(16, 'Peut-on rajouter plusieurs comptes de transfert mobile à son profil ?', 'Oui, vous pouvez rajouter plusieurs comptes de paiement à votre profil. Pour le faire, allez dans les paramètres de \r\nvotre profil et ajoutez de nouveau compte de paiement. \r\nLors d’une vente ou d’un achat vous aurez la possibilité de choisir le compte que vous souhaitez utiliser.'),
(17, 'En cas de litige, que faire ?', 'Ouvrir  un  litige  via  l’application  « Service  client ».  Une  icône  de  conversation  dans  le  menu  horizontal  de \r\nl’application est là à cet effet. Une communication sera établie avec le vendeur et l’acheteur pour trouver une \r\nsolution rapide. \r\nAvant d’ouvrir un litige, il ne faut surtout pas valider la livraison du colis. Aucun litige concernant une transaction \r\nclôturée ne peut être accepté.'),
(18, 'Quand recevoir mon argent, lorsque le client ne confirme pas la réception ?', 'Lorsque vous expédiez le colis à l’acheteur, vous définissez le temps maximum de livraison. Dès que ce temps est \r\natteint (bien entendu avec une marge prévue par l’application), si l’acheteur ne valide pas la réception, l’application \r\nlui envoie une notification, ainsi qu’à vous le vendeur, pour demander à l’acheteur de valider la réception ou \r\nd’ouvrir un litige en cas de non-réception ou de non-conformité du colis. Si l’acheteur ne réagit pas, la transaction \r\nest considérée comme terminée et l’argent est immédiatement versé sur le compte du vendeur.'),
(19, 'Comment puis-je être remboursé alors que j\'ai été déjà prélevé, et le colis n\'est pas conforme ? Ou comment \r\ngérer une réclamation ?', 'Après ouverture d’un litige, les téléconseillers de la plateforme QitKif vont établir une communication entre le \r\nvendeur et l’acheteur pour trouver une solution. Des preuves de non-conformité seront demandées à l’acheteur et \r\ncomparées aux éléments ayant suscités la vente ou l’achat. Cette médiation a pour but de déterminer qui de \r\nl’acheteur ou du vendeur est en tort. \r\nEn cas de tort du vendeur, il est demandé au vendeur de récupérer son colis et l’acheteur est immédiatement \r\nremboursé. \r\nEn cas de tort de l’acheteur, il est dans l’obligation d’accepter le colis, le vendeur est dans ce cas payé.'),
(20, 'Qu\'est ce qui caractérise QitKif ?', 'Ce qui caractérise QitKif, c’est la sécurité et la garantie des transactions. La sécurité en ce sens où l’argent est \r\nbloqué par un système qui n’est pas accessible à QitKif. C’est l’algorithme des mobiles money qui le gère.  \r\nEt, l’acheteur est sûr de recevoir son article commandé et le vendeur est garanti d’être payé.'),
(21, 'Nos données sont-elles en sécurité ?', 'L’application QitKif ne conserve que les informations que vous avez renseignées à la création de votre compte. \r\nAucune donnée de paiement n’est conservée.'),
(22, 'Quelle est la politique de sécurité ?', 'QitKif utilise les derniers standards de sécurité. Cela, pour vous proposer la meilleure expérience qui puisse exister \r\ndans le domaine du commerce entre particuliers. Vos données personnelles sont protégées par des technologies \r\nabsolument infaillibles, pour que vous puissiez toujours utiliser notre service l’esprit léger et les yeux fermés.'),
(23, 'Mon compte peut-il être piraté ?', 'Tant que vous conservez vos identifiants de connexion de façon personnelle, votre compte ne peut pas être piraté.'),
(24, 'Le mot de passe de paiement dans l\'application correspond-il à celui de mon compte Mobile Money ?', 'Le mot de passe de confirmation de paiement dans l’application est votre code de connexion. Il est différent de \r\ncelui de votre compte mobile money. L’application ne demandera jamais votre code de paiement mobile money. \r\nAprès avoir validé le paiement dans l’application, c’est votre opérateur de compte mobile money qui se charge par \r\nun code de validation de finaliser la transaction. Pour dire que QitKif n’a pas autorité à exécuter une action sur \r\nvotre compte mobile money.'),
(25, 'Comment se fait le paiement sur QitKif ?', 'Après validation de votre commande, vous passez au paiement en le validant. Votre opérateur mobile vous enverra \r\nun code SMS pour exécuter le paiement en dehors de l’application. La finalisation de la transaction est faite en \r\ndehors de l’application, donc QitKif ne saurait savoir, ni garder votre code de paiement mobile money.'),
(26, 'QitKif a-t-elle accès à mes données de mon Mobile Money ?', 'Non, La finalisation de la transaction est faite en dehors de l’application, donc QitKif ne saurait savoir, ni garder \r\nvos codes de paiement mobile money.');

-- --------------------------------------------------------

--
-- Structure de la table `fo_header`
--

CREATE TABLE `fo_header` (
  `id` int(11) NOT NULL,
  `great_title` varchar(255) NOT NULL,
  `sub_great_title` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `link_google_play` varchar(255) NOT NULL,
  `link_app_store` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `apk` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fo_header`
--

INSERT INTO `fo_header` (`id`, `great_title`, `sub_great_title`, `slogan`, `link_google_play`, `link_app_store`, `image`, `apk`) VALUES
(1, 'Sécurisez vos ventes et vos achats entre particuliers', 'Vos achats et vos ventes deviennent plus sûres avec QitKif!!!', 'Avec QitKif, on est Qit et tout le monde Kif', 'https://play.google.com/store/apps/details?id=com.qitkif', 'https://tuto-info.com', 'LogoQitKif.jpeg', 'Qitkif.apk');

-- --------------------------------------------------------

--
-- Structure de la table `fo_slogan`
--

CREATE TABLE `fo_slogan` (
  `id` int(11) NOT NULL,
  `slogan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `fo_slogan`
--

INSERT INTO `fo_slogan` (`id`, `slogan`) VALUES
(1, 'Une superbe application pour vous !');

-- --------------------------------------------------------

--
-- Structure de la table `functionality`
--

CREATE TABLE `functionality` (
  `func1` varchar(255) NOT NULL,
  `func2` varchar(255) NOT NULL,
  `func3` varchar(255) NOT NULL,
  `func4` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `content1` varchar(255) NOT NULL,
  `content2` varchar(255) NOT NULL,
  `content3` varchar(255) NOT NULL,
  `content4` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `functionality`
--

INSERT INTO `functionality` (`func1`, `func2`, `func3`, `func4`, `id`, `content1`, `content2`, `content3`, `content4`) VALUES
('Sécurisé', 'Assistance assurée', 'Contact direct', 'Open Source', 1, 'Vos transactions sont sécurisées par le chiffrement de bout en bout. Votre argent est sécurisé dans un coffre-fort jusqu’à la fin de la transaction.', 'Une équipe de téléconseillers est disponible, 24h/24 et 7 jours /7 pour faciliter vos transactions et assurer la prise en charge et la résolution des litiges.', 'Un contact tripartie et direct est établi entre l’acheteur, le vendeur et la plateforme.', 'Application libre de téléchargement et gratuite*');

-- --------------------------------------------------------

--
-- Structure de la table `historique_offre`
--

CREATE TABLE `historique_offre` (
  `id` bigint(20) NOT NULL,
  `id_notification_offre` bigint(20) NOT NULL,
  `etat` int(11) NOT NULL,
  `montant` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `historique_offre`
--

INSERT INTO `historique_offre` (`id`, `id_notification_offre`, `etat`, `montant`, `message`, `created_at`) VALUES
(1, 1, 100, 1500, 'Vêtements femme', '2023-06-09 11:52:54'),
(2, 2, 250, 1500, NULL, '2023-06-09 11:53:28'),
(3, 3, 310, 1500, NULL, '2023-06-09 11:55:53'),
(4, 4, 500, 1500, NULL, '2023-06-09 11:56:59'),
(5, 5, 610, 1500, NULL, '2023-06-09 11:56:59'),
(6, 6, 610, 1500, NULL, '2023-06-09 11:56:59'),
(7, 7, 100, 1500, NULL, '2023-06-09 12:24:40'),
(8, 8, 200, 1500, NULL, '2023-06-09 12:25:20'),
(9, 9, 300, 1500, NULL, '2023-06-09 12:25:59'),
(10, 10, 100, 1500, 'Ordinateur portable', '2023-06-09 12:47:59'),
(11, 11, 200, 1500, NULL, '2023-06-09 12:48:22'),
(12, 12, 300, 1500, NULL, '2023-06-09 12:49:02'),
(13, 13, 310, 1500, NULL, '2023-06-09 12:50:12'),
(14, 14, 500, 1500, NULL, '2023-06-09 12:50:56'),
(15, 15, 610, 1500, NULL, '2023-06-09 12:55:59'),
(16, 16, 610, 1500, NULL, '2023-06-09 12:55:59'),
(17, 17, 100, 1500, 'Salut', '2023-06-15 13:37:56'),
(18, 18, 200, 1500, NULL, '2023-06-15 13:39:04'),
(19, 19, 300, 1500, NULL, '2023-06-15 13:40:04'),
(20, 20, 310, 1500, NULL, '2023-06-15 13:45:01'),
(21, 21, 500, 1500, NULL, '2023-06-15 13:48:17'),
(22, 22, 100, 1500, 'Test de l\'application', '2023-07-20 22:56:24'),
(23, 23, 250, 1500, NULL, '2023-07-20 22:59:16'),
(24, 24, 610, 1500, NULL, '2023-07-20 23:29:17'),
(25, 25, 610, 1500, NULL, '2023-07-20 23:29:17'),
(26, 26, 100, 25000, 'Adidas bleu. Pointure 42.', '2023-08-01 16:24:13'),
(27, 27, 100, 150000, 'Tv', '2023-08-01 16:28:52'),
(28, 28, 250, 150000, NULL, '2023-08-01 16:33:00'),
(29, 29, 200, 25000, NULL, '2023-08-01 16:33:18'),
(30, 30, 610, 150000, NULL, '2023-08-01 17:03:00'),
(31, 31, 610, 150000, NULL, '2023-08-01 17:03:00'),
(32, 32, 610, 25000, NULL, '2023-08-01 17:03:18'),
(33, 33, 610, 25000, NULL, '2023-08-01 17:03:18');

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `id_service` bigint(20) NOT NULL,
  `message` text DEFAULT NULL,
  `piece_jointe` varchar(255) DEFAULT NULL,
  `date_` datetime NOT NULL DEFAULT current_timestamp(),
  `sender` enum('admin','user') DEFAULT NULL,
  `read_by_admin` tinyint(4) NOT NULL DEFAULT 0,
  `read_by_user` text NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `id_user`, `id_service`, `message`, `piece_jointe`, `date_`, `sender`, `read_by_admin`, `read_by_user`) VALUES
(1, 33, 1, 'Salut à vous. J\'aimerais mieux comprendre le fonctionnement de l\'application QitKif', NULL, '2023-07-20 15:27:23', 'user', 1, '1'),
(2, 33, 1, 'Bonjour Monsieur\r\n\r\nJe vous remercie de votre intérêt pour cette application. \r\nUn manuel d\'utilisation sera disponible demain, mais en attendant vous trouverez toutes explications sur notre page YouTube.\r\nhttps://www.youtube.com/channel/UCo_5U7OIBHBwWID9B-Sq0VA\r\n\r\nCordialement,', NULL, '2023-07-20 18:50:51', 'admin', 1, '1'),
(3, 40, 2, 'Dans la partie paiement, donner la possibilité à l\'utilisation de renseigner un autre numéro autre que le numéro de son compte pour le paiement parce que moi j\'ai créé mon compte avec un numéro moov et je me suis vu bloqué au niveau du paiement \n\nSinon félicitations pour l\'application', NULL, '2023-07-20 22:07:47', 'user', 1, '1'),
(4, 40, 2, 'L\'utilisateur je veux dire', NULL, '2023-07-20 23:09:06', 'user', 1, '1'),
(5, 40, 2, 'Bonjour\r\nNous vous remercions pour votre intérêt à notre application.', NULL, '2023-07-20 23:51:13', 'admin', 1, '1'),
(6, 40, 2, 'Vous pouvez ajouter un autre moyen de paiement en allant dans  /// Mon profil (trois traits en haut à droite de l\'écran) => Ajouter nouveau', NULL, '2023-07-20 23:53:12', 'admin', 1, '1'),
(7, 33, 1, 'https://www.youtube.com/watch?v=QPdagviuEEI', NULL, '2023-07-20 23:54:43', 'admin', 1, '1'),
(8, 33, 1, 'https://www.youtube.com/watch?v=QPdagviuEEI', 'pj-1689886572.mp4', '2023-07-20 23:56:12', 'admin', 1, '1'),
(9, 33, 1, 'https://www.youtube.com/watch?v=QPdagviuEEI', 'pj-1689886575.mp4', '2023-07-20 23:56:15', 'admin', 1, '1'),
(10, 40, 2, 'Ok merci', NULL, '2023-07-21 17:29:05', 'user', 1, '1'),
(11, 33, 1, 'Comment vendre un article ?', NULL, '2023-07-22 02:32:34', 'user', 1, '1'),
(12, 33, 1, NULL, 'pj-1690055958.pdf', '2023-07-22 22:59:18', 'admin', 1, '1'),
(13, 25, 3, 'Bonjour', NULL, '2023-07-22 22:00:05', 'user', 1, '1'),
(14, 25, 3, NULL, 'pj-1690056034.pdf', '2023-07-22 23:00:34', 'admin', 1, '1'),
(15, 25, 3, 'Bonjour', NULL, '2023-07-22 23:08:09', 'user', 1, '1'),
(16, 25, 4, 'Comment vendre', NULL, '2023-08-01 15:11:53', 'user', 1, '1'),
(17, 25, 4, 'https://qitkif.com/tutoriels/vendre', NULL, '2023-08-01 16:12:58', 'admin', 1, '1'),
(18, NULL, 5, 'Avez-vous des questions sur QitKif et son fonctionnement?', NULL, '2023-08-04 20:48:38', 'admin', 1, '[25,33,56]'),
(19, 25, 5, 'Bonjour', NULL, '2023-08-04 21:50:22', 'user', 1, '[25,33,56]'),
(20, 33, 5, 'Salut', NULL, '2023-08-07 03:33:20', 'user', 1, '[25,33,56]'),
(21, 33, 5, 'Je n\'arrive pas à vendre et acheter', NULL, '2023-08-07 03:33:57', 'user', 1, '[25,33,56]'),
(22, 33, 5, 'Je n\'arrive pas à vendre et acheter', NULL, '2023-08-07 03:34:02', 'user', 1, '[25,33,56]'),
(23, NULL, 6, 'Avez-vous des questions sur QitKif et son fonctionnement?\r\nEnvoyez un message WhatsApp au +2250707839168.\r\nMerci', NULL, '2023-08-07 22:31:00', 'admin', 1, '[25]');

-- --------------------------------------------------------

--
-- Structure de la table `notification_offre`
--

CREATE TABLE `notification_offre` (
  `id` bigint(20) NOT NULL,
  `id_offre` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notification_offre`
--

INSERT INTO `notification_offre` (`id`, `id_offre`, `id_user`, `created_at`, `is_read`) VALUES
(22, 5, 39, '2023-07-20 22:56:24', 1),
(23, 5, 40, '2023-07-20 22:59:16', 0),
(24, 5, 40, '2023-07-20 23:29:17', 0),
(25, 5, 39, '2023-07-20 23:29:17', 0),
(26, 6, 27, '2023-08-01 16:24:13', 1),
(27, 7, 27, '2023-08-01 16:28:52', 1),
(28, 7, 25, '2023-08-01 16:33:00', 1),
(29, 6, 25, '2023-08-01 16:33:18', 1),
(30, 7, 25, '2023-08-01 17:03:00', 1),
(31, 7, 27, '2023-08-01 17:03:00', 0),
(32, 6, 27, '2023-08-01 17:03:18', 0),
(33, 6, 25, '2023-08-01 17:03:18', 1);

-- --------------------------------------------------------

--
-- Structure de la table `numero_paiement`
--

CREATE TABLE `numero_paiement` (
  `id` int(11) NOT NULL,
  `firstname_proprietaire` varchar(255) NOT NULL,
  `lastname_proprietaire` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `operateur` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `numero_paiement`
--

INSERT INTO `numero_paiement` (`id`, `firstname_proprietaire`, `lastname_proprietaire`, `numero`, `id_user`, `operateur`) VALUES
(7, 'Randi', 'Zo Mah', '+22500000000', 12, 1),
(12, 'Kouadio', 'Aya Jeannine', '+2250709949067', 21, 1),
(14, 'Ohouo', 'Evrard Wilfried', '+2250709392686', 23, 1),
(15, 'KOUADIO', 'Edouard', '+2250707839168', 25, 1),
(16, 'Achy', 'James', '+2250700599217', 26, 1),
(17, 'KADJO', 'Evelyne', '+2250749939726', 27, 1),
(18, 'Allade', 'Jean Paul', '+2250758371450', 29, 1),
(19, 'LOUIS', 'FRANCK', '+2250748321741', 31, 1),
(20, 'GLAZAHAN', 'DAGUIHADA CHRIST ARMEL-EVRARD', '+2250758906471', 33, 1),
(21, 'GLAZAHAN', 'DAGUIHADA CHRIST ARMEL-EVRARD', '+2250505982314', 33, 4),
(22, 'Kadjo', 'Charles Euloge', '+2250101515202', 34, 1),
(23, 'Ohouo', 'Jean Eudes', '+2250173525991', 35, 1),
(24, 'Dieket', 'Lavryth', '+2250749387804', 36, 1),
(25, 'Bakayoko', 'Adam', '+2250779940919', 37, 1),
(26, 'Kouadio', 'Aya', '+2250707914301', 38, 1),
(27, 'Kouassi', 'Innocent', '+2250747412898', 39, 1),
(28, 'Kouassi', 'Innocent', '+2250141504757', 40, 1),
(29, 'Kaugbouh', 'Christian', '+2250708904340', 41, 1),
(30, 'Kaugbouh', 'Christian', '+2250708904340', 41, 1),
(31, 'Nda', 'Jacqueline', '+2250101933075', 45, 1),
(32, 'Kouassi', 'Innocent', '+2250747412899', 40, 1),
(33, 'Cisse', 'Ismahil', '+2250707909743', 46, 1),
(34, 'Ahossi', 'Jean-Claude', '+2250700512172', 48, 1),
(35, 'Aya', 'Marie Paule', '+2250758294712', 49, 1),
(36, 'Blessing', 'Dichou', '+2250759241000', 52, 1),
(37, 'Kadjo', 'Edwige', '+2250709633738', 53, 1),
(38, 'Yao', 'Ste francine', '+2250708618213', 54, 1),
(39, 'Ouattara', 'Alle', '+2250102101932', 55, 1),
(40, 'Amiri', 'Bintou', '+2250707983242', 56, 1),
(41, 'Amiri', 'Bintou', '+2250707983242', 56, 1),
(42, 'YAO', 'Locka Anis', '+2250140874498', 57, 1),
(43, 'Akanda', 'Aboe antheme régis', '+2250102930235', 60, 1),
(44, 'Akanda', 'Aboe antheme régis', '+2250102930235', 60, 1);

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

CREATE TABLE `offre` (
  `id` bigint(20) NOT NULL,
  `id_acheteur` bigint(20) NOT NULL,
  `id_vendeur` bigint(20) NOT NULL,
  `montant` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `nom_objet` varchar(255) NOT NULL,
  `mode_remise` enum('main propre','livraison') NOT NULL,
  `etat` int(11) NOT NULL,
  `action` enum('achat','vente') NOT NULL,
  `updated_at` datetime NOT NULL,
  `duree_livraison` int(11) DEFAULT NULL,
  `justification_livraison` varchar(255) DEFAULT NULL,
  `contre` int(11) DEFAULT 0,
  `expired` int(11) DEFAULT 0,
  `observation` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `operateur_telephonique`
--

CREATE TABLE `operateur_telephonique` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `operateur_telephonique`
--

INSERT INTO `operateur_telephonique` (`id`, `nom`, `logo`) VALUES
(1, 'Orange', 'orange.png'),
(2, 'MTN', 'mtn.png'),
(3, 'Moov', 'télécharger.png'),
(4, 'Wave', 'wave.png');

-- --------------------------------------------------------

--
-- Structure de la table `paiement_setting`
--

CREATE TABLE `paiement_setting` (
  `id` int(11) NOT NULL,
  `timbre` int(11) NOT NULL DEFAULT 0,
  `commission_acheteur` float NOT NULL DEFAULT 0,
  `commission_vendeur` float NOT NULL DEFAULT 0,
  `frais_operateur` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `paiement_setting`
--

INSERT INTO `paiement_setting` (`id`, `timbre`, `commission_acheteur`, `commission_vendeur`, `frais_operateur`) VALUES
(1, 0, 1.8, 1.8, 0);

-- --------------------------------------------------------

--
-- Structure de la table `paiement_user`
--

CREATE TABLE `paiement_user` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_client` bigint(20) NOT NULL,
  `id_offre` bigint(20) NOT NULL,
  `montant` bigint(20) NOT NULL,
  `frais` bigint(20) NOT NULL,
  `date_` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `paiement_user`
--

INSERT INTO `paiement_user` (`id`, `id_user`, `id_client`, `id_offre`, `montant`, `frais`, `date_`) VALUES
(1, 14, 16, 1, 1500, 0, '2023-06-09 11:55:53'),
(2, 14, 16, 3, 1500, 0, '2023-06-09 12:50:12'),
(3, 14, 16, 4, 1500, 0, '2023-06-15 13:45:01');

-- --------------------------------------------------------

--
-- Structure de la table `paiement_vendeur`
--

CREATE TABLE `paiement_vendeur` (
  `id` bigint(20) NOT NULL,
  `id_vendeur` bigint(20) NOT NULL,
  `id_acheteur` bigint(20) NOT NULL,
  `id_offre` bigint(20) NOT NULL,
  `montant` int(11) NOT NULL,
  `date_` datetime NOT NULL DEFAULT current_timestamp(),
  `is_paid` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `plateforme`
--

CREATE TABLE `plateforme` (
  `id` int(11) NOT NULL,
  `soldes` int(11) NOT NULL,
  `nbre_commission` int(11) NOT NULL DEFAULT 0,
  `nbre_retrait` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `plateforme`
--

INSERT INTO `plateforme` (`id`, `soldes`, `nbre_commission`, `nbre_retrait`) VALUES
(1, 118125, 12, 0);

-- --------------------------------------------------------

--
-- Structure de la table `plateforme_numero`
--

CREATE TABLE `plateforme_numero` (
  `id` int(11) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `plateforme_transaction`
--

CREATE TABLE `plateforme_transaction` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `id_offre` bigint(20) DEFAULT NULL,
  `montant` int(11) NOT NULL,
  `motif` enum('achat','vente','retrait') NOT NULL,
  `date_` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `plateforme_transaction`
--

INSERT INTO `plateforme_transaction` (`id`, `id_user`, `id_offre`, `montant`, `motif`, `date_`) VALUES
(1, 7, 8, 54000, 'achat', '2023-04-03 17:14:18'),
(2, 1, 8, 54000, 'vente', '2023-04-03 17:22:13'),
(3, 7, 9, 936, 'achat', '2023-04-03 20:05:59'),
(4, 2, 13, 4500, 'achat', '2023-04-03 20:41:13'),
(5, 1, 13, 4500, 'vente', '2023-04-03 20:44:29'),
(6, 14, 17, 27, 'achat', '2023-05-26 13:02:20'),
(7, 14, 18, 27, 'achat', '2023-05-26 13:37:11'),
(8, 14, 1, 27, 'achat', '2023-06-09 10:55:54'),
(9, 14, 3, 27, 'achat', '2023-06-09 11:50:12'),
(10, 16, 3, 27, 'vente', '2023-06-09 11:52:09'),
(11, 14, 4, 27, 'achat', '2023-06-15 12:45:02'),
(12, 16, 4, 27, 'vente', '2023-06-15 12:49:12');

-- --------------------------------------------------------

--
-- Structure de la table `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `lien` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `promotion`
--

INSERT INTO `promotion` (`id`, `icon`, `message`, `lien`, `created_at`) VALUES
(3, 'Logo_Appli18.png', 'C\'est Quoi QitKif?', 'https://www.youtube.com/watch?v=QPdagviuEEI', '2023-07-20 22:53:05'),
(4, 'Logo_Appli19.png', 'Comment vendre avec QitKif?', 'https://qitkif.com/tutoriels/vendre', '2023-07-30 12:12:33'),
(5, 'Logo_Appli15.png', 'Comment acheter avec QitKif?', 'https://qitkif.com/tutoriels/acheter', '2023-07-30 12:13:11'),
(6, 'Logo_Appli14.png', 'Les questions que vous vous posez sur QitKif.', 'https://qitkif.com/faq', '2023-07-30 12:14:02'),
(7, 'point.png', 'Bientôt FundAxions', 'https://fundaxions.com/', '2023-08-01 16:36:49');

-- --------------------------------------------------------

--
-- Structure de la table `propos`
--

CREATE TABLE `propos` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `propos`
--

INSERT INTO `propos` (`id`, `titre`, `contenu`) VALUES
(1, 'Une seule application pour toutes vos transactions', 'Les fonds sont sécurisés jusqu\'à ce que le colis soit reçu par l\'acheteur. Une fois le colis retiré et validé, le vendeur est automatiquement payé.');

-- --------------------------------------------------------

--
-- Structure de la table `remboursement`
--

CREATE TABLE `remboursement` (
  `id` int(11) NOT NULL,
  `id_service` bigint(20) NOT NULL,
  `montant` int(11) NOT NULL,
  `date_` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `service_client`
--

CREATE TABLE `service_client` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) DEFAULT NULL,
  `numero` varchar(50) NOT NULL,
  `type` enum('ticket','litige') NOT NULL,
  `objet` text NOT NULL,
  `id_offre` bigint(20) DEFAULT NULL,
  `id_vendeur` varchar(255) DEFAULT NULL,
  `closed` tinyint(4) NOT NULL DEFAULT 0,
  `start_by_admin` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `service_client`
--

INSERT INTO `service_client` (`id`, `id_user`, `numero`, `type`, `objet`, `id_offre`, `id_vendeur`, `closed`, `start_by_admin`, `created_at`) VALUES
(1, 33, '00001', 'ticket', 'Une explication du fonctionnement de l\'application', NULL, NULL, 1, 0, '2023-07-20 16:27:23'),
(2, 40, '00002', 'ticket', 'paiement mobile money', NULL, NULL, 1, 0, '2023-07-20 23:07:47'),
(3, 25, '00003', 'ticket', 'Informations', NULL, NULL, 1, 0, '2023-07-22 23:00:05'),
(4, 25, '00004', 'ticket', 'Question', NULL, NULL, 1, 0, '2023-08-01 16:11:53'),
(5, NULL, '00005', 'ticket', 'Tout savoir sur QitKif', NULL, NULL, 1, 1, '2023-08-04 21:48:38'),
(6, NULL, '00006', 'ticket', 'C\'est quoi QitKif?', NULL, NULL, 1, 1, '2023-08-07 23:31:00');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `id_offre` bigint(20) DEFAULT NULL,
  `montant` bigint(20) NOT NULL,
  `motif` enum('achat','vente','retrait','remboursement') NOT NULL,
  `date_` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `transaction`
--

INSERT INTO `transaction` (`id`, `id_user`, `id_offre`, `montant`, `motif`, `date_`) VALUES
(1, 14, 1, 1527, 'achat', '2023-06-09 11:55:53'),
(2, 14, 3, 1527, 'achat', '2023-06-09 12:50:12'),
(3, 16, 3, 1473, 'vente', '2023-06-09 12:52:09'),
(4, 14, 4, 1527, 'achat', '2023-06-15 13:45:01'),
(5, 16, 4, 1473, 'vente', '2023-06-15 13:49:12');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL DEFAULT '',
  `pseudo` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL DEFAULT '',
  `photo` varchar(255) DEFAULT NULL,
  `confirm_code` tinytext DEFAULT NULL,
  `code` mediumtext DEFAULT NULL,
  `is_finished` tinyint(4) DEFAULT 0,
  `nbre_avis` int(11) DEFAULT 0,
  `total_note` int(11) DEFAULT 0,
  `nbre_achat` int(11) DEFAULT 0,
  `nbre_vente` int(11) DEFAULT 0,
  `soldes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `pseudo`, `email`, `phone`, `photo`, `confirm_code`, `code`, `is_finished`, `nbre_avis`, `total_note`, `nbre_achat`, `nbre_vente`, `soldes`) VALUES
(21, 'Kouadio', 'Aya Jeannine', 'Ja', 'ayakanjeannine09@gmail.com', '+2250709949067', NULL, '2301', '$2y$10$rcK/LsJTauuhQU8gwpQEKewiYfhXBtD9u170Dq0xDjpB9j81U5kCi', 1, 0, 0, 0, 0, 0),
(23, 'Ohouo', 'Evrard Wilfried', 'Evrard', 'evrardwilfriedohouo@gmail.com', '+2250709392686', NULL, '1351', '$2y$10$hAtXHag/i3ix3gyu44z.mON/3aGJHXlOYsMFXtl1B9EMycFXrXsPu', 1, 0, 0, 0, 0, 0),
(24, 'KOUSSAN', 'Josue', 'Password', 'koussanjeanjaures@gmail.com', '+2250585678556', NULL, '2514', NULL, 0, 0, 0, 0, 0, 0),
(25, 'KOUADIO', 'Edouard', 'EdouK', NULL, '+2250707839168', 'EdouK-1689503230.jpg', '0320', '$2y$10$afw8sTPC3vczuiS9wvOuwOOIkGjXEHHMLB/slASTIIreWjj2//fFC', 1, 0, 0, 0, 0, 0),
(26, 'Achy', 'James', 'Girro', 'jamesachy25@gmail.com', '+2250700599217', NULL, '2287', '$2y$10$MNPOQ24ufTIY5qomQQtRCun2j04LwlWaK5jN2DDToWdIbGwna03Im', 1, 0, 0, 0, 0, 0),
(27, 'KADJO', 'Evelyne', 'Evekad', NULL, '+2250749939726', NULL, '7172', '$2y$10$9Q.djmySJJBR5LmCsEU//emQtCGh6Kw9SXu2GMK0Atl9RisLn9qda', 1, 0, 0, 0, 0, 0),
(28, 'KOUADIO', 'Joachim', 'Adro', 'njkouadio171@gmail.com', '+2250749205275', NULL, '8207', NULL, 0, 0, 0, 0, 0, 0),
(29, 'Allade', 'Jean Paul', 'Master P', 'jeanpaulallade@gmail.com', '+2250758371450', NULL, '4190', '$2y$10$4n.bVQ8CakqNxp3xahlBqu1HNMmwE2l5zB3ctNlOB6bAz.Ff/sKv.', 1, 0, 0, 0, 0, 0),
(31, 'LOUIS', 'FRANCK', 'Lebourgeois', 'lebourgeoire@gmail.com', '+2250748321741', NULL, '2554', '$2y$10$sIgCdwYo6wp9cWB6DN0t0eX2OwMAHOPeQosCPdK/JM5E50HNfBzKi', 1, 0, 0, 0, 0, 0),
(32, 'GLAZAHAN', 'DAGUIHADA CHRIST ARMEL-EVRARD', 'LE PECI CHRIST ARMEL-EVRARD', 'gdchristarmelevrard@gmail.com', '+2250505982314', NULL, '2534', NULL, 0, 0, 0, 0, 0, 0),
(33, 'GLAZAHAN', 'DAGUIHADA CHRIST ARMEL-EVRARD', 'LE PECI C A-E', 'gdchristarmelevrard@gmail.com', '+2250758906471', 'LE PECI C A-E-1689980846.jpg', '2775', '$2y$10$Ef5/za3TLGD18K.sURhVOuJcw3/9JxUKlPHGRomKxQZryD9u/7aNO', 1, 0, 0, 0, 0, 0),
(34, 'Kadjo', 'Charles Euloge', 'Charly225', 'charlesek.ci@gmail.com', '+2250101515202', NULL, '3937', '$2y$10$yJxsGylMh0kL4Vq5vJH19..v37G65xxUn4qmN2NaD/qSHm5uwg2XS', 1, 0, 0, 0, 0, 0),
(35, 'Ohouo', 'Jean Eudes', 'Eudo', 'inestresorparis@gmail.com', '+2250173525991', NULL, '9597', '$2y$10$HmmuO8OJI.kd2sGcmYn4Ru78Ge82CRSkBfYAKGSMiml8SCj0oiOFu', 1, 0, 0, 0, 0, 0),
(36, 'Dieket', 'Lavryth', 'Lavryth come', 'Lavryth@live.fr', '+2250749387804', NULL, '5071', '$2y$10$k1lH2S8/xSql/BuWnGXyiusiKfehNxDgEgkljBZRYqtUNTlDxUaqu', 1, 0, 0, 0, 0, 0),
(37, 'Bakayoko', 'Mawa', 'Adam', 'adambakayokomawa@gmail.com', '+2250779940919', 'Adam-1689869193.jpg', '5293', '$2y$10$.8XfwnVVCsp3eK625NyM5ukX1JO1n4ihBciFmp5SQXBzhCE9Lm99a', 1, 0, 0, 0, 0, 0),
(38, 'Kouadio', 'Aya', 'Ayan', 'Ayanlepry@gmail.com', '+2250707914301', NULL, '5410', '$2y$10$SUamJc1xejoNb4lR4rwt2uay7s2KUZymG.v5zc66t8QpT1uEcmiiK', 1, 0, 0, 0, 0, 0),
(39, 'Kouassi', 'Innocent', 'Inno', 'innok.services@gmail.com', '+2250747412898', NULL, '5882', '$2y$10$A4XTZnI6vzzWuUiFR7DrX.lqc4m17ihSXczMxad2nmhtXWHnNH2oq', 1, 0, 0, 0, 0, 0),
(40, 'Kouassi', 'Innocent', 'Innos', 'jctopsono1@gmail.com', '+2250141504757', NULL, '6141', '$2y$10$Wgjt3kHrrFkqaasq61cJcO8mrA0IBIOkY0FSVB4e7O.g/KNOaL.OO', 1, 1, 3, 0, 0, 0),
(41, 'Kaugbouh', 'Christian', 'Christkaugbouh', 'vieabondantekaugbouh@gmail.com', '+2250708904340', NULL, '0265', '$2y$10$w7rjCwIuMFZtw5YkkSRSU.SOnpWnyz9vrNeQeOtg07nZQOFd.zySa', 1, 0, 0, 0, 0, 0),
(42, 'Konan', 'Carine', 'Mum Selma', 'carinekonan071@gmail.com', '+225+2250708659186', NULL, '8837', NULL, 0, 0, 0, 0, 0, 0),
(43, 'KOUSSAN', 'Jean', 'Jkoussan', 'testqitkif@yopmail.com', '+2250546203838', NULL, '0440', NULL, 0, 0, 0, 0, 0, 0),
(44, 'Nda', 'Jacqueline', 'Jacquy', NULL, '+2250707191615', NULL, '8557', NULL, 0, 0, 0, 0, 0, 0),
(45, 'Nda', 'Jacqueline', 'Jacqui', 'ndaarrochi@gmail.com', '+2250101933075', NULL, '1527', '$2y$10$Vqhr3SsP.iQ9zcmrkZtxL.BKG6zswNQVrZzbNoaaYD9gWbEAX6NwW', 1, 0, 0, 0, 0, 0),
(46, 'Cisse', 'Ismahil', 'Cisse', 'djenilova1@gmail.com', '+2250707909743', NULL, '3046', '$2y$10$gRJKdraw5vgRMHPXhXWqYuNMVSh3JJg5zeVwnTR4dUHS.824VsDrq', 1, 0, 0, 0, 0, 0),
(48, 'Ahossi', 'Jean-Claude', 'Ahossi Edli-consulting', 'ahoussijeanclaude@gmail.com', '+2250700512172', NULL, '0952', '$2y$10$XrFIkQ10O01AdT82ru2iSuOe3DWbSVgkCdBR7/UAdMCJeLweo/x1C', 1, 0, 0, 0, 0, 0),
(49, 'Aya', 'Marie Paule', 'MP', NULL, '+2250758294712', NULL, '3193', '$2y$10$u6WHa66Y7/nzYnOjBD96.OAc8ps4tjPlOiCqApsxMrxhumHHa16o2', 1, 0, 0, 0, 0, 0),
(50, 'Kadjo', 'Evelyne', 'Melokad', 'Kavelyne01@gmail.com', '+2250506167002', NULL, '0770', NULL, 0, 0, 0, 0, 0, 0),
(52, 'Blessing', 'Dichou', 'Didi', 'aliba.koffi@gmail.com', '+2250759241000', NULL, '8369', '$2y$10$5DSKhsrWt0zHjKBwsfPVb.FTt643r/tRa5P2a2a9zWjvk2nWeMKtC', 1, 0, 0, 0, 0, 0),
(53, 'Kadjo', 'Edwige', 'Edo', 'Kadjoedwige04@gmail.com', '+2250709633738', NULL, '2463', '$2y$10$9pEFxSppy9IHe0gVxe5aKeSgfUAdaX1CeVlO4gv8pZWngWxZeicra', 1, 0, 0, 0, 0, 0),
(54, 'Yao', 'Ste francine', 'Ledelice', 'yaosaintefrancine@gmail.com', '+2250708618213', NULL, '3741', '$2y$10$a/zO3XiM6gd4Ssan2HpsNuyCpG0KOqxTqDE7p4qbECOh.6aLvq27G', 1, 0, 0, 0, 0, 0),
(55, 'Ouattara', 'Alle', 'Moolood', 'huitmarvinhalley@gmail.com', '+2250102101932', NULL, '2528', '$2y$10$wNoAJmyDUbaBLmggn7EGguq1qSGLWvKtC5CitCFsfiBkEIbcx0AXC', 1, 0, 0, 0, 0, 0),
(56, 'Amiri', 'Bintou', 'Bint Blessing', 'bintoublessing@gmail.com', '+2250707983242', NULL, '5529', '$2y$10$0D1lZbKHLhZ20bJDJtjUX.HPZurOgy4jAxqD3GvQYxGvbugEQm6ly', 1, 0, 0, 0, 0, 0),
(57, 'YAO', 'Locka Anis', 'Lock', 'Ylockaanis@yahoo.fr', '+2250140874498', NULL, '2600', '$2y$10$ADvF7.50M/LXbYz2dbcgYOiHJmCbJEIcyttqBM7XE9GIBkswPSm.m', 1, 0, 0, 0, 0, 0),
(58, 'AIBA', 'Michael', 'Maiba', 'info.igdsarl@gmail.com', '+2250504820505', NULL, '4774', NULL, 0, 0, 0, 0, 0, 0),
(59, 'Akanda', 'Aboe antheme régis', 'Antb', 'akanda9regis@gmail.com', '+2250504440815', NULL, '2236', NULL, 0, 0, 0, 0, 0, 0),
(60, 'Akanda', 'Aboe antheme régis', 'Antebe', 'akanda9regis@gmail.com', '+2250102930235', NULL, '8681', '$2y$10$v/GQE1z5TNFBJ8Gukb5KDOF7tRdeKDnPbcEugcHMHOzK/SxsHoo.K', 1, 0, 0, 0, 0, 0),
(61, 'Test', 'Raki to', 'Test', 'Jennyhery@proton.me', '+225358512334', NULL, '9344', NULL, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_device`
--

CREATE TABLE `user_device` (
  `id` bigint(20) NOT NULL,
  `id_user` bigint(20) NOT NULL,
  `token_device` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user_device`
--

INSERT INTO `user_device` (`id`, `id_user`, `token_device`) VALUES
(17, 12, 'fMx3fVilTDC6z5pQ1fe39r:APA91bEuMTCpUxkPbOVi4FAn1dCMRugC6XXDvp82u7_PGhUVYDz88-SgmALMiRBScbTMBw3ZvWo4sF6eE1n1utrigyj4U7uC4kdYONVLgsJ_feU389weYr2Icax2MHNIRZBHLB-7IR-z'),
(39, 21, 'f3VJZjNPQTaP1T0m7s-xM2:APA91bF_YixH1sFDZNGMcIdTP1ogWnMUkimY4GKJWLMNp2NnK3BUnufW36bjDh9qR99Ycd6SVLxaN1Pfh-6Rzdv5kAiKiK2yIG2ihqj2ZmN6COIlYUn5l5GM0gm4NZvDqj0dvhHEjmvb'),
(41, 23, 'e-zsX271RPKZj0jRc3WARu:APA91bEI-GXIx5vEBJAqD4OrvB82LNEKViqkL6v2nv7wtdCz3hiNYuXwPw1I3ZngoZjbQ6KbAQkhSrk4Ovc9ZLvRi6sKYtP6DCy8pghfdPA58gFX_BCB65LKKas0JzC-ACbI76KQhcQS'),
(42, 25, 'ddzgYz0pQqSV8fPQImMMLt:APA91bEwZp8hvmv7KvUvZEBju7N2jReHogqzKidEARdK3sPQjnZ_B9DKuCbuPIzMKOR-SrJGD9KcAT4aztHkMr-xEQ5ivpoCWcNx3FP6SzGjxTWqPTDmH6-y9PGb-SB0FseRXTcm7OO6'),
(43, 26, 'd8CuH2D2Qa-eX-QOSyLC0B:APA91bE1MIeKCV1TKAk7TrRS6SNXrpu-MjpIJP44esC5AwppljoYpjQDgfqvzd3dZlVIIFKUcO36KuINwFzUlxqw7HdN2U2E2uslMhqbZU7CB1lKy7hlI2R5fi9ZUQrp0Ki38BqmCKgo'),
(44, 27, 'ddzgYz0pQqSV8fPQImMMLt:APA91bEwZp8hvmv7KvUvZEBju7N2jReHogqzKidEARdK3sPQjnZ_B9DKuCbuPIzMKOR-SrJGD9KcAT4aztHkMr-xEQ5ivpoCWcNx3FP6SzGjxTWqPTDmH6-y9PGb-SB0FseRXTcm7OO6'),
(45, 29, 'd35cDRY8Sja3UB7Y2lm7NI:APA91bFnu7r4LivIXculXH5rXO5XPWApAlAcku0pFs3oj3Gx7CHo85uoKvL-4ws7vf2BtZix4PlCBTBcUmgNGRJ4VG7MJzgoQpXM-rencr1gDu29HJzruCqAe-39_i1rZGlF_UzBuoYs'),
(46, 31, 'dvvWT3x9SmaTCyRsmvM1uR:APA91bE3jtZRnyaL-HDV3QndQyihfXjLQc41vQZP5mfWj7wdGpA57RV9Uwm0_N5zjej2uvYUmlTZg31rdofpZScZdxRc-MqDFE4uyU2zRA0WmsMNLC4AJ3aAYR74KEDJkkEaBwqYZ0V7'),
(47, 33, 'fhOnpv2XS7GXAqBzafRxaC:APA91bH_m0j3KV7-ZP_kHQk4KRbw4dVic5-YVqwV3qdRzZwr66Mu12FnGUeUmZ5VC_I74ShbMbIf3UBhhN60CsZTNG1-kBwsqA7ybkDfhFY3D3ZhGfzg0Uub6YDXQABtQp8Yc6rFkqSF'),
(48, 34, 'cNE0mhhjSjOsjWWt9vn9xK:APA91bEVitgXBA8ka50RslMwtTV81973IvDV34nAtjyJKw-JGwG0mcpK7SUX0bxTxShqi0gvd-UTvxSiowwJOcE0ZysyjCGWqlPjhbROzR6k9k-lpQZqmpk6pjW1b9ziiWNALCDk3Nm-'),
(49, 35, 'e4a3tPRaT0iQKppgCVW4mb:APA91bE9qr6LexjBVkXH0IQpHK4HUsDYPjSGROYEf_XAMGUMvjq1Hs_eqe3UPZvzAuJv6ecVCmGKKhcItuJ1xaN-D_liYYH6L1uTPb6rWBKXLkV5x6opHmUcL1seLgLlS9z8KXBqjQsn'),
(50, 36, 'cJyqxjIQShC1nHhG3nAn8u:APA91bEBhjFWMJlij8Av7yma0jBUPPo7iZdSrlsQXUMqgSyE11Rs5CpmjbM0M2QFLF3aJuZLGujmxaOhbbdBfzHI7K6w2iK6ppvhrSGHf0vQ4eMZQ13IRS1xPGFZRCQ_Z5rXKEPATvZb'),
(51, 37, 'ebZ3B35qRPGkNExV_YWVss:APA91bHY0mc9pdeaXJfBBK1ZtVJp5vLebCFjIRdxjYtudFw9r5A_0-EbRGpyJlwC0chhGlCmoEMYc2GtO91PLgDLpCmeOkF0usHF8ZAeMJMMHfO37QYXvbbJwA-rsKXQ1pbemy-mkXeE'),
(52, 39, 'fDeQc9bjQVuRH02Xj5vTgx:APA91bEYd78TTZwZO-UqsInabNVaoS7VPj2Sp_TOhtSHpMMlHop-WFRe0KKeBsxO9Bsy8ZbQBEFH8NyRZOhKTwzWum1OVyNHhQSazkf-119OJgmsj23zGgRfhrQV_At73feBwiwoPTKh'),
(53, 40, 'fDeQc9bjQVuRH02Xj5vTgx:APA91bEYd78TTZwZO-UqsInabNVaoS7VPj2Sp_TOhtSHpMMlHop-WFRe0KKeBsxO9Bsy8ZbQBEFH8NyRZOhKTwzWum1OVyNHhQSazkf-119OJgmsj23zGgRfhrQV_At73feBwiwoPTKh'),
(54, 41, 'eguuaRRBRAaY7EBsZmU0n4:APA91bGkSQ1BaBt9fe6RKLmydpPIInJ7xISduxwKG5yMoLoy_cFqEQdqCHI8GNWXJZTmWhdHKu-uWX1XOtP0DYkvS37Kg4i7_DsIfAkhH2TWl8MdwbNbvHdlthKQTisvWhNWT5Sv7QeS'),
(55, 45, 'fCYeWS65TNSgKvI4rDdo3l:APA91bFvx6rWkQJUqONyHh-eIJhSVOvxayERLR40uIscTe92V7uXfppCif4j8r15TQzuz5oJGu_3bwYTkM8acDeNMyU-9mHwOcrveGaLE3NfZK2nub_4br8cg2mhoHF8lYf6ffx-7WTr'),
(56, 46, 'dfcR0heZSVaQWkt5mQV72J:APA91bEZosoZmbnIA_Jzp0uT5gDx2QrkcuANFiw8P3cJLRz8dSTgE7RH-NOajBXVUdM_UKzneskSdWJQMWdkobyrRH2tO1jn0vR2pbAaMkGtPGVxr-AkHutb8z4bIHd46UxUDIwmB4F-'),
(57, 48, 'dybYvsRDS2Gqv9QQaTZRWE:APA91bFSv7JSGaV6dZ7em-yKkeId3d0E3ZPmOo27NCws8mMbO0udbwNTFVSqfcb_MBLPpbN2tqLCpoCeGdXKxV_TMk3aJaIHh_G8BAovndoTIPoS9c-xvEsJBHDkIKVG-Zm7CvyJ9cya'),
(58, 49, 'cQ14MPv4RF6IHZRHjHhjnq:APA91bE2YSVLu4cuH4PkiXhLwHpUgn2HPJSZQSmBjZM_rI_6ASrY40lxSJF9dKBSOf2yTr5zWmDXcGWnM8uHN11Q10wPv0Ufy1sloV8dY2RGXaT9mBPKVT5MNE35JIhmt9FrkUARc00e'),
(59, 25, 'cOgr7Ag_SqWhhnLqxfVpoP:APA91bGcZsjX_cng3fi9AHbH6l5gmknB61dR0wg02NZwQ3fljL_vOSL0ieU_Gvp1dLHOnqdV5CaxYQZyDIk3rVMftIxOBaCYhshSfOJReJDn7yIJ20M5jzvy95GErfDtvTerdR-0ipap'),
(60, 27, 'cOgr7Ag_SqWhhnLqxfVpoP:APA91bGcZsjX_cng3fi9AHbH6l5gmknB61dR0wg02NZwQ3fljL_vOSL0ieU_Gvp1dLHOnqdV5CaxYQZyDIk3rVMftIxOBaCYhshSfOJReJDn7yIJ20M5jzvy95GErfDtvTerdR-0ipap'),
(61, 25, 'fw9YY36JT6ChcirBZsU-_X:APA91bHc2nXvKNitmajNa1ejfQgN9eogbgn0VwV86mEkcUM5nVS6vRM1eBnKJH4ddMuRqgU41UTTdgXa9kRkHmkjGbjfQeZgi9ufJie-cDbpuLLm2IlQ8i6zLWLwCphef_GVXrjcPI0T'),
(62, 25, 'dYtGIusXRQmZNWyDLjlgLN:APA91bEgbecFYEXUXUdohLT5KxzoFC6SN4qmFNDkSx09CWm9af47Nx60AbHLCtuH2PSBBEUvclah2zLhVUc7XgdDcwoHEx8ypP1U2ryNQG4chHAq3aGJWWdWdNyXSr-ZnBof-lsBcwR1'),
(63, 27, 'e68fZ0Q_S5m6hrciJptAPW:APA91bFQoMmcqSFBx-1ms4wpDcnPrn8FiImwV2u-3vQLHbFD2Z9nLCWvCDv5vTz9-m0jHif3tHmafvgXrERa-fFE-ydWt9jR1ZlyNHl4w8iX4fiY9y23TyogUGkzk4KGbrcBzET9j_G2'),
(64, 52, 'eG8-4271SFOtywnrTaLYHV:APA91bEpvzl_pm-HHBP6BiZ1xNpA-ZBi_IFxh-uf9ZvIj9pxOccV4mPHi_8jp4foepRg93HycYRMyLN_18OrBrH6nM7LozSIbczymKAOFDpFyqy4oDHXUvFMNt_0zGc6Hv2EV5cRmFNm'),
(65, 53, 'deT60d0nS7eZ6AZOT0Skjv:APA91bGxaeXLPN82JP4sXXPfyQMQyI_Unx8IzsWbwEXBVpX3fRv4QxRfwFQYIXByiUnKZshT4cLpWbCQByowdlFsShlfe-ZoSu7BOVcFl-rLkq1RkfTx5Xa-YieHHbGtzNFRMYd43PVG'),
(66, 54, 'eSnunulXTRKzCPx9JXs63q:APA91bFmGGreTZE0_5cfvS_59qDth46wE9aCWY4SgcporFoFNt68cHIM3lXMKOUryDkvaF4j-Y7uyZT-4ipDAArQ_biMT9sgjUL-ZMtj1qzaTGRXCPVfChjLXqAaHO39j5Qr9LE_QJbQ'),
(67, 55, 'fBSJCPUvQ6mZZLKvwzhgW6:APA91bEpNX2WYCl2vdj6ClshtGrmklmyTGmISp8E0P21dNl8M96ysM0PfILvr2LGU95_4UQaomio0e9RHSMccpkbKmfSPm330uD-V5LGYt6o_o4GnTQDlikyK74lOKrd2hUgHaoHqhsp'),
(68, 56, 'dZWHMK1rSaK_urfhu1Fnuw:APA91bHpQ3ArHwou0_sXGBRtU19NjZVPjiVm05Ntgn-MDloMxIHEoHbfMZVnRURSgXrvyM-hf2lMk2rOELIkC5S-JwRYFum0S-gSedF_81gTueGbGyljStcfHAOZAXyyJC7kGKSMoRrt'),
(69, 57, 'fAQiqZA0QuW7yamKjer12T:APA91bHWdYB0h7g98fQS_cL0GbBiloKgJ-niPSc00ZtWdatgORm4_Pl_kgKNYLmvkWSoLZtaiqwc54QPV43RzmMIHSyTpik-A2MaLiKxTVibrGUnpyJq-WZx2OaDccqG-IRGM12_sEFD'),
(70, 60, 'dGj1v48hQUGxf3VgFJpSXQ:APA91bEWvRqT-SDte0rqVfL--p6V49YOZFs_pXgaXJeDsXPBaBIb2JHDnYWf458-FYBeeGBJqq1rPUJlaQBsH4BszLKdp5TesZPhUH_M9toDqNtHAc6sea5XtT-JYzzbdy_0vdSPb4hC'),
(71, 33, 'f1wzQnuEThi_5NB1Whw9uq:APA91bEtKNutdzYXMxW8Zc0iOF5ME5UrDg9VqgdwScNHFlXbWnP8v-6y6l2c3hAwD6u1W5Ji9KjZrsauHL4DwcdvSWntXBv3vEVpTfiT41jgV2PP9zf_JTH6kP2IvBm3hELxj-iRPz37');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`idcontact`);

--
-- Index pour la table `description`
--
ALTER TABLE `description`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fo_header`
--
ALTER TABLE `fo_header`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fo_slogan`
--
ALTER TABLE `fo_slogan`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `functionality`
--
ALTER TABLE `functionality`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `historique_offre`
--
ALTER TABLE `historique_offre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `notification_offre`
--
ALTER TABLE `notification_offre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `numero_paiement`
--
ALTER TABLE `numero_paiement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `offre`
--
ALTER TABLE `offre`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `operateur_telephonique`
--
ALTER TABLE `operateur_telephonique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement_setting`
--
ALTER TABLE `paiement_setting`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement_user`
--
ALTER TABLE `paiement_user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paiement_vendeur`
--
ALTER TABLE `paiement_vendeur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `plateforme`
--
ALTER TABLE `plateforme`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `plateforme_numero`
--
ALTER TABLE `plateforme_numero`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Index pour la table `plateforme_transaction`
--
ALTER TABLE `plateforme_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `propos`
--
ALTER TABLE `propos`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `remboursement`
--
ALTER TABLE `remboursement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service_client`
--
ALTER TABLE `service_client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_device`
--
ALTER TABLE `user_device`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `idcontact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `description`
--
ALTER TABLE `description`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `fo_header`
--
ALTER TABLE `fo_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `fo_slogan`
--
ALTER TABLE `fo_slogan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `functionality`
--
ALTER TABLE `functionality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `historique_offre`
--
ALTER TABLE `historique_offre`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `notification_offre`
--
ALTER TABLE `notification_offre`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `numero_paiement`
--
ALTER TABLE `numero_paiement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `offre`
--
ALTER TABLE `offre`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `operateur_telephonique`
--
ALTER TABLE `operateur_telephonique`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `paiement_setting`
--
ALTER TABLE `paiement_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `paiement_user`
--
ALTER TABLE `paiement_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `paiement_vendeur`
--
ALTER TABLE `paiement_vendeur`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `plateforme`
--
ALTER TABLE `plateforme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `plateforme_numero`
--
ALTER TABLE `plateforme_numero`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `plateforme_transaction`
--
ALTER TABLE `plateforme_transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `propos`
--
ALTER TABLE `propos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `remboursement`
--
ALTER TABLE `remboursement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `service_client`
--
ALTER TABLE `service_client`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `user_device`
--
ALTER TABLE `user_device`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
