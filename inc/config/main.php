<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/config/constants.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/AddressVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/CommentVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/GolfclubVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/GolferVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/LessonVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/NotificationVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/PhotoVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/TeachproVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/UserVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/UserContactSubmissionVO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/vo/VideoVO.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/AddressDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/NotificationDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/CommentDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/GolfclubDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/LessonDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/UserDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/PhotoDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/TeachproDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/GolferDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/model/data/dao/VideoDAO.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/view/util/ViewUtilities.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/class/controller/util/ControllerUtilities.php';
session_start();