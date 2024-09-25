ALTER TABLE `project` ADD `stunden` INT NOT NULL ;

ALTER TABLE `project` ADD deadlein date not null default current_date() ;

ALTER TABLE `project` ADD maxstunden int not null ;

SELECT p.*, COALESCE(SUM(m.stunden), 0) as stunden 
FROM `project` p 
LEFT JOIN mitarbeiter_stunden m ON m.projectid = p.id 
GROUP BY p.id 
ORDER BY p.id;

SELECT m.nutzername, m.projectid, p.titel, COALESCE(SUM(m.stunden), 0) as stunden 
FROM mitarbeiter_stunden m 
LEFT JOIN project p ON p.id = m.projectid 
GROUP BY m.nutzername, m.projectid, p.titel 
ORDER BY m.nutzername, m.projectid;
