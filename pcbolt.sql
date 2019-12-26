-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2019. Dec 26. 12:14
-- Kiszolgáló verziója: 10.3.16-MariaDB
-- PHP verzió: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `pcbolt`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cpu`
--

CREATE TABLE `cpu` (
  `cikkszam` varchar(25) NOT NULL,
  `foglalatId` int(11) NOT NULL,
  `tipus` varchar(50) NOT NULL,
  `magok_szama` tinyint(2) NOT NULL,
  `szalak_szama` tinyint(2) NOT NULL,
  `orajel` smallint(5) NOT NULL,
  `turbo_orajel` smallint(5) NOT NULL,
  `l3cache` smallint(5) DEFAULT NULL,
  `l2cache` smallint(5) DEFAULT NULL,
  `huto` varchar(50) NOT NULL,
  `fogyasztas` smallint(3) NOT NULL,
  `gpu` varchar(25) DEFAULT NULL,
  `gpu_orajel` smallint(6) DEFAULT NULL,
  `kepurl` varchar(255) DEFAULT NULL,
  `garancia` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `cpu`
--

INSERT INTO `cpu` (`cikkszam`, `foglalatId`, `tipus`, `magok_szama`, `szalak_szama`, `orajel`, `turbo_orajel`, `l3cache`, `l2cache`, `huto`, `fogyasztas`, `gpu`, `gpu_orajel`, `kepurl`, `garancia`) VALUES
('AM42600', 4, 'Ryzen 5 2600', 6, 12, 3400, 3900, 16, 3, 'Nincs', 65, 'Nincs', 0, 'https://www.computerhouse.co.za/wp-content/uploads/2018/02/19-113-435-Z01.jpg', 36),
('AM42700NON', 4, 'Ryzen 7 2700', 8, 16, 3200, 4100, 16, 4, 'Nincs', 65, 'Nincs', 0, 'https://c1.neweggimages.com/ProductImage/19-113-498-V01.jpg', 36),
('AMAPU3TRTE', 4, 'Ryzen 3 2200G', 4, 4, 3500, 3700, 4, 2, 'Nincs', 65, 'Radeon™ Vega 8', 1100, 'https://c1.neweggimages.com/ProductImage/19-113-481-V01.jpg', 36),
('ASCF545433', 11512, 'Core i7 9700K', 8, 8, 3600, 4900, 12, 2, 'Nincs', 95, 'Intel UHD Graphics 630', 1150, 'https://c1.neweggimages.com/ProductImage/19-117-958-V03.jpg', 36),
('INT1143', 11512, 'Core i5-9400F', 6, 6, 2900, 4100, 9, 1, 'Nincs', 65, 'Nincs', 0, 'https://www.ple.com.au//imagelibrary/inventoryitemimages/183713-634598-full.jpg', 36),
('INT5435UU', 11512, 'Core i3-8350K', 4, 4, 4000, 4000, 8, 1, 'Nincs', 91, 'Intel UHD Graphics 630', 1150, 'https://c1.neweggimages.com/ProductImage/19-117-823-Z01.jpg', 36),
('INT9100F00', 11512, 'Core i3-9100F', 4, 4, 3600, 4200, 6, 1, 'Nincs', 65, 'Nincs', 0, 'https://c1.neweggimages.com/ProductImage/19-118-072-V01.jpg', 36),
('NBHHGJ6565', 11512, 'Core i5 9500F', 6, 6, 3000, 4400, 9, 2, 'Nincs', 65, 'Nincs', 0, 'https://c1.neweggimages.com/ProductImage/19-117-981-V01.jpg', 36),
('NBHZ54546U', 11512, 'Core i9 9900K', 8, 16, 3600, 5000, 16, 2, 'Nincs', 95, 'Intel UHD Graphics 630', 1150, 'https://c1.neweggimages.com/ProductImage/19-117-957-V01.jpg', 36),
('REWRWFS656', 11512, 'Core i5 8600K', 6, 6, 3600, 4300, 9, 2, 'Nincs', 95, 'Intel UHD Graphics 630', 1150, 'https://c1.neweggimages.com/ProductImage/19-117-825-Z01.jpg', 36),
('UZT5454534', 4, 'Ryzen 5 3600X', 6, 12, 3800, 4400, 32, 3, 'Nincs', 95, 'Nincs', 0, 'https://c1.neweggimages.com/ProductImage/19-113-568-V03.jpg', 36);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cpuarak1`
--

