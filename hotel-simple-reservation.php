<?php
/**
 * Plugin Name: Hotel Simple Reservation 
 * Plugin URI: http://369usa.com
 * Description: This plugin handles hotel reservation
 * Version: 1.0.0
 * Author: Colin Zhao
 * Author URI: http://369usa.com
 * License: GPL2
 */

add_action( 'admin_menu', 'my_admin_menu' );

function my_admin_menu() {
	add_menu_page( 'Simple Hotel Reservation', 'Simple Hotel Reservation', 'edit_pages', 'hotel-simple-reservation/main.php', '', 'dashicons-tickets', -9999  );
	add_submenu_page( 'hotel-simple-reservation/main.php', 'Main Calendar', 'Main Calendar', 'edit_pages', 'hotel-simple-reservation/main.php' ) ;
	add_submenu_page( 'hotel-simple-reservation/main.php', 'Global Settings', 'Global Settings', 'edit_pages', 'hotel-simple-reservation/setting.php' ) ;
	add_submenu_page( 'hotel-simple-reservation/main.php', 'Bookings', 'Bookings', 'edit_pages', 'hotel-simple-reservation/orders.php' ) ;
	add_submenu_page( 'hotel-simple-reservation/main.php', 'Advanced', 'Advanced', 'edit_pages', 'hotel-simple-reservation/advanced.php' ) ;
	add_submenu_page( null, 'Custom Rule', 'Custom Rule', 'edit_pages', 'hotel-simple-reservation/rule.php' ) ;
}

/*
//INIT:
$wpdb->query("
CREATE TABLE IF NOT EXISTS `hsr_booking` (
  `Id` int(11) NOT NULL,
  `OrderId` int(11) NOT NULL,
  `BookDate` date NOT NULL,
  `RoomType` varchar(5) NOT NULL,
  `Adults` int(11) NOT NULL,
  `Children` int(11) NOT NULL,
  `Price` decimal(7,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `hsr_booking`
  ADD PRIMARY KEY (`Id`);
ALTER TABLE `hsr_booking`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
 ");
 
$wpdb->query("
CREATE TABLE IF NOT EXISTS `hsr_order` (
  `OrderId` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Note` text NOT NULL,
  `TransactionCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
ALTER TABLE `hsr_order`
  ADD PRIMARY KEY (`OrderId`);
ALTER TABLE `hsr_order`
  MODIFY `OrderId` int(11) NOT NULL AUTO_INCREMENT;
");
*/
