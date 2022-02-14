

INSERT INTO game (GAME_NAME, DEV_ID, RELEASE_DATE, CATEGORY) 
VALUES('$gameName',
	(SELECT dev_id from DEVELOPER where first_name = '$firstName' and last_name = '$lastName'),
	'$releaseDate',
	(select CATEGORY_ID from game_category where category_name like '%$categoryname%'))
	
	
	Select CONCAT(last_name, " ", first_name) as name from developer;
	
	
	
Select g.GAME_NAME, g.TIME_PLAYED, g.RELEASE_DATE, gc.CATEGORY_NAME, CONCAT(d.FIRST_NAME," ",d.LAST_NAME) as developer_name, corp.COMPANY_NAME 
FROM game g, developer d, game_category gc, company corp
WHERE g.DEV_ID = d.DEV_ID
AND g.CATEGORY = gc.CATEGORY_ID
AND d.STUDIO = corp.COMPANY_ID
AND g.GAME_ID = (SELECT GAME_ID FROM game WHERE GAME_NAME LIKE '%Call of Duty%')


UPDATE game
SET GAME_NAME = '[New Game Name]',
	RELEASE_DATE = '[New Release date]',
    TIME_PLAYED = '[New Played Time]',
    DEV_ID = (SELECT d.DEV_ID FROM developer d WHERE d.FIRST_NAME LIKE '%[New First Name]%' AND d.LAST_NAME LIKE '%[New Last Name]%'),
    CATEGORY = (SELECT c.CATEGORY_ID FROM game_category c WHERE c.CATEGORY_NAME LIKE '%New Category%'),
    UPDATE_DATE = SYSDATE()
WHERE GAME_ID = 
