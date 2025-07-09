create database sample;
use sample;
create table sample1(bname varchar(200),image varchar(255));
insert into sample1 values('ikigai','project/ikigai.jpeg');
insert into sample1 values('harry potter','project/harry.jpeg');
insert into sample1 values('the unspoken name','project/unspoken.jpeg');
insert into sample1 values ('alice in the wonderland','project/alice.jpeg');
insert into sample1 values ('wish i could tell you ','project/wish.jpeg');
insert into sample1 values('The Monk Who Sold His Ferrari','project/monk.jpeg');
insert into sample1 values('The Richest Man In Babylon','project/richest.jpeg');
insert into sample1 values('The Wealth Money Can\'t Buy','project/wealth.jpeg');
create table admin(username varchar(20),password varchar(20));
insert into admin values('ronick','ronick123'),('joshiga','joshiga123'),('maitreyan','maitreyan123'),('hemavarshini','hemavarshini123');
desc admin;
CREATE TABLE sample2 (id INT AUTO_INCREMENT PRIMARY KEY,bname VARCHAR(255) NOT NULL,image VARCHAR(255),publication_year INT,publication_name VARCHAR(255),author VARCHAR(255),overview TEXT);
CREATE TABLE sample3 (bname VARCHAR(255) NOT NULL,image VARCHAR(255),publication_year INT,publication_name VARCHAR(255),author VARCHAR(255),overview TEXT);
INSERT INTO sample3 VALUES (
    'Ikigai', 
    'project/ikigai.jpeg', 
    '2016', 
    'Penguin Audio', 
    'Francesc Miralles and Hector Garcia', 
    'The Japanese Secret to a Long and Happy Life explores the Japanese concept of ikigai, which translates to "a reason for being" or "a reason to wake up in the morning." The book combines personal anecdotes, interviews, and research to explain how finding one\'s ikigai can lead to a fulfilling and content life.'
);
alter table sample3 add pdf varchar(30);
create table admin1 (firstname varchar(20),lastname varchar(20),username varchar(20),password varchar(20),age integer,phoneno varchar(10), email varchar(30),country varchar(10));
insert into admin1 values('ronick','joshi','ronick','ronick123',19,9488818001,'ronickjoshi@gmail.com','india');
desc admin1;
select * from admin1;
drop table admin1;
delete from admin1 where firstname='hema';
delete from admin1 where firstname='joshiga';
alter table admin1 add subscribe varchar(30);
UPDATE sample3
SET pdf= 'project/ikigai.pdf'
WHERE bname = 'Ikigai';
select * from sample3;
SET SQL_SAFE_UPDATES = 0;
INSERT INTO sample3 VALUES (
    'Wish I Could Tell You',
    'project/wish.jpeg',
    '2019',
    'Penguin Random House India',
    'Durjoy Datta',
    'A heart-wrenching love story that explores the deep emotions and struggles of the characters as they navigate through love and loss in the digital age.'
    'project/wish.pdf'
);
INSERT INTO sample3 VALUES (
    'Wish I Could Tell You',
    'project/wish.jpeg',
    '2019',
    'Penguin Random House India',
    'Durjoy Datta',
    'A heart-wrenching love story that explores the deep emotions and struggles of the characters as they navigate through love and loss in the digital age.',
    'project/wish.pdf'
);
alter table sample3 add genre varchar(30);
alter table sample3 add type varchar(30);
UPDATE sample3 SET genre='Philosophy' WHERE bname = 'Ikigai';
UPDATE sample3 SET type ='non-fiction' WHERE bname = 'Ikigai';
UPDATE sample3 SET genre='romance' WHERE bname = 'Wish I Could Tell You';
UPDATE sample3 SET type='fiction' WHERE bname = 'Wish I Could Tell You';
INSERT INTO sample3 VALUES (
    'The Unspoken Name',
    'project/unspoken.jpeg',
    '2020',
    'Tor Books',
    'A.K. Larkwood',
    'A fantasy novel that follows Csorwe, a young orc priestess who escapes her doomed fate to serve a mysterious and powerful wizard, embarking on a journey filled with adventure and dark secrets.',
    'project/book2.pdf',
    'Fantasy',
    'Fiction'
);
ALTER TABLE admin1
ADD COLUMN subscribe1 DEFAULT 0,
ADD COLUMN subscription_start DATE,
ADD COLUMN subscription_end DATE;
SHOW COLUMNS FROM admin1;
ALTER TABLE admin1
ADD COLUMN subscribe1 TINYINT DEFAULT 0,
ADD COLUMN subscription_start DATE,
ADD COLUMN subscription_end DATE;
INSERT INTO sample3 VALUES (
    'The Unspoken Name',
    'project/the_unspoken_name.jpeg',
    '2020',
    'Tor Books',
    'A.K. Larkwood',
    'A fantasy novel that follows Csorwe, a young orc priestess who escapes her doomed fate to serve a mysterious and powerful wizard, embarking on a journey filled with adventure and dark secrets.',
    'project/unspoken_name.pdf',
    'Fantasy',
    'Fiction'
);
delete from sample3 where bname="The Unspoken Name";
delete from sample1 where bname="The Unspoken Name";
delete from sample1 where bname="The Wealth Money Can\'t Buy";
delete from sample3 where bname="Wish I Could Tell You";
delete from sample1 where bname="wish i could tell you";

INSERT INTO sample3 VALUES (
    'Wish I Could Tell You',
    'project/wish.jpeg',
    '2019',
    'Penguin Random House India',
    'Durjoy Datta',
    'A heart-wrenching love story that explores the deep emotions and struggles of the characters as they navigate through love and loss in the digital age.',
    'project/wish.pdf'
);
INSERT INTO sample3 VALUES (
    'wish i could tell you',
    'project/wish.jpeg',
    '2019',
    'Penguin Random House India',
    'Durjoy Datta',
    'A heart-wrenching love story that explores the deep emotions and struggles of the characters as they navigate through love and loss in the digital age.',
    'project/book2.pdf',
    'romance',
    'fiction'
);
select * from sample3;