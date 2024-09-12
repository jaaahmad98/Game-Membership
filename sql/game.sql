-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2023 at 07:59 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21027470_gamedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `EventID` int(11) NOT NULL,
  `EventName` varchar(255) NOT NULL,
  `EventImage` varchar(255) NOT NULL,
  `EventDescription` text NOT NULL,
  `GameId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`EventID`, `EventName`, `EventImage`, `EventDescription`, `GameId`) VALUES
(1, 'Valorant Champion Los Angeles', 'uploads\\Valorant-events01.jpg', 'Today we are excited to share the initial details of the ticket sales for Champions Los Angeles!\r\nChampions is the final event of the 2023 VALORANT Champions Tour and represents the culmination of the competitive VALORANT season. Throughout the year, the top teams from around the world battled through their respective International Leagues and Regional Qualifiers to earn one of the sixteen spots at the largest international event of the year. From August 6 - 26 qualified teams will converge in Los Angeles to compete for the Champions trophy and the title of VALORANT World Champion!', 1),
(2, 'APEX LEGENDS™: ARSENAL PATCH NOTES', 'uploads\\apex-legend-events01.png', '\r\nNEW LEGEND: BALLISTIC\r\n\r\nBefore the Apex Games, a more brutal competition held sway: the Thunderdome Games! Here, sibling fighters Sok Leng and Kit Siang Phua reigned supreme. They were joined by August Brinkman, Sok Leng’s eventual husband. But when August’s selfish playstyle led to Kit Siang’s death, August would retreat from the Games, from Sok Leng, and from their young son, Nate.\r\n\r\nAugust spent decades as a recluse. When Nate decides to follow his family’s legacy into the arena, August returns to strike a deal to reenter the Games in his son’s place.\r\n\r\nPASSIVE: SLING\r\n\r\nStore a third weapon in the sling. Access via inventory or Character Utility Action Button. The sling weapon cannot take attachments.\r\n\r\nTACTICAL: WHISTLER\r\n\r\nShoots a projectile that heats up an enemy\'s gun as they shoot. Overheating causes damage. Hold the Tactical to lock-on.\r\n\r\nULTIMATE: TEMPEST\r\n\r\nNearby teammates get faster reloads, faster-armed move speed, and Infinite Ammo. The sling weapon will be upgraded to gold.', 2),
(3, 'Counter Strike 2 is coming', 'uploads\\CSGO-event01.jpg', 'Counter-Strike 2, the long-awaited follow-up to 2012’s Counter-Strike: Global Offensive, is official. As one of the most popular and iconic FPS franchises, there is a lot of excitement for this sequel – but what is the CS2 release date?\r\n\r\nDespite being over a decade old, and Counter-Strike itself over 22 years old, CS:GO has continued to grow in popularity. As of April 2023, it had almost 30 million active players and hit a new peak player count of 1.8 million.\r\n\r\nBut Valve knows the game is becoming outdated, and so has been working on the sequel, Counter-Strike 2, which uses the new Source 2 engine, and it’s finally ready for release.\r\n\r\nCounter-Strike 2 will release in Summer 2023, Valve has confirmed. This would place the release somewhere between June 30 and September 30.', 3),
(29, 'New Agent Revealed: DeadLock', 'uploads\\deadlock-reveal.jpg', 'Deadlock revealed as Valorant Agent 23: Release date, abilities & more', 1),
(30, 'CS:GO 2023 TOURNAMENT SCHEDULE: EVERYTHING IN THE WORKS NEXT YEAR', 'uploads\\CSGO-event02.jpg', 'With the BLAST Premier World Finals finishing last weekend, a lot of fans are turning their attention to the coming year and the CS:GO 2023 tournament schedule. As one of the most popular games in the world, there’s a lot in store for CS fans.\r\n\r\nThe CS:GO tournament calendar is split between three major organizers: ESL, Intel Extreme Masters and BLAST. They share responsibility for planning and running the pro leagues, Majors and that all important World Final.\r\n\r\nESL PRO LEAGUE SEASON 17 & 18\r\nESL Pro Leagues will play a really important role in the CS:GO 2023 tournament schedule. Not only are there some competitive prize funds on offer but the winner of each season earns a direct seed into the Major.\r\n\r\nSEASON 17\r\nDates: March 1st – April 2nd 2023\r\nTeams: 24\r\nTotal prize pool: $835,000 USD\r\nQualifies to: IEM Cologne 2023\r\n\r\nSEASON 18\r\nDates: August 15th – September 24th\r\nTeams: 24\r\nTotal prize pool: $835,000 USD\r\nQualifies to: IEM Katowice 2024', 3),
(38, 'CELEBRATE 4 YEARS OF APEX LEGENDS WITH THE ANNIVERSARY COLLECTION EVENT.', 'uploads\\apex-legends-events02.jpg', 'The celebration continues with this year’s Anniversary Collection Event, featuring a community-created reward track, limited-time Legendary squad set cosmetics, and more. Unlock all 24 limited-time cosmetics and earn enough Heirloom Shards to unlock a Heirloom or Prestige Skin of your choice!\r\nCOMMUNITY-CREATED REWARD TRACKER\r\nThis year we’re featuring a reward track filled with 12 community-created cosmetics and more, totaling 24 event-limited skins that players can earn during the event. Complete challenges to unlock community-created rewards on the Rewards Track, including Epic skins for Wattson, Fuse, the C.A.R. SMG, and the Wingman', 2);

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `GameId` int(11) NOT NULL,
  `GameName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`GameId`, `GameName`) VALUES
