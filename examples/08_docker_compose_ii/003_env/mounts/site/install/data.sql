INSERT INTO `config` (`name`, `value`) VALUES
('site_name', 'My Site'); 

INSERT INTO `pages` (`title`, `content`) VALUES
('404', 'Page not found.'),
('Home', 'Welcome to my site!'),
('About', 'This is the about page.'),
('Contact', 'Contact me here.');

INSERT INTO `queries` (`query`, `page_id`) VALUES
('404', 1),
('index', 2),
('about', 3);