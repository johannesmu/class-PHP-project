-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 27, 2025 at 12:26 AM
-- Server version: 10.4.34-MariaDB-1:10.4.34+maria~ubu2004
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` varchar(64) NOT NULL,
  `reset` varchar(64) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`id`, `email`, `password`, `reset`, `active`, `last_seen`, `created`) VALUES
(9, 'test1@test.com', '$2y$10$2bs19rR1fISycBztOTWZZ.7VxqG0fvHLnnkv9ev53rIUOhzSLjPYG', '1ca97f4f0d70e5bd23fb218784b07a31', 1, '2025-03-27 00:22:30', '2025-03-27 11:22:30'),
(10, 'test2@test.com', '$2y$10$AX0DqfGYHH/lcsyyrOJxrOqJ56TuTpanwZJDcgAcbQcKLAK2RGxSy', 'b905511844e53094b95d8d3f28ce3bd5', 1, '2025-03-27 11:25:29', '2025-03-27 11:25:29');

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Author`
--

CREATE TABLE `Author` (
  `author_id` int(11) NOT NULL,
  `author_first` varchar(255) DEFAULT NULL,
  `author_last` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Author`
--

INSERT INTO `Author` (`author_id`, `author_first`, `author_last`) VALUES
(1, 'Blake', 'Snyder'),
(2, 'Francesco', 'Marciuliano'),
(3, 'Martin', 'Grondin'),
(4, 'Lilian', 'Jackson Braun'),
(5, 'Galia', 'Bernstein'),
(6, 'Marijn', 'Haverbeke'),
(7, 'David', 'Flanagan'),
(8, 'Fran', 'Bailey'),
(9, 'John', 'Robin Baker'),
(10, 'Christian', 'Rätsch'),
(11, 'Frank', 'Rowland Whitt'),
(13, 'David', 'Gordon Wilson'),
(14, 'Jim', 'Papadopoulos'),
(15, 'Frank', 'Rowland Whitt'),
(16, 'Wu', 'Ming-Yi'),
(17, 'John ', 'Montroll'),
(18, 'Deb', 'Fitzpatrick'),
(19, 'Stephanie', 'Campisi'),
(20, 'Ronald', 'J Roberts'),
(21, 'Tom', 'Wolfe'),
(22, 'Jess', 'Black'),
(23, 'Justine', 'Solomons-Moat'),
(24, 'John', 'Byl'),
(25, 'Herwig', 'Baldauf'),
(26, 'Pat', 'Doyle'),
(27, 'Andy', 'Raithby'),
(28, 'Takashi', 'Hiraide'),
(29, 'John', 'Byl');

-- --------------------------------------------------------

--
-- Table structure for table `Book`
--

CREATE TABLE `Book` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `isbn13` bigint(13) DEFAULT NULL,
  `isbn10` int(10) DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `pages` int(8) DEFAULT NULL,
  `summary` varchar(1024) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `tags` varchar(512) DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Book`
--

INSERT INTO `Book` (`id`, `title`, `tagline`, `isbn13`, `isbn10`, `year`, `pages`, `summary`, `image`, `tags`, `visible`) VALUES
(1, 'Save the Cat!', 'The Last Book on Screenwriting You\'ll Ever Need', 9781615931712, 1615931716, 2005, 195, 'Save the Cat\" is just one of many ironclad rules for making your ideas more marketable and your script more satisfying, including: The four elements of every winning logline The seven immutable laws of screenplay physics The 10 genres that every movie ever made can be categorized by -- and why they\'re important to your script Why your Hero must serve your Idea Mastering the 15 Beats Creating the \"Perfect Beast\" by using The Board to map 40 scenes with conflict and emotional change How to get back on track with proven rules for script repair This ultimate insider\'s guide reveals the secrets that none dare admit, told by a showbiz veteran who\'s proven that you can sell your script if you can save the cat.', 'book_2.jpeg', 'cat,screenwriting,nonfiction', 1),
(2, 'I Could Pee on This', 'And Other Poems by Cats', 9781452121864, 1452121869, 2012, 112, 'The internationally bestselling book of tongue-in-cheek poetry that set off a trend of feline funniness! Animal lovers will laugh out loud at the quirkiness of their feline friends with these insightful and curious poems from the singular minds of funny cats. The author of the internationally syndicated comic strip Sally Forth helps cats unlock their creative potential and explain their odd behavior to ignorant humans. With titles like \"Who Is That on Your Lap?,\" \"This Is My Chair,\" \"Kneel Before Me,\" \"Nudge,\" and \"Some of My Best Friends Are Dogs,\" the poems collected in I Could Pee on This perfectly capture the inner workings of the cat psyche. With photos of the cat \"authors\" throughout, this whimsical poetry book reveals kitties at their wackiest and most exas...', 'book_3.jpeg', 'cat,humour,parody,fiction', 1),
(3, 'LOLcat Bible ', 'In Teh Beginnin Ceiling Cat Maded Teh Skiez An Da Urfs N Stuffs', 9781569757345, 1569757348, 2010, 176, 'Discover the OG internet meme-turned-religious cult with the bestselling bible brought down by Ceiling Cat. Giv us dis day our dalee cheezburger.and furgiv us for makin yu a cookie, but eateding it. and we furgiv wen cats steel our cookiez.', 'book_4.jpeg', 'cat,humour,parody,fiction', 1),
(4, 'The Cat Who Said Cheese', '', 9780515120271, 515120278, 1997, 272, 'In this mystery in the bestselling Cat Who series, a murder sends Jim Qwilleran and his cats, Koko and Yum Yum, on a trail that will demand all their feline intuition and mustachioed insight... With the Great Food Explo approaching, there’s a lot of scrumptious activity in Moose County. Residents can’t wait for the restaurant openings, the cheese-tasting, and the bake-off, among other festivities. But there’s nothing as tasty as a morsel of gossip, so when a mysterious woman moves into the New Pickax Hotel, the locals—including Qwill—indulge in lots of speculation. But then a bomb explodes in her room, killing the hotel housekeeper—and now Qwill and his kitty sidekicks, Koko and Yum Yum, must put aside the fun and figure out who cooked up this murderous recipe...', 'book_5.jpeg', 'cat,humour,parody,fiction', 1),
(5, 'I Am a Cat', '', 9781683351801, 1683351800, 2018, 32, '\"A nonchalant string of anecdotes and wisecracks, told by a fellow who doesn\'t have a name, and has never caught a mouse, and isn\'t much good for anything except watching human beings in action…\" —The New Yorker Written from 1904 through 1906, Soseki Natsume\'s comic masterpiece, I Am a Cat, satirizes the foolishness of upper-middle-class Japanese society during the Meiji era. With acerbic wit and sardonic perspective, it follows the whimsical adventures of a world-weary stray kitten who comments on the follies and foibles of the people around him. A classic of Japanese literature, I Am a Cat is one of Soseki\'s best-known novels. Considered by many as the most significant writer in modern Japanese history, Soseki\'s I Am a Cat is a classic novel sure to be enjoyed for years to come.', 'book_6.jpeg', 'cat,humour,parody,fiction', 1),
(6, 'Eloquent JavaScript ', 'A Modern Introduction to Programming', 9781593279509, 1593279507, 2018, 450, 'Completely revised and updated, this best-selling introduction to programming in JavaScript focuses on writing real applications. JavaScript lies at the heart of almost every modern web application, from social apps like Twitter to browser-based game frameworks like Phaser and Babylon. Though simple for beginners to pick up and play with, JavaScript is a flexible, complex language that you can use to build full-scale applications. This much anticipated and thoroughly revised third edition of Eloquent JavaScript dives deep into the JavaScript language to show you how to write beautiful, effective code. It has been updated to reflect the current state of Java¬Script and web browsers and includes brand-new material on features like class notation, arrow functions', 'book_7.jpeg', 'javascript,programming,nonfiction', 0),
(7, 'JavaScript The Definitive Guide', '', 9780596101992, 596101996, 2006, 994, 'Since 1996, JavaScript: The Definitive Guide has been the bible for JavaScript programmers—a programmer\'s guide and comprehensive reference to the core language and to the client-side JavaScript APIs defined by web browsers. The 6th edition covers HTML5 and ECMAScript 5. Many chapters have been completely rewritten to bring them in line with today\'s best web development practices. New chapters in this edition document jQuery and server side JavaScript. It\'s recommended for experienced programmers who want to learn the programming language of the Web, and for current JavaScript programmers who want to master it. \"A must-have reference for expert JavaScript programmers...well-organized and detailed.\"', 'book_8.jpeg', 'javascript,programming,nonfiction', 1),
(8, 'The Healing Power of Plants ', 'The Hero House Plants that Love You Back', 9781473567283, 1473567289, 2019, 192, 'Make your home your happy place with house plants. Bring the outside in. This gorgeous guide features over 80 indoor plants that will turn your house into a happy, healthy, healing home. Discover plants that will clean the air you breathe, help you get a good night’s sleep, reduce stress and anxiety, help you get well soon, boost your brain power and bring greater joy and wellbeing into your life. From cacti and succulents to ferns and palms; flowering plants and foliage – find the perfect house plants for your living room, bathroom, bedroom and even your workspace. Bring the joy of the outdoors in and harness the natural healing power of plants.', 'book_9.jpeg', 'plants,domestic,nonfiction', 1),
(9, 'The Encyclopedia of Psychoactive Plants', 'Ethnopharmacology and Its Applications', 9780892819782, 892819782, 2005, 942, 'The most comprehensive guide to the botany, history, distribution, and cultivation of all known psychoactive plants Examines 414 psychoactive plants and related substances Explores how using psychoactive plants in a culturally sanctioned context can produce important insights into the nature of reality Contains 797 color photographs and 645 black-and-white illustrations nIn the traditions of every culture, plants have been highly valued for their nourishing, healing, and transformative properties. The most powerful plants--those known to transport the human mind into other dimensions of consciousness--have traditionally been regarded as sacred. In The Encyclopedia of Psychoactive Plants Christian Rätsch details the botany, history, distribution,', 'book_10.jpeg', 'plants,medicine,nonfiction', 1),
(10, 'Bicycling science', '', 9780262731546, 262731541, 2004, 477, 'A new, updated edition of a popular book on the history, science, and engineering of bicycles. The bicycle is almost unique among human-powered machines in that it uses human muscles in a near-optimum way. This new edition of the bible of bicycle builders and bicyclists provides just about everything you could want to know about the history of bicycles, how human beings propel them, what makes them go faster, and what keeps them from going even faster. The scientific and engineering information is of interest not only to designers and builders of bicycles and other human-powered vehicles but also to competitive cyclists, bicycle commuters, and recreational cyclists.', 'book_11.jpeg', 'cycling,nonfiction', 1),
(11, 'The Stolen Bicycle', '', 9781925498554, 1925498557, 2017, 416, 'Longlisted for the 2018 Man Booker International Prize. A writer embarks on an epic quest in search of his missing father\'s stolen bicycle and soon finds himself ensnared in the strangely intertwined stories of Lin Wang, the oldest elephant who ever lived, the soldiers who fought in the jungles of South-East Asia during World War II, and the secret world of butterfly handicraft makers in Taiwan. The result is both a majestic historical novel and an intimate meditation on memory, family and home. Wu\'s writing has been compared to that of Margaret Atwood, Haruki Murakami, W.G. Sebald and Yann Martel.', 'book_12.jpeg', 'drama,fiction', 1),
(12, 'Origami Dinosaurs for Beginners', '', 9780486498195, 486498190, 2013, 48, 'An internationally renowned origami master recaptures the prehistoric allure of dinosaurs with this new series of original models. Twenty famous and lesser-known creatures from the Mesozoic era include a tyrannosaurus, apatosaurus, pterodactylus, dimetrodon, quetzalcoatlus, and protoceratops. John Montroll designed these striking models with beginning paperfolders in mind. Based on his famous single-square, no-cuts, no-glue approach, they range from the very easy to the low-intermediate level. Each model features helpful diagrams and easy-to-follow instructions.', 'book_13.jpeg', 'origami,craft,nonfiction', 1),
(13, '90 Packets of Instant Noodles', '', 9781921361999, 1921361999, 2010, 307, 'Australians eat 150 million packets of instant noodles every year - that\'s about 7 packets each. But Joel is a teenager who goes to extremes, and 90 packets may not be enough. Joel and Craggs are in it together. They drink booze together, they flirt with petty theft together and, when Craggs turn violent, they face the consequences together too. That\'s when Joel\'s Dad makes a deal with the police. Craggs is off to juvenile detention and Joel to solitary confinement. 90 days of fending for himself in a remote bush shack. 90 days of his own company and his own cooking. 90 days of instant noodles...', 'book_14.jpeg', 'teenage,crime,fiction', 1),
(14, 'The Ugly Dumpling', '', 9781938063695, 1938063694, 2016, 32, '\"A whimsical story about being different, and the power of love.\"--Wendy Orr, author of Nim\'s Island and The Princess and Her Panther It\'s not easy being the ugliest dumpling in a dim sum restaurant. Uneaten and ignored, the ugly dumpling is down in the dumps. But when an encouraging cockroach sees the dumpling\'s inner beauty, this unlikely duo embarks on an eye-opening adventure, leading the ugly dumpling to discover its true identity and realize that being different is beautiful after all.', 'book_15.jpeg', 'dumpling,drama,fiction', 1),
(15, 'Fish Pathology', '', 9781118222966, 1118222962, 2012, 592, 'This new, fully updated and expanded fourth edition builds upon the success of the previous editions which have made Fish Pathology the best known and most respected book in the field, worldwide. Our knowledge of fish pathology has changed dramatically over the past decade, and as aquaculture continues to grow, this volume will help all those involved in the industry to define, to diagnose and ultimately control, in a sustainable way, the new diseases, which will assuredly manifest themselves.', 'book_16.jpeg', 'science,fish,pathology,nonfiction', 1),
(16, 'The Right Stuff', '', 9781448181971, 1448181976, 2018, 448, 'Tom Wolfe began The Right Stuff at a time when it was unfashionable to contemplate American heroism. Nixon had left the White House in disgrace, the nation was reeling from the catastrophe of Vietnam, and in 1979--the year the book appeared--Americans were being held hostage by Iranian militants. Yet it was exactly the anachronistic courage of his subjects that captivated Wolfe. In his foreword, he notes that as late as 1970, almost one in four career Navy pilots died in accidents. The Right Stuff, he explains, became a story of why men were willing--willing?--delighted!--to take on such odds in this, an era literary people had long since characterized as the age of the anti-hero. After an opening chapter on the terror of being a test pilot\'s wife, the story cuts back to the late 1940s,...', 'book_17.jpeg', 'politics,international,nonfiction', 1),
(17, 'Kitty Is Not a Cat: Lights Out', '', 9780734419750, 734419759, 2020, 60, 'A warmly funny junior-fiction series about Kitty, a little girl who believes she can be anything she dreams - even a cat. When Kitty arrives on the doorstep of a house full of music-mad felines, their lives are turned upside down as they attempt to teach her how to be human. Some children hate going to bed. Not Kitty! Kitty falls asleep every night curled up snug as a bug in a bed box. That is, until one spooky night when Kitty\'s night-light goes missing and her fear of the dark comes creeping out. The cats, unfamiliar with the concept, try to settle her down but to no avail. In the end, it won\'t be a night-light that saves the day.', 'book_18.jpeg', 'cat,humour,parody,fiction', 1),
(18, 'Behind Every Great Woman is a Great Cat', '', 9781912785063, 1912785064, 2019, 96, 'Uplifting stories of remarkable women and their cats combine with bestselling illustrator Lulu Mayo\'s fabulously quirky art to create an irresistible gift for cat lovers and their favorite felines. What do nursing pioneer Florence Nightingale, modernist artist Georgia O\'Keefe, and the revolutionary Rosa Luxemburg have in common? They all dared to change the world--and they all cherished their cats Behind Every Great Woman Is a Great Cat pairs uplifting stories of more than 30 kitty-loving women--artists, pioneers, writers, and humanitarians, including Colette, Julia Child, Betty White, Taylor Swift, and Gigi Hadid--with delightful pictures by bestselling illustrator Lulu Mayo. The book celebrates the fabulous feline as muse, companion, colleague, and emotional support ', 'book_19.jpeg', 'cat,humour,parody,fiction', 1),
(19, 'The Guest Cat', '', 9780811221511, 811221512, 2014, 144, 'A wonderful sui generis novel about a visiting cat who brings joy into a couple’s life in Tokyo A bestseller in France and winner of Japan’s Kiyama Shohei Literary Award, The Guest Cat, by the acclaimed poet Takashi Hiraide, is a subtly moving and exceptionally beautiful novel about the transient nature of life and idiosyncratic but deeply felt ways of living. A couple in their thirties live in a small rented cottage in a quiet part of Tokyo; they work at home, freelance copy-editing; they no longer have very much to say to one another. But one day a cat invites itself into their small kitchen. It leaves, but the next day comes again, and then again and again. Soon they are buying treats for the cat and enjoying talks about the animal and all its little ways.', 'book_20.jpeg', 'cat,humour,parody,fiction', 1),
(20, 'Chicken and Noodle Games', '141 Fun Activities with Innovative Equipment', 9780736063920, 736063927, 2007, 244, 'offer a variety of games that will keep everyone participating, provide inclusive and nontraditional games in which no player starts with an advantage, adapt games to various settings and occasions, andincrease players\' physical activity. Take this book, add rubber chickens, pool noodles, tennis balls, sponges, and bolts, sprinkle in kids, and what do you get? A recipe for pure, unadulterated--and wacky--fun! Written by game masters John Byl, Herwig Baldauf, Pat Doyle, and Andy Raithby; Chicken and Noodle Games: 141 Fun Activities With Innovative Equipment is your ticket to promoting fun and active participation for all involved. The games use easy-to-find equipment in nontraditional way', 'book_21.jpeg', 'craft,games,nonfiction', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Book_Author`
--

CREATE TABLE `Book_Author` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `Book_Author`
--

INSERT INTO `Book_Author` (`id`, `author_id`, `book_id`) VALUES
(1, 1, 1),
(3, 3, 3),
(4, 4, 4),
(5, 5, 5),
(6, 6, 6),
(7, 7, 7),
(8, 8, 8),
(9, 10, 9),
(10, 9, 9),
(11, 13, 10),
(12, 14, 10),
(13, 11, 10),
(14, 16, 11),
(15, 24, 12),
(16, 18, 13),
(17, 19, 14),
(18, 20, 15),
(19, 21, 16),
(20, 22, 17),
(21, 23, 18),
(22, 29, 20),
(23, 25, 20),
(24, 26, 20),
(25, 27, 20),
(26, 2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Admin_Account_Id` (`account_id`);

--
-- Indexes for table `Author`
--
ALTER TABLE `Author`
  ADD PRIMARY KEY (`author_id`);

--
-- Indexes for table `Book`
--
ALTER TABLE `Book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Book_Author`
--
ALTER TABLE `Book_Author`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Book_Author` (`author_id`),
  ADD KEY `Book_Book` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Account`
--
ALTER TABLE `Account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Author`
--
ALTER TABLE `Author`
  MODIFY `author_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `Book`
--
ALTER TABLE `Book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Book_Author`
--
ALTER TABLE `Book_Author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `Admin_Account_Id` FOREIGN KEY (`account_id`) REFERENCES `Account` (`id`);

--
-- Constraints for table `Book_Author`
--
ALTER TABLE `Book_Author`
  ADD CONSTRAINT `Book_Author` FOREIGN KEY (`author_id`) REFERENCES `Author` (`author_id`),
  ADD CONSTRAINT `Book_Book` FOREIGN KEY (`book_id`) REFERENCES `Book` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