(1, 'Valorant'),
(2, 'Apex Legends'),
(3, 'CSGO');

-- --------------------------------------------------------

--
-- Table structure for table `memberships`
--

CREATE TABLE `memberships` (
  `MembershipId` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `GameId` int(11) DEFAULT NULL,
  `TierId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `memberships`
--

INSERT INTO `memberships` (`MembershipId`, `UserId`, `GameId`, `TierId`) VALUES
(13, 16, 1, 1),
(14, 17, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `skins`
--

CREATE TABLE `skins` (
  `SkinID` int(11) NOT NULL,
  `SkinName` varchar(255) NOT NULL,
  `SkinImage` varchar(255) NOT NULL,
  `SkinDescription` text NOT NULL,
  `GameId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `skins`
--

INSERT INTO `skins` (`SkinID`, `SkinName`, `SkinImage`, `SkinDescription`, `GameId`) VALUES
(1, 'New ION EP5 Collection', 'uploads\\Valorant-Skin01.png', 'RM200', 1),
(2, 'Frenzied Frequency G7 Scout', 'uploads\\Apex_skin01.png', '$150', 2),
(3, 'Anubis Collection - R8 Revolver(Inlay)', 'uploads\\csgo_skin01.png', 'RM 90', 3),
(11, 'Prime Collection', 'uploads\\Valorant-skin02.png', 'RM 149', 1),
(12, 'Oni Collection Bundle', 'uploads\\Valorant-skin03.png', 'RM 104 (Great Discount)', 1),
(13, 'Glitchpop Collection\r\n', 'uploads\\Valorant-Skin04.png', 'RM 210', 1),
(21, 'Stained Glass Cannon Mastiff', 'uploads\\apex_skin02.png', 'RM 60', 2),
(22, 'The Notorious One Hemlok', 'uploads\\apex_skin03.png', 'RM 80', 2),
(23, 'Code of Honor EVA-8', 'uploads\\apex_skin04.png', 'RM 90', 2),
(24, 'Rescue Effort Kraber', 'uploads\\apex-skin05.png', 'RM 70', 2),
(31, 'Annubis Collection M4A4 | Eye of Horus', 'uploads\\csgo_skin02.png', 'RM 129', 3),
(32, 'Norse Collection USP-S | Pathfinder', 'uploads\\csgo_skin03.png', 'RM 70', 3),
(33, 'Norse Collection Dual Berettas | Pyre', 'uploads\\csgo_skin04.png', 'RM 100', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tiers`
--

CREATE TABLE `tiers` (
  `TierId` int(11) NOT NULL,
  `TierName` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tiers`
--

INSERT INTO `tiers` (`TierId`, `TierName`) VALUES
(1, 'Standard'),
(2, 'Premium'),
(3, 'VIP');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `ProfilePicture` varchar(255) DEFAULT NULL,
  `Role` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserId`, `Name`, `Email`, `Password`, `ProfilePicture`, `Role`) VALUES
(3, 'Admin1', 'admin@admin.com', 'admin1234', 'admin.jpg', 'admin'),
(16, 'Fansuri', 'fans@fans.com', '1234', 'uploads/men_outerwear_jacket_winter_co_1635662521_03f6ab5f_progressive.jpeg', 'user'),
(17, 'Fariq', 'fariq@fariq.com', '1234', 'uploads/sitemapppp.drawio - Copy.png', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `FK_events_games` (`GameId`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`GameId`);

--
-- Indexes for table `memberships`
--
ALTER TABLE `memberships`
  ADD PRIMARY KEY (`MembershipId`),
  ADD KEY `UserId` (`UserId`),
  ADD KEY `GameId` (`GameId`),
  ADD KEY `FK_memberships_tiers` (`TierId`);

--
-- Indexes for table `skins`
--
ALTER TABLE `skins`
  ADD PRIMARY KEY (`SkinID`),
  ADD KEY `FK_Skins_GameId` (`GameId`);

--
-- Indexes for table `tiers`
--
ALTER TABLE `tiers`
  ADD PRIMARY KEY (`TierId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `EventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `GameId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `memberships`
--
ALTER TABLE `memberships`
  MODIFY `MembershipId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `skins`
--
ALTER TABLE `skins`
  MODIFY `SkinID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tiers`
--
ALTER TABLE `tiers`
  MODIFY `TierId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `FK_events_games` FOREIGN KEY (`GameId`) REFERENCES `games` (`GameId`);

--
-- Constraints for table `memberships`
--
ALTER TABLE `memberships`
  ADD CONSTRAINT `FK_memberships_tiers` FOREIGN KEY (`TierId`) REFERENCES `tiers` (`TierId`),
  ADD CONSTRAINT `memberships_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`),
  ADD CONSTRAINT `memberships_ibfk_2` FOREIGN KEY (`GameId`) REFERENCES `games` (`GameId`);

--
-- Constraints for table `skins`
--
ALTER TABLE `skins`
  ADD CONSTRAINT `FK_Skins_GameId` FOREIGN KEY (`GameId`) REFERENCES `games` (`GameId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
