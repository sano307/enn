-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- 생성 시간: 16-01-26 19:54
-- 서버 버전: 10.1.8-MariaDB
-- PHP 버전: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `mymvc`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `admin`
--

CREATE TABLE `admin` (
  `a_idx` int(10) UNSIGNED NOT NULL COMMENT '관리자 번호',
  `a_adminID` varchar(20) CHARACTER SET utf8 NOT NULL COMMENT '관리자 아이디\n',
  `a_adminPasswd` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '관리자 비밀번호\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='관리자 정보 관리';

-- --------------------------------------------------------

--
-- 테이블 구조 `admin_notice`
--

CREATE TABLE `admin_notice` (
  `n_idx` int(10) UNSIGNED NOT NULL COMMENT '공지사항 번호',
  `a_idx` int(10) UNSIGNED NOT NULL COMMENT '공지사항을 등록한 관리자의 고유번호',
  `n_noticeTitle` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT '공지사항의 제목',
  `n_noticeContent` text CHARACTER SET utf8 NOT NULL COMMENT '공지사항의 내용',
  `n_noticeRegistedTime` datetime NOT NULL COMMENT '공지사항이 등록된 시간'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='관리자 공지사항 글 관리 ';

-- --------------------------------------------------------

--
-- 테이블 구조 `buddy`
--

CREATE TABLE `buddy` (
  `b_idx` int(10) UNSIGNED NOT NULL COMMENT '친구코드',
  `m_idx` int(10) UNSIGNED NOT NULL COMMENT '회원코드',
  `b_requestedMember` varchar(50) NOT NULL COMMENT '신청한회원닉네임',
  `b_acceptanceStateBuddy` varchar(1) NOT NULL COMMENT '친구수락상태'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='친구정보';

-- --------------------------------------------------------

--
-- 테이블 구조 `camp`
--

CREATE TABLE `camp` (
  `c_idx` int(10) UNSIGNED NOT NULL COMMENT '그룹번',
  `m_idx` int(10) UNSIGNED NOT NULL,
  `c_campName` varchar(50) NOT NULL COMMENT '그룹',
  `c_campIntroduction` varchar(200) NOT NULL COMMENT '그룹 소개',
  `c_campRegion` varchar(50) NOT NULL COMMENT '그룹 지',
  `c_campImgName` varchar(255) DEFAULT NULL COMMENT '그룹대표이미지이름',
  `c_campImgExt` varchar(10) DEFAULT NULL COMMENT '그룹대표이미지확장자',
  `c_campThumbName` varchar(255) DEFAULT NULL COMMENT '그룹대표썸네일이',
  `c_campThumbExt` varchar(10) DEFAULT NULL COMMENT '그룹대표썸네일확장자',
  `c_campTheNumber` int(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='그룹정보관리';

-- --------------------------------------------------------

--
-- 테이블 구조 `camp_member`
--

CREATE TABLE `camp_member` (
  `cm_idx` int(10) UNSIGNED NOT NULL COMMENT '그룹 멤버 번',
  `m_idx` int(10) UNSIGNED NOT NULL COMMENT '그룹에 속한 회원의 고유번호',
  `c_idx` int(10) UNSIGNED NOT NULL COMMENT '그룹의 고유번호',
  `cm_joinStateCamp` varchar(1) COLLATE utf8_unicode_ci NOT NULL COMMENT '그룹가입상태'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='그룹멤버정보관리';

-- --------------------------------------------------------

--
-- 테이블 구조 `camp_notice`
--

CREATE TABLE `camp_notice` (
  `cn_idx` int(10) UNSIGNED NOT NULL COMMENT '그룹공지사항번호',
  `c_idx` int(10) UNSIGNED NOT NULL COMMENT '그룹 공지사항을 등록한 그룹의 고유번호',
  `cn_campNoticeTitle` varchar(255) NOT NULL COMMENT '그룹공지사항의 제목',
  `cn_campNoticeContent` text NOT NULL COMMENT '그룹 공지사항의 내용',
  `cn_campNoticeregistedTime` varchar(45) NOT NULL COMMENT '그룹 공지사항이 등록된 시간'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='그룹공지사항관리';

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `m_idx` int(10) UNSIGNED NOT NULL COMMENT '회원코드',
  `m_memberID` char(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '아이디',
  `m_memberPasswd` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '비밀번호',
  `m_nickname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '닉네임',
  `m_nationally` char(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '국적',
  `m_region` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '지역',
  `m_sex` char(1) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '성별',
  `m_profileImgName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '프로필사진이름',
  `m_profileImgExt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '프로필사진확장자',
  `m_profileThumbName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '프로필썸네일이름',
  `m_profileThumbExt` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '프로필썸네일확장자'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='회원정보';

-- --------------------------------------------------------

--
-- 테이블 구조 `nation_region`
--

CREATE TABLE `nation_region` (
  `nri_idx` int(10) NOT NULL,
  `nri_nation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nri_region` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='국가, 지역 정보';

--
-- 테이블의 덤프 데이터 `nation_region`
--

INSERT INTO `nation_region` (`nri_idx`, `nri_nation`, `nri_region`) VALUES
(1, 'korea', 'seoul'),
(2, 'korea', 'gwangju'),
(3, 'korea', 'daegu'),
(4, 'korea', 'daejeon'),
(5, 'korea', 'busan'),
(6, 'korea', 'ulsan'),
(7, 'korea', 'incheon'),
(8, 'korea', 'jeju'),
(9, 'korea', 'ulleung'),
(10, 'korea', 'dokdo'),
(11, 'japan', 'kagoshima'),
(12, 'japan', 'kobe'),
(13, 'japan', 'kyoto'),
(14, 'japan', 'kumamoto'),
(15, 'japan', 'nagano'),
(16, 'japan', 'nagoya'),
(17, 'japan', 'niigata'),
(18, 'japan', 'tokyo'),
(19, 'japan', 'matsuyama'),
(20, 'japan', 'miyazaki'),
(21, 'japan', 'sapporo'),
(22, 'japan', 'aomori'),
(23, 'japan', 'osaka'),
(24, 'japan', 'okinawa'),
(25, 'japan', 'yokohama'),
(26, 'japan', 'chiba'),
(27, 'japan', 'fukushima'),
(28, 'japan', 'fukuoka'),
(29, 'japan', 'hiroshima');

-- --------------------------------------------------------

--
-- 테이블 구조 `post`
--

CREATE TABLE `post` (
  `p_idx` int(10) UNSIGNED NOT NULL COMMENT '포스트 번호\n',
  `m_idx` int(10) UNSIGNED NOT NULL COMMENT '포스트를 등록한 회원의 고유번호\n',
  `c_idx` int(10) UNSIGNED DEFAULT NULL COMMENT '포스트가 등록된 그룹의 고유번호',
  `p_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '포스트 내용\n',
  `p_registedTime` datetime NOT NULL COMMENT '포스트 등록 시간\n',
  `p_postThumbName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_postThumbExt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `p_postHits` int(10) UNSIGNED NOT NULL COMMENT '포스트 조회 수\n',
  `p_postGoods` int(10) UNSIGNED NOT NULL COMMENT '포스트 좋아요 수\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='포스트 정보 관리';

-- --------------------------------------------------------

--
-- 테이블 구조 `post_attach`
--

CREATE TABLE `post_attach` (
  `pa_idx` int(10) UNSIGNED NOT NULL COMMENT '이미지 번호',
  `p_idx` int(10) UNSIGNED NOT NULL COMMENT '이미지가 등록된 포스트의 고유번호\n',
  `pa_postImgName` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '포스트에 등록된 이미지이름',
  `pa_postImgExt` varchar(10) COLLATE utf8_unicode_ci NOT NULL COMMENT '포스트에 등록된 이미지 확장자'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='이미지정보관리';

-- --------------------------------------------------------

--
-- 테이블 구조 `post_goods`
--

CREATE TABLE `post_goods` (
  `m_idx` int(10) UNSIGNED NOT NULL,
  `p_idx` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='포스트의 좋아요 클릭 정보';

-- --------------------------------------------------------

--
-- 테이블 구조 `post_reply`
--

CREATE TABLE `post_reply` (
  `pr_idx` int(10) UNSIGNED NOT NULL COMMENT '댓글번호',
  `m_idx` int(10) UNSIGNED NOT NULL COMMENT '댓글을 등록한 회원의 고유 번호',
  `p_idx` int(10) UNSIGNED NOT NULL COMMENT '댓글이 등록된 포스트의 고유 번호',
  `pr_content` text COLLATE utf8_unicode_ci NOT NULL COMMENT '댓글 내용',
  `pr_registedTime` datetime NOT NULL COMMENT '댓글 등록 시간'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_idx`);

--
-- 테이블의 인덱스 `admin_notice`
--
ALTER TABLE `admin_notice`
  ADD PRIMARY KEY (`n_idx`),
  ADD KEY `a_idx` (`a_idx`);

--
-- 테이블의 인덱스 `buddy`
--
ALTER TABLE `buddy`
  ADD PRIMARY KEY (`b_idx`),
  ADD KEY `m_idx` (`m_idx`);

--
-- 테이블의 인덱스 `camp`
--
ALTER TABLE `camp`
  ADD PRIMARY KEY (`c_idx`),
  ADD UNIQUE KEY `g_groupName_UNIQUE` (`c_campName`),
  ADD KEY `m_idx` (`m_idx`);

--
-- 테이블의 인덱스 `camp_member`
--
ALTER TABLE `camp_member`
  ADD PRIMARY KEY (`cm_idx`),
  ADD KEY `m_idx` (`m_idx`),
  ADD KEY `c_idx` (`c_idx`);

--
-- 테이블의 인덱스 `camp_notice`
--
ALTER TABLE `camp_notice`
  ADD PRIMARY KEY (`cn_idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`m_idx`),
  ADD UNIQUE KEY `m_nickname_UNIQUE` (`m_nickname`);

--
-- 테이블의 인덱스 `nation_region`
--
ALTER TABLE `nation_region`
  ADD PRIMARY KEY (`nri_idx`);

--
-- 테이블의 인덱스 `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`p_idx`),
  ADD KEY `m_idx` (`m_idx`),
  ADD KEY `c_idx` (`c_idx`);

--
-- 테이블의 인덱스 `post_attach`
--
ALTER TABLE `post_attach`
  ADD PRIMARY KEY (`pa_idx`),
  ADD KEY `p_idx` (`p_idx`);

--
-- 테이블의 인덱스 `post_goods`
--
ALTER TABLE `post_goods`
  ADD KEY `p_idx` (`p_idx`),
  ADD KEY `m_idx` (`m_idx`) USING BTREE,
  ADD KEY `m_idx_2` (`m_idx`,`p_idx`);

--
-- 테이블의 인덱스 `post_reply`
--
ALTER TABLE `post_reply`
  ADD PRIMARY KEY (`pr_idx`),
  ADD KEY `m_idx` (`m_idx`),
  ADD KEY `p_idx` (`p_idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `admin`
--
ALTER TABLE `admin`
  MODIFY `a_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '관리자 번호';
--
-- 테이블의 AUTO_INCREMENT `admin_notice`
--
ALTER TABLE `admin_notice`
  MODIFY `n_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '공지사항 번호';
--
-- 테이블의 AUTO_INCREMENT `buddy`
--
ALTER TABLE `buddy`
  MODIFY `b_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '친구코드';
--
-- 테이블의 AUTO_INCREMENT `camp`
--
ALTER TABLE `camp`
  MODIFY `c_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '그룹번';
--
-- 테이블의 AUTO_INCREMENT `camp_member`
--
ALTER TABLE `camp_member`
  MODIFY `cm_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '그룹 멤버 번';
--
-- 테이블의 AUTO_INCREMENT `camp_notice`
--
ALTER TABLE `camp_notice`
  MODIFY `cn_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '그룹공지사항번호';
--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `m_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '회원코드';
--
-- 테이블의 AUTO_INCREMENT `nation_region`
--
ALTER TABLE `nation_region`
  MODIFY `nri_idx` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- 테이블의 AUTO_INCREMENT `post`
--
ALTER TABLE `post`
  MODIFY `p_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '포스트 번호\n';
--
-- 테이블의 AUTO_INCREMENT `post_attach`
--
ALTER TABLE `post_attach`
  MODIFY `pa_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '이미지 번호';
--
-- 테이블의 AUTO_INCREMENT `post_reply`
--
ALTER TABLE `post_reply`
  MODIFY `pr_idx` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '댓글번호';
--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `admin_notice`
--
ALTER TABLE `admin_notice`
  ADD CONSTRAINT `notice_admin_fk` FOREIGN KEY (`a_idx`) REFERENCES `admin` (`a_idx`);

--
-- 테이블의 제약사항 `buddy`
--
ALTER TABLE `buddy`
  ADD CONSTRAINT `member_fk` FOREIGN KEY (`m_idx`) REFERENCES `member` (`m_idx`);

--
-- 테이블의 제약사항 `camp`
--
ALTER TABLE `camp`
  ADD CONSTRAINT `camp_member_fk` FOREIGN KEY (`m_idx`) REFERENCES `member` (`m_idx`);

--
-- 테이블의 제약사항 `camp_member`
--
ALTER TABLE `camp_member`
  ADD CONSTRAINT `cm_camp_fk` FOREIGN KEY (`c_idx`) REFERENCES `camp` (`c_idx`),
  ADD CONSTRAINT `cm_member_fk` FOREIGN KEY (`m_idx`) REFERENCES `member` (`m_idx`);

--
-- 테이블의 제약사항 `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `member_post_fk` FOREIGN KEY (`m_idx`) REFERENCES `member` (`m_idx`),
  ADD CONSTRAINT `post_attach_post_fk` FOREIGN KEY (`c_idx`) REFERENCES `camp` (`c_idx`);

--
-- 테이블의 제약사항 `post_attach`
--
ALTER TABLE `post_attach`
  ADD CONSTRAINT `post_postattach_fk` FOREIGN KEY (`p_idx`) REFERENCES `post` (`p_idx`);

--
-- 테이블의 제약사항 `post_goods`
--
ALTER TABLE `post_goods`
  ADD CONSTRAINT `post_goods_ibfk_1` FOREIGN KEY (`m_idx`,`p_idx`) REFERENCES `post` (`m_idx`, `p_idx`);

--
-- 테이블의 제약사항 `post_reply`
--
ALTER TABLE `post_reply`
  ADD CONSTRAINT `member_postreply_fk` FOREIGN KEY (`m_idx`) REFERENCES `member` (`m_idx`),
  ADD CONSTRAINT `post_postreply_fk` FOREIGN KEY (`p_idx`) REFERENCES `post` (`p_idx`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
