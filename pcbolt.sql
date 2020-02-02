-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Feb 02. 16:10
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.1

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
('AM42600', 4, 'Ryzen 5 2600', 6, 12, 3400, 3900, 16, 3, 'Nincs', 65, 'Nincs', 0, 'https://www.computerhouse.co.za/wp-content/uploads/2018/02/19-113-435-Z01.jpg', 3),
('AM42700NON', 4, 'Ryzen 7 2700', 8, 16, 3200, 4100, 16, 4, 'Nincs', 65, 'Nincs', 0, 'https://c1.neweggimages.com/ProductImage/19-113-498-V01.jpg', 3),
('AM4R31200B', 4, 'Ryzen 3 1200', 4, 4, 3100, 3400, 8, 2, 'Nincs', 65, 'Nincs', 0, 'https://p1.akcdn.net/full/455424445.amd-ryzen-3-1200-quad-core-3-1ghz-am4.jpg', 5),
('AM4R73700B', 4, 'Ryzen 7 3700X', 8, 16, 3600, 4400, 32, 4, 'Wraith PRISM', 65, 'Nincs', 0, 'https://assets.pcmag.com/media/images/564294-amd-ryzen-7-3700x.jpg', 3),
('AM4R93900X', 4, 'Ryzen 9 3900X', 12, 24, 3800, 4600, 64, 6, 'Wraith PRISM', 105, 'Nincs', 0, 'https://assets.pcmag.com/media/images/564279-amd-ryzen-9-3900x-6.jpg?width=810&height=456', 3),
('ASCF545433', 11512, 'Core i7 9700K', 8, 8, 3600, 4900, 12, 2, 'Nincs', 95, 'Intel UHD Graphics 630', 1150, 'https://c1.neweggimages.com/ProductImage/19-117-958-V03.jpg', 3),
('INT1143', 11512, 'Core i5-9400F', 6, 6, 2900, 4100, 9, 1, 'Nincs', 65, 'Nincs', 0, 'https://p1.akcdn.net/full/551861820.intel-core-i5-9400f-hexa-cores-2-90ghz-lga1151.jpg', 3),
('INT5435UU', 11512, 'Core i3-8350K', 4, 4, 4000, 4000, 8, 1, 'Nincs', 91, 'Intel UHD Graphics 630', 1150, 'https://c1.neweggimages.com/ProductImage/19-117-823-Z01.jpg', 3),
('INT9100F00', 11512, 'Core i3-9100F', 4, 4, 3600, 4200, 6, 1, 'Nincs', 65, 'Nincs', 0, 'https://c1.neweggimages.com/ProductImage/19-118-072-V01.jpg', 3),
('LGAI78700K', 11512, 'Core i7-8700K', 6, 12, 3700, 4700, 12, 2, 'Nincs', 95, 'Intel UHD Graphics 630', 1200, 'https://media.icdn.hu/product/GalleryMod/2019-09/581268/thumb/1313936_intel_core_i7_8700k_370ghz_1151_300_box.jpg;https://ae01.alicdn.com/kf/HTB1mVR.hQ9WBuNjSspeq6yz5VXae.jpg', 3),
('NBHHGJ6565', 11512, 'Core i5 9500F', 6, 6, 3000, 4400, 9, 2, 'Nincs', 65, 'Nincs', 0, 'https://c1.neweggimages.com/ProductImage/19-117-981-V01.jpg', 3),
('NBHZ54546U', 11512, 'Core i9 9900K', 8, 16, 3600, 5000, 16, 2, 'Nincs', 95, 'Intel UHD Graphics 630', 1150, 'https://c1.neweggimages.com/ProductImage/19-117-957-V01.jpg', 4),
('REWRWFS656', 11512, 'Core i5 8600K', 6, 6, 3600, 4300, 9, 2, 'Nincs', 95, 'Intel UHD Graphics 630', 1150, 'https://c1.neweggimages.com/ProductImage/19-117-825-Z01.jpg', 3),
('TR4THR1950X', 44, 'Ryzen Threadripper 1950X', 16, 32, 3400, 4000, 32, 8, 'Nincs', 180, 'Nincs', 0, 'https://static.techspot.com/images/products/2018/processors/amd/org/2017-08-10-product-5.jpg;https://static.techspot.com/articles-info/1465/images/Image_02S.jpg', 3),
('UZT5454534', 4, 'Ryzen 5 3600X', 6, 12, 3800, 4400, 32, 3, 'Nincs', 95, 'Nincs', 0, 'https://c1.neweggimages.com/ProductImage/19-113-568-V03.jpg', 3);

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
(1, 'AM42600', '42500'),
(2, 'AM42700NON', '67890'),
(3, 'ASCF545433', '125100'),
(4, 'INT1143', '47990'),
(5, 'INT5435UU', '58962'),
(6, 'INT9100F00', '28750'),
(7, 'NBHHGJ6565', '62325'),
(8, 'NBHZ54546U', '160980'),
(9, 'REWRWFS656', '91000'),
(10, 'UZT5454534', '78225'),
(25, 'AM4R31200B', '14000'),
(27, 'AM4R73700B', '109700'),
(29, 'AM4R93900X', '181250'),
(30, 'LGAI78700K', '133600'),
(31, 'TR4THR1950X', '186023');

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
-- Tábla szerkezet ehhez a táblához `cpu_manufacturers`
--

