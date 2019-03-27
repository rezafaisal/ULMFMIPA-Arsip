/*
SQLyog Ultimate v12.09 (32 bit)
MySQL - 10.1.29-MariaDB : Database - arsip
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`arsip` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `arsip`;

/* Procedure structure for procedure `nested` */

/*!50003 DROP PROCEDURE IF EXISTS  `nested` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `nested`(PARAM_ID INT)
BEGIN
	DECLARE counter INTEGER;
	DECLARE max_counter INTEGER;
	DECLARE current_top INTEGER;
	SET counter = 2;
        SET max_counter = 2 * (SELECT COUNT(*) FROM folder WHERE group_id=PARAM_ID);
        SET current_top = 1;
        DROP TABLE IF EXISTS `tmp_tree`;
        CREATE TABLE `tmp_tree` (
		`emp`		CHAR(11) NOT NULL DEFAULT '0',
		boss 		INT(11)  DEFAULT NULL,
		`pemilik_id` 		INT(11) DEFAULT NULL,
		nama 			VARCHAR(100),
		`tgl_buat`       	DATETIME,
		`no_urut`      		INT(11)  UNSIGNED DEFAULT NULL,
		`group_id`      	INT(11)  UNSIGNED DEFAULT NULL,
		`jumlah_tree`      	INT(11)  UNSIGNED DEFAULT NULL
	    ) ENGINE = MEMORY;
	INSERT INTO tmp_tree 
		SELECT * FROM (
			SELECT 
				folder.folder_id ,
				folder.parent_id, 
				folder.pemilik_id, 
				folder.nama, 
				folder.tgl_buat, 
				folder.no_urut, 
				folder.group_id, 
				COUNT(arsip_in_folder.folder_id)
				FROM folder 
				LEFT JOIN arsip_in_folder ON arsip_in_folder.folder_id=folder.folder_id
				WHERE folder.group_id=PARAM_ID
				GROUP BY folder.folder_id
				order by folder.`no_urut` asc
		) AS insert_from_folder;
		
        DROP TABLE IF EXISTS `tmp_stack`;
        CREATE TABLE `tmp_stack` (
		stack_top INT(11),
		`emp`        CHAR(11) NOT NULL DEFAULT '0',
		`parent` INT(11)          DEFAULT NULL,
		nama VARCHAR(100),
		`lft`       INT(11)  UNSIGNED DEFAULT NULL,
		`rgt`      INT(11)  UNSIGNED DEFAULT NULL,
		`jumlah`      INT(11)  UNSIGNED DEFAULT NULL
	    ) ENGINE = MEMORY;
	INSERT INTO tmp_stack 
		SELECT 1, emp,boss, nama, 1, max_counter, 0 FROM tmp_tree WHERE boss IS NULL;
	DELETE FROM tmp_tree WHERE boss IS NULL;
        WHILE counter <= (max_counter -1) DO
            IF EXISTS (SELECT * FROM tmp_stack AS S1, tmp_tree AS T1 WHERE S1.emp = T1.boss AND S1.stack_top = current_top) THEN
                BEGIN
                    INSERT INTO tmp_stack
                    SELECT (current_top + 1),MIN(T1.emp), T1.boss, T1.nama, counter, NULL, T1.jumlah_tree
			FROM tmp_stack AS S1, tmp_tree AS T1 WHERE S1.emp = T1.boss AND S1.stack_top = current_top;
                    DELETE FROM tmp_tree WHERE emp=(SELECT emp FROM tmp_stack WHERE stack_top=current_top+1);
                    SET counter = counter + 1;
                    SET current_top = current_top + 1;
                END;
            ELSE
                BEGIN
                    UPDATE tmp_stack SET rgt=counter, stack_top=-stack_top WHERE stack_top = current_top;
                    SET counter = counter + 1;
                    SET current_top = current_top - 1;
                END;
            END IF;
        END WHILE;
        SELECT * from (select parent.stack_top,parent.emp, 
                    parent.nama_folder,
                    parent.lft,parent.rgt,
                    sum(node.jumlah_arsip) as total
            FROM (SELECT 
				tmp_stack.*, 
				COUNT(arsip_in_folder.folder_id) as jumlah_arsip
				FROM tmp_stack 
				LEFT JOIN arsip_in_folder ON arsip_in_folder.folder_id=tmp_stack.emp
				GROUP BY tmp_stack.emp) AS node, (SELECT tmp_stack.*, folder.nama AS nama_folder FROM tmp_stack JOIN folder ON tmp_stack.emp=folder.folder_id) AS parent
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
            GROUP BY parent.emp
            ORDER BY parent.lft asc) result;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
