-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2016 at 03:10 AM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ffadillasppd`
--
CREATE DATABASE IF NOT EXISTS `pa_sppd` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pa_sppd`;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penunjukan`
--

CREATE TABLE IF NOT EXISTS `detail_penunjukan` (
  `iddetailpenunjukan` int(11) NOT NULL,
  `lokasitgs` varchar(11) NOT NULL,
  `peserta` varchar(11) NOT NULL,
  `waktutgs` varchar(11) NOT NULL,
  `totalbiayatgs` int(11) NOT NULL,
  `penugasan` varchar(11) NOT NULL,
  PRIMARY KEY (`iddetailpenunjukan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diseksternal`
--

CREATE TABLE IF NOT EXISTS `diseksternal` (
  `iddiseksternal` int(11) NOT NULL,
  `instansi` varchar(11) NOT NULL,
  `tglterima` date NOT NULL,
  `tglsurat` date NOT NULL,
  `suratdari` varchar(100) NOT NULL,
  `diajukankepada` varchar(100) NOT NULL,
  `perihal` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disinternal`
--

CREATE TABLE IF NOT EXISTS `disinternal` (
  `iddisinternal` int(11) NOT NULL,
  `uploadfilein` text NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `tglterima` date NOT NULL,
  `tglsurat` date NOT NULL,
  `diajukankepada` varchar(100) NOT NULL,
  `suratdari` varchar(100) NOT NULL,
  PRIMARY KEY (`iddisinternal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE IF NOT EXISTS `disposisi` (
  `iddisposisi` varchar(100) NOT NULL,
  `nosurat` varchar(100) NOT NULL,
  `noagenda` varchar(100) NOT NULL,
  `tglsurat` date NOT NULL,
  `tgl_diterima` date NOT NULL,
  `suratdari` varchar(100) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `isidisposisi` varchar(100) NOT NULL,
  `diajukankepada` varchar(100) NOT NULL,
  `dasar` varchar(100) NOT NULL,
  `jenissurat` varchar(100) NOT NULL,
  `statusdisposisi` varchar(11) NOT NULL,
  PRIMARY KEY (`iddisposisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `idlogin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` int(50) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `golongan` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  PRIMARY KEY (`idlogin`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`idlogin`, `username`, `password`, `email`, `nama`, `nip`, `pangkat`, `golongan`, `jabatan`) VALUES
(1, 'firda', '12345', 'firdadillade@gmail.com', 'firda', 2147483647, 'pembina', 'IV', 'kepala sekolah'),
(2, 'fadilla', '12345', 'firdaishak2123@gmail.com', 'fadilla', 98736547, 'pengatur', 'II/c', 'guru muda'),
(3, 'raga', '12345', 'ragapraduga@gmail.com', 'raga praduga', 264542719, 'Penata Muda', 'III/a', 'Guru Madya');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuansppd`
--

CREATE TABLE IF NOT EXISTS `pengajuansppd` (
  `idpengajuan` varchar(100) NOT NULL,
  `nspengajuan` varchar(100) NOT NULL,
  `pejabat` varchar(100) NOT NULL,
  `maksudpd` varchar(100) NOT NULL,
  `lamapd` varchar(100) NOT NULL,
  `tglberangkat` date NOT NULL,
  `tglkembali` date NOT NULL,
  `ttujuan` varchar(100) NOT NULL,
  `tberangkat` varchar(100) NOT NULL,
  `pengikut` varchar(100) NOT NULL,
  `rincianbiaya` int(100) NOT NULL,
  `anggarandana` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `komentar` varchar(100) NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`idpengajuan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `penunjukan`
--

CREATE TABLE IF NOT EXISTS `penunjukan` (
  `idpenunjukan` varchar(100) NOT NULL,
  `tglpenunjukan` date NOT NULL,
  `nosurattgs` varchar(100) NOT NULL,
  `perihalpenunjukan` int(11) NOT NULL,
  `tglpelaksanaan` date NOT NULL,
  PRIMARY KEY (`idpenunjukan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `suratmasuk`
--

CREATE TABLE IF NOT EXISTS `suratmasuk` (
  `idsmasuk` varchar(100) NOT NULL,
  `tglsmasuk` date NOT NULL,
  `uploadfile` text NOT NULL,
  `instansi` varchar(100) NOT NULL,
  PRIMARY KEY (`idsmasuk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `surattugas`
--

CREATE TABLE IF NOT EXISTS `surattugas` (
  `idlogin` int(11) NOT NULL,
  `idstugas` int(11) NOT NULL,
  `ketstatuspenunjukan` varchar(100) NOT NULL,
  `statusapppenunjukan` varchar(50) NOT NULL,
  `idpenunjukan` int(11) NOT NULL,
  PRIMARY KEY (`idpenunjukan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