CREATE TABLE `cpu_manufacturers` (
  `Id` int(11) NOT NULL,
  `cikkszamUrl` varchar(25) NOT NULL,
  `Url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `cpu_manufacturers`
--

INSERT INTO `cpu_manufacturers` (`Id`, `cikkszamUrl`, `Url`) VALUES
(1, 'INT1143', 'https://ark.intel.com/content/www/us/en/ark/products/190883/intel-core-i5-9400f-processor-9m-cache-up-to-4-10-ghz.html'),
(3, 'INT9100F00', 'https://ark.intel.com/content/www/us/en/ark/products/190886/intel-core-i3-9100f-processor-6m-cache-up-to-4-20-ghz.html'),
(4, 'AM42600', 'https://www.amd.com/en/products/cpu/amd-ryzen-5-2600'),
(5, 'INT5435UU', 'https://ark.intel.com/content/www/us/en/ark/products/126689/intel-core-i3-8350k-processor-8m-cache-4-00-ghz.html'),
(6, 'NBHHGJ6565', 'https://ark.intel.com/content/www/us/en/ark/products/190890/intel-core-i5-9500f-processor-9m-cache-up-to-4-40-ghz.html'),
(7, 'AM42700NON', 'https://www.amd.com/en/products/cpu/amd-ryzen-7-2700'),
(8, 'UZT5454534', 'https://www.amd.com/en/products/cpu/amd-ryzen-5-3600x'),
(9, 'REWRWFS656', 'https://ark.intel.com/content/www/us/en/ark/products/126685/intel-core-i5-8600k-processor-9m-cache-up-to-4-30-ghz.html'),
(10, 'ASCF545433', 'https://ark.intel.com/content/www/us/en/ark/products/186604/intel-core-i7-9700k-processor-12m-cache-up-to-4-90-ghz.html'),
(11, 'NBHZ54546U', 'https://ark.intel.com/content/www/us/en/ark/products/186605/intel-core-i9-9900k-processor-16m-cache-up-to-5-00-ghz.html'),
(17, 'AM4R31200B', 'https://www.amd.com/en/products/cpu/amd-ryzen-3-1200'),
(20, 'AM4R73700B', 'https://www.amd.com/en/products/cpu/amd-ryzen-7-3700x'),
(21, 'AM4R93900X', 'https://www.amd.com/en/products/cpu/amd-ryzen-9-3900x'),
(22, 'LGAI78700K', 'https://ark.intel.com/content/www/us/en/ark/products/126684/intel-core-i7-8700k-processor-12m-cache-up-to-4-70-ghz.html'),
(23, 'TR4THR1950X', 'https://www.amd.com/en/products/cpu/amd-ryzen-threadripper-1950x');

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
('AS', 'https://www.asrock.com/MB/AMD/B450M%20Pro4-F/index.asp'),
('ASUSROGZET', 'https://www.asus.com/hu/Motherboards/ROG-ZENITH-EXTREME/'),
('ASUSTB360P', 'https://www.asus.com/hu/Motherboards/TUF-B360-PRO-GAMING/'),
('G970ADS3PA', 'http://hu.gigabyte.com/products/page/mb/ga-970a-ds3prev_10#sp'),
('GAM4AORUSM', 'https://www.gigabyte.com/Motherboard/B450-AORUS-M-rev-10#kf'),
('GAX470AORU', 'https://www.gigabyte.com/Motherboard/X470-AORUS-ULTRA-GAMING-rev-10#kf'),
('GB450AE000', 'https://www.gigabyte.com/Motherboard/B450-AORUS-ELITE-rev-10#kf'),
('GIGX570GAX', 'https://www.gigabyte.com/Motherboard/X570-GAMING-X-rev-10#kf'),
('MEGX570GODLIKE', 'https://www.msi.com/Motherboard/MEG-X570-GODLIKE/Specification'),
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
(10, 'ROGMXIHERO', '112600'),
(11, 'AS', '24050'),
(12, 'MEGX570GODLIKE', '245100');

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
('AS', 4, 4, 4, 64, 'B450', 'MA', 3200, 2, 'Realtek RTL8111GR', 'Realtek ALC892 Audio Codec', 4, 0, 5, 1, 'Ar', 'B450M PRO4-F', 'https://www.asrock.com/mb/photo/B450M%20Pro4-F(L1).png;https://www.asrock.com/mb/photo/B450M%20Pro4-F(L2).png;https://www.asrock.com/mb/photo/B450M%20Pro4-F(L3).png;https://www.asrock.com/mb/photo/B450M%20Pro4-F(L5).png', 4),
('ASUSROGZET', 44, 4, 8, 128, 'X399', 'EA', 2666, 3, 'Intel® I211-AT', 'ROG SupremeFX 8', 0, 0, 13, 4, 'As', 'ROG Zenith Extreme', 'https://www.asus.com/media/global/gallery/Kgj0l3hEYFq21uNc_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/ToCVtMO64zESDp3r_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/cjhIrX4cKRiW3ZJ7_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/P9R3VFvkG5mB5jZx_setting_000_1_90_end_500.png', 3),
('ASUSTB360P', 11512, 4, 4, 64, 'B360', 'A', 2666, 2, 'Intel® I219V, 1 db G', 'Realtek® ALC887', 6, 0, 3, 1, 'As', 'TUF B360-PRO GAMING', 'https://www.asus.com/media/global/gallery/SOBQvFXKMeBWWgBi_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/fMPFYnFp5aJvjlcI_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/UNI86f1qOaRoaM9K_setting_000_1_90_end_500.png', 3),
('G970ADS3PA', 3, 4, 4, 64, '970A', 'A', 1866, 0, 'Realtek® GbE LAN chip', 'Realtek® ALC887', 6, 4, 0, 1, 'Gi', '970A-DS3P', 'http://hu.gigabyte.com/products/upload/products/3543/51050301_5.jpg;http://hu.gigabyte.com/products/upload/products/3543/066606c9_5.jpg;http://hu.gigabyte.com/products/upload/products/3543/0570a26a_5.jpg;http://hu.gigabyte.com/products/upload/products/3543/f6dafbe4_5.jpg', 3),
('GAM4AORUSM', 4, 4, 4, 64, 'B450', 'MA', 2933, 1, 'Realtek® GbE LAN chi', 'Realtek® ALC887', 6, 0, 8, 1, 'Gi', 'B450 AORUS M', 'https://static.gigabyte.com/Product/2/6633/2019021115513944e18412f6db42424d44677cbf1e4f8fcb_src.png;https://static.gigabyte.com/Product/2/6633/2018070514384478_src.png;https://static.gigabyte.com/Product/2/6633/2018070514384352_src.png;https://static.gigabyte.com/Product/2/6633/2018070514384316_src.png;https://static.gigabyte.com/Product/2/6633/2018070514384278_src.png', 3),
('GAX470AORU', 4, 4, 4, 64, 'X470', 'A', 2933, 2, 'Intel® GbE LAN chip', 'Realtek® ALC1220-VB', 6, 2, 5, 3, 'Gi', 'GA-X470 AORUS Ultra Gaming', 'https://static.gigabyte.com/Product/2/6547/2019021115453003a43114eb368baefb799ea79601ed2450_src.png;https://static.gigabyte.com/Product/2/6547/2018041110424545_src.png;https://static.gigabyte.com/Product/2/6547/2018041110424568_src.png;https://static.gigabyte.com/Product/2/6547/2018041110424581_src.png', 3),
('GB450AE000', 4, 4, 4, 64, 'B450', 'A', 3600, 2, 'Realtek® GbE LAN', 'Realtek® ALC892 code', 6, 2, 4, 2, 'Gi', 'B450 AORUS ELITE', 'https://static.gigabyte.com/Product/2/6668/20190131150655285a345af1c2e8eb103b7b2615ea7db92a_big.png;https://static.gigabyte.com/Product/2/6668/2018072414422448_src.png;https://static.gigabyte.com/Product/2/6668/2018072314011297_src.png;https://static.gigabyte.com/Product/2/6668/2018072314011296_src.png', 2),
('GIGX570GAX', 4, 4, 4, 128, 'X570', 'A', 3200, 1, 'Realtek® GbE LAN chi', 'Realtek® ALC887 code', 6, 0, 8, 1, 'Gi', 'X570 GAMING X', 'https://static.gigabyte.com/Product/2/6895/20190702153642246d75ea4563aa946f3b1cf53e79a0559c_big.png;https://static.gigabyte.com/Product/2/6895/20190612174733329acb8e2faf8a92baeec02b43546551af_src.png;https://static.gigabyte.com/Product/2/6895/20190612174733013fcb91c26107eec3c5f0a591ec3b62b5_src.png;https://static.gigabyte.com/Product/2/6895/20190612174733167e5511a3fa9263bb1721ee44899227ad_src.png', 3),
('MEGX570GODLIKE', 4, 4, 4, 128, 'X570', 'EA', 4733, 3, 'KillerTM E3000 2.5 Gbps LAN Controlle', 'Realtek® ALC1220 Codec', 6, 0, 2, 4, 'Ms', 'MEG X570 GODLIKE', 'https://asset.msi.com/resize/image/global/product/product_9_20190723093040_5d36634076704.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_0_20190527092314_5ceb3c02a95fc.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_2_20190527092314_5ceb3c02d49b7.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_9_20190527092315_5ceb3c030496e.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png', 3),
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
  `cikkszamUrl` varchar(25) NOT NULL,
  `Url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rammanufatctureurl`
--

INSERT INTO `rammanufatctureurl` (`ramurlID`, `cikkszamUrl`, `Url`) VALUES
(1, 'KING182400', 'https://www.kingston.com/dataSheets/HX424C15FB2_8.pdf'),
(2, 'KING283200', 'https://www.kingston.com/dataSheets/HX432C16PB3K2_16.pdf'),
(6, 'GSK2163200', 'https://www.gskill.com/specification/165/184/1536110922/F4-3200C16D-32GVK-Specification'),
(7, 'CSX21066CS', '#'),
(8, 'C2400SPORT', 'https://eu.crucial.com/eur/en/bls4g4d240fsb'),
(10, 'KING8HYPX2666', 'https://www.kingston.com/dataSheets/HX426C13PB3_8.pdf');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rampictureurl`
--

CREATE TABLE `rampictureurl` (
  `ramurlID` int(11) NOT NULL,
  `cikkszamPicUrl` varchar(25) NOT NULL,
  `picUrl` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `rampictureurl`
--

INSERT INTO `rampictureurl` (`ramurlID`, `cikkszamPicUrl`, `picUrl`) VALUES
(1, 'KING182400', 'https://dotkepek.kmak.hu/247/8gb-2400mhz-ddr4-ram-kingston-hyperx-fury-black-cl15-hx424c15fb28-373147.jpg;https://dotkepek.kmak.hu/247/8gb-2400mhz-ddr4-ram-kingston-hyperx-fury-black-cl15-hx424c15fb28-373148.jpg'),
(3, 'KING283200', 'https://dotkepek.kmak.hu/256/16gb-3200mhz-ddr4-ram-kingston-hyperx-predator-cl16-2x8gb-hx432c16pb3k216-387167.jpg;https://dotkepek.kmak.hu/256/16gb-3200mhz-ddr4-ram-kingston-hyperx-predator-cl16-2x8gb-hx432c16pb3k216-387169.jpg;https://dotkepek.kmak.hu/256/16gb-3200mhz-ddr4-ram-kingston-hyperx-predator-cl16-2x8gb-hx432c16pb3k216-387170.jpg'),
(4, 'GSK2163200', 'https://dotkepek.kmak.hu/244/32gb-3200mhz-ddr4-ram-gskill-ripjaw-v-cl16-2x16gb-f4-3200c16d-32gvk-370714.jpg'),
(5, 'CSX21066CS', 'https://p1.akcdn.net/full/224569503.csx-2gb-ddr3-1066mhz-csxo-d3-lo-1066-2gb.jpg'),
(6, 'C2400SPORT', 'https://p1.akcdn.net/full/334922101.crucial-ballistix-sport-4gb-ddr4-2400mhz-bls4g4d240fsb.jpg;https://dotkepek.kmak.hu/184/4gb-2400mhz-ddr4-ram-crucial-ballistix-sport-cl16-bls4g4d240fsb-284884.jpg'),
(7, 'KING8HYPX2666', 'https://www.legitreviews.com/wp-content/uploads/2017/05/hyperx-predator.jpg;https://cdn.elkor.lv/media/catalog/product/cache/0/image/500x500/9df78eab33525d08d6e5fb8d27136e95/0/_/0_2689864292_f82812a7-e222-4528-9884-1e85419288e1.Jpeg');

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
  `ramCikkszam` varchar(25) NOT NULL,
  `ramPrice` decimal(15,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `ram_price`
--

INSERT INTO `ram_price` (`ramPriceId`, `ramCikkszam`, `ramPrice`) VALUES
(1, 'KING182400', '13100'),
(2, 'KING283200', '30599'),
(3, 'GSK2163200', '44590'),
(4, 'CSX21066CS', '3000'),
(5, 'C2400SPORT', '6300'),
(6, 'KING8HYPX2666', '13200');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `ram_products`
--

CREATE TABLE `ram_products` (
  `cikkszam` varchar(25) NOT NULL,
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
('C2400SPORT', 4, 'Cr', 'Ballistix Sport LT', 'BLS4G4D240FSB', 4, 0, '16', 2400, 1.20, 1, 3),
('CSX21066CS', 3, 'CS', 'CSXO-D3-LO-1066-2GB', 'CSXO-D3-LO-1066-2GB', 2, 0, '9', 1066, 1.50, 1, 5),
('GSK2163200', 4, 'Gs', 'Ripjaws V', 'F4-3200C16D-32GVK', 32, 1, '16', 3200, 1.35, 2, 3),
('KING182400', 4, 'Ki', 'HyperX Fury Black', 'HX424C15FB2/8', 8, 0, '15', 2400, 1.20, 1, 3),
('KING283200', 4, 'Ki', 'HyperX Predator XMP', 'HX432C16PB3K2/16', 16, 1, '16', 3200, 1.35, 2, 3),
('KING8HYPX2666', 5, 'Ki', 'HyperX Predator', 'HX426C13PB3/8', 8, 1, '13', 2666, 1.35, 1, 5);

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
('06805478520', 'nagytommy76@hotmail.com', 8174, 'Balatonkenese', 'Berek utca', 15, 'Nincs', 'Tamás', 'Nagy', '1996-10-09', 'felhasználó'),
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
('nagytommy76@hotmail.com', '$2y$10$O4Aigboj3f3VQzPtSoF/9.ZFpPLXml/4RHr1w3wTw6plrB6wRe3UG', 'NagyTamás93'),
('nagytommyvagyok@fleckens.hu', '$2y$10$OA0HSD/3fF.d3Vux4eWyZOwFe98EvO4hTLnsXA4T0gpKi0IgtMCN.', 'NagyTomVok'),
('semmi@faszom.hu', '$2y$10$U0jz7XoqTsEPvYfnw8DQ0eOyEMwEIbIChfYnlu2mffc2B6yQZa80u', 'senkihazi99'),
('smicimarta58@hotmail.com', '$2y$10$E8NjVHG3S9V3sGFCu06oPemTegS1tTI/qCEnJLB/wNkdxrEoZ1vc.', 'NagyTiborne');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `user_cart_item`
--

CREATE TABLE `user_cart_item` (
  `user_email` varchar(255) NOT NULL,
  `cartItems` varchar(255) NOT NULL,
  `orderedAt` datetime NOT NULL DEFAULT current_timestamp(),
  `orderCode` varchar(50) NOT NULL,
  `orderPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- A tábla adatainak kiíratása `user_cart_item`
--

INSERT INTO `user_cart_item` (`user_email`, `cartItems`, `orderedAt`, `orderCode`, `orderPrice`) VALUES
('nagytommy76@gmail.com', '[\"ram_KING182400\",\"ram_KING182400\",\"vga_ASRX57008GBROGSTR\",\"vga_ASRX57008GBROGSTR\"]', '2020-02-02 15:39:20', '4W3haxxN3l7q19AqbViQt60hJ', 325400),
('nagytommy76@gmail.com', '[\"cpu_UZT5454534\",\"cpu_UZT5454534\"]', '2020-01-17 16:26:42', '7yuFsKon57YViq65K7j5jsfoO', 156450),
('nagytommy76@gmail.com', '[\"cpu_AM42600\",\"cpu_AM42600\",\"cpu_AM42600\"]', '2020-01-12 15:26:14', '83nNI2r7hwCu62X7nfTI3TjGa', 131100),
('nagytommy76@gmail.com', '[\"cpu_TR4THR1950X\",\"mb_ASUSROGZET\",\"ram_GSK2163200\",\"ram_GSK2163200\",\"vga_MSRX5700XTEVOKE\"]', '2020-02-02 13:46:07', 'IOSmg2ObjyafIH7lfYVK17cMF', 625462),
('nagytommy76@gmail.com', '[\"cpu_UZT5454534\",\"mb_GB450AE000\",\"ram_KING283200\"]', '2020-01-14 20:05:23', 'MuS6MY4PigtDrYrLiSkLR0T7b', 141244),
('nagytommy76@gmail.com', '[\"mb_GAM4AORUSM\"]', '2020-01-12 15:15:49', 'QknflYb3oxSQInHy7moxTXSF0', 27150),
('nagytommy76@hotmail.com', '[\"mb_GB450AE000\",\"mb_GB450AE000\"]', '2020-01-12 14:59:55', 'trtCwvG6OnEuvKJNXkuhAVh23', 64840),
('nagytommy76@gmail.com', '[\"cpu_AM4R31200B\"]', '2020-02-02 16:01:50', 'UAh2QMI9mGsrGssHebWiyYwWF', 14000),
('nagytommy76@gmail.com', '[\"cpu_AM4R31200B\"]', '2020-02-02 16:00:55', 'vzheh0lxZZWOvxWVGZwFvmItB', 14000),
('nagytommy76@gmail.com', '[\"vga_ASRX57008GBROGSTR\",\"mb_GAM4AORUSM\",\"mb_GAM4AORUSM\"]', '2020-02-02 14:24:59', 'YHEJdGxN5LbqCDhuHLol1IvIW', 203900),
('nagytommy76@hotmail.com', '[\"mb_MPGZ390GAP\"]', '2020-01-12 15:08:01', 'yoU6mT0mSUY8qaFnVPlfoa0Ee', 40350);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vga_manufacturers`
--

CREATE TABLE `vga_manufacturers` (
  `man_id` varchar(3) NOT NULL,
  `manufacturer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `vga_manufacturers`
--

INSERT INTO `vga_manufacturers` (`man_id`, `manufacturer`) VALUES
('AR', 'AsRock'),
('As', 'ASUS'),
('Co', 'Colorful'),
('Ga', 'Gainward'),
('Gi', 'Gigabyte'),
('In', 'Inno3D'),
('Ma', 'Manli'),
('Ms', 'MSI'),
('Pn', 'PNY'),
('Pw', 'Powercolor'),
('Sa', 'Sapphire'),
('Xf', 'XFX'),
('Zt', 'ZOTAC');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vga_manunfact_url`
--

CREATE TABLE `vga_manunfact_url` (
  `vga_man_id` int(11) NOT NULL,
  `cikkszam` varchar(25) NOT NULL,
  `Url` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `vga_manunfact_url`
--

INSERT INTO `vga_manunfact_url` (`vga_man_id`, `cikkszam`, `Url`) VALUES
(2, 'MSRX5700XTEVOKE', 'https://www.msi.com/Graphics-card/Radeon-RX-5700-XT-EVOKE-OC/Specification'),
(3, 'ASRX57008GBROGSTR', 'https://www.asus.com/Graphics-Cards/ROG-STRIX-RX5700-O8G-GAMING/specifications/');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vga_picurl`
--

CREATE TABLE `vga_picurl` (
  `vga_pic_id` int(11) NOT NULL,
  `cikkszam` varchar(25) NOT NULL,
  `picUrl` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `vga_picurl`
--

INSERT INTO `vga_picurl` (`vga_pic_id`, `cikkszam`, `picUrl`) VALUES
(1, 'MSRX5700XTEVOKE', 'https://asset.msi.com/resize/image/global/product/product_1_20191108141014_5dc506c6048cc.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_6_20190814150905_5d53b3916db98.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_4_20191108141013_5dc506c53aaf7.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_7_20190814150904_5d53b390bb48f.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png;https://asset.msi.com/resize/image/global/product/product_8_20191108141013_5dc506c57fa52.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png'),
(2, 'ASRX57008GBROGSTR', 'https://www.asus.com/media/global/gallery/5zfcztloqvpdrcog_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/fbrivqst7m4tfqxw_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/u0sajucahhwnc3b0_setting_000_1_90_end_500.png;https://www.asus.com/media/global/gallery/h8rdrhibxtckoqnx_setting_000_1_90_end_500.png');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vga_price`
--

CREATE TABLE `vga_price` (
  `vga_price_id` int(11) NOT NULL,
  `cikkszam` varchar(25) NOT NULL,
  `price` decimal(15,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `vga_price`
--

INSERT INTO `vga_price` (`vga_price_id`, `cikkszam`, `price`) VALUES
(1, 'MSRX5700XTEVOKE', '150259'),
(2, 'ASRX57008GBROGSTR', '149600');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vga_products`
--

CREATE TABLE `vga_products` (
  `cikkszam` varchar(25) NOT NULL,
  `manufacturer_id` varchar(3) NOT NULL,
  `type` varchar(150) NOT NULL,
  `typeCode` varchar(100) DEFAULT '',
  `vga_man` varchar(15) NOT NULL,
  `pci_type` varchar(20) NOT NULL,
  `gpu_clock` mediumint(5) NOT NULL,
  `gpu_peak` mediumint(5) NOT NULL,
  `vram_capacity` tinyint(3) NOT NULL,
  `vram_clock` mediumint(7) NOT NULL,
  `vram_type` varchar(6) NOT NULL,
  `vram_bandwidth` mediumint(4) NOT NULL,
  `power_consumption` mediumint(5) NOT NULL,
  `power_pin` varchar(20) NOT NULL,
  `directX` varchar(20) NOT NULL,
  `warr_id` tinyint(4) NOT NULL,
  `displayPort` tinyint(4) NOT NULL DEFAULT 0,
  `DVI` tinyint(4) NOT NULL DEFAULT 0,
  `HDMI` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `vga_products`
--

INSERT INTO `vga_products` (`cikkszam`, `manufacturer_id`, `type`, `typeCode`, `vga_man`, `pci_type`, `gpu_clock`, `gpu_peak`, `vram_capacity`, `vram_clock`, `vram_type`, `vram_bandwidth`, `power_consumption`, `power_pin`, `directX`, `warr_id`, `displayPort`, `DVI`, `HDMI`) VALUES
('ASRX57008GBROGSTR', 'As', 'RX 5700 ROG STRIX', 'ROG-STRIX-RX5700-O8G-GAMING', 'AMD', 'PCI-E 16x 4.0', 1610, 1725, 8, 14000, 'GDDR6', 256, 180, '1 x 6-pin, 1 x 8-pin', '12', 3, 3, 0, 1),
('MSRX5700XTEVOKE', 'Ms', 'RX 5700 XT EVOKE OC', '', 'AMD', 'PCI-E 16x 4.0', 1690, 1835, 8, 14000, 'GDDR6', 256, 225, '8-pin x 1+ 6-pin x 1', '12', 3, 3, 0, 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `vga_stockpile`
--

CREATE TABLE `vga_stockpile` (
  `vga_stockpile_id` int(11) NOT NULL,
  `cikkszam` varchar(25) NOT NULL,
  `vga_stock` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- A tábla adatainak kiíratása `vga_stockpile`
--

INSERT INTO `vga_stockpile` (`vga_stockpile_id`, `cikkszam`, `vga_stock`) VALUES
(1, 'MSRX5700XTEVOKE', 8),
(2, 'ASRX57008GBROGSTR', 4);

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
-- A tábla indexei `cpu_manufacturers`
--
ALTER TABLE `cpu_manufacturers`
  ADD PRIMARY KEY (`Id`);

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
  ADD PRIMARY KEY (`orderCode`),
  ADD KEY `user_email` (`user_email`);

--
-- A tábla indexei `vga_manufacturers`
--
ALTER TABLE `vga_manufacturers`
  ADD PRIMARY KEY (`man_id`);

--
-- A tábla indexei `vga_manunfact_url`
--
ALTER TABLE `vga_manunfact_url`
  ADD PRIMARY KEY (`vga_man_id`),
  ADD KEY `cikkszam` (`cikkszam`);

--
-- A tábla indexei `vga_picurl`
--
ALTER TABLE `vga_picurl`
  ADD PRIMARY KEY (`vga_pic_id`),
  ADD KEY `cikkszam` (`cikkszam`);

--
-- A tábla indexei `vga_price`
--
ALTER TABLE `vga_price`
  ADD PRIMARY KEY (`vga_price_id`),
  ADD UNIQUE KEY `cikkszam` (`cikkszam`),
  ADD KEY `cikkszam_2` (`cikkszam`);

--
-- A tábla indexei `vga_products`
--
ALTER TABLE `vga_products`
  ADD PRIMARY KEY (`cikkszam`),
  ADD KEY `warr_id` (`warr_id`),
  ADD KEY `manufacturer_id` (`manufacturer_id`);

--
-- A tábla indexei `vga_stockpile`
--
ALTER TABLE `vga_stockpile`
  ADD PRIMARY KEY (`vga_stockpile_id`),
  ADD KEY `cikkszam` (`cikkszam`);

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
  MODIFY `cpuarid` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT a táblához `cpu_manufacturers`
--
ALTER TABLE `cpu_manufacturers`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT a táblához `mbprices`
--
ALTER TABLE `mbprices`
  MODIFY `MBarID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT a táblához `rammanufatctureurl`
--
ALTER TABLE `rammanufatctureurl`
  MODIFY `ramurlID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT a táblához `rampictureurl`
--
ALTER TABLE `rampictureurl`
  MODIFY `ramurlID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT a táblához `ram_price`
--
ALTER TABLE `ram_price`
  MODIFY `ramPriceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `vga_manunfact_url`
--
ALTER TABLE `vga_manunfact_url`
  MODIFY `vga_man_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT a táblához `vga_picurl`
--
ALTER TABLE `vga_picurl`
  MODIFY `vga_pic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `vga_price`
--
ALTER TABLE `vga_price`
  MODIFY `vga_price_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT a táblához `vga_stockpile`
--
ALTER TABLE `vga_stockpile`
  MODIFY `vga_stockpile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  ADD CONSTRAINT `motherboard_ibfk_2` FOREIGN KEY (`memtipusID`) REFERENCES `ram` (`foglalatId`),
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
  ADD CONSTRAINT `ram_products_ibfk_1` FOREIGN KEY (`foglalatID`) REFERENCES `ram` (`foglalatId`),
  ADD CONSTRAINT `ram_products_ibfk_2` FOREIGN KEY (`warr_id`) REFERENCES `warranity` (`warr_id`),
  ADD CONSTRAINT `ram_products_ibfk_3` FOREIGN KEY (`manufacturer_id`) REFERENCES `ram_manufacturers` (`man_id`);

--
-- Megkötések a táblához `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `userinfo_ibfk_1` FOREIGN KEY (`email1`) REFERENCES `users` (`email`);

--
-- Megkötések a táblához `vga_manunfact_url`
--
ALTER TABLE `vga_manunfact_url`
  ADD CONSTRAINT `vga_manunfact_url_ibfk_1` FOREIGN KEY (`cikkszam`) REFERENCES `vga_products` (`cikkszam`);

--
-- Megkötések a táblához `vga_picurl`
--
ALTER TABLE `vga_picurl`
  ADD CONSTRAINT `vga_picurl_ibfk_1` FOREIGN KEY (`cikkszam`) REFERENCES `vga_products` (`cikkszam`);

--
-- Megkötések a táblához `vga_price`
--
ALTER TABLE `vga_price`
  ADD CONSTRAINT `vga_price_ibfk_1` FOREIGN KEY (`cikkszam`) REFERENCES `vga_products` (`cikkszam`);

--
-- Megkötések a táblához `vga_products`
--
ALTER TABLE `vga_products`
  ADD CONSTRAINT `vga_products_ibfk_2` FOREIGN KEY (`warr_id`) REFERENCES `warranity` (`warr_id`),
  ADD CONSTRAINT `vga_products_ibfk_3` FOREIGN KEY (`manufacturer_id`) REFERENCES `vga_manufacturers` (`man_id`);

--
-- Megkötések a táblához `vga_stockpile`
--
ALTER TABLE `vga_stockpile`
  ADD CONSTRAINT `vga_stockpile_ibfk_1` FOREIGN KEY (`cikkszam`) REFERENCES `vga_products` (`cikkszam`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
