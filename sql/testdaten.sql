INSERT INTO `project` (`id`, `titel`, `grad`, `deadlein`, `maxstunden`) VALUES 
(NULL, 'Mit rot', '0', curdate(), '10');

INSERT INTO `mitarbeiter_stunden` (`id`, `projectid`, `nutzername`, `stunden`) VALUES 
(NULL, '1', 'Tom', '3'), 
(NULL, '1', 'Jan', '4');