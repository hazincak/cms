-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2021 at 02:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(4) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(24, 'Breakfast and Brunch'),
(25, 'Cakes'),
(28, 'Pork recipes'),
(29, 'Italian Cuisine'),
(30, 'Pork recipes'),
(33, 'Chicken Recipes');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_user_id` int(4) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_user_id`, `comment_content`, `comment_status`, `comment_date`) VALUES
(21, 156, 23, 'perfect post. Tasty recipe', 'approved', '2021-02-20');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_name` text NOT NULL,
  `image_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `image_post_id`) VALUES
(216, 'pancakes2.jpg', 143),
(250, 'breakfast2.jpg', 144),
(267, 'brownies2.jpg', 150),
(268, 'brownies3.jpg', 150),
(269, 'brownies4.jpg', 150),
(270, 'brownies5.jpg', 150),
(281, 'schnitzel2.jpg', 156),
(282, 'schnitzel3.jpg', 156);

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `ingredient_id` int(11) NOT NULL,
  `ingredient_description` text NOT NULL,
  `ingredient_post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`ingredient_id`, `ingredient_description`, `ingredient_post_id`) VALUES
(101, '100g plain flour', 143),
(103, '300ml milk', 143),
(104, '1 tbsp sunflower or vegetable oil, plus a little extra for frying', 143),
(105, 'lemon wedges to serve (optional)', 143),
(106, 'caster sugar to serve (optional)', 143),
(132, 'Vegetable, sunflower, or olive oil, for frying', 144),
(133, 'Butter, for frying and spreading on toast', 144),
(134, '1-2 medium-size pork sausages', 144),
(135, '1-2 slices (rashers) thick-cut, dry-cured, smoked or unsmoked, Canadian (back) or regular (streaky) bacon, rind removed', 144),
(136, '2 to 3 slices of black and/or white pudding', 144),
(137, '2 ounces (50g) button mushrooms, sliced, or 1 large flat mushroom, stem removed', 144),
(138, 'Salt and freshly ground black pepper', 144),
(139, '1 ripe tomato, halved', 144),
(140, 'Pinch of sugar (if roasting the tomato in the oven)', 144),
(160, ' 185g unsalted butter', 150),
(161, '185g best dark chocolate', 150),
(162, '85g plain flour', 150),
(163, '40g cocoa powder', 150),
(164, '50g white chocolate', 150),
(165, '50g milk chocolate', 150),
(166, '3 large eggs', 150),
(167, '275g golden caster sugar', 150),
(209, '1 tablespoon olive oil, or as desired', 156),
(210, '6 chicken breasts, cut in half lengthwise (butterflied)', 156),
(211, 'salt and ground black pepper to taste', 156),
(212, '¾ cup all-purpose flour', 156),
(213, '1 tablespoon paprika', 156),
(214, '2 eggs, beaten', 156),
(215, '2 cups seasoned bread crumbs', 156),
(217, '1 large lemon, zested', 156);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(4) NOT NULL,
  `post_category_id` int(4) NOT NULL,
  `post_user_id` int(4) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_short_description` text NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_prep_time` varchar(50) NOT NULL,
  `post_cook_time` varchar(50) NOT NULL,
  `post_servings` int(6) NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_user_id`, `post_title`, `post_short_description`, `post_date`, `post_image`, `post_content`, `post_prep_time`, `post_cook_time`, `post_servings`, `post_tags`, `post_comment_count`, `post_status`) VALUES