CREATE TABLE `cpuarak1` (
  `cpuarid` int(50) NOT NULL,
  `cikkszamcpu` varchar(25) NOT NULL,
  `ar` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `cpuarak1`
--

INSERT INTO `cpuarak1` (`cpuarid`, `cikkszamcpu`, `ar`) VALUES
(1, 'AM42600', '43700'),
(2, 'AM42700NON', '67890'),
(3, 'ASCF545433', '125100'),
(4, 'INT1143', '47990'),
(5, 'INT5435UU', '58962'),
(6, 'INT9100F00', '28750'),
(7, 'NBHHGJ6565', '62325'),
(8, 'NBHZ54546U', '160980'),
(9, 'REWRWFS656', '91000'),
(10, 'UZT5454534', '78225'),
(13, 'AMAPU3TRTE', '25200');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cpufoglalatok`
--

CREATE TABLE `cpufoglalatok` (
  `foglalatID` int(11) NOT NULL,
  `gyarto` varchar(10) DEFAULT NULL,
  `foglalat` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `cpufoglalatok`
--

INSERT INTO `cpufoglalatok` (`foglalatID`, `gyarto`, `foglalat`) VALUES
(2, 'AMD', 'FM2+'),
(3, 'AMD', 'AM3+'),
(4, 'AMD', 'AM4'),
(33, 'AMD', 'SP3'),
(44, 'AMD', 'TR4'),
(1151, 'Intel', 'LGA1151'),
(2011, 'Intel', 'LGA2011'),
(2066, 'Intel', 'LGA2066'),
(11512, 'Intel', 'LGA1151v2'),
(20113, 'Intel', 'LGA2011v3');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `gyartourl`
--

CREATE TABLE `gyartourl` (
  `itemCikkszam` varchar(255) NOT NULL,
  `Url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `gyartourl`
--

INSERT INTO `gyartourl` (`itemCikkszam`, `Url`) VALUES
('AROGB450ST', 'https://www.asus.com/hu/Motherboards/ROG-STRIX-B450-F-GAMING/specifications/'),
('ASUSROGZET', 'https://www.asus.com/hu/Motherboards/ROG-ZENITH-EXTREME/'),
('ASUSTB360P', 'https://www.asus.com/hu/Motherboards/TUF-B360-PRO-GAMING/'),
('G970ADS3PA', 'http://hu.gigabyte.com/products/page/mb/ga-970a-ds3prev_10#sp'),
('GAM4AORUSM', 'https://www.gigabyte.com/Motherboard/B450-AORUS-M-rev-10#kf'),
('GAX470AORU', 'https://www.gigabyte.com/Motherboard/X470-AORUS-ULTRA-GAMING-rev-10#kf'),
('GB450AE000', 'https://www.gigabyte.com/Motherboard/B450-AORUS-ELITE-rev-10#kf'),
('GIGX570GAX', 'https://www.gigabyte.com/Motherboard/X570-GAMING-X-rev-10#kf'),
('MPGZ390GAP', 'https://www.msi.com/Motherboard/MPG-Z390-GAMING-PLUS'),
('ROGMXIHERO', 'https://www.asus.com/hu/Motherboards/ROG-MAXIMUS-XI-HERO-WI-FI/specifications/');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mbformats`
--

CREATE TABLE `mbformats` (
  `Id` varchar(2) NOT NULL,
  `format` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `mbformats`
--

INSERT INTO `mbformats` (`Id`, `format`) VALUES
('A', 'ATX'),
('EA', 'E-ATX'),
('MA', 'Micro-ATX'),
('MI', 'Mini-ITX');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `mbprices`
--

CREATE TABLE `mbprices` (
  `MBarID` int(11) NOT NULL,
  `MBcikkszam` varchar(25) NOT NULL,
  `price` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `mbprices`
--

INSERT INTO `mbprices` (`MBarID`, `MBcikkszam`, `price`) VALUES
(1, 'GB450AE000', '32420'),
(2, 'ASUSTB360P', '29950'),
(3, 'ASUSROGZET', '200000'),
(4, 'GAM4AORUSM', '27150'),
(5, 'GIGX570GAX', '55990'),
(6, 'G970ADS3PA', '22500'),
(7, 'GAX470AORU', '48255'),
(8, 'AROGB450ST', '40350'),
(9, 'MPGZ390GAP', '40350'),
(10, 'ROGMXIHERO', '112600');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motherboard`
--

CREATE TABLE `motherboard` (
  `cikkszam` varchar(25) NOT NULL,
  `cpufoglalatID` int(11) NOT NULL,
  `memtipusID` int(3) NOT NULL,
  `memfoglalat` int(2) NOT NULL,
  `memMeret` int(4) NOT NULL,
  `chipset` varchar(15) NOT NULL,
  `meret` varchar(2) NOT NULL,
  `maxMemMHz` int(4) NOT NULL,
  `m2` int(1) DEFAULT NULL,
  `intLAN` varchar(120) DEFAULT NULL,
  `intHang` varchar(120) DEFAULT NULL,
  `sata3` int(2) DEFAULT NULL,
  `usb30` int(2) DEFAULT NULL,
  `usb31` int(2) DEFAULT NULL,
  `pcie16` int(2) DEFAULT NULL,
  `gyarto` varchar(2) NOT NULL,
  `MBtipus` varchar(100) NOT NULL,
  `picUrl` text NOT NULL,
  `garancia` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `motherboard`
--

INSERT INTO `motherboard` (`cikkszam`, `cpufoglalatID`, `memtipusID`, `memfoglalat`, `memMeret`, `chipset`, `meret`, `maxMemMHz`, `m2`, `intLAN`, `intHang`, `sata3`, `usb30`, `usb31`, `pcie16`, `gyarto`, `MBtipus`, `picUrl`, `garancia`) VALUES
('AROGB450ST', 4, 4, 4, 64, 'B450', 'A', 3466, 2, 'Intel I211-AT', 'ROG SupremeFX 8', 6, 6, 3, 3, 'As', 'ROG STRIX B450-F GAMING', 'https://www.asus.com/media/global/gallery/gSvoRx0Uib73jBhq_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/6BRSZbYAjm6nno4I_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/dAhcsyS0cWNigwNe_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/y5Evv87f5BsiNz3n_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/w5o4m2oSrNYTB4aU_setting_000_1_90_end_500.png', 3),
('ASUSROGZET', 44, 4, 8, 128, 'X399', 'EA', 2666, 3, 'Intel® I211-AT', 'ROG SupremeFX 8', 0, 0, 13, 4, 'As', 'ROG Zenith Extreme', 'https://www.asus.com/media/global/gallery/Kgj0l3hEYFq21uNc_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/ToCVtMO64zESDp3r_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/cjhIrX4cKRiW3ZJ7_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/P9R3VFvkG5mB5jZx_setting_000_1_90_end_500.png', 3),
('ASUSTB360P', 11512, 4, 4, 64, 'B360', 'A', 2666, 2, 'Intel® I219V, 1 db G', 'Realtek® ALC887', 6, 0, 3, 1, 'As', 'TUF B360-PRO GAMING', 'https://www.asus.com/media/global/gallery/SOBQvFXKMeBWWgBi_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/fMPFYnFp5aJvjlcI_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/UNI86f1qOaRoaM9K_setting_000_1_90_end_500.png', 3),
('G970ADS3PA', 3, 4, 4, 64, '970A', 'A', 1866, 0, 'Realtek® GbE LAN chip', 'Realtek® ALC887', 6, 4, 0, 1, 'Gi', '970A-DS3P', 'http://hu.gigabyte.com/products/upload/products/3543/51050301_5.jpg;http://hu.gigabyte.com/products/upload/products/3543/066606c9_5.jpg;http://hu.gigabyte.com/products/upload/products/3543/0570a26a_5.jpg;http://hu.gigabyte.com/products/upload/products/3543/f6dafbe4_5.jpg', 3),
('GAM4AORUSM', 4, 4, 4, 64, 'B450', 'MA', 2933, 1, 'Realtek® GbE LAN chi', 'Realtek® ALC887', 6, 0, 8, 1, 'Gi', 'B450 AORUS M', 'https://static.gigabyte.com/Product/2/6633/2019021115513944e18412f6db42424d44677cbf1e4f8fcb_src.png;https://static.gigabyte.com/Product/2/6633/2018070514384478_src.png;https://static.gigabyte.com/Product/2/6633/2018070514384352_src.png;https://static.gigabyte.com/Product/2/6633/2018070514384316_src.png;https://static.gigabyte.com/Product/2/6633/2018070514384278_src.png', 3),
('GAX470AORU', 4, 4, 4, 64, 'X470', 'A', 2933, 2, 'Intel® GbE LAN chip', 'Realtek® ALC1220-VB', 6, 2, 5, 3, 'Gi', 'GA-X470 AORUS Ultra Gaming', 'https://static.gigabyte.com/Product/2/6547/2019021115453003a43114eb368baefb799ea79601ed2450_src.png;https://static.gigabyte.com/Product/2/6547/2018041110424545_src.png;https://static.gigabyte.com/Product/2/6547/2018041110424568_src.png;https://static.gigabyte.com/Product/2/6547/2018041110424581_src.png', 3),
('GB450AE000', 4, 4, 4, 64, 'B450', 'A', 3600, 2, 'Realtek® GbE LAN', 'Realtek® ALC892 code', 6, 2, 4, 2, 'Gi', 'B450 AORUS ELITE', 'https://static.gigabyte.com/Product/2/6668/20190131150655285a345af1c2e8eb103b7b2615ea7db92a_big.png;https://static.gigabyte.com/Product/2/6668/2018072414422448_src.png;https://static.gigabyte.com/Product/2/6668/2018072314011297_src.png;https://static.gigabyte.com/Product/2/6668/2018072314011296_src.png', 2),
('GIGX570GAX', 4, 4, 4, 128, 'X570', 'A', 3200, 1, 'Realtek® GbE LAN chi', 'Realtek® ALC887 code', 6, 0, 8, 1, 'Gi', 'X570 GAMING X', 'https://static.gigabyte.com/Product/2/6895/20190702153642246d75ea4563aa946f3b1cf53e79a0559c_big.png;https://static.gigabyte.com/Product/2/6895/20190612174733329acb8e2faf8a92baeec02b43546551af_src.png;https://static.gigabyte.com/Product/2/6895/20190612174733013fcb91c26107eec3c5f0a591ec3b62b5_src.png;https://static.gigabyte.com/Product/2/6895/20190612174733167e5511a3fa9263bb1721ee44899227ad_src.png', 3),
('MPGZ390GAP', 11512, 4, 4, 128, 'Z390', 'A', 4400, 2, 'Intel I219-V', 'Realtek ALC892 Codec', 6, 0, 4, 2, 'Ms', 'MPG Z390 GAMING PLUS', 'https://asset.msi.com/resize/image/global/product/product_7_20181008103003_5bbac12b10a3b.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_6_20181008103003_5bbac12bcb1fa.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_0_20181008103003_5bbac12b7121c.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_8_20181008103003_5bbac12b9bc05.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://storage-asset.msi.com//global/picture/gallery/product_0_20181012132810_5bc030ea08e1f.png', 3),
('ROGMXIHERO', 11512, 4, 4, 64, 'Z390', 'A', 4400, 2, 'Intel I219V', 'ROG SupremeFX 8', 6, 4, 8, 2, 'As', 'ROG MAXIMUS XI HERO (WI-FI)', 'https://www.asus.com/media/global/gallery/flJ9OSVjC1DYeuY0_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/9FXDEjR8rmJjPUcO_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/fziPlQsTaa85XWF6_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/w2mirGkiRtlCaMjd_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/JM9dI1VyTY67WI3L_setting_000_1_90_end_500.png', 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `motherboard_man`
--

CREATE TABLE `motherboard_man` (
  `man_id` varchar(2) NOT NULL,
  `manufacturer` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `motherboard_man`
--

INSERT INTO `motherboard_man` (`man_id`, `manufacturer`) VALUES
('Ar', 'AsRock'),
('As', 'ASUS'),
('Bi', 'Biostar'),
('Gi', 'Gigabyte'),
('Ms', 'MSI');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ram`
--

CREATE TABLE `ram` (
  `foglalatId` int(1) NOT NULL,
  `tipus` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `ram`
--

INSERT INTO `ram` (`foglalatId`, `tipus`) VALUES
(1, 'DDR1'),
(2, 'DDR2'),
(3, 'DDR3'),
(4, 'DDR4'),
(5, 'DDR5');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rammanufatctureurl`
--

CREATE TABLE `rammanufatctureurl` (
  `ramurlID` int(11) NOT NULL,
  `cikkszamUrl` varchar(10) NOT NULL,
  `Url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rammanufatctureurl`
--

INSERT INTO `rammanufatctureurl` (`ramurlID`, `cikkszamUrl`, `Url`) VALUES
(1, 'KING182400', 'https://www.kingston.com/dataSheets/HX424C15FB2_8.pdf'),
(2, 'KING283200', 'https://www.kingston.com/dataSheets/HX432C16PB3K2_16.pdf'),
(6, 'GSK2163200', 'https://www.gskill.com/specification/165/184/1536110922/F4-3200C16D-32GVK-Specification');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rampictureurl`
--

CREATE TABLE `rampictureurl` (
  `ramurlID` int(11) NOT NULL,
  `cikkszamPicUrl` varchar(10) NOT NULL,
  `picUrl` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rampictureurl`
--

INSERT INTO `rampictureurl` (`ramurlID`, `cikkszamPicUrl`, `picUrl`) VALUES
(1, 'KING182400', 'https://dotkepek.kmak.hu/247/8gb-2400mhz-ddr4-ram-kingston-hyperx-fury-black-cl15-hx424c15fb28-373147.jpg;https://dotkepek.kmak.hu/247/8gb-2400mhz-ddr4-ram-kingston-hyperx-fury-black-cl15-hx424c15fb28-373148.jpg'),
(3, 'KING283200', 'https://dotkepek.kmak.hu/256/16gb-3200mhz-ddr4-ram-kingston-hyperx-predator-cl16-2x8gb-hx432c16pb3k216-387167.jpg;https://dotkepek.kmak.hu/256/16gb-3200mhz-ddr4-ram-kingston-hyperx-predator-cl16-2x8gb-hx432c16pb3k216-387169.jpg;https://dotkepek.kmak.hu/256/16gb-3200mhz-ddr4-ram-kingston-hyperx-predator-cl16-2x8gb-hx432c16pb3k216-387170.jpg'),
(4, 'GSK2163200', 'https://dotkepek.kmak.hu/244/32gb-3200mhz-ddr4-ram-gskill-ripjaw-v-cl16-2x16gb-f4-3200c16d-32gvk-370714.jpg');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ram_manufacturers`
--

CREATE TABLE `ram_manufacturers` (
  `man_id` varchar(2) NOT NULL,
  `manufacturer` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `ram_manufacturers`
--

INSERT INTO `ram_manufacturers` (`man_id`, `manufacturer`) VALUES
('Ad', 'Adata'),
('Ap', 'Apacer'),
('Co', 'Corsair'),
('Cr', 'Crucial'),
('CS', 'CSX'),
('Gi', 'Gigabyte'),
('Gs', 'G.Skill'),
('Ki', 'Kingston'),
('Pa', 'Patriot'),
('Sp', 'Silicon Power'),
('TG', 'Team Group');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ram_price`
--

CREATE TABLE `ram_price` (
  `ramPriceId` int(11) NOT NULL,
  `ramCikkszam` varchar(10) NOT NULL,
  `ramPrice` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `ram_price`
--

INSERT INTO `ram_price` (`ramPriceId`, `ramCikkszam`, `ramPrice`) VALUES
(1, 'KING182400', '13100'),
(2, 'KING283200', '30599'),
(3, 'GSK2163200', '44590');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ram_products`
--

CREATE TABLE `ram_products` (
  `cikkszam` varchar(10) NOT NULL,
  `foglalatID` int(6) NOT NULL,
  `manufacturer_id` varchar(2) NOT NULL,
  `type` varchar(50) NOT NULL,
  `typeCode` varchar(30) DEFAULT NULL,
  `capacity` int(4) NOT NULL,
  `is_xmp` tinyint(1) NOT NULL,
  `timing` varchar(4) NOT NULL,
  `clock` int(5) NOT NULL,
  `voltage` float(3,2) NOT NULL,
  `kit` tinyint(2) DEFAULT NULL,
  `warr_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `ram_products`
--

INSERT INTO `ram_products` (`cikkszam`, `foglalatID`, `manufacturer_id`, `type`, `typeCode`, `capacity`, `is_xmp`, `timing`, `clock`, `voltage`, `kit`, `warr_id`) VALUES
('GSK2163200', 4, 'Gs', 'Ripjaws V', 'F4-3200C16D-32GVK', 32, 1, '16', 3200, 1.35, 2, 3),
('KING182400', 4, 'Ki', 'HyperX Fury Black', 'HX424C15FB2/8', 8, 0, '15', 2400, 1.20, 1, 3),
('KING283200', 4, 'Ki', 'HyperX Predator XMP', 'HX432C16PB3K2/16', 16, 1, '16', 3200, 1.35, 2, 3);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `userinfo`
--

CREATE TABLE `userinfo` (
  `telefon` varchar(25) NOT NULL,
  `email1` varchar(255) NOT NULL,
  `irszam` smallint(4) NOT NULL,
  `varos` varchar(150) NOT NULL,
  `utca` varchar(150) NOT NULL,
  `hazszam` smallint(15) NOT NULL,
  `emeletajto` varchar(20) DEFAULT NULL,
  `keresztnev` varchar(50) NOT NULL,
  `vezeteknev` varchar(50) NOT NULL,
  `szulido` date DEFAULT NULL,
  `jogosultsag` varchar(50) NOT NULL DEFAULT 'felhasználó'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `userinfo`
--

INSERT INTO `userinfo` (`telefon`, `email1`, `irszam`, `varos`, `utca`, `hazszam`, `emeletajto`, `keresztnev`, `vezeteknev`, `szulido`, `jogosultsag`) VALUES
('06705773790', 'nagytommy76@gmail.com', 1118, 'Budapest', 'Frankhegy utca', 11, '10/40', 'Tamás', 'Nagy', '1993-01-06', 'admin'),
('06805478692', 'smicimarta58@hotmail.com', 1118, 'Budapest', 'Kerepes utca', 44, '4/10', 'Tiborné', 'Nagy', '1968-09-05', 'eladó'),
('06905883000', 'buzoske55@gmail.com', 4651, 'Debrecen', 'Várpalotai út', 125, '', 'Sándor', 'Büdös', '1994-09-01', 'felhasználó'),
('06905896894', 'semmi@faszom.hu', 2596, 'Pécs', 'Nemtudom', 36, '10/40', 'Gedeon', 'Senkiházi', '1980-08-27', 'felhasználó');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`email`, `pass`, `username`) VALUES
('buzoske55@gmail.com', '$2y$10$u0NzGuIzI0mgicUyqsZJUupNTNeOXs4AomNVOt5gPk..9r39TJWDu', 'BűzbakAdolf55'),
('nagytommy76@gmail.com', '$2y$10$sRMWGdOtri9C7xc6wbMg5eFRSThLdVO0.2QeoSp1f5IzkeMJlo11O', 'nagytommy76'),
('nagytommyvagyok@fleckens.hu', '$2y$10$OA0HSD/3fF.d3Vux4eWyZOwFe98EvO4hTLnsXA4T0gpKi0IgtMCN.', 'NagyTomVok'),
('semmi@faszom.hu', '$2y$10$U0jz7XoqTsEPvYfnw8DQ0eOyEMwEIbIChfYnlu2mffc2B6yQZa80u', 'senkihazi99'),
('smicimarta58@hotmail.com', '$2y$10$E8NjVHG3S9V3sGFCu06oPemTegS1tTI/qCEnJLB/wNkdxrEoZ1vc.', 'NagyTiborne');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_cart_item`
--

CREATE TABLE `user_cart_item` (
  `cart_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `product_cikkszam` varchar(10) NOT NULL,
  `quantity` tinyint(2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curdate(),
  `modified` datetime NOT NULL DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `user_cart_item`
--

INSERT INTO `user_cart_item` (`cart_id`, `user_email`, `product_cikkszam`, `quantity`, `created_at`, `modified`) VALUES
(10, 'nagytommy76@gmail.com', 'G970ADS3PA', 3, '2019-12-16 19:38:29', '2019-12-16 20:04:44');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `warranity`
--

CREATE TABLE `warranity` (
  `warr_id` tinyint(4) NOT NULL,
  `warr_months` smallint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `warranity`
--

INSERT INTO `warranity` (`warr_id`, `warr_months`) VALUES
(0, 0),
(1, 12),
(2, 24),
(3, 36),
(4, 48),
(5, 60);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `cpu`
--
ALTER TABLE `cpu`
  ADD PRIMARY KEY (`cikkszam`),
  ADD KEY `foglalatId` (`foglalatId`);

--
-- A tábla indexei `cpuarak1`
--
ALTER TABLE `cpuarak1`
  ADD PRIMARY KEY (`cpuarid`),
  ADD KEY `cikkszamcpu` (`cikkszamcpu`);

--
-- A tábla indexei `cpufoglalatok`
--
ALTER TABLE `cpufoglalatok`
  ADD PRIMARY KEY (`foglalatID`),
  ADD UNIQUE KEY `foglalat` (`foglalat`);

--
-- A tábla indexei `gyartourl`
--
ALTER TABLE `gyartourl`
  ADD PRIMARY KEY (`itemCikkszam`);

--
-- A tábla indexei `mbformats`
--
ALTER TABLE `mbformats`
  ADD PRIMARY KEY (`Id`);

--
-- A tábla indexei `mbprices`
--
ALTER TABLE `mbprices`
  ADD PRIMARY KEY (`MBarID`),
  ADD KEY `MBcikkszam` (`MBcikkszam`);

--
-- A tábla indexei `motherboard`
--
ALTER TABLE `motherboard`
  ADD PRIMARY KEY (`cikkszam`),
  ADD KEY `cpufoglalatID` (`cpufoglalatID`),
  ADD KEY `memtipusID` (`memtipusID`),
  ADD KEY `motherboard_ibfk_3` (`meret`),
  ADD KEY `MBtipus` (`MBtipus`),
  ADD KEY `garancia` (`garancia`),
  ADD KEY `gyarto` (`gyarto`);

--
-- A tábla indexei `motherboard_man`
--
ALTER TABLE `motherboard_man`
  ADD PRIMARY KEY (`man_id`);

--
-- A tábla indexei `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`foglalatId`);

--
-- A tábla indexei `rammanufatctureurl`
--
ALTER TABLE `rammanufatctureurl`
  ADD PRIMARY KEY (`ramurlID`),
  ADD KEY `cikkszamUrl` (`cikkszamUrl`);

--
-- A tábla indexei `rampictureurl`
--
ALTER TABLE `rampictureurl`
  ADD PRIMARY KEY (`ramurlID`),
  ADD KEY `cikkszamPicUrl` (`cikkszamPicUrl`);

--
-- A tábla indexei `ram_manufacturers`
--
ALTER TABLE `ram_manufacturers`
  ADD PRIMARY KEY (`man_id`);

--
-- A tábla indexei `ram_price`
--
ALTER TABLE `ram_price`
  ADD PRIMARY KEY (`ramPriceId`),
  ADD KEY `ramCikkszam` (`ramCikkszam`);

--
-- A tábla indexei `ram_products`
--
ALTER TABLE `ram_products`
  ADD PRIMARY KEY (`cikkszam`),
  ADD KEY `foglalatID` (`foglalatID`),
  ADD KEY `warr_id` (`warr_id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`);

--
-- A tábla indexei `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`telefon`),
  ADD KEY `email` (`email1`);

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- A tábla indexei `user_cart_item`
--
ALTER TABLE `user_cart_item`
  ADD PRIMARY KEY (`cart_id`);

--
-- A tábla indexei `warranity`
--
ALTER TABLE `warranity`
  ADD PRIMARY KEY (`warr_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `cpuarak1`
--
ALTER TABLE `cpuarak1`
  MODIFY `cpuarid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT a táblához `mbprices`
--
ALTER TABLE `mbprices`
  MODIFY `MBarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `rammanufatctureurl`
--
ALTER TABLE `rammanufatctureurl`
  MODIFY `ramurlID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `rampictureurl`
--
ALTER TABLE `rampictureurl`
  MODIFY `ramurlID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `ram_price`
--
ALTER TABLE `ram_price`
  MODIFY `ramPriceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT a táblához `user_cart_item`
--
ALTER TABLE `user_cart_item`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `cpu`
--
ALTER TABLE `cpu`
  ADD CONSTRAINT `cpu_ibfk_1` FOREIGN KEY (`foglalatId`) REFERENCES `cpufoglalatok` (`foglalatID`);

--
-- Megkötések a táblához `cpuarak1`
--
ALTER TABLE `cpuarak1`
  ADD CONSTRAINT `cpuarak1_ibfk_1` FOREIGN KEY (`cikkszamcpu`) REFERENCES `cpu` (`cikkszam`);

--
-- Megkötések a táblához `gyartourl`
--
ALTER TABLE `gyartourl`
  ADD CONSTRAINT `gyartourl_ibfk_1` FOREIGN KEY (`itemCikkszam`) REFERENCES `motherboard` (`cikkszam`);

--
-- Megkötések a táblához `mbprices`
--
ALTER TABLE `mbprices`
  ADD CONSTRAINT `mbprices_ibfk_1` FOREIGN KEY (`MBcikkszam`) REFERENCES `motherboard` (`cikkszam`);

--
-- Megkötések a táblához `motherboard`
--
ALTER TABLE `motherboard`
  ADD CONSTRAINT `motherboard_ibfk_1` FOREIGN KEY (`cpufoglalatID`) REFERENCES `cpufoglalatok` (`foglalatID`),
  ADD CONSTRAINT `motherboard_ibfk_2` FOREIGN KEY (`memtipusID`) REFERENCES `ram` (`foglalatID`),
  ADD CONSTRAINT `motherboard_ibfk_3` FOREIGN KEY (`meret`) REFERENCES `mbformats` (`Id`),
  ADD CONSTRAINT `motherboard_ibfk_4` FOREIGN KEY (`garancia`) REFERENCES `warranity` (`warr_id`),
  ADD CONSTRAINT `motherboard_ibfk_5` FOREIGN KEY (`gyarto`) REFERENCES `motherboard_man` (`man_id`);

--
-- Megkötések a táblához `rammanufatctureurl`
--
ALTER TABLE `rammanufatctureurl`
  ADD CONSTRAINT `rammanufatctureurl_ibfk_1` FOREIGN KEY (`cikkszamUrl`) REFERENCES `ram_products` (`cikkszam`);

--
-- Megkötések a táblához `rampictureurl`
--
ALTER TABLE `rampictureurl`
  ADD CONSTRAINT `rampictureurl_ibfk_1` FOREIGN KEY (`cikkszamPicUrl`) REFERENCES `ram_products` (`cikkszam`);

--
-- Megkötések a táblához `ram_price`
--
ALTER TABLE `ram_price`
  ADD CONSTRAINT `ram_price_ibfk_1` FOREIGN KEY (`ramCikkszam`) REFERENCES `ram_products` (`cikkszam`);

--
-- Megkötések a táblához `ram_products`
--
ALTER TABLE `ram_products`
  ADD CONSTRAINT `ram_products_ibfk_1` FOREIGN KEY (`foglalatID`) REFERENCES `ram` (`foglalatID`),
  ADD CONSTRAINT `ram_products_ibfk_2` FOREIGN KEY (`warr_id`) REFERENCES `warranity` (`warr_id`),
  ADD CONSTRAINT `ram_products_ibfk_3` FOREIGN KEY (`manufacturer_id`) REFERENCES `ram_manufacturers` (`man_id`);

--
-- Megkötések a táblához `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_ibfk_1` FOREIGN KEY (`email1`) REFERENCES `users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