(143, 24, 23, 'Easy Pancakes', 'Perfect pancakes every time.', '2021-02-20', '4.jpg', '<h3>STEP 1</h3><p>Put 100g plain flour, 2 large eggs, 300ml milk, 1 tbsp sunflower or vegetable oil and a pinch of salt into a bowl or large jug, then whisk to a smooth batter.</p><p>&nbsp;</p><h3>STEP 2</h3><p>Set aside for 30 mins to rest if you have time, or start cooking straight away.</p><p>&nbsp;</p><h3>STEP 3</h3><p>Set a medium frying pan or crêpe pan over a medium heat and carefully wipe it with some oiled kitchen paper.</p><p>&nbsp;</p><h3>STEP 4</h3><p>When hot, cook your pancakes for 1 min on each side until golden, keeping them warm in a low oven as you go.</p><p>&nbsp;</p><h3>STEP 5</h3><p>Serve with lemon wedges and caster sugar, or your favourite filling. Once cold, you can layer the pancakes between baking parchment, then wrap in cling film and freeze for up to 2 months.</p>', '60', '15', 4, 'pancakes breakfast brunch', 0, 'published'),
(144, 24, 23, 'Full Irish breakfast', 'Full Irish breakfast including the following: Bacon, sausages, baked beans, eggs, mushrooms, grilled tomatoes, and some cooked leftover potatoes made into a hash or a bubble and squeak.', '2021-02-20', 'breakfast1.jpg', '<p>Step 1</p><p>&nbsp;</p><p>Heat 1 tablespoon oil and 1 tablespoon butter in a large frying pan over a medium heat. Add the sausages and fry for 10 to 15 minutes, until golden and cooked through. Add the bacon and fry for 3 to 4 minutes on each side, until crisp and golden, dabbing off any milky liquid with paper towels. Add the black and/or white pudding slices to the pan and fry for 2 to 3 minutes on each side, until beginning to crisp; the white pudding (if using) should turn golden. Remove the sausages, bacon, and pudding slices from the pan and drain on paper towels.</p><p>&nbsp;</p><p>&nbsp;</p><p>Step 2</p><p>&nbsp;</p><p>Place in an ovenproof dish in a low oven to keep warm.</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>Step 3</p><p>&nbsp;</p><p>&nbsp;</p><p>Meanwhile, add a dash of oil and pat (knob) of butter to another frying pan over medium heat. Add the button mushrooms and sauté for 3 to 4 minutes, until softened and turning golden. Season with salt and pepper, then remove from the pan and keep warm (adding to the dish with the sausages and bacon). If you are cooking a large flat mushroom, then add the oil and butter to the pan and fry the mushroom for 8 to 10 minutes, turning halfway through, until softened and browned.</p><p>&nbsp;</p><p>&nbsp;</p><p>Step 4 &nbsp;</p><p>&nbsp;</p><p>Season the cut side of the tomato halves with salt and pepper and drizzle over 1 tablespoon of oil. Gently fry them, cut side down first, for 2 to 3 minutes, then turn over and fry for another 2 to 3 minutes, until just softened.</p><p>Alternatively, cook the large flat mushroom and/or the tomatoes in the oven. Preheat the oven to 400°F (200°C/Gas mark 6). Drizzle 2 teaspoons of olive oil over or add a pat (knob) of butter to the mushroom and season with salt and pepper before roasting for 12 to 15 minutes, until softened. If you are using the oven, begin roasting the mushroom and tomatoes a few minutes before frying the sausages and bacon. Once cooked, decrease the oven temperature to low for keeping everything warm as it is cooked.</p><p>&nbsp;</p><p>&nbsp;</p><p>Step 5</p><p>&nbsp;</p><p>To fry an egg, melt a pat (knob) of butter in a small, clean frying pan over low heat. Carefully crack the egg into the pan and allow to fry gently. For an over-easy egg, fry for 1 to 2 minutes, until it begins to set, then flip over and fry for another 1 to 2 minutes. If you prefer your egg sunny side up, then fry gently for 4 to 5 minutes, until the yolk has filmed over. Remove from the pan and serve immediately with the other cooked ingredients.</p><p>&nbsp;</p><p>&nbsp;</p><p>Step 6</p><p>&nbsp;</p><p>For scrambled eggs, crack the eggs into a bowl, add the milk, season with salt and pepper, and beat together. Add 1 tablespoon of the butter to a small saucepan over low heat. Immediately pour in the eggs and cook for 2 to 3 minutes, stirring continuously (I find a wooden spatula best for this), until the butter has melted and the eggs are softly scrambled. Remove from the heat immediately so that the eggs don\'t become overcooked. Serve with the other cooked ingredients.</p><p>&nbsp;</p><p>Step 7</p><p>&nbsp;</p><p>While the egg is cooking, put the slices of bread in a toaster or toast under a preheated broiler (grill) for a few minutes (and on both sides, if using the broiler/grill) until golden. Butter the toast and cut the slices in half.</p><p>To serve, arrange everything on a warm serving plate, with the hot buttered toast on the side and with some tomato ketchup or relish.</p>', '30', '30', 4, 'breakfast, irish, brunch, breakfast', 0, 'published'),
(150, 25, 23, 'Chocolate brownies', 'A foolproof brownie recipe for a squidgy chocolate bake.', '2021-02-20', 'brownies1.jpg', '<p>STEP 1</p><p>Cut 185g unsalted butter into small cubes and tip into a medium bowl. Break 185g dark chocolate into small pieces and drop into the bowl.</p><p>&nbsp;</p><p>STEP 2</p><p>Fill a small saucepan about a quarter full with hot water, then sit the bowl on top so it rests on the rim of the pan, not touching the water. Put over a low heat until the butter and chocolate have melted, stirring occasionally to mix them.</p><p>&nbsp;</p><p>STEP 3</p><p>Remove the bowl from the pan. Alternatively, cover the bowl loosely with cling film and put in the microwave for 2 minutes on High. Leave the melted mixture to cool to room temperature.</p><p>&nbsp;</p><p>STEP 4</p><p>While you wait for the chocolate to cool, position a shelf in the middle of your oven and turn the oven on to 180C/160C fan/gas 4.</p><p>&nbsp;</p><p>STEP 5</p><p>Using a shallow 20cm square tin, cut out a square of non-stick baking parchment to line the base. Tip 85g plain flour and 40g cocoa powder into a sieve held over a medium bowl. Tap and shake the sieve so they run through together and you get rid of any lumps.</p><p>&nbsp;</p><p>STEP 6</p><p>Chop 50g white chocolate and 50g milk chocolate into chunks on a board.</p><p>&nbsp;</p><p>STEP 7</p><p>Break 3 large eggs into a large bowl and tip in 275g golden caster sugar. With an electric mixer on maximum speed, whisk the eggs and sugar. They will look thick and creamy, like a milk shake. This can take 3-8 minutes, depending on how powerful your mixer is. You’ll know it’s ready when the mixture becomes really pale and about double its original volume. Another check is to turn off the mixer, lift out the beaters and wiggle them from side to side. If the mixture that runs off the beaters leaves a trail on the surface of the mixture in the bowl for a second or two, you’re there.</p><p>&nbsp;</p><p>STEP 8</p><p>Pour the cooled chocolate mixture over the eggy mousse, then gently fold together with a rubber spatula. Plunge the spatula in at one side, take it underneath and bring it up the opposite side and in again at the middle. Continue going under and over in a figure of eight, moving the bowl round after each folding so you can get at it from all sides, until the two mixtures are one and the colour is a mottled dark brown. The idea is to marry them without knocking out the air, so be as gentle and slow as you like.</p><p>&nbsp;</p><p>STEP 9</p><p>Hold the sieve over the bowl of eggy chocolate mixture and resift the cocoa and flour mixture, shaking the sieve from side to side, to cover the top evenly.</p><p>&nbsp;</p><p>STEP 10</p><p>Gently fold in this powder using the same figure of eight action as before. The mixture will look dry and dusty at first, and a bit unpromising, but if you keep going very gently and patiently, it will end up looking gungy and fudgy. Stop just before you feel you should, as you don’t want to overdo this mixing.</p><p>&nbsp;</p><p>STEP 11</p><p>Finally, stir in the white and milk chocolate chunks until they’re dotted throughout.</p><p>&nbsp;</p><p>STEP 12</p><p>Pour the mixture into the prepared tin, scraping every bit out of the bowl with the spatula. Gently ease the mixture into the corners of the tin and paddle the spatula from side to side across the top to level it.</p><p>&nbsp;</p><p>STEP 13</p><p>Put in the oven and set your timer for 25 mins. When the buzzer goes, open the oven, pull the shelf out a bit and gently shake the tin. If the brownie wobbles in the middle, it’s not quite done, so slide it back in and bake for another 5 minutes until the top has a shiny, papery crust and the sides are just beginning to come away from the tin. Take out of the oven.</p><p>&nbsp;</p><p>STEP 14</p><p>Leave the whole thing in the tin until completely cold, then, if you’re using the brownie tin, lift up the protruding rim slightly and slide the uncut brownie out on its base. If you’re using a normal tin, lift out the brownie with the foil. Cut into quarters, then cut each quarter into four squares and finally into triangles.</p>', '60', '90', 6, 'cakes, brownies, desserts', 0, 'published'),
(156, 33, 27, 'Baked Chicken Schnitzel', 'Golden, crispy fried chicken breasts', '2021-02-20', 'schnitzel1.jpg', '<p>&nbsp;</p><p>Step 1.</p><p>Preheat oven to 425 degrees F (220 degrees C). Line a large baking sheet with aluminum foil and drizzle olive oil over foil. Place baking sheet in preheated oven.</p><p>&nbsp;</p><p>Step 2.</p><p>Flatten chicken breasts so they are all about 1/4-inch thick. Season chicken with salt and pepper.</p><p>&nbsp;</p><p>Step 3.</p><p>Mix flour and paprika together on a large plate. Beat eggs with salt and pepper in a shallow bowl. Mix bread crumbs and lemon zest together on a separate large plate. Dredge each chicken piece in flour mixture, then egg, and then bread crumbs mixture and set aside in 1 layer on a clean plate. Repeat with remaining chicken.</p><p>Growing up, chicken schnitzel was a classic. I decided to make this dish oven-friendly using less oil, and an easier cleanup. This dish tastes great with potato salad, or mashed potatoes and a nice crisp salad. Tastes great the next day cold too! It\'s a family-favorite! Enjoy with fresh squeezed lemon juice.</p><p>&nbsp;</p><p>Step 4.</p><p>Remove baking sheet from oven and arrange chicken in 1 layer on the sheet. Drizzle more olive oil over each piece of coated chicken.</p><p>&nbsp;</p><p>Step 5.</p><p>Bake in the preheated oven for 5 to 6 minutes. Flip chicken and continue baking until no longer pink in the center and the breading is lightly browned, 5 to 6 minutes more. An instant-read thermometer inserted into the center should read at least 165 degrees F (74 degrees C).</p>', '30', '90', 6, 'chicken, lunch, schnitzel, chinken breast', 1, 'published');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`) VALUES
(23, 'admin', '$1$JikBMKT7$lfDC4omqn/6PgNECHIlw01', 'Jan', 'Hazincak', 'jan.hazincak@gmail.com', '', 'admin', '$2y$10$iusesomecrazystrings22'),
(27, 'user', '$2y$10$iusesomecrazystrings2ur6nj.D8DC3mirp3W7h1NPF6FmX3StMW', 'Martin', 'Kukucka', 'M.Kukucka@gmail.com', '', 'subscriber', '$2y$10$iusesomecrazystrings22');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(8, '1jjrr85ttjcvtlqcd0tpu4boua', 1591324789),
(9, 'd22h7a0lkhr57ngpd2l2dj0e5r', 1591419707),
(10, 'pv5svguq7e91ld7v0g211natnp', 1591464353),
(11, 'koo7bejr1j4n88trt9d3ddqft0', 1591465090),
(12, 'nq4bjd001o7pi11l4er8tjit0k', 1591474613),
(13, 'j3cfc37f4hdhrvmr6d07o5f21b', 1591491346),
(14, 's6tnh9tkjr7h8e9kj8v6vvr8bp', 1611941153),
(15, '35emvjpkhj63trkmlavrc1i40s', 1613268950),
(16, '9kkbu3gur5o5u59d8mcpjf8o05', 1613358435),
(17, 'h0g389rpabim622ruj6d48trou', 1613294719),
(18, 'je6n2reo6omctjr13ttfht9pnn', 1613356553),
(19, 'nhq6eo2b8egibq452766m3c15f', 1613365544),
(20, 'ekbkds3t81ffjv126m45cqllme', 1613398045),
(21, 'kpo85gvt78foolhk80e6d8stk9', 1613404466),
(22, 'c9vmahd5kcvk94h8v146qn0e5f', 1613443687),
(23, 'k45fti57vkhk6apfkcerjjd122', 1613454973),
(24, '1v3e580f0clttk1o2ipldv4a18', 1613474679),
(25, 'il56du7ihumgcvepk9p7n3fdhv', 1613498857),
(26, 'rj9citbnufma6stn5gribl9l5h', 1613571463),
(27, '6slvquogh3008e0fepeeva3ib1', 1613579259);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `comment_post_id` (`comment_post_id`),
  ADD KEY `comment_user_id` (`comment_user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `image_post_id` (`image_post_id`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`ingredient_id`),
  ADD KEY `ingredient_post_id` (`ingredient_post_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_category_id` (`post_category_id`),
  ADD KEY `post_user_id` (`post_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `ingredient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=218;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`comment_post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`comment_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`image_post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_ibfk_1` FOREIGN KEY (`ingredient_post_id`) REFERENCES `posts` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`post_category_id`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`post_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
